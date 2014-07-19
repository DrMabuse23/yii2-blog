<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var drmabuse\blog\models\app\PostLookupCategorySearch $searchModel
*/

$this->title = 'Post Lookup Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="post-lookup-category-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Post Lookup Category', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="pull-right">


                                                                                
            <?php             echo \yii\bootstrap\ButtonDropdown::widget(
                [
                    'id'       => 'giiant-relations',
                    'encodeLabel' => false,
                    'label'    => '<span class="glyphicon glyphicon-paperclip"></span> Relations',
                    'dropdown' => [
                        'options'      => [
                            'class' => 'dropdown-menu-right'
                        ],
                        'encodeLabels' => false,
                        'items'        => [
    [
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Post</i>',
        'url' => [
            'crud/post/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Category</i>',
        'url' => [
            'crud/category/index',
        ],
    ],
]                    ],
                ]
            );
            ?>        </div>
    </div>

            <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        
			[
            "class" => yii\grid\DataColumn::className(),
            "attribute" => "category_id",
            "value" => function($model){
                $rel = $model->getCategory()->one();

                return !is_null($rel)
                    ?yii\helpers\Html::a($rel->default_title,["/blog/crud/category/view","id" => $rel->id])
                    :"n-a";
            },
            "format" => "raw",
            "filter" => yii\helpers\ArrayHelper::map(
                drmabuse\blog\models\app\Category::find()->all(),'id','default_title'
            )
        ],
			[
            "class" => yii\grid\DataColumn::className(),
            "attribute" => "post_id",
            "value" => function($model){
                $rel = $model->getPost()->one();

                return !is_null($rel)
                    ?yii\helpers\Html::a($rel->default_title,["/blog/crud/post/view","id" => $rel->id])
                    :"n-a";
            },
            "format" => "raw",
            "filter" => yii\helpers\ArrayHelper::map(
                drmabuse\blog\models\app\Post::find()->all(),'id','default_title'
            )
        ],
            [
                'class' => 'common\helpers\ActionColumn',
                'contentOptions' => ['nowrap'=>'nowrap']
            ],
        ],
    ]); ?>
    
</div>
