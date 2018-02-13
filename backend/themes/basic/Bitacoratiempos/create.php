<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bitacoratiempos */

$this->title = Yii::t('app', 'Crear Registro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bitacoratiempos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bitacoratiempos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
