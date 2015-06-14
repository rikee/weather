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
                'attribute' => 'Type',
                'value' => 'contestType.title',
                'filter' => Html::activeDropDownList($searchModel, 'type_id',\yii\helpers\ArrayHelper::map(\common\models\ContestType::find()->all(), 'id', 'title'),['class'=>'form-control', 'prompt' => 'Select Type']),
            ],
            'category',
            [
                'attribute' => 'Region',
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
                        '10' => 'active',
                        '0' => 'disabled'
                    ]
                    ,['class'=>'form-control', 'prompt' => 'Select Status']),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
