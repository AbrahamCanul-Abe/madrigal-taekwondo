<?php

use app\models\Destinos;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categorias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-index container-fluid">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Categoria'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            //'activo:boolean',
            //'categoria_padre',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete} {update} {geo}',
                'urlCreator' => function ($action, $model, $key, $index) {

                    if ($action == "delete") {
                        $desti = ArrayHelper::map(Destinos::find()->where(['categoria_id' => $model->id])->all(), 'id', 'categoria_id');
                        if (empty($desti)) {
                            return Url::to(['delete', 'id' => $key]);
                        } else {
                            return Url::to(['case2', 'id' => $key]);
                        }
                    }
                    if ($action == "view") {

                        return Url::to(['view', 'id' => $key]);
                    }
                    if ($action == "update") {

                        return Url::to(['update', 'id' => $key]);
                    }
                },
            ],
        ],
    ]); ?>


</div>