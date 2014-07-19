<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\PostLookupCategory $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="post-lookup-category-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?=         $form->field($model, 'category_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(drmabuse\blog\models\app\Category::find()->all(),'id','default_title'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel($model, 'category_id', []).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['crud/category/create'],
                ['target'=>'_blank']
            )
        ); ?>
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
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'PostLookupCategory',
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
