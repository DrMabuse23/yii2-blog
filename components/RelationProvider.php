<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 14.03.14
 * Time: 10:21
 */

namespace drmabuse\blog\components;

use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\helpers\VarDumper;


\Yii::$container->set(
    'schmunk42\giiant\crud\providers\CallbackProvider',
    [
        'attributeFormats' => [
            'default_html' => function ($column, $model) {
                return "['format'=>'html','attribute'=>'default_html',]";
            }
        ],
    ]
);

class RelationProvider extends \schmunk42\giiant\base\Provider
{

    /**
     * form relations
     * @var array
     */
    public $nameAttributes = [
        'common\models\app\BlogCategory' => 'default_title',
        'common\models\app\BlogPost' => 'default_title',
        'common\models\app\BlogAuthor' => 'name',
        'common\models\app\BlogPostContent' => 'default_title',
        'common\models\app\BlogComment' => 'author',
    ];

    /**
     * Grid Columns
     * @var array
     */
    public $columnAttributes = [
        'category_id' => [
            'standard' => ['category', 'default_title']
        ],
        'post_id' => [
            'standard' => ['post', 'default_title']
        ],
        'author_id' => [
            'standard' => ['author', 'name']
        ]
    ];

    /**
     * @param $attr //'gallery_id'
     * @param $relationQuery //getGallery()
     * @param $path // path /crud/$path/view
     * @param $filterModel //Gallery
     *
     * @return string
     */
    public static function getStandardFilterColumn($attr, $output)
    {
        return '[
            "class" => yii\\grid\\DataColumn::className(),
            "attribute" => "' . $attr . '_id",
            "value" => function($model){
                $rel = $model->get' . ucfirst($attr) . '()->one();

                return !is_null($rel)
                    ?yii\helpers\Html::a($rel->' . $output . ',["/blog/crud/' . $attr . '/view","id" => $rel->id])
                    :"n-a";
            },
            "format" => "raw",
            "filter" => yii\helpers\ArrayHelper::map(
                drmabuse\blog\models\app\\' . ucfirst($attr) . '::find()->all(),\'id\',\'' . $output . '\'
            )
        ]';
    }

    public function activeField($column)
    {
        $attribute = $column->name;

        switch ($attribute) {
            case 'created_at':
            case 'updated_at':
                return '""'; // TODO: should be able to return false
            case 'default_html':
            case 'default_content':
                return
" \$form->field(\$model, '".$attribute."')->widget(\\drmabuse\\blog\\extensions\\sirtrevorjs\\SirTrevorWidget::className()) ";
            case 'default_technical_data_json':
                $code = $this->DataJsonWidget();
                return $code;
        }

        if (!isset($this->generator->getTableSchema()->columns[$attribute])) {
            return \Yii::$app->log->logger->log($attribute . ' is not defined', 10, 'not-exist-attribute');
        }
        $column = $this->generator->getTableSchema()->columns[$attribute];
        $relation = $this->generator->getRelationByColumn($this->generator->modelClass, $column);

        if ($relation) {
            \Yii::$app->log->logger->log(Json::encode($relation->modelClass), 10, 'relation-column');

            if (isset($this->nameAttributes[$relation->modelClass])) {
                $name = $this->nameAttributes[$relation->modelClass];
                \Yii::$app->log->logger->log($name, 10, 'name-column');
            } else {
                $name = $this->generator->getNameAttribute($relation->modelClass);
            }

            switch (true) {
                case (!$relation->multiple):
                    $code = $this->dropdown($column, $relation, $name);
                    return $code;
                    break;
                case ($relation->multiple):
                    return null;
                default:
                    return null;

            }
        }
    }

    /**
     * Generate Special GridColumns
     *
     * @param $column
     *
     * @return mixed
     */
    public function columnFormat($column)
    {
        switch ($column->name) {
            case 'created_at':
            case 'updated_at':
            case 'default_content':
            case 'author':
            case 'email':
            case 'url':
            case 'css_class':
            case 'seo_id':
            case 'readmore_length':
            case 'tags':
                return false;
            case 'content':
            case 'default_html':
                return '"' . $column->name . ':html"';
            case 'slug':
                //                return '"'.$column->name.':url"';
                return false;
            case 'status_id':
                return $this->getStatus($column);

        }

        if (isset($this->columnAttributes[$column->name])) {
            if (isset($this->columnAttributes[$column->name]['standard'])) {
                $column = $this->columnAttributes[$column->name]['standard'];
                return $this->getStandardFilterColumn($column[0], $column[1]);
            } else {
                return $this->columnAttributes[$column->name];
            }
        }
    }

    /**
     * creates a Relation Dropdown
     *
     * @param $columnname
     * @param $relationmodelClass
     * @param $name
     *
     * @return string
     */
    public function dropdown($column, $relation, $name)
    {

        $options = "[]";
        $route = $this->generator->pathPrefix . Inflector::camel2id(
                $this->generator->generateRelationTo($relation),
                '-',
                true
            );
        $label = $this->generator->getModelNameAttribute($relation->modelClass);
        return <<<EOS
        \$form->field(\$model, '{$column->name}')->dropDownList(
            \yii\helpers\ArrayHelper::map({$relation->modelClass}::find()->all(),'id','{$label}'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel(\$model, '{$column->name}', {$options}).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['{$route}/create'],
                ['target'=>'_blank']
            )
        );
EOS;
    }

    public function DataJsonWidget()
    {
        return <<<EOS
        \$form->field(\$model, 'default_technical_data_json')->widget(
            backend\\extensions\\machineDataJson\\DataJsonWidget::className(),
            [
                'model'     => \$model,
                'attribute' => 'default_technical_data_json'
            ]
        );
EOS;
    }


    public function getStatus($column)
    {
        //        VarDumper::dump($column);
        //        exit;
        return
            '[
            "class" => yii\\grid\\DataColumn::className(),
            "attribute" => "' . $column->name . '",
            "value" => function($model){

                if($model->getRelation("comments")){
                    if(!$model->status_id == null){
                        return $model->getStatus()->one()->name;
                    }
                }
            },
            "format" => "raw",
            "filter" => yii\helpers\ArrayHelper::map(
                drmabuse\blog\models\app\\Status::find()->where(["type" => "PostStatus"])->orderby("position ASC")->all(),\'id\',\'name\'
            )
        ]';
    }
}