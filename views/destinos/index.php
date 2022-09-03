<?php

use yii\helpers\Html;
/* use yii\grid\GridView; */
use app\models\Empresa;
use app\models\Categoria;
use yii\helpers\ArrayHelper;
use  yii\helpers\Json;
use app\models\Elementos;
use app\models\Geolocation;
use app\models\Multimedia;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DestinosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Destinos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="destinos-index container-fluid">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Crear un destino'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'descripcion_corta',
            /* 'descripcion_larga:ntext', */
            'hora_apertura',
            'hora_cierre',
            'aforo',
            /* 'informacion_adicional', */
            /* 'ubicacion:ntext',
            'ubicacion_gps', */

            /* 'infraestructura',
            'actividades',
            'servicios',
            'inclusion', */
            /* 'status:boolean',
            'fecha_alta', */
            [
                /* para hacer un select en search de preferencia  */
                'attribute' => 'categoria_id', // Debe llamarse igual a la llave foránea  
                'value' => 'categoria.nombre', // Se deberá de colocar el nombre del campo con el cual se filtrará, puede usarse el mismo nombre de acuerdo al modelo
                'filterType' => GridView::FILTER_SELECT2, //No cambia dejarlo tal cual
                'filter' => ArrayHelper::map($cat, 'id', 'nombre'), //Se debe de mapear el arreglo
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' =>  'Filtrar categorias'], // Si así lo desea puedes agregar un place holder
            ],
            [
                /* para hacer un select en search de preferencia  */
                'attribute' => 'empresa_id', // Debe llamarse igual a la llave foránea  
                'value' => 'empresa.nombre', // Se deberá de colocar el nombre del campo con el cual se filtrará, puede usarse el mismo nombre de acuerdo al modelo
                'filterType' => GridView::FILTER_SELECT2, //No cambia dejarlo tal cual
                'filter' => ArrayHelper::map($propietarios, 'id', 'nombre'), //Se debe de mapear el arreglo
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' =>  'Filtrar Empresas'], // Si así lo desea puedes agregar un place holder
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete} {update} {geo}',
                'urlCreator' => function( $action, $model, $key, $index ){

                    if ($action == "delete") {
                        $geo = ArrayHelper::map(Geolocation::find()->where(['destinos_id' => $model->id])->all(), 'id', 'destinos_id');
                        $multi = ArrayHelper::map(Multimedia::find()->where(['contenido_id' => $model->id])->all(), 'id', 'contenido_id');
                        if(empty($multi) && empty($geo)){
                            return Url::to(['delete', 'id' => $key]);
                        }
                        else{
                            return Url::to(['case', 'id' => $key]);
                        }

                    }
                    if ($action == "view") {

                        return Url::to(['view', 'id' => $key]);

                    }
                    if ($action == "update") {

                        return Url::to(['update', 'id' => $key]);

                    }

                },
                'buttons' => [
                    
                    'geo' => function ($url, $model, $key) {
                        $geo = ArrayHelper::map(Geolocation::find()->where(['destinos_id' => $model->id])->all(), 'id', 'destinos_id');
                        
                        if (empty($geo)) {
                            return Html::a('<span class="fas fa-map-marker-alt"></span>', ['destinos/mapa/', 'id' => $model->id], ['title' => 'Agregar geolocalización',]);
                        }
                        else{
                            return Html::a('<span style="color:green" class="fas fa-map-marker-alt"></span>', ['destinos/mapaup/', 'id' => $model->id], ['title' => 'Actualizar geolocalización',]);
                        }
                    },
                ],
            ],
        ]
    ]); ?>


</div>