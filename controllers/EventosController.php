<?php

namespace app\controllers;

use Yii;
use app\models\Eventos;
use app\models\Sedes;
use app\models\ProgramacionEvento;
use app\models\ItemsCatalogo;
use app\models\ItemsEvento;
use app\models\EmpleadoGI;
use app\models\Invitados;
use app\models\EventosSearch;
use app\models\UploadForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Helper;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\web\Response;


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
        $model->evento_codigo = 0;
 
        $model->fecha_modificacion = Helper::getDateTimeNow();
        $model->usuario_modificacion =Helper::getUserDefault();
        $model->fecha_registro = Helper::getDateTimeNow();
        $model->usuario_registro =Helper::getUserDefault();
        $model->organizacion_codigo = Yii::$app->params['codigo_pais'];
        if($request = Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && !array_key_exists('btn_guardar',$_POST)) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && array_key_exists('btn_guardar',$_POST) ) {
            $programas = json_decode($_POST['table_program_data'], true);
            if(count($programas) == 0){
                Yii::$app->session->setFlash('flashMsgError', "Debe agregar al menos una programación para este evento."); 
                return $this->redirect(Yii::$app->request->referrer);
            }
            $model->evento_codigo = $model->getNextRecord();
            if($model->validate()){
                if($model->save()){

                    //Guardando Items de Evento
                    $ItemsEvento = new ItemsEvento();
                    $ItemsEvento->evento_codigo = $model->evento_codigo;
                    $ItemsEvento->usuario_modificacion = Helper::getUserDefault();
                    $ItemsEvento->usuario_registro = Helper::getUserDefault();
                    $items = json_decode($_POST['table_items_data'], true);
                    if(count($items) > 0){
                        $ItemsEvento->MasivoItemsEvento($items);
                    }

                    //Guardando Programacion de Evento
                    $ProgramacionEvento = new ProgramacionEvento();
                    $ProgramacionEvento->evento_codigo = $model->evento_codigo;
                    $ProgramacionEvento->sede_codigo = $_POST['Eventos']['sede'];
                    $ProgramacionEvento->ubicacion_codigo = $_POST['Eventos']['ubicacion_sede'];
                    $ProgramacionEvento->usuario_registro = Helper::getUserDefault();
                    $ProgramacionEvento->usuario_modifica = Helper::getUserDefault();
                    
                    if(count($programas) > 0){
                        $ProgramacionEvento->MasivoProgramacionEvento($programas);
                    }

                    //Guardando Invitados al evento
                    //si no hay invitados realizar la carga masiva
                    $Invitados = new Invitados();
                    $Invitados->evento_codigo = $model->evento_codigo;
                    if($Invitados->getExisteInvitadosEvento() == false){
                        $Invitados->usuario_modificacion = Helper::getUserDefault();
                        $Invitados->usuario_registro = Helper::getUserDefault();
                        $invitados = json_decode($_POST['table_invitados_data'], true);
                        $Invitados->MasivoInvitadosEvento($invitados);
                    }
                    return $this->redirect(['eventos/index']);
                }  

            }else{
                var_dump($model->errors);
                exit();
            }
        }

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->evento_codigo]);
        }*/

        return $this->render('create', [
            'model' => $model,
            'model_sedes'=> new Sedes(),
            'model_itemsCatalogo'=> new ItemsCatalogo(),
            'model_invitados'=> new Invitados(),

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
            $programas = json_decode($_POST['table_program_data'], true);
            if(count($programas) == 0){
                Yii::$app->session->setFlash('flashMsgError', "Debe agregar al menos una programación para este evento."); 
                return $this->redirect(Yii::$app->request->referrer);
            }
            if($model->validate()){
                if($model->save()){
                    $model->fecha_modificacion = Helper::getDateTimeNow();
                    $model->usuario_modificacion =Helper::getUserDefault();

                    //Guardando Items de Evento
                    $ItemsEvento = new ItemsEvento();
                    $ItemsEvento->evento_codigo = $model->evento_codigo;
                    $ItemsEvento->usuario_modificacion = Helper::getUserDefault();
                    $ItemsEvento->usuario_registro = Helper::getUserDefault();
                    $items = json_decode($_POST['table_items_data'], true);
                    if(count($items) > 0){
                        $ItemsEvento->MasivoItemsEvento($items);
                    }
                   
                    //Guardando Programacion de Evento
                    $ProgramacionEvento = new ProgramacionEvento();
                    $ProgramacionEvento->evento_codigo = $model->evento_codigo;
                    $ProgramacionEvento->sede_codigo = $_POST['Eventos']['sede'];
                    $ProgramacionEvento->ubicacion_codigo = $_POST['Eventos']['ubicacion_sede'];
                    $ProgramacionEvento->usuario_registro = Helper::getUserDefault();
                    $ProgramacionEvento->usuario_modifica = Helper::getUserDefault();
                    $programas = json_decode($_POST['table_program_data'], true);
                    $ProgramacionEvento->MasivoProgramacionEvento($programas);
                    //Guardando Invitados al evento
                    //si no hay invitados realizar la carga masiva
                    $Invitados = new Invitados();
                    $Invitados->evento_codigo = $model->evento_codigo;
                    if($Invitados->getExisteInvitadosEvento() == false){
                        $Invitados->usuario_modificacion = Helper::getUserDefault();
                        $Invitados->usuario_registro = Helper::getUserDefault();
                        $invitados = json_decode($_POST['table_invitados_data'], true);
                        if(count($invitados) > 0){
                            $Invitados->MasivoInvitadosEvento($invitados);
                        }
                    }
                    Yii::$app->session->setFlash('flashMsgExito', "Se registró exitosamente.");
                    return $this->redirect(['eventos/index']);
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
            'model_invitados'=> new Invitados(),

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

    public function actionPreviewInvitados(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $EmpleadoGI = new EmpleadoGI();
        $tmp_file = $_FILES['file']['tmp_name'];
        $ruta_archivo = './uploads/'. $_FILES['file']['name'];
        move_uploaded_file($tmp_file, $ruta_archivo);
        $fp  = fopen($ruta_archivo, "r");
        $invitados = [];
        while (!feof($fp)) {
            $line = fgets($fp);
            $line     = trim($line," \t\n\r");
            $EmpleadoGI->numero_documento = $line;
            $datosEmpleado = $EmpleadoGI->getEmpleadoDNI();
            if($datosEmpleado != false){
                array_push($invitados, $datosEmpleado);
            }
        }
        return $invitados;
    }
}
