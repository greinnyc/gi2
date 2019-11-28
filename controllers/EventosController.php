<?php

namespace app\controllers;

use Yii;
use app\models\Eventos;
use app\models\Sedes;
use app\models\ProgramacionEvento;
use app\models\ItemsCatalogo;
use app\models\ItemsEvento;
use app\models\EventosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Helper;


/**
 * EventosController implements the CRUD actions for Eventos model.
 */
class EventosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Eventos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Eventos model.
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
     * Creates a new Eventos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Eventos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->evento_codigo]);
        }

        return $this->render('create', [
            'model' => $model,
            'model_sedes'=> new Sedes(),
            'model_itemsCatalogo'=> new ItemsCatalogo(),
        ]);
    }

    /**
     * Updates an existing Eventos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->sede = $model->getSedeEvento($id);
        $model->ubicacion_sede = $model->getSedeUbicacionEvento($id);
        if($request = Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && !array_key_exists('btn_guardar',$_POST)) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }



        if ($model->load(Yii::$app->request->post()) && array_key_exists('btn_guardar',$_POST) ) {
            if($model->validate()){
                if($model->save()){
                    
                    //var_dump($_POST['Eventos']);
                    //exit();
                    $model->fecha_modificacion = Helper::getDateTimeNow();
                    $model->usuario_modificacion =Helper::getUserDefault();
                    //Guardando Programacion de Evento
                    $ProgramacionEvento = new ProgramacionEvento();
                    $ProgramacionEvento->evento_codigo = $model->evento_codigo;
                    $ProgramacionEvento->sede_codigo = $_POST['Eventos']['sede'];
                    $ProgramacionEvento->ubicacion_codigo = $_POST['Eventos']['ubicacion_sede'];
                    $ProgramacionEvento->usuario_registro = Helper::getUserDefault();
                    $ProgramacionEvento->usuario_modifica = Helper::getUserDefault();
                    $programas = json_decode($_POST['table_program_data'], true);
                    $ProgramacionEvento->MasivoProgramacionEvento($programas);
                                             

                    //Guardando Items de Evento
                    $ItemsEvento = new ItemsEvento();
                    $ItemsEvento->evento_codigo = $model->evento_codigo;
                    $ItemsEvento->usuario_modificacion = Helper::getUserDefault();
                    $ItemsEvento->usuario_registro = Helper::getUserDefault();
                    $items = json_decode($_POST['table_items_data'], true);
                    $ItemsEvento->MasivoItemsEvento($items);

                    //$ItemsEvento->evento_codigo


                    
                    return $this->redirect(['eventos/index']);
                    //return $this->redirect(['view', 'id' => $model->evento_codigo]);
                }  

            }else{
                var_dump($model->errors);
                exit();
            }
            

        }

        return $this->render('update', [
            'model' => $model,
            'model_sedes'=> new Sedes(),
            'model_itemsCatalogo'=> new ItemsCatalogo(),
        ]);
    }

    /**
     * Deletes an existing Eventos model.
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

    /**
     * Finds the Eventos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Eventos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Eventos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
