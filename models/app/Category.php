<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the model class for table "blog_category".
 */
class Category extends CategoryBase
{
    public function extraFields()
    {
        return [
            'seo',
            'publishPosts',
            'posts'
        ];
    }

    public function getPublishPosts(){
        /**
         * @return \yii\db\ActiveQuery
         */
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->where(['status_id' => 2])->viaTable('blog_post_lookup_category', ['category_id' => 'id']);
    }
}
