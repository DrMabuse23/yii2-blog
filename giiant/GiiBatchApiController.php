<?php

namespace console\controllers;

use yii\console\Controller;
use yii\helpers\Inflector;

/**
 * @author Tobias Munk <schmunk@usrbin.de>
 */
class GiiBatchApiController extends Controller
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
            # TODO fix prefix
            $table  = str_replace($tablePrefix, '', $table);
            $modelClass = $baseNamespace . 'models\\app\\' . Inflector::camelize($table);
            $params = [
                'generate'         => $this->generate,
                'template'         => 'default',
                'tablePrefix'        => $tablePrefix,
//                'moduleID'         => 'console-sakila',composer
                'modelClass'       => $modelClass,
                'controllerClass'  => $baseNamespace . 'controllers\\api\\' . Inflector::camelize($table). 'ApiController',
                'providerList'     => implode(',', $providers),
                'pathPrefix'       => 'api/',
            ];
            $route  = 'giic/giiant-crud';
            #$route  = 'giic/crud';
            \Yii::$app->runAction(ltrim($route, '/'), $params);
        }
    }
}