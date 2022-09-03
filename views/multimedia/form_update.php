<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Destinos;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\Multimedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="multimedia-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true,'placeholder'=>'Nombre']) ?>

    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true,]) ?>

    <?= $form->field($model, 'url')->widget(FileInput::classname(), ['options' => ['accept' => '.jpg, .png',], 'pluginOptions' => [
        'initialPreview' => [
            Yii::getAlias('@web') . '/upload/multimedia/' . $model->url
        ],
        'allowedFileExtensions'=>["jpg", "png"],
        'initialPreviewAsData' => true,
        'initialCaption' => $model->url,
        'initialPreviewConfig' => [
            ['caption' => $model->url],

        ],
        'overwriteInitial' => true,
        'resizeImages'=>true,
        'maxFileSize' => 2000,
    ],])->label('Imagen') ?>

    <?= $form->field($model, 'tipo')->textInput(['disabled'=>true]) 
    ?>

    <?php
    $destino = ArrayHelper::map(Destinos::find()->where(['status' => 1])->orderBy('nombre')->all(), 'id', 'nombre');
    echo $form->field($model, 'contenido_id')->widget(Select2::classname(), [
        'data' => $destino,
        'options' => ['placeholder' => 'Elige destino'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Seleccion de destino'); ?>
    <div class="form-group">
        <br>
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
        <a class="btn btn-outline-danger" href=<?= Url::to(['multimedia/index']);?>>Cancelar </a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
