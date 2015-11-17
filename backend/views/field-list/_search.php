<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FieldListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="field-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'field') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'visibility') ?>

    <?= $form->field($model, 'new') ?>

    <?php // echo $form->field($model, 'excluded') ?>

    <?php // echo $form->field($model, 'inserted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
