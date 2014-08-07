<?php
/**

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
class BlogModule extends \yii\base\Module
{

    /**
     * @var string
     */
    public $version = '0.0.1-dev';

    /**
     * @var string
     */
    public $layout = 'main';

    /**
     * @var array
     */
    public static $blogMenu = [];

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, $config = [])
    {
        parent::__construct($id, $parent, $config);
    }

    /**
     * @param string $label
     * @param string $category
     * @param string $post
     * @param string $postContent
     * @param string $seo
     * @param string $comment
     *
     * @return array
     */
    public static function getBlogMenu(
        $label          = 'Blog',
        $category       = 'Category',
        $post           = 'Post',
        $postContent    = 'Post-Content',
        $seo            = 'Seo',
        $comment        = 'Comment'
    ) {
        return self::$blogMenu = [
            'label' => $label,
            'items' => [
                [
                    'label' => $category,
                    'url'   => \yii\helpers\Url::to(['/blog/crud/category'])
                ],
                [
                    'label' => $post,
                    'url'   => \yii\helpers\Url::to(['/blog/crud/post'])
                ],
                [
                    'label' => $postContent,
                    'url'   => \yii\helpers\Url::to(['/blog/crud/post-content'])
                ],
                [
                    'label' => $seo,
                    'url'   => \yii\helpers\Url::to(['/blog/crud/seo'])
                ],
                [
                    'label' => $comment,
                    'url'   => \yii\helpers\Url::to(['/blog/crud/comment'])
                ],

            ]
        ];
    }
} 