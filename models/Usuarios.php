<?php
namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use app\models\Postulantes;
use yii\web\User;
use app\models\Empleados;

class Usuarios extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $flagEmpleado;
    public $usuario;
    public $clave;
    
    public static function tableName()
    {
        return 'Postulantes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Postulante_Codigo'], 'required'],
            [['Postulante_Codigo', 'Estado_Codigo','flagEmpleado'], 'integer'],
            [['Postulante_nombre', 'Postulante_Apellido_Paterno', 'Postulante_Apellido_Materno', 'Postulante_dni','usuario','clave'], 'string'],
            [['Postulante_dni'], 'unique'],
        ];
    }

    /*public function init() {
        parent::init();

        $this->on(User::EVENT_AFTER_LOGIN , function ($event) {
            Yii::$app->setHomeUrl(Url::to(['atenea/asistencias']));
        });
    }*/
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Postulante_Codigo' => 'Postulante  Codigo',
            'Estado_Codigo' => 'Estado  Codigo',
            'Postulante_nombre' => 'Postulante Nombre',
            'Postulante_Apellido_Paterno' => 'Postulante  Apellido  Paterno',
            'Postulante_Apellido_Materno' => 'Postulante  Apellido  Materno',
            'Postulante_dni' => 'Postulante Dni',
            'Flag_empleado' => 'Flag Empleado',
            'usuario' => 'usuario',
            'clave' => 'Clave',
        ];
    }
    
    //public $Nombre_Postulante;

    /**
     * @return \yii\db\ActiveQuery
     */  

     
    public static function getFlagEmpleado($username)
    {
        $emp = new Empleados();
        
        $consulta = $emp->getEmpleadoActivo($username);
        
        if(!$consulta)
        {
            $flag = 0;
        } else {
            $flag = 1;
        }
        
        return $flag;
    }
    
    public static function findIdentity($id){
               
       $user = self::find()                
        ->where("Postulante_dni=:$id", [":$id" => $id])
        ->one();         

      /*  $user->Postulante_Codigo = $user_->Postulante_Codigo;
        $user->Estado_Codigo = $user_->Estado_Codigo;
        $user->Postulante_nombre = $user_->Postulante_nombre;
        $user->Postulante_Apellido_Paterno = $user_->Postulante_Apellido_Paterno;
        $user->Postulante_Apellido_Materno = $user_->Postulante_Apellido_Materno;
        $user->Postulante_dni = $user_->Postulante_dni;
        $user->usuario = $user_->Postulante_dni;
        $user->clave = $user_->postulante_clave;*/

         return isset($user) ? new static($user) : null;  
        
        
                
    }

    public static function findIdentityByAccessToken($token, $type = null){
            throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }

    public function getId(){
            return $this->Postulante_dni;//$this->Postulante_Codigo;//return $this->id;
    }

    public function getAuthKey(){
            throw new NotSupportedException();//return $this->authKey;//Here I return a value of my authKey column
    }

    public function validateAuthKey($authKey){
            throw new NotSupportedException();//return $this->authKey === $authKey;
    }
    public static function findByUsername($username){
        
            $obj = new Usuarios();
            
            $flagEmpleado = $obj->getFlagEmpleado($username);            
            
            if($flagEmpleado === 0){
                $connection = Usuarios::getDb();

                $cod_ = Yii::$app->get('db')->createCommand(
                        'select * from Postulantes p inner join pos_identificacion pos on p.Postulante_Codigo = pos.Postulante_Codigo '
                        .'where Postulante_dni = :id ',[':id' => $username])->queryOne();

                //echo "<pre>"; print_r($cod_);die();

                $obj->Postulante_Codigo = $cod_['Postulante_Codigo'];     
                $obj->Estado_Codigo = $cod_['Estado_Codigo'];
                $obj->Postulante_nombre = $cod_['Postulante_nombre'];
                $obj->Postulante_Apellido_Paterno = $cod_['Postulante_Apellido_Paterno'];
                $obj->Postulante_Apellido_Materno = $cod_['Postulante_Apellido_Materno'];
                $obj->Postulante_dni = $cod_['Postulante_dni'];
                $obj->flagEmpleado = $flagEmpleado;
                $obj->usuario = $cod_['Postulante_dni'];
                $obj->clave = $cod_['postulante_clave'];
                //echo "<pre>";print_r($obj);die();
                return $obj;            
            } elseif($flagEmpleado === 1){
                $connection = Usuarios::getDb_();

                $cod_ = Yii::$app->get('db_zeus')->createCommand(
                        'select * from vDatos vD where vD.Empleado_Dni = :id',[':id' => $username])->queryOne();
                
                //$p = md5('clave123');
                //echo "<pre>";print_r($p);die();             
                
                $obj->usuario = $cod_['Empleado_Dni'];
                $obj->clave = $cod_['Empleado_Clave_Acceso'];    
               
                $pos = Yii::$app->get('db')->createCommand(
                        'select * from Postulantes p inner join pos_identificacion pos on p.Postulante_Codigo = pos.Postulante_Codigo '
                        .'where Postulante_dni = :id ',[':id' => $username])->queryOne();
                
                $obj->Postulante_Codigo = $pos['Postulante_Codigo'];     
                $obj->Estado_Codigo = $pos['Estado_Codigo'];
                $obj->Postulante_nombre = $pos['Postulante_nombre'];
                $obj->Postulante_Apellido_Paterno = $pos['Postulante_Apellido_Paterno'];
                $obj->Postulante_Apellido_Materno = $pos['Postulante_Apellido_Materno'];
                $obj->Postulante_dni = $pos['Postulante_dni'];
                $obj->flagEmpleado = $flagEmpleado;
                
                return $obj; 
            }             
            
           // return $obj->findOne(['postulante_usuario'=>$username, 'Postulante_activo' => 1]);//->where(" Estado_Codigo = 1");
    }

    public function validatePassword($password,$username){
               
            $obj = new Usuarios();           
            
            $flagEmpleado = $obj->getFlagEmpleado($username);   
            
            //$password = 'Virginia.21';
            //ec5bf84ca58b1d47ffd3b980d4c74213
            $md5 = md5($password); 
           /* echo '$flagEmpleado '.$flagEmpleado;
            echo '$password '.$md5;
            echo ' Postulante_dni: '.$this->Postulante_dni;
            echo ' clave (usuarios) '.$this->clave;die();*/           
            
            if($flagEmpleado === 0){        
                return $this->clave === $password;//md5($password)
            } elseif($flagEmpleado === 1){
                return $this->clave === md5($password); //para empleados activos tabla vDatos
            }
            
    }
    
    public function getNombre($id)
    {
            $user_ = Postulantes::find()
            ->select('Postulantes.Postulante_Apellido_Paterno,Postulantes.Postulante_nombre')
            ->where("Postulante_Codigo=:$id", [":$id" => $id])
            ->one(); 
            
            $nombre = $user_['Postulante_nombre'].' '.$user_['Postulante_Apellido_Paterno'];
            //echo $nombre;
            //echo "<pre>";            print_r($user_);die();
            return $nombre; 
            
    }
    
    public function getPostulanteCodigo()
    {
        return $this->hasOne(Postulantes::className(), ['Postulante_Codigo' => 'Postulante_Codigo']);
    }
    
    public function getPosIdentificacions()
    {
        return $this->hasMany(PosIdentificacion::className(), ['Postulante_Codigo' => 'Postulante_Codigo']);
    }
    
    public static function getDb()
    {
        return Yii::$app->get('db');
    }
    
    public static function getDb_()
    {
        return Yii::$app->get('db_zeus');
    }
    

}
