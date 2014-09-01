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

    <?php $form = ActiveForm::begin(
        [
            'enableClientValidation' => false
        ]

    ); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>
        <p>
            <?php \yii\helpers\VarDumper::dump($model->getErrors(),10,true) ?>
            <?= $form->field($model, 'default_html')->widget(
                \drmabuse\sirtrevorjs\SirTrevorWidget::className(),
                [
                    'imageUploadUrl' => yii\helpers\Url::to(['/blog/crud/post-content/upload']),
                    'language'       => 'de',
                    'block_type' => 'full'
                ]
            ) ?>
            <?= $form->field($model, 'post_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(drmabuse\blog\models\app\Post::find()->all(), 'id', 'default_title'),
                ['prompt' => 'Choose...'] // relation provider
            )->label(
                Html::activeLabel($model, 'post_id', []) . ' ' .
                Html::a(
                    '<span class="glyphicon glyphicon-plus-sign"></span>',
                    ['crud/post/create'],
                    ['target' => '_blank']
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
                'items'        => [
                    [
                        'label' => 'PostContent',
                        'content' => $this->blocks['main'],
                        'active' => true,
                    ],
                ]
            ]
        );
        ?>
        <hr/>

        <?= Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> ' . ($model->isNewRecord ? 'Create' : 'Save'),
            [
                'class' => $model->isNewRecord ?
                    'btn btn-primary' : 'btn btn-primary'
            ]
        ) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
