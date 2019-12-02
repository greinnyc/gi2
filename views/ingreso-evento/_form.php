<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IngresoEvento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingreso-evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ingreso_codigo')->textInput() ?>

    <?= $form->field($model, 'invitado_codigo')->textInput() ?>

    <?= $form->field($model, 'programacion_codigo')->textInput() ?>

    <?= $form->field($model, 'evento_codigo')->textInput() ?>

    <?= $form->field($model, 'sede_codigo')->textInput() ?>

    <?= $form->field($model, 'fecha_ingreso')->textInput() ?>

    <?= $form->field($model, 'Ip')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
