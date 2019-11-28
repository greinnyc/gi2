<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SedeUbicacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sede Ubicacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sede-ubicacion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sede Ubicacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ubicacion_codigo',
            'sede_codigo',
            'nombre',
            'direccion',
            'aforo',
            //'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
