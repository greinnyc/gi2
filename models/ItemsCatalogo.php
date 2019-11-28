<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items_catalogo".
 *
 * @property int $item_codigo
 * @property int $organizacion_codigo
 * @property string $nombre
 * @property string $marca
 * @property string $modelo
 * @property int $estado
 * @property int $usuario_registro
 * @property int $usuario_modificacion
 * @property string $fecha_registro
 * @property string $fecha_modificacion
 *
 * @property Organizacion $organizacionCodigo
 */
class ItemsCatalogo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items_catalogo';
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
            [['item_codigo', 'organizacion_codigo', 'nombre', 'marca', 'modelo', 'estado', 'usuario_registro', 'usuario_modificacion', 'fecha_registro', 'fecha_modificacion'], 'required'],
            [['item_codigo', 'organizacion_codigo', 'estado', 'usuario_registro', 'usuario_modificacion'], 'integer'],
            [['fecha_registro', 'fecha_modificacion'], 'safe'],
            [['nombre', 'marca', 'modelo'], 'string', 'max' => 255],
            [['item_codigo'], 'unique'],
            /*[['organizacion_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Organizacion::className(), 'targetAttribute' => ['organizacion_codigo' => 'organizacion_codigo']],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_codigo' => 'Item Codigo',
            'organizacion_codigo' => 'Organizacion Codigo',
            'nombre' => 'Nombre',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'estado' => 'Estado',
            'usuario_registro' => 'Usuario Registro',
            'usuario_modificacion' => 'Usuario Modificacion',
            'fecha_registro' => 'Fecha Registro',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizacionCodigo()
    {
        return $this->hasOne(Organizacion::className(), ['organizacion_codigo' => 'organizacion_codigo']);
    }

     public function getItems(){
        $query = Yii::$app->db_invitado->createCommand("SELECT item_codigo AS Codigo, nombre+'|'+marca+'|'+modelo AS Descripcion 
            FROM db_invitado.dbo.items_catalogo WHERE estado = 1 and organizacion_codigo =".Yii::$app->params['codigo_pais']." ORDER BY item_codigo")->queryAll();
        return $query;
    }
}
