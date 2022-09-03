<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;


?>
<br><br><br><br><br>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-lg-offset-1" style="color:blank;" >
        <center><h1>LOGIN</h1></center> 
    </div>
    <center><h4>Estas apunto de ingresar al backend (administracion) de los datos del sitio web, 
        </h4></p></center><p>
    <CEnter><h3>FAVOR DE INGRESAR USUARIO Y CONTRASEÑA CORRECTA </h3></CEnter>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        /* 'layout' => 'horizontal', */
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <center><?=$form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block' , 'name' => 'login-button']) ?>
            </div>
        </div> </center>

    <?php ActiveForm::end(); ?>

</div>
