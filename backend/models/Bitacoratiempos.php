<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bitacoratiempos".
 *
 * @property integer $idBitacoraTiempo
 * @property string $Fecha
 * @property string $HoraInicio
 * @property string $HoraFinal
 * @property string $Interrupcion
 * @property double $Total
 * @property string $ActividadNoPlaneada
 * @property integer $idActividadPlaneada
 * @property integer $idProyecto
 * @property string $Artefacto
 * @property integer $idUsuario
 */
class Bitacoratiempos extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'bitacoratiempos';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Fecha', 'HoraInicio', 'HoraFinal', 'Interrupcion'], 'safe'],
            ['Interrupcion', 'match', 'pattern' => '/[0-9][0-9]:[0-5][0-9]/', 'message' => 'Indique en formato hh:mm'],
            [['idActividadPlaneada', 'idProyecto', 'idUsuario'], 'integer'],
            [['ActividadNoPlaneada', 'Artefacto'], 'string', 'max' => 250],
            [['Fecha', 'HoraInicio', 'HoraFinal', 'Interrupcion', 'Artefacto', 'idProyecto'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idBitacoraTiempo' => Yii::t('app', 'Id Bitacora Tiempo'),
            'Fecha' => Yii::t('app', 'Fecha'),
            'HoraInicio' => Yii::t('app', 'Hora Inicio'),
            'HoraFinal' => Yii::t('app', 'Hora Final'),
            'Interrupcion' => Yii::t('app', 'Interrupcion'),
            'Total' => Yii::t('app', 'Total'),
            'ActividadNoPlaneada' => Yii::t('app', 'Actividad No Planeada'),
            'idActividadPlaneada' => Yii::t('app', 'Id Actividad Planeada'),
            'idProyecto' => Yii::t('app', 'Proyecto'),
            'Artefacto' => Yii::t('app', 'Artefacto'),
            'idUsuario' => Yii::t('app', 'Id Usuario'),
        ];
    }

    public function beforeSave($insert) {
        $fechaHoraInicio = date_create_from_format('h:i a', $this->HoraInicio);
        $fechaHoraFinal = date_create_from_format('h:i a', $this->HoraFinal);
        $fechaHoraInt = date_create_from_format('H:i', $this->Interrupcion);
        $interval = date_diff($fechaHoraFinal, $fechaHoraInicio);
        $this->Total = (($interval->h * 60 + $interval->i) - (
                $fechaHoraInt->format('i'))) / 60.0;
        $this->Fecha = date_format(date_create_from_format('d-m-Y', $this->Fecha), 'Y-m-d');
        $this->HoraInicio = date_format($fechaHoraInicio, 'Y-m-d H:i:s');
        $this->HoraFinal = date_format($fechaHoraFinal, 'Y-m-d H:i:s');
        $this->Interrupcion = date_format($fechaHoraInt, 'Y-m-d H:i:s');
        $this->idUsuario = Yii::$app->user->id;
        return true;
    }

    public function getProyecto() {
        return $this->hasOne(Proyectos::className(), ['idProyecto' => 'idProyecto']);
    }

    /*public function getNombreProyecto() {
        return $this->proyecto ? $this->proyecto->NombreProyecto : 'Proyecto';
    }*/

}
