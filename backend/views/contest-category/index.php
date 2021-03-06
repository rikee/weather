<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContestCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contest Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contest-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contest Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
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
