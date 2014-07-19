<?php

namespace drmabuse\blog\models\app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use drmabuse\blog\models\app\BlogStatus;

/**
 * BlogStatusSearch represents the model behind the search form about BlogStatus.
 */
class BlogStatusSearch extends Model
{
	public $id;
	public $name;
	public $code;
	public $type;
	public $position;

	public function rules()
	{
		return [
			[['id', 'code', 'position'], 'integer'],
			[['name', 'type'], 'safe'],
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

	public function search($params)
	{
		$query = BlogStatus::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'code' => $this->code,
            'position' => $this->position,
        ]);

		$query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type]);

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
