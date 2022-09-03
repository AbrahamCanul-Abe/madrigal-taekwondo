<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = Yii::t('app', 'Viendo información de la empresa: {name}', [
    'name' => $model->nombre,
]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="empresa-view container mt-auto">
    <br><br>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['Actualizar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!-- <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Esta Seguro de eliminar esta empresa?'),
                'method' => 'post',
            ],
        ]) ?> -->
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'descripcion',
            [
                'attribute' => 'logo',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 28%; text-align:center;'],
                'value' => function ($model) {
                    // if ($model->url!=''){
                    return '<img src="' . Yii::getAlias('@web') . '/upload/empresas/' . $model->logo . '" width="200" height="auto">';
                }
            ],
            'telefono',
            'email:email',
            'website',
            'ubicacion_gps',
            'status:boolean',
        ],
    ]) ?>
    <div class="form-group">
        <a class="btn btn-outline-danger" href=<?= Url::to(['empresa/index']); ?>>Volver </a>
    </div>
</div>