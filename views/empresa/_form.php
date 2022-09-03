<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Empresa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-form container mt-auto">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true,'placeholder'=>'Nombre','class' => 'form-control']) ?>

    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->widget(FileInput::classname(), ['options' => ['accept' => '.jpg, .png'], 'pluginOptions' => [
        'maxFileSize' => 2000,
        'maxFiles' => '1',
        'allowedFileExtensions'=>["jpg", "png"],
    ]]) ?>
    
    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder'=>'name@example.com']) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true,'placeholder'=>'https://example.com/users/']) ?>

    <!-- <?= $form->field($model, 'ubicacion_gps')->textInput() ?> -->

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
        <a class="btn btn-outline-danger" href=<?= Url::to(['empresa/index']);?>>Cancelar </a>
    </div>
    <?php ActiveForm::end(); ?>

</div>