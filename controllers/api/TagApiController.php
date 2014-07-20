<?php

namespace drmabuse\blog\controllers\api;

use yii\rest\ActiveController;

/**
* TagApiController implements the CRUD actions for Tag model.
*/
class TagApiController extends ActiveController {

    public $modelClass = 'drmabuse\blog\models\app\Tag';
    public $enableCsrfValidation = false;
    public function init(){
        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->enableCsrfValidation = false;
        return parent::init();
    }
}
