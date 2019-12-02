<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IngresoEvento */

$this->title = 'Create Ingreso Evento';
$this->params['breadcrumbs'][] = ['label' => 'Ingreso Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-evento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
