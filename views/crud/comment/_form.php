<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\Comment $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
			<?=         $form->field($model, 'post_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(drmabuse\blog\models\app\Post::find()->all(),'id','default_title'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel($model, 'post_id', []).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['crud/post/create'],
                ['target'=>'_blank']
            )
        ); ?>
			<?= $form->field($model, 'publish_status')->textInput() ?>
			<?= $form->field($model, 'create_time')->textInput() ?>
			<?= $form->field($model, 'author')->textInput(['maxlength' => 128]) ?>
			<?= $form->field($model, 'email')->textInput(['maxlength' => 128]) ?>
			<?= $form->field($model, 'url')->textInput(['maxlength' => 128]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'Comment',
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
