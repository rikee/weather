<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList([
        $model::ROLE_SUPERADMIN => 'Superadmin',
        $model::ROLE_REGISTERED => 'Registered'
    ]) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance_bonus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        $model::STATUS_ACTIVE => 'Active',
        $model::STATUS_DISABLED => 'Disabled',
        $model::STATUS_DELETED => 'Deleted',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
