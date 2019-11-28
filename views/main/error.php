<?php
use Yii;
use yii\helpers\Html;
$this->title = "";
?>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <center>
            
                    <h1 class="error-number">404</h1>
                    <h2>Lo sentimos, el recurso solicitado no esta disponible</h2>
                    <p>
                    <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>
                    <?php if(Yii::$app->user->isGuest):?>
                    &nbsp;&nbsp;<?=Html::a("Iniciar Sesion",["main/login"])?>
                    <?php else:?>
                    Intente nuevamente con otra opci&oacute;n del sistema
                    <?php endif?>
                    </p>
                
            </center>
        </div>
    </div>