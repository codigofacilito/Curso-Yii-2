<?php

namespace backend\controllers;

use Yii;
use backend\models\Bitacoratiempos;
use backend\models\search\BitacoratiemposSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BitacoratiemposController implements the CRUD actions for Bitacoratiempos model.
 */
class BitacoratiemposController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'delete', 'update', 'timer'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionTimer() {
        $model = new Bitacoratiempos();
        $model->Fecha = Date('d-m-Y');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $bandera = true;
                $mensaje = "El registro se agregó de manera satisfactoria";
                $searchModel = new BitacoratiemposSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                return $this->redirect(['index',
                            'bandera' => $bandera,
                            'mensaje' => $mensaje
                ]);
            } else {
                return $this->render('view', ['model' => $model]);
            }
        } else {
            return $this->render('timer', ['model' => $model]);
        }
    }

    /**
     * Lists all Bitacoratiempos models.
     * @return mixed
     */
    public function actionIndex($mensaje = NULL) {
        if ($mensaje === NULL) {
            $bandera = false;
            $mensaje = "";
        } else {
            $bandera = TRUE;
        }
        $searchModel = new BitacoratiemposSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'bandera' => $bandera,
                    'mensaje' => $mensaje
        ]);
    }

    /**
     * Displays a single Bitacoratiempos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bitacoratiempos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Bitacoratiempos();
        $model->Fecha = time();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $bandera = true;
            $mensaje = "El registro se agregó de manera satisfactoria";
            $searchModel = new BitacoratiemposSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->redirect(['index',
                        'bandera' => $bandera,
                        'mensaje' => $mensaje
            ]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Bitacoratiempos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $bandera = true;
            $mensaje = "El registro se modificó de manera satisfactoria";
            $searchModel = new BitacoratiemposSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->redirect(['index',
                        'bandera' => $bandera,
                        'mensaje' => $mensaje
            ]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Bitacoratiempos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $bandera = true;
        $mensaje = "El registro con id " . $id . " se eliminó de manera correcta";
        $this->findModel($id)->delete();

        return $this->redirect(['index',
                    'bandera' => $bandera,
                    'mensaje' => $mensaje
        ]);
    }

    /**
     * Finds the Bitacoratiempos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bitacoratiempos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Bitacoratiempos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
