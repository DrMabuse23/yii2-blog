<?php

namespace drmabuse\blog\models\app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use drmabuse\blog\models\app\File;

/**
 * FileSearch represents the model behind the search form about File.
 */
class FileSearch extends Model
{
	public $id;
	public $name_id;
	public $path;
	public $mime_type;
	public $folder;
	public $deleted;

	public function rules()
	{
		return [
			[['id', 'deleted'], 'integer'],
			[['name_id', 'path', 'mime_type', 'folder'], 'safe'],
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

	public function search($params)
	{
		$query = File::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'deleted' => $this->deleted,
        ]);

		$query->andFilterWhere(['like', 'name_id', $this->name_id])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'mime_type', $this->mime_type])
            ->andFilterWhere(['like', 'folder', $this->folder]);

		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
