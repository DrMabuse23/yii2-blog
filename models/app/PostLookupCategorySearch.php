<?php

namespace drmabuse\blog\models\app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use drmabuse\blog\models\app\PostLookupCategory;

/**
 * PostLookupCategorySearch represents the model behind the search form about PostLookupCategory.
 */
class PostLookupCategorySearch extends Model
{
	public $category_id;
	public $post_id;

	public function rules()
	{
		return [
			[['category_id', 'post_id'], 'integer'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'category_id' => 'Category ID',
			'post_id' => 'Post ID',
		];
	}

	public function search($params)
	{
		$query = PostLookupCategory::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'category_id' => $this->category_id,
            'post_id' => $this->post_id,
        ]);

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
