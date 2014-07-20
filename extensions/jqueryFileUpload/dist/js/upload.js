/* global $, window */

$(function () {
    'use strict';
    $(document).on('fileupload-refresh-action',function(){
        var $fileUpload = $('#fileupload');

        // Initialize the jQuery File Upload widget:
        $fileUpload.fileupload({
            url:        $fileUpload.attr('action'),
            always:function(){
                $(this).removeClass('fileupload-processing');
            },
            done:       function(event,result){
                $("table tbody.files").empty();
                $(document).trigger('fileupload-fileuploaddone',[result,event]);
            },
            fail:function(){

            }
        }).on('fileuploadfail', function (e, data) {
            $.each(data.files, function (index, file) {
                var error = $('<span class="text-danger"/>').text('File upload failed.');
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            });
        });

        // Enable iframe cross-domain access via redirect option:
        $fileUpload.fileupload(
            'option',
            'redirect',
            window.location.href.replace(
                /\/[^\/]*$/,
                '/cors/result.html?%s'
            )
        );

        // Load existing files:
        $fileUpload.addClass('fileupload-processing');
    });


});