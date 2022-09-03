<?php

namespace app\controllers;

use Yii;
use app\models\Categoria;
use app\models\Destinos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriaController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    /* public function behaviors()
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
     * Lists all Categoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Categoria::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCase2($id)
    {
        $model = $this->findModel($id);
        $desti = ArrayHelper::map(Destinos::find()->where(['categoria_id' => $model->id])->all(), 'id', 'categoria_id');
        return $this->render('case2', [

            'model' => $model,
            'desti' => $desti
        ]);
    }

    /**
     * Displays a single Categoria model.
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
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categoria();

        if ($model->load(Yii::$app->request->post())) {
            $fileImage1 = UploadedFile::getInstance($model, 'imagen');
            if (empty($fileImage1)) { //no hay imagen, solo guarda datos
                /* $model->tipo = 1; */
                $model->imagen = 'default.png';
                $model->save(); //guarda los registros
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $datotemporal = uniqid('imagen-', true) . date('-Y-m-d-H-i-s');

                $imgName = $datotemporal . '.' . $fileImage1->getExtension();
                $model->imagen = $imgName;
                /* $model->tipo = 1; //imagen */

                $model->save(); //guarda los registros
                if ($model->save()) {
                    $fileImage1->saveAs('upload/categorias/' . $imgName);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $archivoAnterior = 'upload/categorias/' . $model->imagen;
        $archivoAnterior2 = $model->imagen;
        if ($model->load(Yii::$app->request->post())) {
            $fileImage1 = UploadedFile::getInstance($model, 'imagen');
            if (empty($fileImage1)) { //no hay imagen, solo guarda datos
                /* $model->tipo = 1; */
                $model->imagen = $archivoAnterior2;
                $model->save(); //guarda los registros
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                if ($archivoAnterior2 == 'default.png') {
                    $datotemporal = uniqid('imagen-', true) . date('-Y-m-d-H-i-s');
                    $imgName = $datotemporal . '.' . $fileImage1->getExtension();
                    $model->imagen = $imgName;
                    /* $model->tipo = 1; //imagen */

                    $model->save(); //guarda los registros
                    if ($model->save()) {
                        $fileImage1->saveAs('upload/categorias/' . $imgName);
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    unlink($archivoAnterior);
                    $datotemporal = uniqid('imagen-', true) . date('-Y-m-d-H-i-s');
                    $imgName = $datotemporal . '.' . $fileImage1->getExtension();
                    $model->imagen = $imgName;
                    /* $model->tipo = 1; //imagen */

                    $model->save(); //guarda los registros
                    if ($model->save()) {
                        $fileImage1->saveAs('upload/categorias/' . $imgName);
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Categoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();
        $archivoAnterior = 'upload/categorias/' . $model->imagen;
        if($model->imagen!='default.png'){
            unlink($archivoAnterior);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categoria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
