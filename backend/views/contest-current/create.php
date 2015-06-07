<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ContestCurrent */

$this->title = 'Create Contest Current';
$this->params['breadcrumbs'][] = ['label' => 'Contest Currents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contest-current-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
