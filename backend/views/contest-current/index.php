<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContestCurrentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contest Currents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contest-current-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contest Current', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'type',
                'value' => 'type.title',
                'filter' => Html::activeDropDownList($searchModel, 'type_id',\yii\helpers\ArrayHelper::map(\common\models\ContestType::find()->all(), 'id', 'title'),['class'=>'form-control', 'prompt' => 'Select Type']),
            ],
            [
                'attribute' => 'category',
                'value' => 'category.title',
                'filter' => Html::activeDropDownList($searchModel, 'category_id',\yii\helpers\ArrayHelper::map(\common\models\ContestCategory::find()->all(), 'id', 'title'),['class'=>'form-control', 'prompt' => 'Select Category']),
            ],
            [
                'attribute' => 'region',
                'value' => 'region.title',
                'filter' => Html::activeDropDownList($searchModel, 'region_id',\yii\helpers\ArrayHelper::map(\common\models\Region::find()->all(), 'id', 'title'),['class'=>'form-control', 'prompt' => 'Select Region']),
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
