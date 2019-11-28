<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Eventos */

$this->title = 'Update Eventos: ' . $model->evento_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->evento_codigo, 'url' => ['view', 'id' => $model->evento_codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eventos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_sedes'=>$model_sedes,
        'model_itemsCatalogo'=>$model_itemsCatalogo
    ]) ?>

</div>
