<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var common\models\app\BlogPostLookupCategorySearch $searchModel
*/

$this->title = 'Blog Post Lookup Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="blog-post-lookup-category-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Blog Post Lookup Category', ['create'], ['class' => 'btn btn-success']) ?>
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
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Blog Post</i>',
        'url' => [
            'crud/blog-post/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Blog Category</i>',
        'url' => [
            'crud/blog-category/index',
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
                return yii\helpers\Html::a($rel->default_title,["/crud/category/view","id" => $rel->id]);
            },
            "format" => "raw",
            "filter" => yii\helpers\ArrayHelper::map(
                common\models\starrag\Category::find()->all(),'id','default_title'
            )
        ],
			'post_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['nowrap'=>'nowrap']
            ],
        ],
    ]); ?>
    
</div>
