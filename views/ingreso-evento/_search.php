<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IngresoEventoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingreso-evento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ingreso_codigo') ?>

    <?= $form->field($model, 'invitado_codigo') ?>

    <?= $form->field($model, 'programacion_codigo') ?>

    <?= $form->field($model, 'evento_codigo') ?>

    <?= $form->field($model, 'sede_codigo') ?>

    <?php // echo $form->field($model, 'fecha_ingreso') ?>

    <?php // echo $form->field($model, 'Ip') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
