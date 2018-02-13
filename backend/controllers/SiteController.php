<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\Graficas;
use backend\models\UploadForm;
use yii\web\UploadedFile;
use backend\models\Bitacoratiempos;

/**
 * Site controller
 */
class SiteController extends Controller {

    const NUM_DIAS = 15;

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'logout'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'upload', 'logout', 'extplorer'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        $fechas = array();
        for ($i = 0; $i < self::NUM_DIAS; $i++)
            $fechas[$i] = date("d-m-Y", strtotime((self::NUM_DIAS - 1 - $i) . " days ago"));
        $datos = new Graficas();
        $datos = $datos->obtenDatos(self::NUM_DIAS, date('Y-m-d'), Yii::$app->user->id);
        return $this->render('index', ['fechas' => $fechas, 'series' => $datos]);
    }

    public function actionLogin() {
        $this->layout = 'login';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionUpload() {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstance($model, 'excelFile');
            if ($model->upload()) {
                if($this->guardaRegistro('uploads/' . $model->excelFile->name))
                    return $this->goHome();
                else
                   return $this->render('error'); 
            }
            else {
                return $this->render('error', ['message' => 'El archivo ya fue cargado', 'name' => 'archivo duplicado']);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
    
    public function actionExtplorer() {
        return $this->render('extplorer');
    }

    private function guardaRegistro($inputFile) {

        try
        {
        $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
        $objReader = \PHPEXCEL_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFile);


        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            if ($row == 1) {
                continue;
            }

            $registro = new Bitacoratiempos();
            $registro->Fecha = $rowData[0][0];
            $registro->HoraInicio = $rowData[0][1];
            $registro->Interrupcion = $rowData[0][2];
            $registro->HoraFinal = $rowData[0][3];
            $registro->ActividadNoPlaneada = $rowData[0][6];
            $registro->idProyecto = $rowData[0][7];
            $registro->Artefacto = $rowData[0][8];
            $registro->save();
        }
        return true;
        }
        catch(yii\db\Exception $e)
        {
            return false;
        }
    }

}
