<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var drmabuse\blog\models\app\BlogPostLookupCategory $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="blog-post-lookup-category-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            
			<?=         $form->field($model, 'category_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(drmabuse\blog\models\app\BlogCategory::find()->all(),'id','default_title'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel($model, 'category_id', []).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['crud/blog-category/create'],
                ['target'=>'_blank']
            )
        ); ?>
			<?=         $form->field($model, 'post_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(drmabuse\blog\models\app\BlogPost::find()->all(),'id','default_title'),
            ['prompt'=>'Choose...']    // relation provider
        )->label(
            Html::activeLabel($model, 'post_id', []).' '.
            Html::a(
                '<span class="glyphicon glyphicon-plus-sign"></span>',
                ['crud/blog-post/create'],
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
    'label'   => 'BlogPostLookupCategory',
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
