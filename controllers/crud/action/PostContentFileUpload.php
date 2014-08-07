<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace drmabuse\blog\controllers\crud\action;

use drmabuse\blog\models\app\PostContent;
use yii\base\Action;
use yii\console\Response;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;


/**
 * Class PostContentFileUpload
 * @package drmabuse\blog\controllers\crud\action
 * @author Pascal Brewing <pascalbrewing@gmail.com>
 */
class PostContentFileUpload extends Action
{

    public $uploadPath = "upload/blog/post_content";
    private static $_files = null;

    public function init()
    {
        if (!is_dir($this->uploadPath)) {
            FileHelper::createDirectory($this->uploadPath);
        }
    }

    public function run()
    {

        $model = new PostContent();

        $model->file = UploadedFile::getInstanceByName('attachment[file]');

        $response = new \yii\web\Response();
        $response->format = \yii\web\Response::FORMAT_JSON;


        if ($model->file->saveAs(\Yii::getAlias('@app') . '/web/' . $this->uploadPath . '/' . $model->file->name)) {
            $response->setStatusCode(200);
            $response->data = [
                "file" => [
                    "url" => $this->uploadPath . '/' . $model->file->name,
                ]
            ];
            \Yii::$app->end(0,$response);
        }

        $response->setStatusCode(500);
        $response->statusText = "File could not be saved.";
        \Yii::$app->end(0, $response);
    }
}