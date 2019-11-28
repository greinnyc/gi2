<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemsCatalogo */

$this->title = 'Create Items Catalogo';
$this->params['breadcrumbs'][] = ['label' => 'Items Catalogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-catalogo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
