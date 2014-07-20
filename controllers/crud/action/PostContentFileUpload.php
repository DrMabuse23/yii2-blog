<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace drmabuse\blog\controllers\crud\action;

use yii\base\Action;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;


/**
 * Class PostContentFileUpload
 * @package drmabuse\blog\controllers\crud\action
 * @author Pascal Brewing <pascalbrewing@gmail.com>
 */
class PostContentFileUpload extends Action{

    public $uploadPath = "upload/blog/post_content";

    public function init(){
        if(!is_dir($this->uploadPath))
            FileHelper::createDirectory($this->uploadPath);
    }
    public function run(){

//        VarDumper::dump($_POST);
        VarDumper::dump($_FILES);

    }
} 