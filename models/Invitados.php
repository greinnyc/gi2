<?php

namespace app\models;

use Yii;
use yii\db\Expression;


/**
 * This is the model class for table "invitados".
 *
 * @property int $invitado_codigo
 * @property int $evento_codigo
 * @property int $empleado_codigo
 * @property int $activo
 * @property int $usuario_registro
 * @property int $usuario_modificacion
 * @property int $fecha_registro
 * @property int $fecha_modificacion
 *
 * @property IngresoEvento[] $ingresoEventos
 * @property Eventos $eventoCodigo
 * @property Empleado $empleadoCodigo
 * @property ItemsInvitado[] $itemsInvitados
 */
class Invitados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invitados';
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
            [['invitado_codigo', 'evento_codigo', 'empleado_codigo', 'activo', 'usuario_registro', 'usuario_modificacion', 'fecha_registro', 'fecha_modificacion'], 'required'],
            [['invitado_codigo', 'evento_codigo', 'empleado_codigo', 'activo', 'usuario_registro', 'usuario_modificacion', 'fecha_registro', 'fecha_modificacion'], 'integer'],
            [['invitado_codigo'], 'unique'],
            [['evento_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::className(), 'targetAttribute' => ['evento_codigo' => 'evento_codigo']],
           /* [['empleado_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['empleado_codigo' => 'empleado_codigo']],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'invitado_codigo' => 'Invitado Codigo',
            'evento_codigo' => 'Evento Codigo',
            'empleado_codigo' => 'Empleado Codigo',
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
    public function getIngresoEventos()
    {
        return $this->hasMany(IngresoEvento::className(), ['invitado_codigo' => 'invitado_codigo']);
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
    public function getEmpleadoCodigo()
    {
        return $this->hasOne(Empleado::className(), ['empleado_codigo' => 'empleado_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsInvitados()
    {
        return $this->hasMany(ItemsInvitado::className(), ['invitado_codigo' => 'invitado_codigo']);
    }


    public function MasivoInvitadosEvento($invitados){
        error_log("MasivoInvitadosEvento*****");
        error_log(print_r($invitados,1));
        foreach ($invitados as $value) {
            $this->empleado_codigo = $value[0]['empleado_codigo'];
            $this->activo = ($value[0]['estado_codigo'] == 1)?$value[0]['estado_codigo']:0;;
            $this->AddInvitadoEvento();
        }
    }

    public function AddInvitadoEvento(){
        $query = Yii::$app->db->createCommand("SELECT case when max(invitado_codigo) is null then 1 else max(invitado_codigo)+1 end as id 
            from DB_Invitado.dbo.invitados")->queryAll();
        $this->invitado_codigo = $query[0]['id'];

        Yii::$app->db_invitado->createCommand()->insert('DB_Invitado.dbo.invitados', [
                                            'invitado_codigo' => $this->invitado_codigo,
                                            'evento_codigo' => $this->evento_codigo,
                                            'empleado_codigo'=>$this->empleado_codigo,
                                            'activo'=>$this->activo,
                                            'usuario_registro'=>$this->usuario_registro,
                                            'fecha_registro'=>new Expression("getdate()"),
                                            'usuario_modificacion'=>$this->usuario_modificacion,
                                            'fecha_modificacion'=>new Expression("getdate()")                                            
        ])->execute();
    }

     public function updateInvitadoEvento(){
        $params =  [
                    'invitado_codigo' => $this->invitado_codigo,
                    'activo'=>$this->activo,
                    'usuario_modificacion'=>$this->usuario_modificacion,
                    'fecha_modificacion'=>$this->fecha_modificacion                   
                   ];
        Yii::$app->db_invitado->createCommand("UPDATE DB_Invitado.dbo.invitados
            SET activo=:activo, usuario_modificacion=:usuario_modificacion, fecha_modificacion=:fecha_modificacion
            WHERE invitado_codigo=:invitado_codigo",$params)->execute();
        return;

    }

    public function getExisteInvitadosEvento(){
        $query = Yii::$app->db->createCommand("SELECT COUNT(*) as cantidad
            from DB_Invitado.dbo.invitados
            WHERE evento_codigo =".$this->evento_codigo)->queryAll();
        $cantidad = $query[0]['cantidad'];
        if($cantidad > 0){
            return true;
        }else{
            return false;
        }
    }

    public function existInvitadoEmpleadoEvento($evento_codigo,$codigo_empleado){
        $query = Yii::$app->db->createCommand("SELECT invitado_codigo
            from DB_Invitado.dbo.invitados
            WHERE evento_codigo = ".$evento_codigo." and empleado_codigo=".$codigo_empleado)->queryAll();
        if(count($query) > 0){
            return $query[0]['invitado_codigo'];
        }else{
            return false;
        }
    }

     public function getInvitadoEmpleadoEvento($empleadoInvitado){
        
         $query = Yii::$app->db_invitado->createCommand("SELECT i.invitado_codigo,e.nombre,e.apellido_materno,e.apellido_paterno,i.activo,i.evento_codigo,e.empleado_codigo
            from DB_Invitado.dbo.invitados i
            left join empleado e on e.empleado_codigo = i.empleado_codigo
            where i.invitado_codigo=".$empleadoInvitado)->queryAll();
        return $query;
    }

    
}
