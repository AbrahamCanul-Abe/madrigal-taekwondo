<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DestinosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="destinos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion_corta') ?>

    <?= $form->field($model, 'descripcion_larga') ?>

    <?= $form->field($model, 'hora_apertura') ?>

    <?php // echo $form->field($model, 'hora_cierre') ?>

    <?php // echo $form->field($model, 'aforo') ?>

    <?php // echo $form->field($model, 'informacion_adicional') ?>

    <?php // echo $form->field($model, 'ubicacion') ?>

    <?php // echo $form->field($model, 'ubicacion_gps') ?>

    <?php // echo $form->field($model, 'infraestructura') ?>

    <?php // echo $form->field($model, 'actividades') ?>

    <?php // echo $form->field($model, 'servicios') ?>

    <?php // echo $form->field($model, 'inclusion') ?>

    <?php // echo $form->field($model, 'status')->checkbox() ?>

    <?php // echo $form->field($model, 'fecha_alta') ?>

    <?php // echo $form->field($model, 'categoria_id') ?>

    <?php // echo $form->field($model, 'empresa_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
