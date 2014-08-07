<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the base-model class for table "blog_comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $publish_status
 * @property integer $create_time
 * @property string Pascal Brewing
 * @property string $email
 * @property string $url
 * @property integer $post_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Post $post
 */
class CommentBase extends \common\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'post_id'], 'required'],
            [['content'], 'string'],
            [['publish_status', 'create_time', 'post_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['author', 'email', 'url'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'publish_status' => 'Publish Status',
            'create_time' => 'Create Time',
            'author' => 'Author',
            'email' => 'Email',
            'url' => 'Url',
            'post_id' => 'Post ID',
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
