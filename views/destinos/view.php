<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\Elementos;
use app\models\Destinos;
use Mpdf\Tag\Br;

/* @var $this yii\web\View */
/* @var $model app\models\Destinos */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="destinos-view container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!-- <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'descripcion_corta',
            'descripcion_larga:ntext',
            'hora_apertura',
            'hora_cierre',
            'aforo',
            'informacion_adicional',
            'ubicacion:ntext',
            [
                'attribute' => 'infraestructura',
                'format' => 'raw',
                'value' => function ($model) {
                    $id = $model->id;
                    $model = Destinos::find()->where(['id' => $id])->one();
                    $array = json_decode(json_encode($model->infraestructura));
                    $infraestructura = "";
                    if (empty($array)) {
                        return $infraestructura;
                    }
                    else {
                        foreach ($array as $value) {
                            $modelElementos = Elementos::find()->where(['id' => $value])->one();
                            $infraestructura.=$modelElementos->descripcion .Html::tag('br');
                        }
                        return $infraestructura;
                    }
                    
                }
            ],
            [
                'attribute' => 'actividades',
                'format' => 'raw',
                'value' => function ($model) {
                    $id = $model->id;
                    $model = Destinos::find()->where(['id' => $id])->one();
                    $array = json_decode(json_encode($model->actividades));
                    $infraestructura = "";
                    if (empty($array)) {
                        return $infraestructura;
                    }
                    else{
                        foreach ($array as $value) {
                            $modelElementos = Elementos::find()->where(['id' => $value])->one();
                            $infraestructura.=$modelElementos->descripcion .Html::tag('br');;
                        }
                        return $infraestructura;
                    }
                }
            ],
            [
                'attribute' => 'servicios',
                'format' => 'raw',
                'value' => function ($model) {
                    $id = $model->id;
                    $model = Destinos::find()->where(['id' => $id])->one();
                    $array = json_decode(json_encode($model->servicios));
                    $infraestructura = "";
                    if (empty($array)) {
                        return $infraestructura;
                    }
                    else{
                        foreach ($array as $value) {
                            $modelElementos = Elementos::find()->where(['id' => $value])->one();
                            $infraestructura.=$modelElementos->descripcion .Html::tag('br');;
                        }
                        return $infraestructura;
                    }
                }
            ],
            [
                'attribute' => 'inclusion',
                'format' => 'raw',
                'value' => function ($model) {
                    $id = $model->id;
                    $model = Destinos::find()->where(['id' => $id])->one();
                    $array = json_decode(json_encode($model->inclusion));
                    $infraestructura = "";
                    if (empty($array)) {
                        return $infraestructura;
                    }
                    else{
                        foreach ($array as $value) {
                            $modelElementos = Elementos::find()->where(['id' => $value])->one();
                            $infraestructura.=$modelElementos->descripcion .Html::tag('br');;
                        }
                        return $infraestructura;
                    }
                }
            ],
            'status:boolean',
            'fecha_alta',
            'categoria_id',
            'empresa_id',
        ],
    ]) ?>
    <a class="btn btn-outline-danger" href=<?= Url::to(['destinos/index']); ?>>Volver </a>
</div>