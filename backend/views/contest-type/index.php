<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContestTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contest Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contest-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contest Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'entry_fee',
            'withheld',
            'min_players',
            'max_players',
            [
                'attribute' => 'Structure',
                'value' => 'structure.title',
                'filter' => Html::activeDropDownList($searchModel, 'structure_id',\yii\helpers\ArrayHelper::map(\common\models\Structure::find()->all(), 'id', 'title'),['class'=>'form-control', 'prompt' => 'Select Structure']),
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
