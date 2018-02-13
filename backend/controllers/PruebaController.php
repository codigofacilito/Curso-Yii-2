<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use yii\rest\ActiveController;
use \yii\filters\auth\HttpBasicAuth;
use \yii\helpers\ArrayHelper;
use \yii\filters\AccessControl;

/**
 * Description of RestBitacoratiempos
 *
 * @author marcos
 */
class PruebaController extends ActiveController {

    public $modelClass = 'backend\models\Bitacoratiempos';

    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                    'authenticator' => [
                        'class' => HttpBasicAuth::className(),
                    ],
                    'access' => [
                        'class' => AccessControl::className(),
                        'rules' => [
                            [
                                'actions' => ['index', 'view', 'create', 'delete', 'update'],
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                        ],
                    ],
        ]);
    }

    public function actionIndex($inicio, $final) {
        $query = \backend\models\Bitacoratiempos::find();
        $query->andWhere("Fecha>='" . $inicio . "'");
        $query->andWhere("Fecha<='" . $final . "'");
        return $query->all();
    }

}
