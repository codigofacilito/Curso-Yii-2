<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BitacoratiemposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bitacora de Tiempos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bitacoratiempos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    if ($bandera) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-success',
            ],
            'body' => $mensaje,
        ]);
    }
    ?>
    <p>
        <?= Html::a(Yii::t('app', 'Crear registro'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Fecha',
            'HoraInicio',
            'HoraFinal',
            'Interrupcion',
            'Total',
            'ActividadNoPlaneada',
            /*['value' => function ($data) {
                    return $data->getNombreProyecto();
                }, 'label' => 'Proyecto'],*/
            ['attribute' => 'idProyecto', 'value' => 'proyecto.NombreProyecto'],
            // 'idActividadPlaneada',
            // 'idProyecto',
            // 'Artefacto',
            // 'idUsuario',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
