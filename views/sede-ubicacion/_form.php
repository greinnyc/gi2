<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SedeUbicacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sede-ubicacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ubicacion_codigo')->textInput() ?>

    <?= $form->field($model, 'sede_codigo')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aforo')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
