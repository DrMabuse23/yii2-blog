<?php use common\helpers\Glyph;
?>
<div class="btn-group btn-group-sm">
    <?=
    Glyph::icon(
        Glyph::ICON_FOLDER_OPEN,
        'button',
        ' ' . $value,
        [
            'type'        => 'button',
            'class'       => 'btn btn-primary',
            'data-toggle' => 'tooltip',
            'data-title'  => 'open/close'
        ]
    ) .
    Glyph::icon(
        Glyph::ICON_PLUS_SIGN,
        'button',
        '',
        [
            'type'        => 'button',
            'class'       => 'btn btn-success',
            'data-toggle' => 'tooltip',
            'data-title'  => 'addfolder'
        ]
    ) .
    Glyph::icon(
        Glyph::ICON_UPLOAD,
        'button',
        '',
        [
            'type'        => 'button',
            'class'       => 'btn btn-info upload',
            'data-toggle' => 'tooltip',
            'data-title'  => 'upload'
        ]
    ) ?>
</div>