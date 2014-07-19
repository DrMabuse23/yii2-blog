<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var common\models\app\BlogPost $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="blog-post-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?= $form->field($model, 'default_title')->textInput(['maxlength' => 128]) ?>
			<?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>
			<?=         $form->field($model, 'author_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(common\models\app\BlogAuthor::find()->all(),'id','name'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel($model, 'author_id', []).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['crud/blog-author/create'],
                ['target'=>'_blank']
            )
        ); ?>
			<?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>
			<?=         $form->field($model, 'status')->dropDownList(
            \yii\helpers\ArrayHelper::map(common\models\app\BlogStatus::find()->all(),'id','name'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel($model, 'status', []).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['crud/blog-status/create'],
                ['target'=>'_blank']
            )
        ); ?>
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
    'label'   => 'BlogPost',
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
