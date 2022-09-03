<?php

namespace app\controllers;

use Yii;
use app\models\Destinos;
use app\models\Categoria;
use app\models\Multimedia;
use app\models\DestinosSearch;
use app\models\Empresa;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Geolocation;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * DestinosController implements the CRUD actions for Destinos model.
 */
class DestinosController extends BackendController
{
    /**
     * {@inheritdoc}
     */
/*     public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    } */

    /**
     * Lists all Destinos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DestinosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $propietarios = Empresa::find()->select(['id', 'nombre'])->asArray()->all(); /* para hacer un select en search de preferencia  */
        $cat = Categoria::find()->select(['id', 'nombre'])->asArray()->all(); /* para hacer un select en search de preferencia  */

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'propietarios' => $propietarios,/* para hacer un select en search de preferencia  */
            'cat'=>$cat,
        ]);
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionMapa($id)
    {


        $model = new Geolocation();

        if ($model->load(Yii::$app->request->post())) {

            $model->destinos_id = $id;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->destinos_id]);
            }

            //print_r($model);
            //exit;                    
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('mapa', [
            'model' => $model,
        ]);
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionMapaup($id)
    {

        $model = Geolocation::find()->where(['destinos_id' => $id])->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->destinos_id = $id;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->destinos_id]);
            }

            //print_r($model);
            //exit;                    
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('mapaup', [
            'model' => $model,
        ]);
    }
    /**
     * Displays a single Destinos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Destinos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Destinos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Destinos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Destinos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionCase($id)
    {
        $model = $this->findModel($id);
        $geo = ArrayHelper::map(Geolocation::find()->where(['destinos_id' => $model->id])->all(), 'id', 'destinos_id');
        $multi = ArrayHelper::map(Multimedia::find()->where(['contenido_id' => $model->id])->all(), 'id', 'contenido_id');
        return $this->render('case', [

            'model' => $model,
            'geo' => $geo,
            'multi' => $multi,
        ]);
    }

    /**
     * Finds the Destinos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Destinos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Destinos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
