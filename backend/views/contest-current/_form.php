<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use janisto\timepicker\TimePicker;
use common\models\ContestCategory;
use common\models\ContestType;
use common\models\Region;

/* @var $this yii\web\View */
/* @var $model common\models\ContestCurrent */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $hours = array();
    for ($i = 0; $i < 24; $i++) {
        if ($i < 10) {
            $hours[] = '0' . $i;
        } else {
            $hours[] = (string) $i;
        }
    }
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

    <?= $form->field($model, 'state')->dropDownList([
        $model::STATE_ANNOUNCED => 'Announced',
        $model::STATE_REGISTERING => 'Registering',
        $model::STATE_RUNNING => 'Running',
        $model::STATE_CONCLUDED => 'Concluded',
        $model::STATE_CANCELED => 'Canceled',
    ]) ?>

    <?= $form->field($model, 'recurring')->dropDownList([
        $model::RECURRING_ONCE => 'Once',
        $model::RECURRING_DAILY => 'Daily',
        $model::RECURRING_WEEKLY => 'Weekly',
        $model::RECURRING_MONTHLY => 'Monthly',
    ]) ?>

    <?= $form->field($model, 'date')->widget(TimePicker::className(), [
        'mode' => 'datetime',
        'clientOptions'=>[
        'dateFormat' => 'yy-mm-dd',
        'timeFormat' => 'HH:mm:ss',
        'showSecond' => false,
        ]
    ]) ?>

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
