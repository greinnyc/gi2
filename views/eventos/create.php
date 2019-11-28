<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Eventos */

$this->title = 'Crear evento';
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'model_sedes'=>$model_sedes,
        'model_itemsCatalogo'=>$model_itemsCatalogo
    ]) ?>

</div>
