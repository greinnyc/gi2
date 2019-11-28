<?php

namespace app\controllers;

use Yii;
use app\models\StaffEvento;
use app\models\StaffEventoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\components\Helper;


/**
 * StaffEventoController implements the CRUD actions for StaffEvento model.
 */
class StaffEventoController extends Controller
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
     * Lists all StaffEvento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffEventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StaffEvento model.
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
     * Creates a new StaffEvento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StaffEvento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->staff_codigo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StaffEvento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->staff_codigo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StaffEvento model.
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
     * Finds the StaffEvento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StaffEvento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StaffEvento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

     public function actionGetProgramacionEvento($evento){
        $model = new ProgramacionEvento();
        $programas = $model->getProgramacionEvento($evento);
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = [];
        foreach ($programas as $programa) {
            $data_pro= [
                        'programacion_codigo' => $programa['programacion_codigo'],
                        'fecha_inicial' => $programa['fecha_inicial'],
                        'fecha_final' => $programa['fecha_final'],
                        'hora_inicio' => $programa['hora_inicio'],
                        'hora_fin' => $programa['hora_fin'],
                      ];
            array_push($data, $data_pro);
        }
        
        return ['data' => $data];

    }

    public function actionGetStaffEmpleadoEvento($empleadoStaff){
        $model = new StaffEvento();
        $empleadoStaff = $model->getStaffEmpleadoEvento($empleadoStaff);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $empleadoStaff;
       
    }
    public function actionSaveStaffEmpleadoEvento($staff_codigo,$staff_empleado,$tarea_codigo,$activo,$evento_codigo){
        $model = new StaffEvento();
        $model->evento_codigo = $evento_codigo;
        $model->codigo_empleado = $staff_empleado;
        $model->tarea_codigo = $tarea_codigo;
        $model->activo = $activo;
        $model->usuario_modificacion = Helper::getUserDefault();
        $model->fecha_modificacion = Helper::getDateTimeNow();
        $model->staff_codigo = $model->existStaffEmpleadoEvento($evento_codigo,$staff_empleado);

        if($model->staff_codigo == false){
            $model->token = 'TOKEN_ENCRIPTAR'; 
            $model->fecha_token = Helper::getDateTimeNow(); 
            $model->vigencia_token = Helper::getDateTimeNow();
            $model->usuario_registro = Helper::getUserDefault();
            $model->fecha_registro = Helper::getDateTimeNow();                                          
            $model->addStaffEmpleadoEvento();

        }else{
            $model->updateStaffEmpleadoEvento();
        }
          
    }
}
