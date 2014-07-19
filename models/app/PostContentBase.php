<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the base-model class for table "blog_post_content".
 *
 * @property integer $id
 * @property string $default_title
 * @property string $default_html
 * @property integer $post_id
 * @property integer $rank
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Post $post
 */
class PostContentBase extends \common\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_post_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['default_html'], 'string'],
            [['post_id'], 'required'],
            [['post_id', 'rank'], 'integer'],
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
            'default_html' => 'Default Html',
            'post_id' => 'Post ID',
            'rank' => 'Rank',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
