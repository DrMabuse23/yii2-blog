<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the base-model class for table "blog_post".
 *
 * @property integer $id
 * @property string $default_title
 * @property string $slug
 * @property string $tags
 * @property integer $status
 * @property string $css_class
 * @property integer $readmore_length
 * @property integer $author_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BlogComment[] $blogComments
 * @property BlogStatus $status0
 * @property BlogAuthor $author
 * @property BlogPostContent[] $blogPostContents
 * @property BlogPostLookupCategory[] $blogPostLookupCategories
 * @property BlogCategory[] $categories
 */
class BlogPostBase extends \common\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['default_title', 'slug', 'author_id'], 'required'],
            [['tags'], 'string'],
            [['status', 'readmore_length', 'author_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['default_title'], 'string', 'max' => 128],
            [['slug'], 'string', 'max' => 255],
            [['css_class'], 'string', 'max' => 5]
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
            'slug' => 'Slug',
            'tags' => 'Tags',
            'status' => 'Status',
            'css_class' => 'Css Class',
            'readmore_length' => 'Readmore Length',
            'author_id' => 'Author ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(BlogComment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(BlogStatus::className(), ['id' => 'status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(BlogAuthor::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPostContents()
    {
        return $this->hasMany(BlogPostContent::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPostLookupCategories()
    {
        return $this->hasMany(BlogPostLookupCategory::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(BlogCategory::className(), ['id' => 'category_id'])->viaTable('blog_post_lookup_category', ['post_id' => 'id']);
    }
}
