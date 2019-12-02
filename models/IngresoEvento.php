<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingreso_evento".
 *
 * @property int $ingreso_codigo
 * @property int $invitado_codigo
 * @property int $programacion_codigo
 * @property int $evento_codigo
 * @property int $sede_codigo
 * @property string $fecha_ingreso
 * @property string $Ip
 *
 * @property Invitados $invitadoCodigo
 * @property Eventos $eventoCodigo
 * @property ProgramacionEvento $programacionCodigo
 * @property Sedes $sedeCodigo
 */
class IngresoEvento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingreso_evento';
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
            [['ingreso_codigo', 'invitado_codigo', 'programacion_codigo', 'evento_codigo', 'sede_codigo', 'Ip'], 'required'],
            [['ingreso_codigo', 'invitado_codigo', 'programacion_codigo', 'evento_codigo', 'sede_codigo'], 'integer'],
            [['fecha_ingreso'], 'safe'],
            [['Ip'], 'string', 'max' => 42],
            [['ingreso_codigo'], 'unique'],
            [['invitado_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Invitados::className(), 'targetAttribute' => ['invitado_codigo' => 'invitado_codigo']],
            [['evento_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::className(), 'targetAttribute' => ['evento_codigo' => 'evento_codigo']],
            [['programacion_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramacionEvento::className(), 'targetAttribute' => ['programacion_codigo' => 'programacion_codigo']],
            [['sede_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['sede_codigo' => 'sede_codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ingreso_codigo' => 'Ingreso Codigo',
            'invitado_codigo' => 'Invitado Codigo',
            'programacion_codigo' => 'Programacion Codigo',
            'evento_codigo' => 'Evento Codigo',
            'sede_codigo' => 'Sede Codigo',
            'fecha_ingreso' => 'Fecha Ingreso',
            'Ip' => 'Ip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitadoCodigo()
    {
        return $this->hasOne(Invitados::className(), ['invitado_codigo' => 'invitado_codigo']);
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
    public function getProgramacionCodigo()
    {
        return $this->hasOne(ProgramacionEvento::className(), ['programacion_codigo' => 'programacion_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSedeCodigo()
    {
        return $this->hasOne(Sedes::className(), ['sede_codigo' => 'sede_codigo']);
    }
}
