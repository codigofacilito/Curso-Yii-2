<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;

HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProyectosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Productividad');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <?=
    Highcharts::widget([
        'options' => [
            'credits' => ['enabled' => false],
            'chart' => ['type' => 'area'],
            'title' => ['text' => 'Productividad ' . Yii::$app->user->identity->username],
            'exporting' => [
                'chartOptions' => [// specific options for the exported image
                    'plotOptions' => [
                        'series' => [
                            'dataLabels' => [
                                'enabled' => true
                            ]
                        ]
                    ]
                ],
                'scale' => 3,
                'fallbackToExportServer' => false
            ],
            'plotOptions' => [
                'area' => [
                    'stacking' => 'normal',
                    'lineColor' => '#666666',
                    'lineWidth' => 1,
                    'marker' => [
                        'lineWidth' => 1,
                        'lineColor' => '#666666'
                    ]
                ]
            ],
            'xAxis' => [
                'categories' => $fechas
            ],
            'yAxis' => [
                'title' => ['text' => 'Horas productivas']
            ],
            'series' => $series
        ]
    ]);
    ?>

</div>
