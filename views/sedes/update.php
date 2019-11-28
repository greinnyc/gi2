<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sedes */

$this->title = 'Update Sedes: ' . $model->sede_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Sedes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sede_codigo, 'url' => ['view', 'id' => $model->sede_codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sedes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
