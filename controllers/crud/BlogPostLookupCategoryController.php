<?php

namespace drmabuse\blog\controllers\crud;

use drmabuse\blog\models\app\BlogPostLookupCategory;
use drmabuse\blog\models\app\BlogPostLookupCategorySearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * BlogPostLookupCategoryController implements the CRUD actions for BlogPostLookupCategory model.
 */
class BlogPostLookupCategoryController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
            'access' => [
                'class' => AccessControl::className(),
                    'rules' => [
                    [
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'delete',
                            'view'
                        ],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ]
		];
	}

	/**
	 * Lists all BlogPostLookupCategory models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new BlogPostLookupCategorySearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single BlogPostLookupCategory model.
	 * @param integer $category_id
	 * @param integer $post_id
	 * @return mixed
	 */
	public function actionView($category_id, $post_id)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($category_id, $post_id),
		]);
	}

	/**
	 * Creates a new BlogPostLookupCategory model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new BlogPostLookupCategory;

		try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(Url::previous());
            } else {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $model->addError('category_id', $e->errorInfo[2]);
		}
        return $this->render('create', ['model' => $model,]);
	}

	/**
	 * Updates an existing BlogPostLookupCategory model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $category_id
	 * @param integer $post_id
	 * @return mixed
	 */
	public function actionUpdate($category_id, $post_id)
	{
		$model = $this->findModel($category_id, $post_id);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing BlogPostLookupCategory model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $category_id
	 * @param integer $post_id
	 * @return mixed
	 */
	public function actionDelete($category_id, $post_id)
	{
		$this->findModel($category_id, $post_id)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the BlogPostLookupCategory model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $category_id
	 * @param integer $post_id
	 * @return BlogPostLookupCategory the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($category_id, $post_id)
	{
		if (($model = BlogPostLookupCategory::findOne(['category_id' => $category_id, 'post_id' => $post_id])) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
