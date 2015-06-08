<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContestTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contest-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'entry_fee') ?>

    <?= $form->field($model, 'withheld') ?>

    <?= $form->field($model, 'min_players') ?>

    <?php // echo $form->field($model, 'max_players') ?>

    <?php // echo $form->field($model, 'structure_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
