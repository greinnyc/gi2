<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItemsCatalogo */

$this->title = $model->item_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Items Catalogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="items-catalogo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->item_codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->item_codigo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'item_codigo',
            'organizacion_codigo',
            'nombre',
            'marca',
            'modelo',
            'estado',
            'usuario_registro',
            'usuario_modificacion',
            'fecha_registro',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
