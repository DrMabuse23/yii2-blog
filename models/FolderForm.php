<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace drmabuse\blog\models;

use yii\base\Model;


/**
 * Class Folder
 * @package backend\models
 * @author $Author
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