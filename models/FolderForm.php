<?php
/**

 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace drmabuse\blog\models;

use yii\base\Model;


/**
 * Class Folder
 * @package backend\models
 * @author Pascal Brewing
 */
class FolderForm extends Model{

    public $name;

    public function rules(){
        return [
          ['name','required']
        ];
    }


    public function attributeLabels(){
        return [
          'name' => 'Foldername'
        ];
    }
} 