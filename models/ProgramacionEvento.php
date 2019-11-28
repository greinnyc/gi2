<?php

namespace app\models;

use Yii;
 use yii\db\Expression;

/**
 * This is the model class for table "programacion_evento".
 *
 * @property int $programacion_codigo
 * @property int $evento_codigo
 * @property int $sede_codigo
 * @property int $ubicacion_codigo
 * @property string $fecha_inicial
 * @property string $fecha_final
 * @property string $hora_inicio
 * @property string $hora_fin
 * @property int $usuario_registro
 * @property string $fecha_registro
 * @property int|null $usuario_modifica
 * @property string|null $fecha_modifica
 *
 * @property IngresoEvento[] $ingresoEventos
 * @property Eventos $eventoCodigo
 * @property Sedes $sedeCodigo
 * @property SedeUbicacion $ubicacionCodigo
 */
class ProgramacionEvento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'programacion_evento';
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
            [['programacion_codigo', 'evento_codigo', 'sede_codigo', 'ubicacion_codigo', 'fecha_inicial', 'fecha_final', 'hora_inicio', 'hora_fin', 'usuario_registro'], 'required'],
            [['programacion_codigo', 'evento_codigo', 'sede_codigo', 'ubicacion_codigo', 'usuario_registro', 'usuario_modifica'], 'integer'],
            [['fecha_inicial', 'fecha_final', 'hora_inicio', 'hora_fin', 'fecha_registro', 'fecha_modifica'], 'safe'],
            [['programacion_codigo'], 'unique'],
            [['evento_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::className(), 'targetAttribute' => ['evento_codigo' => 'evento_codigo']],
            [['sede_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['sede_codigo' => 'sede_codigo']],
            [['ubicacion_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => SedeUbicacion::className(), 'targetAttribute' => ['ubicacion_codigo' => 'ubicacion_codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'programacion_codigo' => 'Programacion Codigo',
            'evento_codigo' => 'Evento Codigo',
            'sede_codigo' => 'Sede Codigo',
            'ubicacion_codigo' => 'Ubicacion Codigo',
            'fecha_inicial' => 'Fecha Inicial',
            'fecha_final' => 'Fecha Final',
            'hora_inicio' => 'Hora Inicio',
            'hora_fin' => 'Hora Fin',
            'usuario_registro' => 'Usuario Registro',
            'fecha_registro' => 'Fecha Registro',
            'usuario_modifica' => 'Usuario Modifica',
            'fecha_modifica' => 'Fecha Modifica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngresoEventos()
    {
        return $this->hasMany(IngresoEvento::className(), ['programacion_codigo' => 'programacion_codigo']);
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
    public function getSedeCodigo()
    {
        return $this->hasOne(Sedes::className(), ['sede_codigo' => 'sede_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUbicacionCodigo()
    {
        return $this->hasOne(SedeUbicacion::className(), ['ubicacion_codigo' => 'ubicacion_codigo']);
    }

    public function getProgramacionEvento($id){
            $query = Yii::$app->db_invitado->createCommand("SELECT pro.programacion_codigo,pro.fecha_final,pro.fecha_inicial,pro.hora_inicio,pro.hora_fin
            from DB_Invitado.dbo.programacion_evento pro
            left join DB_Invitado.dbo.eventos e on e.evento_codigo = pro.evento_codigo where pro.evento_codigo=".$id)->queryAll();
            error_log(print_r($query,1));
       return $query;
        
    }

    public function MasivoProgramacionEvento($programas){
        error_log("sede_codigo*****");
        error_log($this->ubicacion_codigo);

        foreach ($programas as $value) {
            $this->fecha_inicial = $value['fecha_inicial'];
            $this->fecha_final = $value['fecha_final'];
            $this->hora_inicio = $value['hora_inicio'];
            $this->hora_fin = $value['hora_fin'];
            if($value['programacion_codigo'] == 0){
                $this->AddProgramacionEvento();
            }else{
                $this->programacion_codigo = $value['programacion_codigo'];
                $this->UpdateProgramacionEvento();

            }
        }
    }

    public function UpdateProgramacionEvento(){

        $params =  [
                    ":programacion_codigo"=>$this->programacion_codigo,                
                    ":sede_codigo"=>$this->sede_codigo,
                    ":ubicacion_codigo"=>$this->ubicacion_codigo,
                    ":fecha_inicial"=>$this->fecha_inicial,
                    ":fecha_final"=>$this->fecha_final,
                    ":hora_inicio"=>$this->hora_inicio,
                    ":hora_fin"=>$this->hora_fin,
                    'usuario_modifica'=>$this->usuario_modifica,
                ];
        Yii::$app->db_invitado->createCommand(" UPDATE DB_Invitado.dbo.programacion_evento
            SET sede_codigo=:sede_codigo, ubicacion_codigo=:ubicacion_codigo, fecha_inicial=convert(datetime,:fecha_inicial,103), fecha_final=convert(datetime,:fecha_final,103), hora_inicio=:hora_inicio, hora_fin=:hora_fin, usuario_modifica=:usuario_modifica, fecha_modifica=getdate()
                WHERE programacion_codigo=:programacion_codigo",$params)->execute();
       ;

        return;
        
    }

    public function AddProgramacionEvento(){
        $query = Yii::$app->db->createCommand("SELECT case when max(programacion_codigo) is null then 1 else max(programacion_codigo)+1 end as id 
            from DB_Invitado.dbo.programacion_evento")->queryAll();
        $this->programacion_codigo = $query[0]['id'];

        Yii::$app->db_invitado->createCommand()->insert('DB_Invitado.dbo.programacion_evento', [
                                            'programacion_codigo' => $this->programacion_codigo,
                                            'evento_codigo' => $this->evento_codigo,
                                            'sede_codigo'=>$this->sede_codigo,
                                            'ubicacion_codigo'=>$this->ubicacion_codigo,
                                            'fecha_inicial'=>new Expression("convert(datetime,'".$this->fecha_inicial."',103)"),
                                            'fecha_final'=>new Expression("convert(datetime,'".$this->fecha_final."',103)"),
                                            'hora_inicio'=>$this->hora_inicio,
                                            'hora_fin'=>$this->hora_fin,
                                            'usuario_registro'=>$this->usuario_registro,
                                            'fecha_registro'=>new Expression("getdate()"),
                                            'usuario_modifica'=>$this->usuario_modifica,
                                            'fecha_modifica'=>new Expression("getdate()")
        ])->execute();

       
    }
}
