<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subregion */

$this->title = 'Create Subregion';
$this->params['breadcrumbs'][] = ['label' => 'Subregions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subregion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
