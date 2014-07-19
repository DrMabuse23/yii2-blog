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
'status',
'css_class',
'readmore_length',
'author_id',
'seo_id',
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
<?= ?>
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
<?= ?>
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
<?= ?>
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
