<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Proyectos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyectos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NombreProyecto')->textInput(['maxlength' => true]) ?>
    <?php
    if (!$model->isNewRecord) {
        echo $form->field($model, 'Activo')->checkbox();
        ?>

        <h2>Actividades</h2>
        <?=
        \yii\grid\GridView::widget([
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $model->getActividades(),
                'pagination' => false
                    ]),
            'columns' => [
                'NombreActividad',
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'controller' => 'actividades',
                    'header' => Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;Nueva', ['actividades/create-con-proyecto', 'idProyecto' => $model->idProyecto]),
                    'template' => '{update_con_proyecto}{delete}',
                    'buttons' => [
                        'update_con_proyecto' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon  glyphicon-pencil"></span>', $url, [
                                        'title' => Yii::t('app', 'Update'),
                                    ]);
                                }
                            ],
                            'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'update_con_proyecto') {
                                    $url = Url::to(['actividades/update-con-proyecto', 'id' => $model->idActividad]);
                                    return $url;
                                }
                            }
                        ]
                    ]
                ]);
                ?>
                <?php } ?>

            <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>

</div>
