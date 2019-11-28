<?php

namespace app\models;

use Yii;

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
}
