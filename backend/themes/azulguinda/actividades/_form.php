<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \backend\models\Proyectos;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Actividades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NombreActividad')->textInput(['maxlength' => true]) ?>

    <?php
    if (!$model->isNewRecord)
        echo $form->field($model, 'Activo')->checkbox();
    ?>

    <?php
    if ($bandera) {
        $proyectos = ArrayHelper::map(Proyectos::find()->where(['Activo' => 1])->orderBy('NombreProyecto')->all(), 'idProyecto', 'NombreProyecto');
        echo $form->field($model, 'idProyecto')->widget(Select2::classname(), [
            'data' => $proyectos,
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione un proyecto ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    }
    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
