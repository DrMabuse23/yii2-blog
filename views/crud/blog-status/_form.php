<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var common\models\app\BlogStatus $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="blog-status-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>
			<?= $form->field($model, 'code')->textInput() ?>
			<?= $form->field($model, 'type')->textInput(['maxlength' => 128]) ?>
			<?= $form->field($model, 'position')->textInput() ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'BlogStatus',
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
