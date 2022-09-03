<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Categoria;
use app\models\Destinos;
use app\models\Multimedia;
//use yii\bootstrap4;
use app\models\Geolocation;
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;
use app\models\Comentarios;
use yii\db\Command;


class SiteController extends Controller
{
    public $layout = 'main-frontend';

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays categorias page.
     *
     * @return string
     */
    public function actionCategorias()
    { 
        $Categorias = Categoria::find()->orderBy('nombre')->all();
        $Destinos = Destinos::find()->all();
        $Multimedia = Multimedia::find()->all();

        return $this->render('categorias', ['categorias'=>$Categorias, 'destinos'=>$Destinos, 'multimedia'=>$Multimedia]);
    }

    /**
     * Displays Destinos page.
     * 
     * @return string
     */
    public function actionDestinos($id_categoria)
    {
        $Destinos = Destinos::find()->where(['categoria_id' => $id_categoria])->orderBy('nombre')->all();
        $Categorias = Categoria::find()->where(['id'=>$id_categoria])->orderBy('nombre')->all();
        $Multimedia = Multimedia::find()->all();

        return $this->render('destinos', ['destinos'=>$Destinos, 'categorias'=>$Categorias, 'multimedia' =>$Multimedia]);
    }   

     /**
     * Displays destinodetallado page.
     *
     * @return string
     */
    public function actionDestinodetallado($id_destino)
    {
    
        $model = new Comentarios();

        if ($model->load(Yii::$app->request->post())) {
            $model->destinos_id = $id_destino;
            if ($model->save()) {
                return $this->redirect(['destinodetallado', 'id_destino' => $model->destinos_id]);
            }

            //print_r($model);
            //exit;                    
            //return $this->redirect(['view', 'id' => $model->id]);
        }


        $Comentarios = Comentarios::find()->where(['destinos_id' => $id_destino])->orderBy('id DESC')->all();
        //$Rating = Comentarios::find()->select(['destinos_id', 'AVG(puntuacion)'])->where(['destinos_id' => $id_destino])->groupBy('destinos_id')->all();
        //$Rating = $connection->createCommand('SELECT destinos_id, AVG(puntuacion) FROM comentarios GROUP BY destinos_id;')->queryAll();
        $Rating = Yii::$app->db->createCommand('SELECT destinos_id, AVG(puntuacion) as promedio FROM comentarios WHERE destinos_id ='.$id_destino.' GROUP BY destinos_id')->queryOne();

        $Destinos = Destinos::find()->where(['id'=>$id_destino])->all();
        $Multimedia = Multimedia::find()->all();
        $video = Multimedia::find()->where(['tipo'=>2, 'contenido_id'=>$id_destino])->all();
        $Obtener = Geolocation::findOne(['destinos_id' => $id_destino]);
        $point = json_decode($Obtener->location);
        $long = $point->geometry->coordinates[0];
        $lat = $point->geometry->coordinates[1];
        $getDestino= Destinos::findOne($id_destino);
        $Titulo=$getDestino->nombre;
        $Descripcion=$getDestino->descripcion_corta;
        $getMultimedia= Multimedia::find()->where(['contenido_id' => $id_destino])->andWhere(['tipo'=>1])->one();

        if(empty($getMultimedia)){
            $Foto="default.png";
        }else{
            $Foto=$getMultimedia->url;
        }
        if(empty($Rating)){
            $Rating['promedio']=0;
           return $this->render('destinodetallado', ['video'=>$video,'comentarios'=>$Comentarios,'destinos'=>$Destinos, 'multimedia'=>$Multimedia,'model' => $model,'rating'=>$Rating,'Titulo'=>$Titulo,'Descripcion'=>$Descripcion,'Foto'=>$Foto,'id_des'=>$id_destino,'long'=>$long,'lat'=>$lat]); 
        }
       else{
        return $this->render('destinodetallado', ['video'=>$video,'comentarios'=>$Comentarios,'destinos'=>$Destinos, 'multimedia'=>$Multimedia,'model' => $model,'rating'=>$Rating,'Titulo'=>$Titulo,'Descripcion'=>$Descripcion,'Foto'=>$Foto,'id_des'=>$id_destino,'long'=>$long,'lat'=>$lat]);
       }
       
    }   


     /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionMapa()
    {
/*      vgit m$query = select a.nombre, descripcion_corta, location, mapcenter, mapzoom 
        from destinos a 
        inner join geolocation b on a.id = b.destinos_id 
        left join multimedia c on a.id = c.contenido_id         
 */

        $destino=Destinos::find()->all();
        $models = Geolocation::find()->all();
        return $this->render('mapa', ['models' => $models,'destino'=>$destino ]);
    }
   
    /**
     * Displays mialredor.
     *
     * @return string
     */
    public function actionMialrededor()
    {
        return $this->render('mialrededor');
    } 


    public function actionAcerca_de()
    {
        return $this->render('acerca_de');
    }

    public function actionPolitica_privacidad()
    {
        return $this->render('politica_privacidad');
    }

    public function actionTerminos_condiciones()
    {
        return $this->render('terminos_condiciones');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['backend/index']);
        }
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]); 
    } 

}
