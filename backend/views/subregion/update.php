<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subregion */

$this->title = 'Update Subregion: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Subregions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subregion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
