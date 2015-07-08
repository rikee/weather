<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Subregion */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Subregions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subregion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'short_title',
            [
                'attribute' => 'region',
                'value' => $model->region->title,
            ],
        ],
    ]) ?>

</div>
