<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\Destinos;
/* @var $this yii\web\View */
/* @var $model app\models\Multimedia */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Multimedia'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="multimedia-view container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?php $un = $model->tipo;
        if ($un == 1) {
            echo Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        } else {
            echo Html::a(Yii::t('app', 'Actualizar'), ['videoup', 'id' => $model->id], ['class' => 'btn btn-primary']);
        } ?>
       <!--  <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estas seguro de eliminar esta multimedia?'),
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
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function ($model) {
                    $url = $model->tipo;
                    if ($url == 2) {
                        $res = preg_split("/=/", $model->url);
                        if ($res[0]!='https://www.youtube.com/watch?v') {
                            return 'Url invalida, no es un url de youtube'. Html::a(Yii::t('app', 'Actualizar'), ['videoup', 'id' => $model->id], ['class' => 'btn btn-primary']);;
                        } else {
                            $embeddedUrl = $res[1];
                            return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $embeddedUrl . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        }
                    } else {
                        return '<img src="' . Yii::getAlias('@web') . '/upload/multimedia/' . $model->url . '" width="200" height="auto">';
                    }
                }
            ],
            'tipo',
            [
                'attribute' => 'contenido_id',
                'contentOptions' => ['style' => 'width: 10%;'],
                'value' => function ($model) {
                    $empresa = Destinos::findOne($model->contenido_id);
                    return $empresa->nombre;
                },

            ],
        ],
    ]) ?>
    <br>
    <a class="btn btn-outline-danger" href=<?= Url::to(['multimedia/index']); ?>>Regresar </a>
</div>