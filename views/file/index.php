<?php
$this->title = 'File Upload';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php \common\helpers\Panel::begin(
        [
            'panel'        => [
                'htmlOptions' => [],
                'panelType'   => \common\helpers\Panel::PANEL_PRIMARY, //primary success info warning danger
            ],
            'panelHeading' => [
                'title'        => \common\helpers\Glyph::icon(\common\helpers\Glyph::ICON_FILE).' File Manager',
                'htmlOptions'  => [],
                'hTag'         => true,
                'titleOptions' => [],
                'titleTag'     => 'h3',
            ],
            'panelBody'    => true, //set to false no div-panel-body wil be generated
        ]
    );
    ?>
    <div class="tree-holder">
    <?= $this->context->tree($items); ?>
    </div>
    <?php \common\helpers\Panel::end(); ?>


<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;

Modal::begin(
    [
        'header'  => '<h2>Add Folder</h2>',
        'options' => [
            'id' => 'new-folder'
        ]
    ]
);
$model = new \backend\models\FolderForm();
$form  = \yii\bootstrap\ActiveForm::begin([
        'layout' => 'horizontal',
        'id' => 'folder-form'
]);
echo $form->field($model, 'name');
?>
<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton(\common\helpers\Glyph::icon(\common\helpers\Glyph::ICON_PLUS_SIGN).' Create', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php
$form->end();
Modal::end();
Modal::begin(
    [
        'header'  => '<h2>Upload Files</h2>',
        'size' => Modal::SIZE_LARGE,
        'options' => [
            'id' => 'new-upload'
        ]
    ]
);
?>
<?php $image = new \common\models\starrag\File(); ?>
<?= \backend\extensions\jqueryFileUpload\JqueryFileUpload::widget([
    'model'         => $image,
    'attribute'     => 'file',
    'uploadAction'  => \yii\helpers\Url::to(['file/upload'])
]); ?>
<?php
Modal::end();
?>