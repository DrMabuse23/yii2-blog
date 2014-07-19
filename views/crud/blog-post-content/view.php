<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var common\models\app\BlogPostContent $model
*/

$this->title = 'Blog Post Content View ' . $model->id . '';
$this->params['breadcrumbs'][] = ['label' => 'Blog Post Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="blog-post-content-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Blog Post Content', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->default_title ?>    </h3>


    <?php $this->beginBlock('common\models\app\BlogPostContent'); ?>

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


    
<?php $this->beginBlock('BlogComments'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Blog Comments',
            ['crud/blog-comment/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Blog Comment',
            ['crud/blog-comment/create', 'BlogComment'=>['post_id'=>$model->id]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-BlogComments','linkSelector'=>'#pjax-BlogComments ul.pagination a']) ?>
<?= ?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('BlogPostContents'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Blog Post Contents',
            ['crud/blog-post-content/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Blog Post Content',
            ['crud/blog-post-content/create', 'BlogPostContent'=>['post_id'=>$model->id]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-BlogPostContents','linkSelector'=>'#pjax-BlogPostContents ul.pagination a']) ?>
<?= ?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('Categories'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Categories',
            ['crud/blog-category/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Category',
            ['crud/blog-category/create', 'Category'=>['id'=>$model->id]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-link"></span> Attach Category', ['crud/blog-post-lookup-category/create', 'BlogPostLookupCategory'=>['post_id'=>$model->id]],
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
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> BlogPostContent',
    'content' => $this->blocks['common\models\app\BlogPostContent'],
    'active'  => true,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Blog Comments</small>',
    'content' => $this->blocks['BlogComments'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Blog Post Contents</small>',
    'content' => $this->blocks['BlogPostContents'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Categories</small>',
    'content' => $this->blocks['Categories'],
    'active'  => false,
], ]
                 ]
    );
    ?></div>
