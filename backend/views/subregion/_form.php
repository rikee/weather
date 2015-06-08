<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Region;

/* @var $this yii\web\View */
/* @var $model common\models\Subregion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subregion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region_id')->dropDownList(
        ArrayHelper::map(Region::find()->all(), 'id', 'title')
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
