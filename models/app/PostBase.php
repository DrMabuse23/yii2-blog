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
 * @property integer $status_id
 * @property integer $author_id
 * @property integer $seo_id
 * @property integer $readmore_length
 * @property string $css_class
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Comment[] $comments
 * @property Author $author
 * @property Seo $seo
 * @property Status $status
 * @property PostContent[] $postContents
 * @property PostLookupCategory[] $postLookupCategories
 * @property Category[] $categories
 */
class PostBase extends \common\models\ActiveRecord
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
            [['default_title', 'slug', 'status_id', 'author_id', 'seo_id'], 'required'],
            [['tags'], 'string'],
            [['status_id', 'author_id', 'seo_id', 'readmore_length'], 'integer'],
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
            'status_id' => 'Status ID',
            'author_id' => 'Author ID',
            'seo_id' => 'Seo ID',
            'readmore_length' => 'Readmore Length',
            'css_class' => 'Css Class',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['id' => 'seo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostContents()
    {
        return $this->hasMany(PostContent::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostLookupCategories()
    {
        return $this->hasMany(PostLookupCategory::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('blog_post_lookup_category', ['post_id' => 'id']);
    }
}
