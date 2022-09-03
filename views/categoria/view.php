<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\url;
/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = Yii::t('app', 'Viendo información de la categoria: {name}', [
    'name' => $model->nombre,
]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="categoria-view container mt-auto">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       <!--  <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Esta Seguro de eliminar esta categoria?'),
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'descripción',
            [
                'attribute' => 'imagen',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 28%; text-align:center;'],
                'value' => function ($model) {
                    // if ($model->url!=''){
                    return '<img src="' . Yii::getAlias('@web') . '/upload/categorias/' . $model->imagen . '" width="200" height="auto">';
                }
            ],
            'orden',
            'activo:boolean',
            'categoria_padre',
        ],
    ]) ?>
    <div class="form-group">
        <a class="btn btn-outline-danger" href=<?= Url::to(['categoria/index']); ?>>Volver </a>
    </div>
</div>
