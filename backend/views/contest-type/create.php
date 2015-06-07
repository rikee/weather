<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ContestType */

$this->title = 'Create Contest Type';
$this->params['breadcrumbs'][] = ['label' => 'Contest Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contest-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
