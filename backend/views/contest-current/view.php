<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ContestCurrent */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Contest Currents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contest-current-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'type',
                'value' => $model->type->title,
            ],
            [
                'attribute' => 'category',
                'value' => $model->category->title,
            ],
            [
                'attribute' => 'region',
                'value' => $model->region->title,
            ],
            [
                'attribute' => 'state',
                'value' => $model->stateString,
            ],
            [
                'attribute' => 'recurring',
                'value' => $model->recurringString,
            ],
            'date',
            [
                'attribute' => 'status',
                'value' => $model->statusString,
            ],
        ],
    ]) ?>

</div>
