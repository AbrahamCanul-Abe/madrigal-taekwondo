<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Destinos;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpresaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Información de las empresas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-index container-fluid">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Nueva Empresa'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
           /*  'website',
            'ubicacion_gps', */
            //'status:boolean',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete} {update} {geo}',
            'urlCreator' => function ($action, $model, $key, $index) {

                if ($action == "delete") {
                    $desti = ArrayHelper::map(Destinos::find()->where(['empresa_id' => $model->id])->all(), 'id', 'empresa_id');
                    if (empty($desti)) {
                        return Url::to(['delete', 'id' => $key]);
                    } else {
                        return Url::to(['case3', 'id' => $key]);
                    }
                }
                if ($action == "view") {

                    return Url::to(['view', 'id' => $key]);
                }
                if ($action == "update") {

                    return Url::to(['update', 'id' => $key]);
                }
            },],
        ],
    ]); ?>


</div>
