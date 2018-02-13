<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\Proyectos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyectos-form">

    <?php
    $form = ActiveForm::begin();
    ?>

    <?= $form->field($model, 'NombreProyecto')->textInput(['maxlength' => true]) ?>
    <?php
    if (!$model->isNewRecord) {
        echo $form->field($model, 'Activo')->checkbox();

        Modal::begin([
            'header' => '<h4>Actividades</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
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
                    'header' => Html::button('Nueva actividad', ['value' => Url::to(['actividades/create-con-proyecto', 'idProyecto' => $model->idProyecto]), 'class' => 'btn btn-primary', 'id' => 'modalActividad']),
                    //Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;Nueva', ['actividades/create-con-proyecto', 'idProyecto' => $model->idProyecto]),
                    'template' => '{update_con_proyecto}{delete}',
                    'buttons' => [
                        'update_con_proyecto' => function ($url, $model) {
                            return Html::a('<span class="glyphicon  glyphicon-pencil"></span>', '#', [
                                        'title' => Yii::t('app', 'Update'),
                                        'value' => urldecode(Url::to(['actividades/update-con-proyecto'])),
                                        'class' => 'modActividad',
                            ]);
                        }
                            ],
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
