<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ContestType */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Contest Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contest-type-view">

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
            'entry_fee',
            'withheld',
            'min_players',
            'max_players',
            'structure_id',
        ],
    ]) ?>

</div>
