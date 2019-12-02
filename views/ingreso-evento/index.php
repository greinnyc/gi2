<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IngresoEventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingreso Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ingreso Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ingreso_codigo',
            'invitado_codigo',
            'programacion_codigo',
            'evento_codigo',
            'sede_codigo',
            //'fecha_ingreso',
            //'Ip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
