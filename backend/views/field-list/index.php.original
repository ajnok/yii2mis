<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FieldListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Field Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Field List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'field',
            'description',
            'visibility',
            'new',
            // 'excluded',
            // 'inserted_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
