<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the model class for table "blog_post_content".
 */
class PostContent extends PostContentBase
{

    /**
     * @var Object
     */
    public $file;

    /**
     * upload Path
     * @var string
     */
    public static  $uploadPath = "@webroot/blog/post_content";

    /**
     * file to upload
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                ['file', 'file', 'extensions' => 'jpg,png,gif,mp4,pdf,svg,mov,mpeg', 'skipOnEmpty' => false],
            ]
        );
    }

}
