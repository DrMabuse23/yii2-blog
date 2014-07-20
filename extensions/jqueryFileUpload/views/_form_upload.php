<?php
use common\helpers\Glyph;

?>
<form style="margin-top: 70px" id="fileupload" method="POST" action="<?= $uploadAction ?>"
      method="POST" enctype="multipart/form-data">
    <!-- Redirect browsers with JavaScript disabled to the origin page -->
    <noscript><input type="hidden" name="redirect" value="<?= Yii::$app->homeUrl ?>"></noscript>
    <!-- The table listing the files available for upload/download -->
    <div class="panel panel-default">
        <div style="padding:0;" class="panel-heading">

            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
            <div class="row fileupload-buttonbar btn-toolbar" role="toolbar" style="margin-bottom: 0;margin-top:0;">
                <div style="margin-left: 0;padding-left: 5px;" class="col-lg-7 btn-group btn-group-sm ">
                    <!-- The fileinput-button span is used to style the file input field as button -->
            <span  data-toggle="tooltip" data-title="check all" class="btn btn-primary text-center" style="border-radius: 0;padding-bottom: 5px;margin-bottom:0;">
                <input style="padding: 0;margin: 0" type="checkbox" class="toggle"/>
            </span>
            <span data-toggle="tooltip" data-title="add new Files" class="btn btn-success fileinput-button" style="padding-bottom: 5px;margin-bottom:0;">
                <?= Glyph::icon(Glyph::ICON_PLUS_SIGN) ?> <span>Add files...</span>
                <?= \yii\helpers\Html::activeFileInput($model, $attribute, ['multiple' => 'multiple']) ?>
                <!--                    <input type="file" name="files[]" multiple>-->
            </span>
                    <button data-toggle="tooltip" data-title="upload added Files" type="submit" class="btn btn-primary start" style="padding-bottom: 5px;margin-bottom:0;">
                        <?= Glyph::icon(Glyph::ICON_UPLOAD) ?> <span> Start upload</span>
                    </button>
                    <button data-toggle="tooltip" data-title="reset" type="reset" class="btn btn-warning cancel" style="padding-bottom: 5px;margin-bottom:0;">
                        <?= Glyph::icon(Glyph::ICON_BAN_CIRCLE) ?><span> Cancel upload</span>
                    </button>
                    <?= \yii\helpers\Html::button(Glyph::icon(Glyph::ICON_TRASH).' <span> Delete</span>',[
                        'type' => 'button',
                        'data-title' => 'delete',
                        'data-toggle' => 'tooltip',
                        'class' => 'btn btn-danger delete',
                        'style' => 'border-radius: 0;padding-bottom: 5px;margin-bottom:0;',
                        'confirm' => 'Möchten Sie die liste leeren ?'
                    ])?>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <table role="presentation" class="table table-striped">
                <thead>
                    <th colspan="4">
                        <!-- The global file processing state -->
                        <span class=" fileupload-process"></span>
                        <!-- The global progress state -->
                        <div class="col-lg-5 fileupload-progress fade">
                            <!-- The global progress bar -->
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                            <!-- The extended global progress state -->
                            <div class="progress-extended">&nbsp;</div>
                        </div>
                    </th>
                </thead>
                <tbody class="files"></tbody>
            </table>
        </div>
    </div>

</form>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fadeIn animated">
        <td>
            <span class="preview">
            {% if (file.thumb) { %}
                <img src="data:{%=file.type%};base64,{%=file.thumb%}" />
            {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <p class="help-block"><span class="label label-danger">Error</span> {%=file.error%}</p>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            <div class="btn-toolbar">
                <div class="btn-group">
                    {% if (file.deleteUrl) { %}
                        <button class="btn btn-danger btn-xs delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Delete</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                        <button class="btn btn-warning btn-xs cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                 </div>
            </div>
        </td>
    </tr>
{% } %}


</script>