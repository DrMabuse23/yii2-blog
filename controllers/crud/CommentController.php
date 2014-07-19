<?php

namespace drmabuse\blog\controllers\crud;

use drmabuse\blog\models\app\Comment;
use drmabuse\blog\models\app\CommentSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
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
	 * Lists all Comment models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new CommentSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Comment model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Comment model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Comment;

		try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(Url::previous());
            } else {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $model->addError('id', $e->errorInfo[2]);
		}
        return $this->render('create', ['model' => $model,]);
	}

	/**
	 * Updates an existing Comment model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Comment model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Comment model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Comment the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Comment::findOne($id)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
