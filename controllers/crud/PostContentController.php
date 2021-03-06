<?php

namespace drmabuse\blog\controllers\crud;

use drmabuse\blog\controllers\crud\action\PostContentFileUpload;
use drmabuse\blog\models\app\PostContent;
use drmabuse\blog\models\app\PostContentSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Response;
use yii\helpers\Json;

/**
 * PostContentController implements the CRUD actions for PostContent model.
 */
class PostContentController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post']
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
                            'view',
                            'upload'
                        ],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ]
                ],
            ]
		];
	}
    /**
     * add actions to controller
     * @return array
     */
    public function actions()
    {
        return [
            'upload' => [
                'class' => PostContentFileUpload::className(),
            ]
        ];
    }

	/**
	 * Lists all PostContent models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new PostContentSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single PostContent model.
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
	 * Creates a new PostContent model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new PostContent;

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
	 * Updates an existing PostContent model.
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
	 * Deletes an existing PostContent model.
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
	 * Finds the PostContent model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return PostContent the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = PostContent::findOne($id)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
