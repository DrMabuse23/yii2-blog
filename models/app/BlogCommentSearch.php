<?php

namespace drmabuse\blog\models\app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use drmabuse\blog\models\app\BlogComment;

/**
 * BlogCommentSearch represents the model behind the search form about BlogComment.
 */
class BlogCommentSearch extends Model
{
	public $id;
	public $content;
	public $status;
	public $create_time;
	public $author;
	public $email;
	public $url;
	public $post_id;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id', 'status', 'create_time', 'post_id'], 'integer'],
			[['content', 'author', 'email', 'url', 'created_at', 'updated_at'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'content' => 'Content',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'author' => 'Author',
			'email' => 'Email',
			'url' => 'Url',
			'post_id' => 'Post ID',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = BlogComment::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'post_id' => $this->post_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'url', $this->url]);

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
