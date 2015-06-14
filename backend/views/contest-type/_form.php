<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Structure;

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

    <?= $form->field($model, 'structure_id')->dropDownList(
        ArrayHelper::map(Structure::find()->all(), 'id', 'title')
    ) ?>

    <?= $form->field($model, 'status')->dropDownList([
        '10' => 'active',
        '0' => 'disabled'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
