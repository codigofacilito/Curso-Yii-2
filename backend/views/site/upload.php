<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use dosamigos\fileinput\FileInput;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?php // $form->field($model, 'excelFile')->fileInput(['options' => ['class' => 'btn btn-primary']]) ?>
<p>Indique el archivo en excel de sus tiempos a cargar:</p>
<?=

FileInput::widget([
    'model' => $model,
    'attribute' => 'excelFile', // image is the attribute
    // using STYLE_IMAGE allows me to display an image. Cool to display previously
    // uploaded images
    //'style' => FileInput::STYLE_IMAGE
]);
?>
<?= Html::submitButton(Yii::t('app', 'Upload'), ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>