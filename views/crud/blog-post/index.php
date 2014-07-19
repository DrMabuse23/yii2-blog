<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var common\models\app\BlogPostSearch $searchModel
*/

$this->title = 'Blog Posts';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="blog-post-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Blog Post', ['create'], ['class' => 'btn btn-success']) ?>
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
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Blog Comment</i>',
        'url' => [
            'crud/blog-comment/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Blog Status</i>',
        'url' => [
            'crud/blog-status/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Blog Author</i>',
        'url' => [
            'crud/blog-author/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Blog Post Content</i>',
        'url' => [
            'crud/blog-post-content/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-random"> Blog Post Lookup Category</i>',
        'url' => [
            'crud/blog-post-lookup-category/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Blog Category</i>',
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
        
			'id',
			'default_title',
			'slug',
			'tags:ntext',
			'status',
			'css_class',
			'readmore_length',
			/*'author_id'*/
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['nowrap'=>'nowrap']
            ],
        ],
    ]); ?>
    
</div>
