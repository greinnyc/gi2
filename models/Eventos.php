<?php

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;

/**
 * This is the model class for table "eventos".
 *
 * @property int $evento_codigo
 * @property int $organizacion_codigo
 * @property string $nombre
 * @property int $Estado_codigo
 * @property int $usuario_registro
 * @property int $usuario_modificacion
 * @property string $fecha_modificacion
 * @property string $fecha_registro
 *
 * @property Estados $estadoCodigo
 * @property Organizacion $organizacionCodigo
 * @property IngresoEvento[] $ingresoEventos
 * @property Invitados[] $invitados
 * @property ItemsEvento[] $itemsEventos
 * @property LogAccionesEvento[] $logAccionesEventos
 * @property ProgramacionEvento[] $programacionEventos
 * @property StaffEvento[] $staffEventos
 */


class Eventos extends \yii\db\ActiveRecord
{
    public $cantidad;
    public $estado_item;
    public $item_codigo;
    public $sede;
    public $ubicacion_sede;
    public $file;
    public $staff;
    public $staff_empleado;
    public $staff_tarea;
    public $estado_staff_empleado;
    public $table_program_data;
    public $invitado_empleado;
    public $estado_invitado_empleado;



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_invitado');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['evento_codigo', 'organizacion_codigo', 'nombre', 'Estado_codigo', 'usuario_registro', 'usuario_modificacion', 'fecha_modificacion', 'fecha_registro','sede','ubicacion_sede'], 'required'],
            [['evento_codigo', 'organizacion_codigo', 'Estado_codigo', 'usuario_registro', 'usuario_modificacion'], 'integer'],
            [['fecha_modificacion', 'fecha_registro'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['evento_codigo'], 'unique'],
            /*[['Estado_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['Estado_codigo' => 'estado_codigo']],
            [['organizacion_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Organizacion::className(), 'targetAttribute' => ['organizacion_codigo' => 'organizacion_codigo']],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'evento_codigo' => 'Evento Codigo',
            'organizacion_codigo' => 'Organizacion Codigo',
            'nombre' => 'Nombre',
            'Estado_codigo' => 'Estado Codigo',
            'usuario_registro' => 'Usuario Registro',
            'usuario_modificacion' => 'Usuario Modificacion',
            'fecha_modificacion' => 'Fecha Modificacion',
            'fecha_registro' => 'Fecha Registro',
            'ubicacion_sede'=>'Ubicación',
            'sede'=>'Sede'

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoCodigo()
    {
        return $this->hasOne(Estados::className(), ['estado_codigo' => 'Estado_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizacionCodigo()
    {
        return $this->hasOne(Organizacion::className(), ['organizacion_codigo' => 'organizacion_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngresoEventos()
    {
        return $this->hasMany(IngresoEvento::className(), ['evento_codigo' => 'evento_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitados()
    {
        return $this->hasMany(Invitados::className(), ['evento_codigo' => 'evento_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsEventos()
    {
        return $this->hasMany(ItemsEvento::className(), ['evento_codigo' => 'evento_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogAccionesEventos()
    {
        return $this->hasMany(LogAccionesEvento::className(), ['evento_codigo' => 'evento_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramacionEventos()
    {
        return $this->hasMany(ProgramacionEvento::className(), ['evento_codigo' => 'evento_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffEventos()
    {
        return $this->hasMany(StaffEvento::className(), ['evento_codigo' => 'evento_codigo']);
    }

    public function getSedeEvento($id){
        $query = Yii::$app->db_invitado->createCommand("SELECT sede_codigo as Codigo
            from DB_Invitado.dbo.programacion_evento
            where evento_codigo =".$id)->queryAll();
        $ids = [];
        if(count($query)>0){
            foreach ($query as $key => $value) {
                array_push($ids, $value['Codigo']);
            } 
        }
        return $ids;
    }

    public function getSedeUbicacionEvento($id){
         $query = Yii::$app->db_invitado->createCommand("SELECT su.ubicacion_codigo as Codigo
            from DB_Invitado.dbo.programacion_evento pe
            inner join sede_ubicacion su on su.ubicacion_codigo = pe.ubicacion_codigo
            where pe.evento_codigo =".$id)->queryAll();
        if(count($query)>0){
            return $query[0]['Codigo'];
        }
        return false;
    }

    public function getStaffEvento($id)
    {  
       $dataProvider = new SqlDataProvider([
            'sql' => "SELECT se.staff_codigo,e.nombre,e.apellido_materno,e.apellido_paterno,t.nombre as tarea,se.activo
                from DB_Invitado.dbo.staff_evento se
                left join empleado e on e.empleado_codigo = se.codigo_empleado
                left join tarea t on t.tarea_codigo = se.tarea_codigo
                where se.evento_codigo =:evento_codigo",
            'db' => Yii::$app->db_invitado,
            'pagination' => ['pageSize' => 10],
           'params' => [':evento_codigo' => $id],
        ]);
       return $dataProvider;
    }

    public function getEmpleadosRolStaff($id){
        $query = Yii::$app->db_invitado->createCommand("SELECT empleado_codigo as Codigo,numero_documento+' - '+nombre+' '+apellido_materno+' '+apellido_paterno as Descripcion from DB_Invitado.dbo.empleado e where
            e.estado_codigo = 1")->queryAll();
//             not exists ( SELECT * from staff_evento se where e.empleado_codigo = se.codigo_empleado and se.evento_codigo = ".$id." )
        return $query;
        
    }

    public function getTareas(){
        $query = Yii::$app->db_invitado->createCommand("SELECT tarea_codigo as Codigo,nombre as Descripcion
            from DB_Invitado.dbo.tarea
            where activo = 1")->queryAll();
        return $query;
    }

    public function getInvitadosEvento($id){

        $dataProvider = new SqlDataProvider([
            'sql' => "SELECT i.invitado_codigo, e.nombre, e.apellido_materno,e.apellido_paterno,i.activo,e.numero_documento
                from DB_Invitado.dbo.invitados i
                LEFT JOIN empleado e on e.empleado_codigo = i.empleado_codigo
                where i.evento_codigo =:evento_codigo",
            'db' => Yii::$app->db_invitado,
            'pagination' => ['pageSize' => 10],
           'params' => [':evento_codigo' => $id],
        ]);
       return $dataProvider;
    }

    public function getEmpleadosEvento($id){
        $query = Yii::$app->db_invitado->createCommand(" SELECT i.invitado_codigo as Codigo,e.numero_documento+' - '+e.nombre+' '+e.apellido_materno+' '+e.apellido_paterno as Descripcion
                from DB_Invitado.dbo.invitados i
                LEFT JOIN empleado e on e.empleado_codigo = i.empleado_codigo
                where i.evento_codigo =".$id)->queryAll();
        return $query;
    }

    public function getNextRecord()
    {
        $model2 = $this->find()->orderBy(['evento_codigo' => SORT_DESC])->one();

        if($model2 !== null) {

             $codigo  = $model2->evento_codigo+1;
        
        }else {

             $codigo  = 1;
        
        }
        return $codigo;

    }

    public function getEmpleados(){
        $query = Yii::$app->db_invitado->createCommand("SELECT e.empleado_codigo as Codigo,e.numero_documento+' - '+e.nombre+' '+e.apellido_materno+' '+e.apellido_paterno as Descripcion
            from DB_Invitado.dbo.empleado e
        where estado_codigo= 1")->queryAll();
        return $query;
    }



    
    
}
