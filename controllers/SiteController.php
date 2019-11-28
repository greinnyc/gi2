<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
       public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index',],
                'rules' => [
                    [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

  

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
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
       
        $this->layout = 'login';
        
        if (!Yii::$app->user->isGuest) {
            //return $this->goHome();
            Yii::$app->response->redirect(['site/index']);
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();

            Yii::$app->response->redirect(['site/index']);
        }

        return $this->render("login", ["model"=> $model]);
        
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        Yii::$app->response->redirect(['site/login']);
    }

    public function actionError()
    {
        /*Yii::$app->user->logout();
        Yii::$app->response->redirect(['site/login']);*/
        //return $this->goHome();
        
    
        
        if(Yii::$app->user->isGuest) {
            
                echo "<b>La página solicitada no existe</b>";

                $previous = "javascript:history.go(-1)";
                if(isset($_SERVER['HTTP_REFERER'])) {
                    $previous = $_SERVER['HTTP_REFERER'];
                }
                echo '<br><br><a href="'.$previous.'"> << Vover atrás</a>';
                exit();
        

        }else {

             return $this->render('error', [
                'name' => "ERROR",
                'message' => "La página solicitada no existe",
            ]);
        }  
    }
    
     public function actionNoautorizado()
    {
        /*Yii::$app->user->logout();
        Yii::$app->response->redirect(['site/login']);*/
        //return $this->goHome();
        return $this->render('error', [
            'name' => "NO AUTORIZADO",
            'message' => "No estás autorizado para ver esta página",
        ]);
    }
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

    
}
