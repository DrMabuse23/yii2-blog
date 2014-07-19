<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\Post $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?= $form->field($model, 'default_title')->textInput(['maxlength' => 128]) ?>
			<?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>
			<?=         $form->field($model, 'status_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(drmabuse\blog\models\app\Status::find()->all(),'id','name'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel($model, 'status_id', []).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['crud/status/create'],
                ['target'=>'_blank']
            )
        ); ?>
			<?=         $form->field($model, 'author_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(drmabuse\blog\models\app\Author::find()->all(),'id','name'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel($model, 'author_id', []).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['crud/author/create'],
                ['target'=>'_blank']
            )
        ); ?>
			<?=         $form->field($model, 'seo_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(drmabuse\blog\models\app\Seo::find()->all(),'id','default_title'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel($model, 'seo_id', []).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['crud/seo/create'],
                ['target'=>'_blank']
            )
        ); ?>
			<?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'readmore_length')->textInput() ?>
			<?= "" ?>
			<?= "" ?>
			<?= $form->field($model, 'css_class')->textInput(['maxlength' => 5]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'Post',
    'content' => $this->blocks['main'],
    'active'  => true,
], ]
                 ]
    );
    ?>
        <hr/>

        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> '.($model->isNewRecord ? 'Create' : 'Save'), ['class' => $model->isNewRecord ?
        'btn btn-primary' : 'btn btn-primary']) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
