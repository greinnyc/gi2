<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items_evento".
 *
 * @property int $item_evento_codigo
 * @property int $evento_codigo
 * @property int $item_codigo
 * @property int $cantidad
 * @property int $stock
 * @property int $activo
 * @property int $usuario_registro
 * @property int $usuario_modificacion
 * @property string $fecha_registro
 * @property string $fecha_modificacion
 *
 * @property Eventos $eventoCodigo
 * @property ItemsInvitado[] $itemsInvitados
 */
class ItemsEvento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items_evento';
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
            [['item_evento_codigo', 'evento_codigo', 'item_codigo', 'cantidad', 'stock', 'activo', 'usuario_registro', 'usuario_modificacion', 'fecha_registro', 'fecha_modificacion'], 'required'],
            [['item_evento_codigo', 'evento_codigo', 'item_codigo', 'cantidad', 'stock', 'activo', 'usuario_registro', 'usuario_modificacion'], 'integer'],
            [['fecha_registro', 'fecha_modificacion'], 'safe'],
            [['item_evento_codigo'], 'unique'],
            [['evento_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::className(), 'targetAttribute' => ['evento_codigo' => 'evento_codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_evento_codigo' => 'Item Evento Codigo',
            'evento_codigo' => 'Evento Codigo',
            'item_codigo' => 'Item Codigo',
            'cantidad' => 'Cantidad',
            'stock' => 'Stock',
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
    public function getItemsInvitados()
    {
        return $this->hasMany(ItemsInvitado::className(), ['items_evento_codigo' => 'item_evento_codigo']);
    }

    public function getItemsEvento($id){
            $query = Yii::$app->db_invitado->createCommand("SELECT itev.item_evento_codigo,ic.item_codigo,ic.nombre+'|'+ic.marca+'|'+ic.modelo as nombre,ic.estado,itev.cantidad,itev.stock
            FROM DB_Invitado.dbo.items_evento itev
            left join DB_Invitado.dbo.eventos ev on ev.evento_codigo=itev.evento_codigo
            left join DB_Invitado.dbo.items_catalogo ic on ic.item_codigo = itev.item_codigo  
            where ev.evento_codigo =".$id)->queryAll();
       return $query;
        
    }



     public function MasivoItemsEvento($items){
        foreach ($items as $value) {
            $this->item_codigo = $value['item_codigo'];
            $this->cantidad = $value['item_cantidad'];
            $this->stock = $value['item_cantidad'];
            $this->activo = $value['item_estado'];
            if($value['item_evento_codigo'] == 0){
                $this->AddItemEvento();
            }else{
                $this->item_evento_codigo = $value['item_evento_codigo'];
                $this->UpdateItemEvento();

            }
        }
    }



    public function UpdateItemEvento(){

        $params =  [
                    'item_evento_codigo' => $this->item_evento_codigo,
                    'item_codigo'=>$this->item_codigo,
                    'cantidad'=>$this->cantidad,
                    'stock'=>$this->cantidad,
                    'activo'=>$this->activo,
                    'usuario_modificacion'=>$this->usuario_modificacion,
                ];
        Yii::$app->db_invitado->createCommand("UPDATE DB_Invitado.dbo.items_evento
            SET item_codigo=:item_codigo, cantidad=:cantidad, stock=:stock, activo=:activo, usuario_modificacion=:usuario_modificacion,fecha_modificacion=getdate()
            WHERE item_evento_codigo=:item_evento_codigo",$params)->execute();
        return;
        
    }


    public function AddItemEvento(){
        $query = Yii::$app->db->createCommand("SELECT case when max(item_evento_codigo) is null then 1 else max(item_evento_codigo)+1 end as id 
            from DB_Invitado.dbo.items_evento")->queryAll();
        $this->item_evento_codigo = $query[0]['id'];

        Yii::$app->db_invitado->createCommand()->insert('DB_Invitado.dbo.programacion_evento', [
                                            'item_evento_codigo' => $this->item_evento_codigo,
                                            'item_codigo'=>$this->item_codigo,
                                            'evento_codigo' => $this->evento_codigo,
                                            'cantidad'=>$this->cantidad,
                                            'stock'=>$this->cantidad,
                                            'activo'=>$this->activo,
                                            'usuario_registro'=>$this->usuario_registro,
                                            'fecha_registro'=>new Expression("getdate()"),
                                            'usuario_modificacion'=>$this->usuario_modifica,
                                            'fecha_modificacion'=>new Expression("getdate()")                                            
        ])->execute();

       
    }
}
