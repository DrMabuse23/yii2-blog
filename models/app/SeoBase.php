<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the base-model class for table "blog_seo".
 *
 * @property integer $id
 * @property string $default_title
 * @property string $default_keywords
 * @property string $default_description
 * @property string $default_meta_json
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category[] $categories
 * @property Post[] $posts
 */
class SeoBase extends \common\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['default_title'], 'required'],
            [['default_keywords', 'default_description', 'default_meta_json'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['default_title'], 'string', 'max' => 255]
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
            'default_keywords' => 'Default Keywords',
            'default_description' => 'Default Description',
            'default_meta_json' => 'Default Meta Json',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['seo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['seo_id' => 'id']);
    }
}
