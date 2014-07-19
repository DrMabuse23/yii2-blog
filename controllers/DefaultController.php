<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace drmabuse\blog\controllers;

use drmabuse\blog\components\BlogController;


/**
 * Class DefaultController
 * @package drmabuse\blog\controllers
 * @author Pascal Brewing <pascalbrewing@gmail.com>
 */
class DefaultController extends BlogController {

    public function actionIndex(){
        return $this->render('index');
    }
} 