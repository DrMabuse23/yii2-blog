<?php
/**

 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace backend\controllers;

use backend\models\FolderForm;
use common\models\starrag\File;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use common\helpers\Glyph;
use yii\web\Cookie;
use yii\web\CookieCollection;
use yii\web\UploadedFile;
use yii\widgets\Menu;


/**
 * Class FileController
 * @package backend\controllers
 * @author Pascal Brewing
 */
class FileController extends Controller
{

    public $rootPath;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'upload',
                            'refresh-tree',
                            'add-folder'
                        ],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     *
     */
    public function init()
    {
        \Yii::$app->session->open();
        $this->enableCsrfValidation = false;
        \Yii::$app->request->enableCookieValidation = false;
        $this->rootPath                             = \Yii::getAlias('@webroot') . '/images';
    }

    /**
     * render a view
     * @return string
     */
    public function actionIndex()
    {
        $items = $this->getItems($this->rootPath);
        //this part update the cookie
        if (isset($_POST['set-cookie'])) {
//            echo VarDumper::dump($_POST['set-cookie']);
            $this->updateCookie($_POST['set-cookie']['key'], $_POST['set-cookie']['value']);
            return true;
        }
        //        VarDumper::dump($items, 10, true);
        return $this->render('index', ['items' => $items]);
    }


    /**
     * build items for the file tree
     *
     * @param $root
     *
     * @return array
     */
    private function getItems($root)
    {
        $result = array();

        $cdir = scandir($root);

        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", "..", ".DS_Store"))) {

                $rootPath = $root . DIRECTORY_SEPARATOR . $value;

                if (is_dir($rootPath)) {


                    if (\Yii::$app->request->cookies->get($rootPath) === null) {
                        $cookie           = new Cookie();
                        $cookie->name     = $root . DIRECTORY_SEPARATOR . $value;
                        $cookie->value    = 'open-menu';
                        $cookie->httpOnly = false;
                        $cookie->expire   = strtotime(date('Y-m-d', strtotime('+1 week')));
                        \Yii::$app->response->cookies->add($cookie);
                    }
                    //                    \Yii::$app->request->enableCookieValidation = true;
                    $result[] =
                        [
                            'label'   => $this->createFolderTemplate($value),
                            'options' => [
                                'class'     => !is_null(\Yii::$app->request->cookies->get($rootPath)) ?
                                    \Yii::$app->request->cookies->getValue($rootPath) . ' folder animated' :
                                    'open-menu folder animated',
                                'data-root' => $root . DIRECTORY_SEPARATOR . $value,
                            ],
                            'items'   => $this->getItems($root . DIRECTORY_SEPARATOR . $value)
                        ];

                } else {
                    //continue;
                    $result[] = [
                        'label'   => $this->createFileTemplate($value, $root . DIRECTORY_SEPARATOR . $value),
                        'options' => [
                            'class'     => 'file',
                            'data-root' => $root . DIRECTORY_SEPARATOR . $value
                        ]
                    ];
                }
            }
        }


        return $result;
    }

    /**
     * @param $path
     *
     * @return bool|string
     */
    public function actionAddFolder($root)
    {
        $model = new FolderForm();
        if ($model->load($_POST) && $model->validate()) {
            $path = $root . '/' . Inflector::underscore(Inflector::camelize($model->name));

            if (is_dir($path)) {
                echo Json::encode(
                    [
                        'message' => 'Folder already exist'
                    ]
                );
                return;
            }


            if (FileHelper::createDirectory($path)) {
                $items = $this->getItems($this->rootPath);
                echo Json::encode(
                    ['widget' => $this->tree($items)]
                );
                return;
            }
        } else {
            echo Json::encode($model->getErrors());
            return;
        }

        return false;
    }

    /**
     *
     */
    public function actionRefreshTree()
    {
        $items = $this->getItems($this->rootPath);
        echo Json::encode(
            ['widget' => $this->tree($items)]
        );
        return;
    }

    /**
     * @param $root
     */
    public function actionUpload($root)
    {
        $model = new File();

        if ($model->load($_POST)) {

            $model->file    = UploadedFile::getInstance($model, 'file');
            $model->name_id = Inflector::underscore(
                Inflector::camelize(str_replace($model->file->extension, '', $model->file->name))
            );

            $filename       = $model->name_id . '.' . $model->file->extension;
            $model->name_id = $this->checkFileNameNotExist($model);

            $model->path = str_replace(
                    \Yii::getAlias('@webroot').'/',
                    '',
                    $root
                ) . '/' . $filename;

            $uploadPath = \Yii::getAlias('@webroot') . '/' . $model->path;

            if (
                !is_file($root . '/' . $filename)
                && is_dir($root)
            ) {
                if ($model->file->saveAs($uploadPath)) {
                    $model->mime_type = FileHelper::getMimeType($uploadPath);
                    $model->file_size = $model->file->size;

                    if($model->save()){
                        $items = $this->getItems($this->rootPath);
                        list($width, $height, $type, $attr) = getimagesize($uploadPath);
                        echo Json::encode(
                            [
                                $this->getResultArray(
                                    [
                                        'name'  => $model->name_id,
                                        'size'  => $model->file_size,
                                        'path'  => Url::to('@web') . $model->path,
                                        'thumb' => Url::to('@web') . $model->path,

                                    ],
                                    $uploadPath
                                )
                            ]
                        );
                        return;
                    }
                }
            } else {
                echo Json::encode(
                    [
                        'files' => [
                            "name"  => $model->path,
                            "error" => "File already exist " . $model->path . ' plz delete this before',
                            'path'  => Url::to('@web') . $model->path,
                            'thumb' => Url::to('@web') . $model->path,
                        ]
                    ]
                );
                return;
            }
        }
    }

    /**
     * update the TREE Cookie By Key
     *
     * @param $key
     * @param $value
     */
    private function updateCookie($key, $value)
    {
        \Yii::$app->request->enableCookieValidation = false;
        if (\Yii::$app->request->cookies->get($key)) {
            \Yii::$app->request->enableCookieValidation = false;
            $cookie                                     = new Cookie();
            $cookie->name                               = $key;
            $cookie->value                              = $value;
            $cookie->httpOnly                           = false;
            $cookie->expire                             = strtotime(date('Y-m-d', strtotime('+1 week')));

            \Yii::$app->response->cookies->add($cookie);
        }
    }

    /**
     * return  the array for jquery
     *
     * @param $uploadPath
     *
     * @return array
     */
    private function getResultArray($file, $uploadPath)
    {

        return $files = [
            'files' => [
                [
                    'name'         => $file['name'],
                    'size'         => $file['size'],
                    'thumb'        => $file['thumb'],
                    'thumbnailUrl' => '',
                    'type'         => FileHelper::getMimeTypeByExtension($uploadPath),
                    'url'          => $file['path']
                ],
            ]
        ];
    }

    /**
     * @param File $model
     */
    private function checkFileNameNotExist(File $model)
    {
        $model->validate();

        if ($model->hasErrors('name_id')) {
            $name_id = uniqid('_' . $model->name_id);
        } else {
            return $model->name_id;
        }

        return $name_id;
    }

    /**
     * return an Menu widget with a file tree
     *
     * @param $items
     *
     * @return string
     */
    public function tree($items)
    {
        return Menu::widget(
            [
                'encodeLabels'    => false,
                'submenuTemplate' => "\n<ul class='submenu open-menu'>\n{items}\n</ul>\n",
                'hideEmptyItems'  => false,
                'options'         => [
                    'class' => 'root',
                ],
                'items'           => $items
            ]
        );
    }

    /**
     * create at the moment the label
     *
     * @param $value
     *
     * @return string
     */
    private function createFolderTemplate($value)
    {
        return $this->renderPartial('_tree_folder_item_template', ['value' => $value]);
    }

    /**
     * return the File label
     *
     * @param $value
     *
     * @return string
     */
    private function createFileTemplate($value, $realPath)
    {
        $path = str_replace(\Yii::getAlias('@webroot'), '', $realPath);
        return $this->renderPartial('_tree_file_item_template', ['value' => $value, 'path' => $path]);
    }

}