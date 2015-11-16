<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FieldEmployee */

$this->title = 'Update Field Employee: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Field Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="field-employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
