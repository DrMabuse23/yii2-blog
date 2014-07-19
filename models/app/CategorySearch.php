<?php

namespace drmabuse\blog\models\app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use drmabuse\blog\models\app\Category;

/**
 * CategorySearch represents the model behind the search form about Category.
 */
class CategorySearch extends Model
{
	public $id;
	public $default_title;
	public $default_content;
	public $slug;
	public $rank;
	public $seo_id;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id', 'rank', 'seo_id'], 'integer'],
			[['default_title', 'default_content', 'slug', 'created_at', 'updated_at'], 'safe'],
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
			'default_content' => 'Default Content',
			'slug' => 'Slug',
			'rank' => 'Rank',
			'seo_id' => 'Seo ID',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = Category::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'rank' => $this->rank,
            'seo_id' => $this->seo_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'default_title', $this->default_title])
            ->andFilterWhere(['like', 'default_content', $this->default_content])
            ->andFilterWhere(['like', 'slug', $this->slug]);

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
