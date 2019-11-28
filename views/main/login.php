<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\captcha\Captcha;
use yii\web\JsExpression;
$this->title = "Gestión de Invitados"

?>

<div>
    <div class="login_wrapper" >
        <div class="animate form login_form" >
            <section class="login_content"  style="text-shadow:none;">
                <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        
                    ])?>
                    <?= Html::img('@web/img/guest.png',['class' => 'logo-login']) ?>

                    <h1 style="color: #fff;text-shadow:none;">Gestión de Invitados</h1>
                    <div>
                    <?=$form->field($model, "usuario")->textInput(['autofocus' => true])->input('text', ['placeholder'=>'Ingrese su DNI',"style"=>"background: rgba(6, 9, 11, 0.3);color:#fff;", 'maxlength' => 15])->label(false)?>
                        
                    </div>
                    <div>
                    <?=$form->field($model, "clave")->passwordInput()->input('password', ['placeholder'=>'Ingrese su clave',"style"=>"background: rgba(6, 9, 11, 0.3);color:#fff;", 'maxlength' => 15])->label(false)?>    
                    </div>
                    <div>
                      
                    </div>
                    <div>
                    <?=Html::submitButton("Ingresar", ["class"=>"btn btn-primary"])?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <span style="color: #fff;text-shadow:none;">©<?=date("Y")?> Gerencia Regional de Desarrollo de Sistemas</span><span style="color: #fff;text-shadow:none;"> Atento-Per&uacute; </span>
                    </div>
                    </div>
                    
                   

                <?php ActiveForm::end()?>
            </section>
        
        </div>
    </div>
</div>
