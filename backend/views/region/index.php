<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Region', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'parent region',
                'value' => function($model) {
                    if (is_null($model->parentRegion))
                    {
                        return 'Root';
                    }
                    return $model->parentRegion->title;
                },
                'filter' => Html::activeDropDownList($searchModel, 'parent_region_id',\yii\helpers\ArrayHelper::map(\common\models\Region::find()->all(), 'id', 'title'),['class'=>'form-control', 'prompt' => 'Select Parent Region']),
            ],
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->statusString;
                },
                'filter' => Html::activeDropDownList($searchModel, 'status',
                    [
                        $searchModel::STATUS_ACTIVE => 'Active',
                        $searchModel::STATUS_DISABLED => 'Disabled',
                        $searchModel::STATUS_DELETED => 'Deleted',
                    ]
                    ,['class'=>'form-control', 'prompt' => 'Select Status']),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
