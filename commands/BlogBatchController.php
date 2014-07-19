<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace drmabuse\blog\commands;

use yii\console\Controller;

/**
 * Class BlogBatchController
 * @package drmabuse\blog\commands
 * @author $Author
 */
class BlogBatchController extends Controller{

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
        $tablePrefix   = '';

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
        $providers = [
            CallbackProvider::className(),
            \common\components\RelationProvider::className(),
            //            RelationProvider::className(),
            EditorProvider::className(),
            SelectProvider::className(),
            DateTimeProvider::className(),
            RangeProvider::className(),
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
            $params = [
                'generate'         => $this->generate,
                'template'         => 'default',
                'tablePrefix'        => $tablePrefix,
                #'moduleID'         => 'console-sakila',
                'modelClass'       => $baseNamespace . 'models\\app\\' . Inflector::camelize($table),
                'searchModelClass' => $baseNamespace . 'models\\app\\' . Inflector::camelize($table) . 'Search',
                'controllerClass'  => 'drmabuse\\blog\\controllers\\crud\\' . Inflector::camelize($table) . 'Controller',
                'providerList'     => implode(',', $providers),
                'viewPath'         => '@vendor/drmabuse/yii2-blog/views/crud',
                'pathPrefix'       => 'crud/',
                # TODO: review class (t.munk) --- 'actionButtonClass' => 'common\\helpers\\ActionColumn'
            ];
            $route  = 'giic/giiant-crud';
            #$route  = 'giic/crud';
            \Yii::$app->runAction(ltrim($route, '/'), $params);
        }
    }
} 