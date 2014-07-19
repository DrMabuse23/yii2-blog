<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var drmabuse\blog\models\app\PostSearch $searchModel
*/

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="post-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Post', ['create'], ['class' => 'btn btn-success']) ?>
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
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Comment</i>',
        'url' => [
            'crud/comment/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Status</i>',
        'url' => [
            'crud/status/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Author</i>',
        'url' => [
            'crud/author/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Seo</i>',
        'url' => [
            'crud/seo/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Post Content</i>',
        'url' => [
            'crud/post-content/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-random"> Post Lookup Category</i>',
        'url' => [
            'crud/post-lookup-category/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Category</i>',
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
        
			'id',
			'default_title',
			'slug',
			'tags:ntext',
			'status',
			'css_class',
			'readmore_length',
			/*'author_id'*/
			/*'seo_id'*/
            [
                'class' => 'common\helpers\ActionColumn',
                'contentOptions' => ['nowrap'=>'nowrap']
            ],
        ],
    ]); ?>
    
</div>
