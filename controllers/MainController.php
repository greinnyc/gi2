<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\LoginUsuario;
use yii\filters\AccessControl;
/*use app\models\FormGrafico;
use app\models\Grafico;
use yii\web\Session;
use yii\db\Expression;
use app\models\ContadorVisitas;
use app\models\Calidad;*/

class MainController extends Controller{
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','util','inicio'],
                'rules' => [
                    [
                        'actions' => ['logout','util','inicio'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
    
    public function actionLogin(){
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            Yii::$app->response->redirect(['main/inicio']);
        }
        
        $model = new LoginUsuario();
        if( $model->load(Yii::$app->request->post()) &&  $model->login()){
            Yii::$app->response->redirect(['main/inicio']);
        }
        return $this->render("login", ["model"=> $model]);
    }
    
   
    public function actionInicio(){
      
        return $this->render("inicio");
    }
    
    public function actionLogout(){
        Yii::$app->user->logout();
        $session = Yii::$app->session;
        if ($session->isActive){
            $session->close();
            $session->destroy();
        }
        Yii::$app->response->redirect(['main/login']);
    }
    
    public function actionError(){
        if(Yii::$app->user->isGuest){
            $this->layout = "404";
        }
        return $this->render("error");
    }

    public function actionNoautorizado()
    {
        
        return $this->render('error', [
            'name' => "NO AUTORIZADO",
            'message' => "No estás autorizado para ver esta página",
        ]);
    }

    
}