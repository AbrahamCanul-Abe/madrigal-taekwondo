<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\tipo;
use app\models\Elementos;
use app\models\Categoria;
use app\models\Empresa;
use kartik\select2\Select2;
use kartik\widgets\TimePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Destinos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="destinos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Nombre']) ?>

    <?= $form->field($model, 'descripcion_corta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion_larga')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hora_apertura')->widget(kartik\time\TimePicker::className(), [
        'pluginOptions' => ['minuteStep' => 1, 'showMeridian' => false, 'autoclose' => true, 'format' => 'hh:ii']
    ]) ?>
    <?= $form->field($model, 'hora_cierre')->widget(kartik\time\TimePicker::className(), [
        'pluginOptions' => ['minuteStep' => 1, 'showMeridian' => false, 'autoclose' => true, 'format' => 'hh:ii',]
    ]) ?>

    <?= $form->field($model, 'aforo')->textInput() ?>

    <?= $form->field($model, 'informacion_adicional')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ubicacion')->textarea(['rows' => 3,'placeholder' => 'ejemplo: Calle 11 x 21 y 30 colonia centro']) ?>

    <?php
    $dataInfraestructura = ArrayHelper::map(Elementos::find()->where(['tipo_id' => 1])->orderBy('descripcion')->all(), 'id', 'descripcion');
    echo $form->field($model, 'infraestructura')->widget(Select2::classname(), [
        'data' => $dataInfraestructura,
        'options' => ['multiple' => true, 'placeholder' => 'Selecciona la Infraestructura del Destino..'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php
    $dataActividades = ArrayHelper::map(Elementos::find()->where(['tipo_id' => 2])->orderBy('descripcion')->all(), 'id', 'descripcion');
    echo $form->field($model, 'actividades')->widget(Select2::classname(), [
        'data' => $dataActividades,
        'options' => ['multiple' => true, 'placeholder' => 'Selecciona las Actividades del Destino..'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php
    $dataDestino = ArrayHelper::map(Elementos::find()->where(['tipo_id' => 3])->orderBy('descripcion')->all(), 'id', 'descripcion');
    echo $form->field($model, 'servicios')->widget(Select2::classname(), [
        'data' => $dataDestino,
        'options' => ['multiple' => true, 'placeholder' => 'Selecciona los Servicios del Destino'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php
    $dataInclusion = ArrayHelper::map(Elementos::find()->where(['tipo_id' => 4])->orderBy('descripcion')->all(), 'id', 'descripcion');
    echo $form->field($model, 'inclusion')->widget(Select2::classname(), [
        'data' => $dataInclusion,
        'options' => ['multiple' => true, 'placeholder' => 'Selecciona los Elementos de Inclusión del Destino'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php
    $categoria = ArrayHelper::map(Categoria::find()->where(['activo' => 1])->orderBy('nombre')->all(), 'id', 'nombre');
    echo $form->field($model, 'categoria_id')->widget(Select2::classname(), [
        'data' => $categoria,
        'options' => ['placeholder' => 'Categorias'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Tipo de destino'); ?>

    <?php
    $Empresa = ArrayHelper::map(Empresa::find()->where(['status' => 1])->orderBy('nombre')->all(), 'id', 'nombre');
    echo $form->field($model, 'empresa_id')->widget(Select2::classname(), [
        'data' => $Empresa,
        'options' => ['placeholder' => 'Empresa'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Propietario'); ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        <a class="btn btn-outline-danger" href=<?= Url::to(['destinos/index']); ?>>Cancelar </a>
    </div>

    <?php ActiveForm::end(); ?>

</div>