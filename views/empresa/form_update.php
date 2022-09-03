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

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'logo')->widget(FileInput::classname(), ['options' => ['accept' => '.jpg, .png'], 'pluginOptions' => [
        'initialPreview' => [
            Yii::getAlias('@web') . '/upload/empresas/' . $model->logo
        ],
        'allowedFileExtensions'=>["jpg", "png"],
        'initialPreviewAsData' => true,
        'initialCaption' => $model->logo,
        'initialPreviewConfig' => [
            ['caption' => $model->logo],

        ],
        'overwriteInitial' => true,
        'maxFileSize' => 1024,
        'maxFiles' => '1',
    ],]) ?>
    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ubicacion_gps')->textInput() ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
        <a class="btn btn-outline-danger" href=<?= Url::to(['empresa/index']);?>>Cancelar </a>
    </div>

    <?php ActiveForm::end(); ?>

</div>