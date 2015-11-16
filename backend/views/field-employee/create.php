<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FieldEmployee */

$this->title = 'Create Field Employee';
$this->params['breadcrumbs'][] = ['label' => 'Field Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
