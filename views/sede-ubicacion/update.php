<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SedeUbicacion */

$this->title = 'Update Sede Ubicacion: ' . $model->ubicacion_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Sede Ubicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ubicacion_codigo, 'url' => ['view', 'id' => $model->ubicacion_codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sede-ubicacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
