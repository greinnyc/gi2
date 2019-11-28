<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemsCatalogo */

$this->title = 'Update Items Catalogo: ' . $model->item_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Items Catalogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_codigo, 'url' => ['view', 'id' => $model->item_codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="items-catalogo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
