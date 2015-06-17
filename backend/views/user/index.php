<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success', 'disabled' => 'disabled']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email',
            [
                'attribute' => 'role',
                'value' => function($model) {
                    return $model->roleString;
                },
                'filter' => Html::activeDropDownList($searchModel, 'status',
                    [
                        backend\models\UserSearch::ROLE_SUPERADMIN => 'Superadmin',
                        backend\models\UserSearch::ROLE_REGISTERED => 'User'
                    ]
                    ,['class'=>'form-control', 'prompt' => 'Select Role']),
            ],
            'created_at:date',
            // 'updated_at',
            // 'password_reset_token',
            // 'password_hash',
            // 'auth_key',
            'balance:currency',
            'balance_bonus:currency',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->statusString;
                },
                'filter' => Html::activeDropDownList($searchModel, 'status',
                    [
                        backend\models\UserSearch::STATUS_ACTIVE => 'Active',
                        backend\models\UserSearch::STATUS_DISABLED => 'Disabled',
                        backend\models\UserSearch::STATUS_DELETED => 'Deleted',
                    ]
                    ,['class'=>'form-control', 'prompt' => 'Select Status']),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
