<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sedes */

$this->title = 'Create Sedes';
$this->params['breadcrumbs'][] = ['label' => 'Sedes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sedes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
