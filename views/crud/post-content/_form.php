<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\PostContent $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="post-content-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => false,'options' => ['enctype'=>"multipart/form-data"]]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?=  $form->field($model, 'default_html')->widget(\drmabuse\blog\extensions\sirtrevorjs\SirTrevorWidget::className())  ?>
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
			<?= $form->field($model, 'rank')->textInput() ?>
			<?= $form->field($model, 'default_title')->textInput(['maxlength' => 255]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'PostContent',
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
