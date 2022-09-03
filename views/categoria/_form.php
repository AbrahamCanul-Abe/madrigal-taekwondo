<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true,'placeholder'=>'Nombre']) ?>

    <?= $form->field($model, 'descripción')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagen')->widget(FileInput::classname(), ['options' => ['accept' => '.jpg, .png'], 'pluginOptions' => [
        'maxFileSize' => 2000,
        'maxFiles' => '1',
        'allowedFileExtensions'=>["jpg", "png"]
    ]]) ?>

    <?= $form->field($model, 'orden')->textInput() ?>

    <?= $form->field($model, 'activo')->checkbox() ?>

    <!-- <?= $form->field($model, 'categoria_padre')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
        <a class="btn btn-outline-danger" href=<?= Url::to(['categoria/index']);?>>Cancelar </a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
