<?php

namespace drmabuse\blog\controllers\api;

use yii\rest\ActiveController;

/**
* PostApiController implements the CRUD actions for Post model.
*/
class PostApiController extends ActiveController {

    public $modelClass = 'drmabuse\blog\models\app\Post';
    public $enableCsrfValidation = false;
    public function init(){
        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->enableCsrfValidation = false;
        return parent::init();
    }
}
