<?php

namespace app\controllers;

use Yii;
use app\models\Multimedia;
use app\models\MultimediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use app\models\Destinos;

/**
 * MultimediaController implements the CRUD actions for Multimedia model.
 */
class MultimediaController extends BaseController
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
     * Lists all Multimedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MultimediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dest = Destinos::find()->select(['id', 'nombre'])->asArray()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dest' => $dest,
        ]);
    }

    /**
     * Displays a single Multimedia model.
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
     * Creates a new Multimedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //nota: si se quiere subir imagenes con mas de 2mb se tiene modificar en php.ini
        $model = new Multimedia();
        $model->tipo = 1;
        if ($model->load(Yii::$app->request->post())) {
            $fileImage1 = UploadedFile::getInstance($model, 'url');
            if (empty($fileImage1)) { //no hay imagen, solo guarda datos
                /* $model->tipo = 1; */
                $model->url = 'default.png';
                $model->save(); //guarda los registros
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {

                $datotemporal = uniqid('url-', true) . date('-Y-m-d-H-i-s');

                $imgName = $datotemporal . '.' . $fileImage1->getExtension();
                $model->url = $imgName;

                $model->save(); //guarda los registros
                if ($model->save()) {
                    $fileImage1->saveAs('..\tmp' . $imgName);
                    Image::getImagine()->open('..\tmp' . $imgName)->thumbnail(new Box(800, 600))->save('upload/multimedia/' . $imgName, ['quality' => 85]);
                    unlink('..\tmp' . $imgName);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionVideo()
    {
        $model = new Multimedia();


        $model->tipo = 2;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('video', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing Multimedia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $archivoAnterior = 'upload/multimedia/' . $model->url;
        $archivoAnterior2 = $model->url;
        if ($model->load(Yii::$app->request->post())) {
            $fileImage1 = UploadedFile::getInstance($model, 'url');
            if (empty($fileImage1)) { //no hay imagen, solo guarda datos
                /* $model->tipo = 1; */
                $model->url = $archivoAnterior2;
                $model->save(); //guarda los registros
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                if ($archivoAnterior2 == 'default.png') {
                    $datotemporal = uniqid('url-', true) . date('-Y-m-d-H-i-s');
                    $imgName = $datotemporal . '.' . $fileImage1->getExtension();
                    $model->url = $imgName;

                    $model->save(); //guarda los registros
                    if ($model->save()) {
                        $fileImage1->saveAs('..\tmp' . $imgName);
                        Image::getImagine()->open('..\tmp' . $imgName)->thumbnail(new Box(800, 600))->save('upload/multimedia/' . $imgName, ['quality' => 85]);
                        unlink('..\tmp' . $imgName);
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    unlink($archivoAnterior);
                    $datotemporal = uniqid('url-', true) . date('-Y-m-d-H-i-s');
                    $imgName = $datotemporal . '.' . $fileImage1->getExtension();
                    $model->url = $imgName;
                    $model->save(); //guarda los registros
                    if ($model->save()) {
                        $fileImage1->saveAs('..\tmp' . $imgName);
                        Image::getImagine()->open('..\tmp' . $imgName)->thumbnail(new Box(800, 600))->save('upload/multimedia/' . $imgName, ['quality' => 85]);
                        unlink('..\tmp' . $imgName);
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionVideoup($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('videoup', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Multimedia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();
        if ($model->tipo == 1) {
            $archivoAnterior = 'upload/multimedia/' . $model->url;
            if ($model->url != 'default.png') {
                unlink($archivoAnterior);
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Multimedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Multimedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Multimedia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
