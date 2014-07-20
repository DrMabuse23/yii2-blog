module.exports = function (grunt) {
    'use strict';
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        clean: {
            dist: ['<&= dist %>']
        },
        uglify: {
            options: {
                mangle: {
                    except: ['jQuery', 'Backbone']
                },
                preserveComments: 'some',
                banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
                    '<%= grunt.template.today("yyyy-mm-dd") %> */'
            },
            fileUpload: {
                files: {
                    '<%= dist %>/js/blueimp/blueimp-base-advanced.min.js': [
                        "bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js",
                        "bower_components/blueimp-load-image/js/load-image.min.js",
                        "bower_components/blueimp-tmpl/js/tmpl.min.js",
                        "bower_components/blueimp-canvas-to-blob/js/canvas-to-blob.min.js",
                        "bower_components/blueimp-file-upload/js/jquery.iframe-transport.js",
                        "bower_components/blueimp-file-upload/js/jquery.fileupload.js",
                        "bower_components/blueimp-file-upload/js/jquery.fileupload-process.js",
                        "bower_components/blueimp-file-upload/js/jquery.fileupload-image.js",
                        "bower_components/blueimp-file-upload/js/jquery.fileupload-audio.js",
                        "bower_components/blueimp-file-upload/js/jquery.fileupload-video.js",
                        "bower_components/blueimp-file-upload/js/jquery.fileupload-validate.js",
                        "bower_components/blueimp-file-upload/js/jquery.fileupload-ui.js"
                    ]
                }
            },
            upload: {
                files: {
                    '<%= dist %>/js/upload.min.js': [
                        '<%= upload %>upload.js'
                    ]
                }
            }
        },
        bower:  'bower_components',
        upload: 'js/',
        dist:   'dist'
    });

    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Default task(s).
    grunt.registerTask('default', ['clean','uglify']);
};