<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var common\models\app\BlogCommentSearch $searchModel
*/

$this->title = 'Blog Comments';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="blog-comment-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Blog Comment', ['create'], ['class' => 'btn btn-success']) ?>
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
			'content:ntext',
			'status',
			'create_time:datetime',
			'author',
			'email:email',
			'url:url',
			/*'post_id'*/
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['nowrap'=>'nowrap']
            ],
        ],
    ]); ?>
    
</div>
