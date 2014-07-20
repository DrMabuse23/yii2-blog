<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the model class for table "blog_post".
 */
class Post extends PostBase
{
    public function extraFields()
    {
        return [
            'seo',
            'status',
            'categories',
            'postContents',
            'comments',
            'author',
        ];
    }


}
