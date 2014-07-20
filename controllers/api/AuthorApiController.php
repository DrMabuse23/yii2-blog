<?php

namespace drmabuse\blog\controllers\api;

use yii\rest\ActiveController;

/**
* AuthorApiController implements the CRUD actions for Author model.
*/
class AuthorApiController extends ActiveController {

    public $modelClass = 'drmabuse\blog\models\app\Author';
    public $enableCsrfValidation = false;
    public function init(){
        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->enableCsrfValidation = false;
        return parent::init();
    }
}
