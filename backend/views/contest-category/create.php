<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ContestCategory */

$this->title = 'Create Contest Category';
$this->params['breadcrumbs'][] = ['label' => 'Contest Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contest-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
