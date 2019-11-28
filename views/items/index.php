<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsCatalogoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items Catalogos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-catalogo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Items Catalogo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item_codigo',
            'organizacion_codigo',
            'nombre',
            'marca',
            'modelo',
            //'estado',
            //'usuario_registro',
            //'usuario_modificacion',
            //'fecha_registro',
            //'fecha_modificacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
