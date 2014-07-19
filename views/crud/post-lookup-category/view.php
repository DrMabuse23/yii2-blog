<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\PostLookupCategory $model
*/

$this->title = 'Post Lookup Category View ' . $model->category_id . '';
$this->params['breadcrumbs'][] = ['label' => 'Post Lookup Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->category_id, 'url' => ['view', 'category_id' => $model->category_id, 'post_id' => $model->post_id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="post-lookup-category-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'category_id' => $model->category_id, 'post_id' => $model->post_id],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Post Lookup Category', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->category_id ?>    </h3>


    <?php $this->beginBlock('drmabuse\blog\models\app\PostLookupCategory'); ?>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
    // generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
[
    'format'=>'html',
    'attribute'=>'category_id',
    'value' => ($model->getCategory()->one() ? Html::a($model->getCategory()->one()->default_title, ['crud/category/view', 'id' => $model->getCategory()->one()->id,]) : ''),
],
// generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
[
    'format'=>'html',
    'attribute'=>'post_id',
    'value' => ($model->getPost()->one() ? Html::a($model->getPost()->one()->default_title, ['crud/post/view', 'id' => $model->getPost()->one()->id,]) : ''),
],
    ],
    ]); ?>

    <hr/>

    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'category_id' => $model->category_id, 'post_id' => $model->post_id],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
    'data-method' => 'post',
    ]); ?>

    <?php $this->endBlock(); ?>


    
    <?=
    \yii\bootstrap\Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [ [
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> PostLookupCategory',
    'content' => $this->blocks['drmabuse\blog\models\app\PostLookupCategory'],
    'active'  => true,
], ]
                 ]
    );
    ?></div>
