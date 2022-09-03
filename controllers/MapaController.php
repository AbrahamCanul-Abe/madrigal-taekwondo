<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Geolocation;
use app\models\Destinos;
use app\models\Multimedia;

class MapaController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($id)
    {
        $Obtener = Geolocation::findOne($id);
        $id_des=$Obtener->destinos_id;
        $getDestino= Destinos::findOne($id_des);
        $Titulo=$getDestino->nombre;
        $Descripcion=$getDestino->descripcion_corta;
        $getMultimedia= Multimedia::findOne(['contenido_id' => $id_des]);
        $Foto=$getMultimedia->url;

        return $this->render('index',['Titulo'=>$Titulo,'Descripcion'=>$Descripcion,'Foto'=>$Foto,'id_des'=>$id_des]);
    }

 
}
