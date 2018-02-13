<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class='panel panel-info'>
        <div class='panel-heading'>
            <h1><?= Html::encode($this->title) ?></h1>

            <p><?= Yii::t('app', 'Please fill out the following fields to login:') ?></p>
        </div>

        <div class="row panel-body">
            <div class="col-lg-12 center-block">
                <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'id' => 'login-form']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
