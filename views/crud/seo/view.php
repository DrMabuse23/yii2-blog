<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\Seo $model
*/

$this->title = 'Seo View ' . $model->id . '';
$this->params['breadcrumbs'][] = ['label' => 'Seos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="seo-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Seo', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->default_title ?>    </h3>


    <?php $this->beginBlock('drmabuse\blog\models\app\Seo'); ?>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
    'id',
'default_title',
'default_keywords:ntext',
'default_description:ntext',
'default_meta_json:ntext',
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


    
<?php $this->beginBlock('Categories'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Categories',
            ['crud/category/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Category',
            ['crud/category/create', 'Category'=>['seo_id'=>$model->id]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-Categories','linkSelector'=>'#pjax-Categories ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getCategories(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'id',
			'default_title',
			'rank',
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'buttons'    => [
        
    ],
    'controller' => 'crud/category'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('Posts'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Posts',
            ['crud/post/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Post',
            ['crud/post/create', 'Post'=>['seo_id'=>$model->id]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-Posts','linkSelector'=>'#pjax-Posts ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getPosts(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'id',
			'default_title',
[
            "class" => yii\grid\DataColumn::className(),
            "attribute" => "status_id",
            "value" => function($model){

                if($model->getRelation("comments")){
                    if(!$model->status_id == null){
                        return $model->getStatus()->one()->name;
                    }
                }
            },
            "format" => "raw",
            "filter" => yii\helpers\ArrayHelper::map(
                drmabuse\blog\models\app\Status::find()->where(["type" => "PostStatus"])->orderby("position ASC")->all(),'id','name'
            )
        ],
[
            "class" => yii\grid\DataColumn::className(),
            "attribute" => "author_id",
            "value" => function($model){
                $rel = $model->getAuthor()->one();

                return !is_null($rel)
                    ?yii\helpers\Html::a($rel->name,["/blog/crud/author/view","id" => $rel->id])
                    :"n-a";
            },
            "format" => "raw",
            "filter" => yii\helpers\ArrayHelper::map(
                drmabuse\blog\models\app\Author::find()->all(),'id','name'
            )
        ],
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'buttons'    => [
        
    ],
    'controller' => 'crud/post'
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
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> Seo',
    'content' => $this->blocks['drmabuse\blog\models\app\Seo'],
    'active'  => true,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Categories</small>',
    'content' => $this->blocks['Categories'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Posts</small>',
    'content' => $this->blocks['Posts'],
    'active'  => false,
], ]
                 ]
    );
    ?></div>
