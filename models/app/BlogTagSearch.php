<?php

namespace drmabuse\blog\models\app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use drmabuse\blog\models\app\BlogTag;

/**
 * BlogTagSearch represents the model behind the search form about BlogTag.
 */
class BlogTagSearch extends Model
{
	public $id;
	public $name;
	public $frequency;

	public function rules()
	{
		return [
			[['id', 'frequency'], 'integer'],
			[['name'], 'safe'],
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

	public function search($params)
	{
		$query = BlogTag::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'frequency' => $this->frequency,
        ]);

		$query->andFilterWhere(['like', 'name', $this->name]);

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
