<?php

namespace drmabuse\blog\controllers\api;

use yii\rest\ActiveController;

/**
* CategoryApiController implements the CRUD actions for Category model.
*/
class CategoryApiController extends ActiveController {

    public $modelClass = 'drmabuse\blog\models\app\Category';
    public $enableCsrfValidation = false;
    public function init(){
        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->enableCsrfValidation = false;
        return parent::init();
    }
}
