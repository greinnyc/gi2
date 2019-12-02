<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IngresoEvento */

$this->title = 'Update Ingreso Evento: ' . $model->ingreso_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Ingreso Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ingreso_codigo, 'url' => ['view', 'id' => $model->ingreso_codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ingreso-evento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
