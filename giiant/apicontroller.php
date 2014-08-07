<?php

use yii\helpers\StringHelper;

/**
 * This is the template for generating a CRUD controller class file.
 *
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass.'Search';
}

$pks = $generator->getTableSchema()->primaryKey;
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use yii\rest\ActiveController;

/**
* <?= $controllerClass ?> implements the API actions for <?= $modelClass ?> model.
*/
class <?= $controllerClass ?> extends ActiveController {

    public $modelClass = '<?= $modelClass ?>';
    public $enableCsrfValidation = false;
    public function init(){
        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->enableCsrfValidation = false;
        return parent::init();
    }
}
