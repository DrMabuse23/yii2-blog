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
        $model->file = UploadedFile::getInstance($model, 'file');
        if ($model->file->saveAs(\Yii::getAlias('@app') . '/web/' . $this->uploadPath . '/' . $model->file->name)) {
            echo Json::encode(
                [
                    "file" => [
                        "url" => $this->uploadPath . '/' . $model->file->name
                    ]
                ]
            );

        }
    }
}