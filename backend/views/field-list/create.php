<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FieldList */

$this->title = 'Create Field List';
$this->params['breadcrumbs'][] = ['label' => 'Field Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
