<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the base-model class for table "blog_tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class BlogTagBase extends \common\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128]
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
            'frequency' => 'Frequency',
        ];
    }
}
