<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var common\models\app\BlogAuthor $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="blog-author-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>
			<?= "" ?>
			<?= "" ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'BlogAuthor',
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
