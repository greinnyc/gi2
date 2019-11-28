<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sedes".
 *
 * @property int $sede_codigo
 * @property int $organizacion_codigo
 * @property string $nombre
 * @property int $activo
 * @property int $usuario_registro
 * @property int $usuario_modificacion
 * @property string $fecha_registro
 * @property string $fecha_modificacion
 *
 * @property IngresoEvento[] $ingresoEventos
 * @property ProgramacionEvento[] $programacionEventos
 * @property SedeUbicacion[] $sedeUbicacions
 * @property Organizacion $organizacionCodigo


 */

class Sedes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sedes';
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
            [['sede_codigo', 'organizacion_codigo', 'nombre', 'activo', 'usuario_registro', 'usuario_modificacion', 'fecha_registro', 'fecha_modificacion'], 'required'],
            [['sede_codigo', 'organizacion_codigo', 'activo', 'usuario_registro', 'usuario_modificacion'], 'integer'],
            [['fecha_registro', 'fecha_modificacion'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['sede_codigo'], 'unique'],
            /*[['organizacion_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Organizacion::className(), 'targetAttribute' => ['organizacion_codigo' => 'organizacion_codigo']],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sede_codigo' => 'Sede Codigo',
            'organizacion_codigo' => 'Organizacion Codigo',
            'nombre' => 'Nombre',
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
        return $this->hasMany(IngresoEvento::className(), ['sede_codigo' => 'sede_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramacionEventos()
    {
        return $this->hasMany(ProgramacionEvento::className(), ['sede_codigo' => 'sede_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSedeUbicacions()
    {
        return $this->hasMany(SedeUbicacion::className(), ['sede_codigo' => 'sede_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizacionCodigo()
    {
        return $this->hasOne(Organizacion::className(), ['organizacion_codigo' => 'organizacion_codigo']);
    }

    public function getSedes(){
        $query = Yii::$app->db_invitado->createCommand("SELECT sede_codigo AS Codigo, nombre AS Descripcion 
            FROM db_invitado.dbo.sedes WHERE activo = 1 and organizacion_codigo =".Yii::$app->params['codigo_pais']." ORDER BY sede_codigo")->queryAll();
        return $query;
    }
}
