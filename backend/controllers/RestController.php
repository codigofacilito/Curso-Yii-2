<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use yii\rest\Controller;
use backend\models\Graficas;
use Yii;

/**
 * Description of RestController
 *
 * @author marcos
 */
class RestController extends Controller {

    public function actionIndex() {
        $graficas = new Graficas();
        return $graficas->obtenDatos(15, date('Y-m-d'), Yii::$app->user->id);
    }

}
