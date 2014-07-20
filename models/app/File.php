<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the model class for table "blog_file".
 */
class File extends FileBase
{
    /**
     * @var the file
     */
    public $file;

    /**
     * file to upload
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
//                ['file', 'file', 'extensions' => 'jpg,png,gif,mp4,pdf', 'skipOnEmpty' => false],
//                ['folder', 'string'],
            ]
        );
    }

    /**
     * @return string
     */
    public function getLabel(){
        return $this->path;
    }
}
