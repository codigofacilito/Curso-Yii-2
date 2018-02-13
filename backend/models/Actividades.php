<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "actividades".
 *
 * @property integer $idActividad
 * @property string $NombreActividad
 * @property boolean $Activo
 * @property integer $idProyecto
 */
class Actividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Activo'], 'boolean'],
            [['idProyecto'], 'integer'],
            [['NombreActividad'], 'string', 'max' => 200],
            [['idProyecto', 'NombreActividad'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idActividad' => Yii::t('app', 'Id Actividad'),
            'NombreActividad' => Yii::t('app', 'Nombre Actividad'),
            'Activo' => Yii::t('app', 'Activo'),
            'idProyecto' => Yii::t('app', 'Id Proyecto'),
        ];
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        if($insert)
            $this->Activo = 1;
        return true;
    }


}
