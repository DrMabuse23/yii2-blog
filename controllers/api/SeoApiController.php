<?php

namespace drmabuse\blog\controllers\api;

use yii\rest\ActiveController;

/**
* SeoApiController implements the CRUD actions for Seo model.
*/
class SeoApiController extends ActiveController {

    public $modelClass = 'drmabuse\blog\models\app\Seo';
    public $enableCsrfValidation = false;
    public function init(){
        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->enableCsrfValidation = false;
        return parent::init();
    }
}
