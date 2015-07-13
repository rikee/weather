<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ContestCurrentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Current Contests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contest-current-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
                'attribute' => 'state',
                'value' => function($model) {
                    return $model->stateString;
                },
                'filter' => Html::activeDropDownList($searchModel, 'status',
                    [
                        $searchModel::STATE_ANNOUNCED => 'Announced',
                        $searchModel::STATE_REGISTERING => 'Registering',
                        $searchModel::STATE_RUNNING => 'Running',
                        $searchModel::STATE_CONCLUDED => 'Concluded',
                        $searchModel::STATE_CANCELED => 'Canceled',
                    ]
                    ,['class'=>'form-control', 'prompt' => 'Select Status']),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
