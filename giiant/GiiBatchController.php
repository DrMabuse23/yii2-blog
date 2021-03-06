<?php

namespace console\controllers;

use yii\console\Controller;
use yii\helpers\Inflector;

/**
 * @author Tobias Munk <schmunk@usrbin.de>
 */
class GiibatchController extends Controller
{
    /**
     * @var bool whether to generate and overwrite all files
     */
    public $generate = false;

    /**
     * @var bool whether to generate and overwrite extended models (from ModelBase)
     */
    public $extendedModels = false;

    /**
     * @inheritdoc
     */
    public function options($id)
    {
        return array_merge(
            parent::options($id),
            ['generate', 'extendedModels']
        );
    }

    /**
     * This command echoes what you have entered as the message.
     *
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        echo "Running batch...\n";

        \Yii::setAlias('schmunk42/sakila', '@vendor/schmunk42/yii2-sakila-module');

        $baseNamespace = 'drmabuse\\blog\\';
        $tablePrefix   = 'blog_';

        $tables = [
            'blog_seo',
            'blog_category',
            'blog_author',
            'blog_file',
            'blog_post',
            'blog_post_lookup_category',
            'blog_post_content',
            'blog_status',
            'blog_tag',
            'blog_comment',
        ];

        // works nice with IDE autocompleteion
        // works nice with IDE autocompleteion
        $providers = [
            \schmunk42\giiant\crud\providers\CallbackProvider::className(),
            \drmabuse\blog\components\RelationProvider::className(),
            \schmunk42\giiant\crud\providers\RelationProvider::className(),
            \schmunk42\giiant\crud\providers\EditorProvider::className(),
            \schmunk42\giiant\crud\providers\SelectProvider::className(),
            \schmunk42\giiant\crud\providers\DateTimeProvider::className(),
            \schmunk42\giiant\crud\providers\RangeProvider::className(),
        ];
        foreach ($tables AS $table) {
            $params = [
                'generate'           => $this->generate,
                'template'           => 'default',
                'ns'                 => $baseNamespace . 'models\\app',
                'tableName'          => $table,
                'baseClass'          => 'common\\models\\ActiveRecord',
                # TODO fix prefix
                'tablePrefix'        => $tablePrefix,
                'generateModelClass' => $this->extendedModels,
                'modelClass'         => Inflector::camelize($table),
            ];
            $route  = 'giic/giiant-model';
            \Yii::$app->runAction(ltrim($route, '/'), $params);
        }

        foreach ($tables AS $table) {
            # TODO fix prefix
            $table  = str_replace($tablePrefix, '', $table);
            $modelClass = $baseNamespace . 'models\\app\\' . Inflector::camelize($table);
            $params = [
                'generate'         => $this->generate,
                'template'         => 'default',
                'tablePrefix'        => $tablePrefix,
//                'moduleID'         => 'console-sakila',composer
                'modelClass'       => $modelClass,
                'searchModelClass' => $modelClass . 'Search',
                'controllerClass'  => $baseNamespace . 'controllers\\crud\\' . Inflector::camelize($table). 'Controller',
                'providerList'     => implode(',', $providers),
                'viewPath'         => '@vendor/drmabuse/yii2-blog/views/crud',
                'pathPrefix'       => 'crud/',
                'actionButtonClass' => 'common\\helpers\\ActionColumn'
                # TODO: review class (t.munk) ---
            ];
            $route  = 'giic/giiant-crud';
            #$route  = 'giic/crud';
            \Yii::$app->runAction(ltrim($route, '/'), $params);
        }
    }
}