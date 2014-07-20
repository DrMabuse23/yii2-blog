<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\File $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="file-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?= $form->field($model, 'path')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'mime_type')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'folder')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'deleted')->textInput() ?>
			<?= $form->field($model, 'name_id')->textInput(['maxlength' => 64]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'File',
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
