<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;
use app\models\Comentarios;
use app\models\Destinos;
use app\models\User;

class BackendController extends BaseController
{

/*     public function behaviors(){
            return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'view','create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view','create', 'update','delete'],
                         'allow' => true,
                         'roles' => ['@'],
                    ],
                ],
            ]
        ];
        }  */
    
/*     public function actionIndex()
    {
        $model = new LoginForm();
        $this->layout = 'main-frontend';
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->layout = 'main-backend';
            return $this->render('dashboard');
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }  */

    public function actionIndex(){
  #return $this->render('index');
  return $this->render('dashboard');
} 

/**EXIT SESSION**/
/* public function actionLogout()
{
  Yii::$app->user->logout(true);

      return $this->actionIndex();
}
 */
/****SEGURIDAD****/
/* public function behaviors()
   {
       return [
           'access' => [
             'class'=>AccessControl::className(),
             'only'=>['index'],
             'rules'=>[
             [
              'allow'=>true,
              'actions'=>['index'],
              'roles'=>['@'],
            ]
             ]
           ]
          ];
    } */

    public function actionReportview(){

        $comentarios = Comentarios::find()->where(['>', 'puntuacion', 3])->orderBy('puntuacion')->all();
        
        
        $destinos = Destinos::find()->orderBy('nombre')->all();

        $content = $this->renderPartial('reportview', ['destinos' => $destinos, 'comentarios' => $comentarios]);
        /* $pdf = Yii::$app->pdf;
        $pdf->content = $content; */

        $pdf = Yii::$app->pdf; // or new Pdf();
        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->SetHeader('Reporte de comentarios'); // call methods or set any properties
        $mpdf->SetFooter('Instituto Tecnologico Superior De Valladolid ');
        $mpdf->WriteHtml($content); // call mpdf write html


        return $pdf->render();
/*         $destinos = Destinos::find()->all();
        $comentarios = Comentarios::find()->all();
        return $this->render('reportview', [
            'destinos' => $destinos,
            'comentarios' => $comentarios,
        ]); */
    }

    
        /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}