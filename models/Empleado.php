<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleado".
 *
 * @property int $empleado_codigo
 * @property int $organizacion_codigo
 * @property string $numero_documento
 * @property string $nombre
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property int $estado_codigo
 * @property string $sexo
 * @property int|null $usuario_registro
 * @property int|null $usuario_modificacion
 * @property string|null $fecha_registro
 * @property string|null $fecha_modificacion
 *
 * @property Estados $estadoCodigo
 * @property Organizacion $organizacionCodigo
 * @property Invitados[] $invitados
 * @property LogAccionesEvento[] $logAccionesEventos
 * @property StaffEvento[] $staffEventos
 */
class Empleado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleado';
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
            [['empleado_codigo', 'organizacion_codigo', 'numero_documento', 'nombre', 'apellido_paterno', 'apellido_materno', 'estado_codigo', 'sexo'], 'required'],
            [['empleado_codigo', 'organizacion_codigo', 'estado_codigo', 'usuario_registro', 'usuario_modificacion'], 'integer'],
            [['fecha_registro', 'fecha_modificacion'], 'safe'],
            [['numero_documento'], 'string', 'max' => 15],
            [['nombre', 'apellido_paterno', 'apellido_materno'], 'string', 'max' => 30],
            [['sexo'], 'string', 'max' => 1],
            [['empleado_codigo'], 'unique'],
            /*[['estado_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado_codigo' => 'estado_codigo']],
            [['organizacion_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Organizacion::className(), 'targetAttribute' => ['organizacion_codigo' => 'organizacion_codigo']],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'empleado_codigo' => 'Empleado Codigo',
            'organizacion_codigo' => 'Organizacion Codigo',
            'numero_documento' => 'Numero Documento',
            'nombre' => 'Nombre',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'estado_codigo' => 'Estado Codigo',
            'sexo' => 'Sexo',
            'usuario_registro' => 'Usuario Registro',
            'usuario_modificacion' => 'Usuario Modificacion',
            'fecha_registro' => 'Fecha Registro',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoCodigo()
    {
        return $this->hasOne(Estados::className(), ['estado_codigo' => 'estado_codigo']);
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
    public function getInvitados()
    {
        return $this->hasMany(Invitados::className(), ['empleado_codigo' => 'empleado_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogAccionesEventos()
    {
        return $this->hasMany(LogAccionesEvento::className(), ['empleado_codigo' => 'empleado_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffEventos()
    {
        return $this->hasMany(StaffEvento::className(), ['codigo_empleado' => 'empleado_codigo']);
    }

    
}
