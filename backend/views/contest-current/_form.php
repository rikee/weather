<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ContestCategory;
use common\models\ContestType;
use common\models\Region;

/* @var $this yii\web\View */
/* @var $model common\models\ContestCurrent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contest-current-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(ContestType::find()->all(), 'id', 'title')
    ) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(ContestCategory::find()->all(), 'id', 'title')
    ) ?>

    <?= $form->field($model, 'region_id')->dropDownList(
        ArrayHelper::map(Region::find()->all(), 'id', 'title')
    ) ?>

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
