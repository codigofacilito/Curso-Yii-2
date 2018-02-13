<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "proyectos".
 *
 * @property integer $idProyectos
 * @property string $NombreProyecto
 * @property integer $Activo
 */
class Proyectos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyectos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Activo'], 'boolean'],
            [['NombreProyecto'], 'string', 'max' => 200],
            ['NombreProyecto', 'required', 'message' => 'El nombre del proyecto es requerido']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProyectos' => Yii::t('app', 'Id Proyectos'),
            'NombreProyecto' => Yii::t('app', 'Nombre Proyecto'),
            'Activo' => Yii::t('app', 'Activo'),
        ];
    }
    
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividades()
    {
        return $this->hasMany(Actividades::className(), ['idProyecto' => 'idProyecto']);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        if($insert)
            $this->Activo = 1;
        return true;
    }
}
