<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var common\models\app\BlogPostLookupCategory $model
*/

$this->title = 'Blog Post Lookup Category View ' . $model->category_id . '';
$this->params['breadcrumbs'][] = ['label' => 'Blog Post Lookup Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->category_id, 'url' => ['view', 'category_id' => $model->category_id, 'post_id' => $model->post_id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="blog-post-lookup-category-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'category_id' => $model->category_id, 'post_id' => $model->post_id],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Blog Post Lookup Category', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->category_id ?>    </h3>


    <?php $this->beginBlock('common\models\app\BlogPostLookupCategory'); ?>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
    'category_id',
'post_id',
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
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> BlogPostLookupCategory',
    'content' => $this->blocks['common\models\app\BlogPostLookupCategory'],
    'active'  => true,
], ]
                 ]
    );
    ?></div>
