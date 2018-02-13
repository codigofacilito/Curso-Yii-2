<?php

use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use backend\models\Proyectos;
use kartik\select2\Select2;
use backend\assets\TimerAsset;

TimerAsset::register($this);
?>

<?php $form = ActiveForm::begin(['id' => 'frmTimer']); ?>

<div class="container">
    <?= $form->field($model, 'ActividadNoPlaneada')->textInput(['maxlength' => true]) ?>

    <?php
    $proyectos = ArrayHelper::map(Proyectos::find()->where(['Activo' => 1])->orderBy('NombreProyecto')->all(), 'idProyecto', 'NombreProyecto');
    echo $form->field($model, 'idProyecto')->widget(Select2::classname(), [
        'data' => $proyectos,
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un proyecto ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'Artefacto')->textInput(['maxlength' => true]) ?>
</div>

<div class="container text-center">
    <?=
    yii\helpers\Html::button('<span class="glyphicon glyphicon-play"></span> Iniciar', [
        'class' => 'btn-primary btn-lg',
        'id' => 'btnIniciar',
    ])
    ?>
    <?=
    yii\helpers\Html::button('<span class="glyphicon glyphicon-pause"></span> Pausa', [
        'class' => 'btn-primary btn-lg',
        'id' => 'btnPausa',
        'disabled' => true,
    ])
    ?>
    <?=
    yii\helpers\Html::submitButton('<span class="glyphicon glyphicon-stop"></span> Detener', [
        'class' => 'btn-primary btn-lg',
        'id' => 'btnDetener',
        'disabled' => true,
        'OnClick' => 'return ChecaForm()',
    ])
    ?>
</div>
<div class="container">
    <?= $form->field($model, 'Fecha')->textInput(['id' => 'fecha', 'disabled' => true]);
    ?>
    <?=
    $form->field($model, 'HoraInicio')->textInput(['id' => 'inicio', 'disabled' => true]);
    ?>

    <?=
    $form->field($model, 'HoraFinal')->textInput(['id' => 'final', 'disabled' => true]);
    ?>
    <?= $form->field($model, 'Interrupcion')->textInput(['id' => 'interrupcion', 'disabled' => true]) ?>

</div>
<?php ActiveForm::end(); ?>
