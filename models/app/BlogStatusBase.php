<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the base-model class for table "blog_status".
 *
 * @property integer $id
 * @property string $name
 * @property integer $code
 * @property string $type
 * @property integer $position
 *
 * @property BlogPost[] $blogPosts
 */
class BlogStatusBase extends \common\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'type', 'position'], 'required'],
            [['code', 'position'], 'integer'],
            [['name', 'type'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'type' => 'Type',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPosts()
    {
        return $this->hasMany(BlogPost::className(), ['status' => 'id']);
    }
}
