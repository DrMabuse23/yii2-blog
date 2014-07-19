<?php

namespace drmabuse\blog\models\app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use drmabuse\blog\models\app\PostContent;

/**
 * PostContentSearch represents the model behind the search form about PostContent.
 */
class PostContentSearch extends Model
{
	public $id;
	public $default_title;
	public $default_html;
	public $post_id;
	public $rank;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id', 'post_id', 'rank'], 'integer'],
			[['default_title', 'default_html', 'created_at', 'updated_at'], 'safe'],
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
			'default_html' => 'Default Html',
			'post_id' => 'Post ID',
			'rank' => 'Rank',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = PostContent::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'post_id' => $this->post_id,
            'rank' => $this->rank,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'default_title', $this->default_title])
            ->andFilterWhere(['like', 'default_html', $this->default_html]);

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
