<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\BlogCategory $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="blog-category-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?= $form->field($model, 'default_title')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'rank')->textInput() ?>
			<?=         $form->field($model, 'seo_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(drmabuse\blog\models\app\BlogSeo::find()->all(),'id','default_title'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel($model, 'seo_id', []).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['crud/blog-seo/create'],
                ['target'=>'_blank']
            )
        ); ?>
			<?= $form->field($model, 'default_content')->textarea(['rows' => 6]) ?>
			<?= "" ?>
			<?= "" ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'BlogCategory',
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
