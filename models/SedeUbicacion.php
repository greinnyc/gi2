<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sede_ubicacion".
 *
 * @property int $ubicacion_codigo
 * @property int $sede_codigo
 * @property string $nombre
 * @property string|null $direccion
 * @property int|null $aforo
 * @property int $activo
 *
 * @property ProgramacionEvento[] $programacionEventos
 * @property Sedes $sedeCodigo
 */
class SedeUbicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sede_ubicacion';
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
            [['ubicacion_codigo', 'sede_codigo', 'nombre'], 'required'],
            [['ubicacion_codigo', 'sede_codigo', 'aforo', 'activo'], 'integer'],
            [['nombre'], 'string', 'max' => 80],
            [['direccion'], 'string', 'max' => 250],
            [['ubicacion_codigo'], 'unique'],
            [['sede_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['sede_codigo' => 'sede_codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ubicacion_codigo' => 'Ubicacion Codigo',
            'sede_codigo' => 'Sede Codigo',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'aforo' => 'Aforo',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramacionEventos()
    {
        return $this->hasMany(ProgramacionEvento::className(), ['ubicacion_codigo' => 'ubicacion_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSedeCodigo()
    {
        return $this->hasOne(Sedes::className(), ['sede_codigo' => 'sede_codigo']);
    }

    

    public function getUbicacion($codigo){
        
        $query = Yii::$app->db_invitado->createCommand("SELECT ubicacion_codigo as id,
            nombre as name 
            from db_invitado.dbo.sede_ubicacion where sede_codigo = ".$codigo." 
            and activo =1")->queryAll();
        return $query;
    }
}
