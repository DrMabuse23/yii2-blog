<?php

namespace drmabuse\blog\controllers\api;

use yii\rest\ActiveController;

/**
* PostContentApiController implements the CRUD actions for PostContent model.
*/
class PostContentApiController extends ActiveController {

    public $modelClass = 'drmabuse\blog\models\app\PostContent';
    public $enableCsrfValidation = false;
    public function init(){
        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->enableCsrfValidation = false;
        return parent::init();
    }
}
