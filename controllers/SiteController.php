<?php

namespace app\controllers;

use app\models\Data;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SiteController extends Controller
{

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete-items' => ['post'],
				],
			],
		];
	}

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	$model = new Data();
    	if ($model->load(Yii::$app->request->post()) && $model->save()) {
    		$this->setFlash([
			    'class' => 'success',
			    'message' => "Новая запис добавлено успешно!"
		    ], false);
	    }
	    $data = Data::find()->orderBy('id DESC')->all();
        return $this->render('index', [
	        'model' => $model,
	        'data' => $data
        ]);
    }

    public function actionUpdate($id)
    {
    	$model = Data::findOne($id);
    	if (!$model) {
		    $this->setFlash([
			    'class' => 'warning',
			    'message' => "Запис не найдено!"
		    ], true);
	    }
	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
		    $this->setFlash([
			    'class' => 'success',
			    'message' => "Запис обновлено успешно!"
		    ], true);
	    }
    	return $this->render('update', [
    		'model' => $model
	    ]);
    }

    public function actionDelete($id)
    {
     	$model = Data::findOne($id);
	    if (!$model) {
	    	$result = [
			    'class' => 'warning',
			    'message' => "Запис не найдено!"
		    ];
	    } else {
	    	$result = [
			    'class' => 'info',
			    'message' => "Запис удалено!"
		    ];
		    $model->delete();
	    }
	    $this->setFlash($result, true);
    	return $this->goHome();
    }

    public function actionDeleteItems()
    {
    	$ids = Yii::$app->request->post()['id'];
    	foreach ($ids as $id) {
    		Data::findOne($id)->delete();
	    }
    	$result = [ 'class' => 'info', 'message' => "Записы удалено!"];
    	$this->setFlash($result, true);
    }

    public function setFlash(array $result, bool $home) : void
	{
		Yii::$app->session->setFlash('result', $result);
		if ($home) {
			$this->goHome();
		}
	}
}
