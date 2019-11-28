<?php



use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Grafico;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;


?>


<!--
    <div class="table-responsive">
        <div id="contenedor" class="x_content"></div>
    </div>
-->

<div class="table-responsive">
    <div id="contenedor"></div>    
</div>
                        
                       
<div id="dialog" title="Basic dialog" style="display: none;">
    <table border="0" width="100%" style="font-size: 11px;" >
    <tr>
        <td rowspan="6"><img src="" id="g_foto" /><?= Html::img('@web/img/avatar5.png', ['class' => 'img-circle', 'alt' => 'User Image',"width"=>100]) ?> </td>
    </tr>
        <tr>
            <td>DNI:</td><td><p id="g_dni"></p></td>
        </tr>
        <tr>
            <td>TURNO:</td><td><p id="g_turno"></p></td>
        </tr>
        <tr>
            <td>CARGO:</td><td><p id="g_cargo"></p></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
    </table>
</div>