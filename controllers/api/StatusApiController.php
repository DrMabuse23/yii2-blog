<?php

namespace drmabuse\blog\controllers\api;

use yii\rest\ActiveController;

/**
* StatusApiController implements the CRUD actions for Status model.
*/
class StatusApiController extends ActiveController {

    public $modelClass = 'drmabuse\blog\models\app\Status';
    public $enableCsrfValidation = false;
    public function init(){
        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->enableCsrfValidation = false;
        return parent::init();
    }
}
