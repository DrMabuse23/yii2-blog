<?php

namespace drmabuse\blog\controllers\api;

use yii\rest\ActiveController;

/**
* PostLookupCategoryApiController implements the CRUD actions for PostLookupCategory model.
*/
class PostLookupCategoryApiController extends ActiveController {

    public $modelClass = 'drmabuse\blog\models\app\PostLookupCategory';
    public $enableCsrfValidation = false;
    public function init(){
        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->enableCsrfValidation = false;
        return parent::init();
    }
}
