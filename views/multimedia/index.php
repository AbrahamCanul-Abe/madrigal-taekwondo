<?php

use app\models\Destinos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MultimediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Multimedia');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multimedia-index container-fluid">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Agregar Imagen'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Agregar Video'), ['video'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /* 'id', */
            'nombre',
            'descripcion',
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function ($model) {
                $url=$model->tipo;
                    if ($url==2) {
                        $res = preg_split("/=/", $model->url);
                        
                        if ($res[0]!='https://www.youtube.com/watch?v') {
                            return 'Url invalida, no es un url de youtube';
                        } else {
                            $embeddedUrl = $res[1];
                            return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $embeddedUrl . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        }
                    }
                    else{
                        return '<img width="560" height="315" src="' . Yii::getAlias('@web') . '/upload/multimedia/' . $model->url . '" width="200" height="auto">';
                    }
                }
            ],
      /*       [
                'attribute' => 'tipo',
                'contentOptions' => ['style' => 'width: 10%;'],
                'value' => function ($model) {
                    $tipo=$model->tipo;
                    if($tipo==1){

                        return 'imagen';
                    }
                    else{
                        return 'Video';
                    }
                    
                },

            ], */
            [
                /* para hacer un select en search de preferencia  */
                'attribute' => 'tipo', // Debe llamarse igual a la llave foránea  
                'value' => function ($model) {
                    $tipo=$model->tipo;
                    if($tipo==1){

                        return 'imagen';
                    }
                    else{
                        return 'Video';
                    }
                    
                }, // Se deberá de colocar el nombre del campo con el cual se filtrará, puede usarse el mismo nombre de acuerdo al modelo
                'filterType' => GridView::FILTER_SELECT2, //No cambia dejarlo tal cual
                'filter' =>[1=>'imagen',2=>'video'], //Se debe de mapear el arreglo
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' =>  'Filtrar tipo de multimedia'], // Si así lo desea puedes agregar un place holder
            ],
            [
                /* para hacer un select en search de preferencia  */
                'attribute' => 'contenido_id', // Debe llamarse igual a la llave foránea  
                'value' => 'destinos.nombre', // Se deberá de colocar el nombre del campo con el cual se filtrará, puede usarse el mismo nombre de acuerdo al modelo
                'filterType' => GridView::FILTER_SELECT2, //No cambia dejarlo tal cual
                'filter' => ArrayHelper::map($dest, 'id', 'nombre'), //Se debe de mapear el arreglo
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' =>  'Filtrar Destinos'], // Si así lo desea puedes agregar un place holder
            ],
            [
                'class' => 'yii\grid\ActionColumn',

                'template' =>'{view} {delete} {update} {video}',

                'buttons' => [

                    
                    'video' => function ($url, $model, $key) {
                        $tipo=$model->tipo;
                        if ($tipo==2){
                            return Html::a( '<span class="fas fa-video"></span>', ['multimedia/videoup/','id'=>$model->id],['title' => 'Editar video',]);
                        }
                        
                    },
                    'update' => function ($url, $model, $key) {
                        $tipo=$model->tipo;
                        if ($tipo==1){
                            return Html::a( '<span class="fas fa-image"></span>', ['multimedia/update/','id'=>$model->id],['title' => 'Editar imagen',]);
                        }
                        
                    },
                    ]
            ],
        ],
    ]); ?>
</div>