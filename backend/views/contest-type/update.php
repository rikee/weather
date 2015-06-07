<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContestType */

$this->title = 'Update Contest Type: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Contest Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contest-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
