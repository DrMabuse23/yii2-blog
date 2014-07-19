<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace drmabuse\blog;


/**
 * Class Module
 * @package drmabuse\blog
 * @author Pascal Brewing <pascalbrewing@gmail.com>
 */
class Module extends \yii\base\Module{

    /**
     * @var string
     */
    public $version = '0.0.1-dev';

    /**
     * @var string
     */
    public $layout = 'main';


    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, $config = [])
    {
        parent::__construct($id, $parent, $config);
    }
} 