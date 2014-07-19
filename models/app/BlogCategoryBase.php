<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the base-model class for table "blog_category".
 *
 * @property integer $id
 * @property string $default_title
 * @property string $default_content
 * @property string $slug
 * @property integer $rank
 * @property integer $seo_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BlogSeo $seo
 * @property BlogPostLookupCategory[] $blogPostLookupCategories
 * @property BlogPost[] $posts
 */
class BlogCategoryBase extends \common\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['default_title', 'slug', 'rank', 'seo_id'], 'required'],
            [['default_content'], 'string'],
            [['rank', 'seo_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['default_title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'default_title' => 'Default Title',
            'default_content' => 'Default Content',
            'slug' => 'Slug',
            'rank' => 'Rank',
            'seo_id' => 'Seo ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeo()
    {
        return $this->hasOne(BlogSeo::className(), ['id' => 'seo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPostLookupCategories()
    {
        return $this->hasMany(BlogPostLookupCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(BlogPost::className(), ['id' => 'post_id'])->viaTable('blog_post_lookup_category', ['category_id' => 'id']);
    }
}
