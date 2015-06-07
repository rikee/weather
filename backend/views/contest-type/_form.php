<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContestType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contest-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entry_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'withheld')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_players')->textInput() ?>

    <?= $form->field($model, 'max_players')->textInput() ?>

    <?= $form->field($model, 'structure_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
