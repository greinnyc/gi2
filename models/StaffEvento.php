<?php

namespace app\models;
 use yii\db\Expression;


use Yii;

/**
 * This is the model class for table "staff_evento".
 *
 * @property int $staff_codigo
 * @property int $codigo_empleado
 * @property int $evento_codigo
 * @property int $tarea_codigo
 * @property string $token
 * @property string $fecha_token
 * @property string $vigencia_token
 * @property int $activo
 * @property int $usuario_registro
 * @property int $usuario_modificacion
 * @property string $fecha_registro
 * @property string $fecha_modificacion
 *
 * @property Eventos $eventoCodigo
 * @property Empleado $codigoEmpleado
 * @property Tarea $tareaCodigo
 */
class StaffEvento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff_evento';
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
            [['staff_codigo', 'codigo_empleado', 'evento_codigo', 'tarea_codigo', 'token', 'fecha_token', 'vigencia_token', 'activo', 'usuario_registro', 'usuario_modificacion', 'fecha_registro', 'fecha_modificacion'], 'required'],
            [['staff_codigo', 'codigo_empleado', 'evento_codigo', 'tarea_codigo', 'activo', 'usuario_registro', 'usuario_modificacion'], 'integer'],
            [['fecha_token', 'vigencia_token', 'fecha_registro', 'fecha_modificacion'], 'safe'],
            [['token'], 'string', 'max' => 255],
            [['staff_codigo'], 'unique'],
            [['evento_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::className(), 'targetAttribute' => ['evento_codigo' => 'evento_codigo']],
            /*[['codigo_empleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['codigo_empleado' => 'empleado_codigo']],
            [['tarea_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Tarea::className(), 'targetAttribute' => ['tarea_codigo' => 'tarea_codigo']],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staff_codigo' => 'Staff Codigo',
            'codigo_empleado' => 'Codigo Empleado',
            'evento_codigo' => 'Evento Codigo',
            'tarea_codigo' => 'Tarea Codigo',
            'token' => 'Token',
            'fecha_token' => 'Fecha Token',
            'vigencia_token' => 'Vigencia Token',
            'activo' => 'Activo',
            'usuario_registro' => 'Usuario Registro',
            'usuario_modificacion' => 'Usuario Modificacion',
            'fecha_registro' => 'Fecha Registro',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventoCodigo()
    {
        return $this->hasOne(Eventos::className(), ['evento_codigo' => 'evento_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoEmpleado()
    {
        return $this->hasOne(Empleado::className(), ['empleado_codigo' => 'codigo_empleado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTareaCodigo()
    {
        return $this->hasOne(Tarea::className(), ['tarea_codigo' => 'tarea_codigo']);
    }

    public function getStaffEmpleadoEvento($empleadoStaff){
        
         $query = Yii::$app->db_invitado->createCommand("SELECT se.staff_codigo,e.nombre,e.apellido_materno,e.apellido_paterno,t.nombre,se.activo,t.tarea_codigo,se.evento_codigo,e.empleado_codigo
            from DB_Invitado.dbo.staff_evento se
            left join empleado e on e.empleado_codigo = se.codigo_empleado
            left join tarea t on t.tarea_codigo = se.tarea_codigo
            where se.staff_codigo =".$empleadoStaff)->queryAll();
        return $query;
    }

    public function updateStaffEmpleadoEvento(){
        $params =  [
                    'staff_codigo'=>$this->staff_codigo,
                    'tarea_codigo' => $this->tarea_codigo,
                    'activo'=>$this->activo,
                    'usuario_modificacion'=>$this->usuario_modificacion,
                    'fecha_modificacion'=>$this->fecha_modificacion                   
                ];
        Yii::$app->db_invitado->createCommand("UPDATE DB_Invitado.dbo.staff_evento
            SET tarea_codigo=:tarea_codigo, activo=:activo, usuario_modificacion=:usuario_modificacion, fecha_modificacion=:fecha_modificacion
            WHERE staff_codigo=:staff_codigo",$params)->execute();
        return;

    }

    public function addStaffEmpleadoEvento(){
        $query = Yii::$app->db->createCommand("SELECT case when max(staff_codigo) is null then 1 else max(staff_codigo)+1 end as id 
            from DB_Invitado.dbo.staff_evento")->queryAll();
        $this->staff_codigo = $query[0]['id'];
        Yii::$app->db_invitado->createCommand()->insert('DB_Invitado.dbo.staff_evento', [
                                            'staff_codigo' => $this->staff_codigo,
                                            'codigo_empleado' => $this->codigo_empleado,
                                            'evento_codigo'=>$this->evento_codigo,
                                            'tarea_codigo'=>$this->tarea_codigo,
                                            'token'=>$this->token,
                                            'fecha_token'=>$this->fecha_token,
                                            'vigencia_token'=>$this->vigencia_token,
                                            'activo'=>$this->activo,
                                            'usuario_registro'=>$this->usuario_registro,
                                            'fecha_registro'=>new Expression("getdate()"),
                                            'usuario_modificacion'=>$this->usuario_modificacion,
                                            'fecha_modificacion'=>new Expression("getdate()")
        ])->execute();
    }

    public function existStaffEmpleadoEvento($evento_codigo,$codigo_empleado){
        $query = Yii::$app->db->createCommand("SELECT staff_codigo,codigo_empleado
            from DB_Invitado.dbo.staff_evento se
            where se.evento_codigo = ".$evento_codigo." 
            and codigo_empleado =".$codigo_empleado)->queryAll();
        if(count($query) > 0){
            return $query[0]['staff_codigo'];
        }else{
            return false;
        }
    }
}
