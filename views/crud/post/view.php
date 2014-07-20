<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\Post $model
*/

$this->title = 'Post View ' . $model->id . '';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="post-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Post', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->default_title ?>    </h3>


    <?php $this->beginBlock('drmabuse\blog\models\app\Post'); ?>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
    'id',
'default_title',
'slug',
'tags:ntext',
// generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
[
    'format'=>'html',
    'attribute'=>'status_id',
    'value' => ($model->getStatus()->one() ? Html::a($model->getStatus()->one()->name, ['crud/status/view', 'id' => $model->getStatus()->one()->id,]) : ''),
],
// generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
[
    'format'=>'html',
    'attribute'=>'author_id',
    'value' => ($model->getAuthor()->one() ? Html::a($model->getAuthor()->one()->name, ['crud/author/view', 'id' => $model->getAuthor()->one()->id,]) : ''),
],
// generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
[
    'format'=>'html',
    'attribute'=>'seo_id',
    'value' => ($model->getSeo()->one() ? Html::a($model->getSeo()->one()->default_title, ['crud/seo/view', 'id' => $model->getSeo()->one()->id,]) : ''),
],
'readmore_length',
'css_class',
'created_at',
'updated_at',
    ],
    ]); ?>

    <hr/>

    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'id' => $model->id],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
    'data-method' => 'post',
    ]); ?>

    <?php $this->endBlock(); ?>


    
<?php $this->beginBlock('Comments'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Comments',
            ['crud/comment/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Comment',
            ['crud/comment/create', 'Comment'=>['post_id'=>$model->id]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-Comments','linkSelector'=>'#pjax-Comments ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getComments(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'id',
"content:html",
			'publish_status',
			'create_time:datetime',
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'buttons'    => [
        
    ],
    'controller' => 'crud/comment'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('PostContents'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Post Contents',
            ['crud/post-content/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Post Content',
            ['crud/post-content/create', 'PostContent'=>['post_id'=>$model->id]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-PostContents','linkSelector'=>'#pjax-PostContents ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getPostContents(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'id',
			'default_title',
			'rank',
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'buttons'    => [
        
    ],
    'controller' => 'crud/post-content'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('Categories'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Categories',
            ['crud/category/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Category',
            ['crud/category/create', 'Category'=>['id'=>$model->id]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-link"></span> Attach Category', ['crud/post-lookup-category/create', 'PostLookupCategory'=>['post_id'=>$model->id]],
            ['class'=>'btn btn-info btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-Categories','linkSelector'=>'#pjax-Categories ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getPostLookupCategories(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [[
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
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {delete}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'buttons'    => [
        'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                    'class' => 'text-danger',
                    'title' => Yii::t('yii', 'Remove'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete the related item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]);
            },
'view' => function ($url, $model) {
                return Html::a(
                    '<span class="glyphicon glyphicon-cog"></span>',
                    $url,
                    [
                        'data-title'  => Yii::t('yii', 'View Pivot Record'),
                        'data-toggle' => 'tooltip',
                        'data-pjax'   => '0',
                        'class'        => 'text-muted'
                    ]
                );
            },
    ],
    'controller' => 'crud/post-lookup-category'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


    <?=
    \yii\bootstrap\Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [ [
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> Post',
    'content' => $this->blocks['drmabuse\blog\models\app\Post'],
    'active'  => true,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Comments</small>',
    'content' => $this->blocks['Comments'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Post Contents</small>',
    'content' => $this->blocks['PostContents'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Categories</small>',
    'content' => $this->blocks['Categories'],
    'active'  => false,
], ]
                 ]
    );
    ?></div>
