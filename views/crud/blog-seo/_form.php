<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\BlogSeo $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="blog-seo-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?= $form->field($model, 'default_title')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'default_keywords')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'default_description')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'default_meta_json')->textarea(['rows' => 6]) ?>
			<?= "" ?>
			<?= "" ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'BlogSeo',
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
