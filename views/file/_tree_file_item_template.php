<?php use yii\helpers\Html;
use common\helpers\Glyph; ?>
<?php //echo
//Html::img(
//    \Yii::getAlias('@web') . '/' . $path,
//    [ 'class' => "img-responsive"]
//) ?>
<div class="btn-group btn-group-xs">

    <?=
    Glyph::icon(
        Glyph::ICON_FILE,
        'button',
        $path,
        [
            'type' => 'button',
            'class' => 'btn btn-default'
        ]
    )
//    .
//    Glyph::icon(
//        Glyph::ICON_MINUS_SIGN,
//        'button',
//        '',
//        [
//            'type' => 'button',
//            'class' => 'btn btn-danger'
//        ]
//    )
    ?>
</div>