<?php 
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class BaseController extends Controller { 
    public $layout = 'main-backend';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                #'only' => ['logout','index'],
                'rules' => [
                   
                    [
                        'allow' => true,
                        #'actions' => ['logout', 'index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    

/*     public function actionLogout(){
        Yii::$app->user->logout();
         $this->redirect(['site/index']); 
    } */
  
}

?>