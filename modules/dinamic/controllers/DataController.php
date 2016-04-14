<?php

namespace app\modules\dinamic\controllers;

use Yii;
use app\modules\dinamic\models\Data;
use app\modules\dinamic\models\DataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataController implements the CRUD actions for Data model.
 */
class DataController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Data models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Data model.
     * @param integer $unit_id
     * @param integer $element_id
     * @return mixed
     */
    public function actionView($unit_id, $element_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($unit_id, $element_id),
        ]);
    }

    /**
     * Creates a new Data model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Data();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'unit_id' => $model->unit_id, 'element_id' => $model->element_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Data model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $unit_id
     * @param integer $element_id
     * @return mixed
     */
    public function actionUpdate($unit_id, $element_id)
    {
        $model = $this->findModel($unit_id, $element_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'unit_id' => $model->unit_id, 'element_id' => $model->element_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Data model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $unit_id
     * @param integer $element_id
     * @return mixed
     */
    public function actionDelete($unit_id, $element_id)
    {
        $this->findModel($unit_id, $element_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Data model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $unit_id
     * @param integer $element_id
     * @return Data the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($unit_id, $element_id)
    {
        if (($model = Data::findOne(['unit_id' => $unit_id, 'element_id' => $element_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
