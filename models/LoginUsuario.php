<?php

namespace app\models;
use Yii;
use yii\base\Model;
/**
 * Description of LoginUsuario
 *
 * @author bsolanoa
 */
class LoginUsuario extends Model{
    public $usuario;
    public $clave;
    private $user = false;
    public $verifyCode;
    
    public function rules(){
        return [
            [['usuario','clave'],'required'],
            ['clave', 'validarClave'],
            //['verifyCode', 'captcha'],
        ];
    }
    
    public function validarClave($campo, $opciones){
        $user = $this->getUser();
        if(!$user){
            return $this->addError($campo, "Usuario o contraseña incorrecta");
        }
    }
    
    public function getUser(){
        
        if($this->user === false){
            $this->user = Empleados::validaUsuarioClave($this->usuario, $this->clave);
        }
        return $this->user;
    }
    
    public function login(){
        if($this->validate()){
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }
    
     public function attributeLabels()
    {
        return [
            'verifyCode' => 'Ingrese el texto de la imagen',
        ];
    }
}