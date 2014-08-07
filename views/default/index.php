<?php
\yii\helpers\VarDumper::dump(Yii::$app->i18n,10,true);
use drmabuse\blog\helpers\Panel;
use drmabuse\blog\helpers\Glyph;
//    use drmabuse\sirtrevorjs\SirTrevorConverter;
//    $converter = new SirTrevorConverter();
//    $model = \drmabuse\blog\models\app\PostContent::findOne(5);

?>
<?//= $converter->toHtml($model->default_html) ?>

<?php \common\helpers\Panel::begin(
    [
        'panel'        => [
            'htmlOptions' => [
                'style' => 'min-height:300px;'
            ],
            'panelType'   => Panel::PANEL_INFO, //primary success info warning danger
        ],
        'panelHeading' => [
            'title'        => Glyph::icon(Glyph::ICON_FOLDER_OPEN) . ' '.$menu['label'],
            'htmlOptions'  => [],
            'hTag'         => true,
            'titleOptions' => [],
            'titleTag'     => 'h3',
        ],
        'panelBody'    => true, //set to false no div-panel-body wil be generated
    ]
);
echo \yii\bootstrap\Nav::widget(
    [
        'items' => $menu['items']
    ]
);
?>
<?php \common\helpers\Panel::end(); ?>