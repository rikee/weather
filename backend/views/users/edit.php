<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h2><?=$title?></h2>
<?php
$form = ActiveForm::begin([
    'id' => 'editUserForm',
    'options' => ['class' => 'adminForm'],
]) ?>

<?= $form->field($user, 'username') ?>
<?= $form->field($user, 'email')->input('email') ?>
<?= $form->field($user, 'password')->passwordInput() ?>
<?= $form->field($user, 'role')->dropDownList(['1' => 'Registered', '10' => 'Thor']) ?>
<?= $form->field($user, 'status')->radioList(['10' => 'Active', '0' => 'Deleted']) ?>
<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>