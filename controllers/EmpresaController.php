<?php

namespace app\controllers;

use Yii;
use app\models\Empresa;
use app\models\EmpresaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Destinos;
use yii\helpers\ArrayHelper;
/**
 * EmpresaController implements the CRUD actions for Empresa model.
 */
class EmpresaController extends BackendController
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
     * Lists all Empresa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpresaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCase3($id)
    {
        $model = $this->findModel($id);
        $desti = ArrayHelper::map(Destinos::find()->where(['empresa_id' => $model->id])->all(), 'id', 'empresa_id');
        return $this->render('case3', [

            'model' => $model,
            'desti' => $desti
        ]);
    }
    /**
     * Displays a single Empresa model.
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
     * Creates a new Empresa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empresa();
        $bandera = true;

        if ($model->load(Yii::$app->request->post())) {
            $fileImage1 = UploadedFile::getInstance($model, 'logo');
            if (empty($fileImage1)) { //no hay imagen, solo guarda datos
                /* $model->tipo = 1; */
                $model->logo = 'default.png';
                $model->save(); //guarda los registros
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {

                $categoriaName = $model->nombre;
                $datotemporal = uniqid('logo-', true) . date('-Y-m-d-H-i-s');

                $imgName = $datotemporal . '.' . $fileImage1->getExtension();
                $model->logo = $imgName;
                /* $model->tipo = 1; //imagen */

                $model->save(); //guarda los registros
                if ($model->save()) {
                    $fileImage1->saveAs('upload/empresas/' . $imgName);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'bandera' => $bandera,
        ]);
    }

    /**
     * Updates an existing Empresa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $bandera = true;
        $archivoAnterior = 'upload/empresas/' . $model->logo;
        $archivoAnterior2 = $model->logo;
        if ($model->load(Yii::$app->request->post())) {
            $fileImage1 = UploadedFile::getInstance($model, 'logo');
            if (empty($fileImage1)) { //no hay imagen, solo guarda datos
                /* $model->tipo = 1; */
                $model->logo = $archivoAnterior2;
                $model->save(); //guarda los registros
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                if ($archivoAnterior2 == 'default.png') {
                    $datotemporal = uniqid('logo-', true) . date('-Y-m-d-H-i-s');
                    $imgName = $datotemporal . '.' . $fileImage1->getExtension();
                    $model->logo = $imgName;
                    /* $model->tipo = 1; //imagen */

                    $model->save(); //guarda los registros
                    if ($model->save()) {
                        $fileImage1->saveAs('upload/empresas/' . $imgName);
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    unlink($archivoAnterior);
                    $datotemporal = uniqid('logo-', true) . date('-Y-m-d-H-i-s');
                    $imgName = $datotemporal . '.' . $fileImage1->getExtension();
                    $model->logo = $imgName;
                    /* $model->tipo = 1; //imagen */

                    $model->save(); //guarda los registros
                    if ($model->save()) {
                        $fileImage1->saveAs('upload/empresas/' . $imgName);
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'bandera' => $bandera,
        ]);
    }

    /**
     * Deletes an existing Empresa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();
        $archivoAnterior = 'upload/empresas/' . $model->logo;
        if($model->logo!='default.png'){
            unlink($archivoAnterior);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Empresa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empresa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empresa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
