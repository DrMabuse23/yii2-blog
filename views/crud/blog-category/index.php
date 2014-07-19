<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var common\models\app\BlogCategorySearch $searchModel
*/

$this->title = 'Blog Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="blog-category-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Blog Category', ['create'], ['class' => 'btn btn-success']) ?>
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
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Blog Seo</i>',
        'url' => [
            'crud/blog-seo/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-random"> Blog Post Lookup Category</i>',
        'url' => [
            'crud/blog-post-lookup-category/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Blog Post</i>',
        'url' => [
            'crud/blog-post/index',
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
        
			'id',
			'default_title',
			'default_content:ntext',
			'slug',
			'rank',
			'seo_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['nowrap'=>'nowrap']
            ],
        ],
    ]); ?>
    
</div>
