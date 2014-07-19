<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the base-model class for table "blog_post_lookup_category".
 *
 * @property integer $category_id
 * @property integer $post_id
 *
 * @property BlogPost $post
 * @property BlogCategory $category
 */
class BlogPostLookupCategoryBase extends \common\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_post_lookup_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'post_id'], 'required'],
            [['category_id', 'post_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(BlogPost::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'category_id']);
    }
}
