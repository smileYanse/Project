<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-form">

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="top">
            <img src="img/kode-icon.png" alt="icon" class="icon">
            <h1>BADU</h1>
            <h4>BADU Admin Login</h4>
        </div>
        <div class="form-area">
            <div class="group">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            </div>

            <div class="group">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>

            <div class="checkbox checkbox-primary">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    <div class="footer-links row">
        <div class="col-xs-6"><a href="#"><i class="fa fa-external-link"></i> Register Now</a></div>
        <div class="col-xs-6 text-right"><a href="#"><i class="fa fa-lock"></i> Forgot password</a></div>
    </div>
</div>