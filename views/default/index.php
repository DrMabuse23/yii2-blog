<?php
use drmabuse\blog\helpers\Panel;
use drmabuse\blog\helpers\Glyph;
?>
<?php foreach ([\drmabuse\blog\BlogModule::getBlogMenu()] as $menu) : ?>
    <div class="col-lg-3">
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
    </div>
<?php endforeach; ?>