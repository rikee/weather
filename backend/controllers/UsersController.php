<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\url;
use app\models\Users;

class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'edit', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Users::find();

        $pagination = new Pagination([
            'defaultPageSize' => 50,
            'totalCount' => $query->count(),
        ]);

        $users = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }

    public function actionEdit($id = null)
    {
        $model = new Users();

        if(!isset($model->status))
        {
            $model->status = '10';
        }

        if ($model->load(Yii::$app->request->post())) {
            if (!is_null($id)) {
                $model->edit($id);
            }
            else {
                $model->add();
            }
        }

        if (!is_null($id)) {
            $user = Users::findOne($id);
            $title = 'Edit User';
        }
        else {
            $user = $model;
            $title = 'Add User';
        }

        return $this->render('edit', [
            'user' => $user,
            'title' => $title,
        ]);
    }

    public function actionDelete($id)
    {
        $model = new Users();
        $model->remove($id);

        return $this->redirect(Url::to(['users/index']));
    }
}