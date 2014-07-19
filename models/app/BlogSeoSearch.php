<?php

namespace drmabuse\blog\models\app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use drmabuse\blog\models\app\BlogSeo;

/**
 * BlogSeoSearch represents the model behind the search form about BlogSeo.
 */
class BlogSeoSearch extends Model
{
	public $id;
	public $default_title;
	public $default_keywords;
	public $default_description;
	public $default_meta_json;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['default_title', 'default_keywords', 'default_description', 'default_meta_json', 'created_at', 'updated_at'], 'safe'],
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

	public function search($params)
	{
		$query = BlogSeo::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'default_title', $this->default_title])
            ->andFilterWhere(['like', 'default_keywords', $this->default_keywords])
            ->andFilterWhere(['like', 'default_description', $this->default_description])
            ->andFilterWhere(['like', 'default_meta_json', $this->default_meta_json]);

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
