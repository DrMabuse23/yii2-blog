<?php

namespace drmabuse\blog\models\app;

use Yii;

/**
 * This is the base-model class for table "blog_file".
 *
 * @property integer $id
 * @property string $name_id
 * @property string $path
 * @property string $mime_type
 * @property string $folder
 * @property integer $deleted
 */
class FileBase extends \common\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'mime_type', 'folder'], 'required'],
            [['deleted'], 'integer'],
            [['name_id'], 'string', 'max' => 64],
            [['path', 'mime_type', 'folder'], 'string', 'max' => 255],
            [['path'], 'unique'],
            [['name_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_id' => 'Name ID',
            'path' => 'Path',
            'mime_type' => 'Mime Type',
            'folder' => 'Folder',
            'deleted' => 'Deleted',
        ];
    }
}
