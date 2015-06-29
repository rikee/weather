<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Location */
$model->getPastDataSingle();
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'lat',
            'lon',
            [
                'attribute' => 'subregion',
                'value' => $model->subregion->title,
            ],
        ],
    ]) ?>

</div>
