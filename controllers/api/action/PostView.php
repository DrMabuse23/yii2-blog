<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace drmabuse\blog\controllers\api\action;

use drmabuse\blog\models\app\Post;
use yii\helpers\VarDumper;
use yii\rest\Action;
use yii\web\NotFoundHttpException;

/**
 * Class PostView
 * @package drmabuse\blog\controllers\api\action
 * @author $Author
 */
class PostView extends Action{

    /**
     * Displays a model.
     * @param string $id the primary key of the model.
     * @return \yii\db\ActiveRecordInterface the model being displayed
     */
    public function run($slug)
    {
        $model = $this->bySlug($slug);
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        return $model;
    }

    public function bySlug($slug){
//        if ($this->bySlug !== null) {
//            return call_user_func($this->bySlug, $slug, $this);
//        }

        /* @var $modelClass ActiveRecordInterface */
        $type = new Post();


        $model = Post::find()->where(['slug' => $slug])->with($type->extraFields())->one();

        if (isset($model)) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $slug");
        }
    }
}