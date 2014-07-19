<?php

namespace drmabuse\blog\models\app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use drmabuse\blog\models\app\BlogPostContent;

/**
 * BlogPostContentSearch represents the model behind the search form about BlogPostContent.
 */
class BlogPostContentSearch extends Model
{
	public $id;
	public $default_title;
	public $slug;
	public $tags;
	public $status;
	public $css_class;
	public $readmore_length;
	public $author_id;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id', 'status', 'readmore_length', 'author_id'], 'integer'],
			[['default_title', 'slug', 'tags', 'css_class', 'created_at', 'updated_at'], 'safe'],
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
			'slug' => 'Slug',
			'tags' => 'Tags',
			'status' => 'Status',
			'css_class' => 'Css Class',
			'readmore_length' => 'Readmore Length',
			'author_id' => 'Author ID',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = BlogPostContent::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'readmore_length' => $this->readmore_length,
            'author_id' => $this->author_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'default_title', $this->default_title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'css_class', $this->css_class]);

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
