<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Region;

/* @var $this yii\web\View */
/* @var $model frontend\models\SubregionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subregion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'region_id')->dropDownList(
        ArrayHelper::map(Region::find()->all(), 'id', 'title'), ['prompt' => 'Select Region']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default clear']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
