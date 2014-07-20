<?php

namespace drmabuse\blog\controllers\api;

use yii\rest\ActiveController;

/**
* CommentApiController implements the CRUD actions for Comment model.
*/
class CommentApiController extends ActiveController {

    public $modelClass = 'drmabuse\blog\models\app\Comment';
    public $enableCsrfValidation = false;
    public function init(){
        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->enableCsrfValidation = false;
        return parent::init();
    }
}
