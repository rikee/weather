<?php

namespace app\models;

use Yii;
use common\models\User;

class Users extends User
{
    public $password;

    public function edit($id)
    {
        if ($this->validate()) {
            $request = Yii::$app->request;
            $post = $request->post()['Users'];
            $user = parent::findOne($id);
            
            $user->username = $post['username'];
            $user->email = $post['email'];
            if (isset($post['password']) && $post['password'] != '') {
                $user->setPassword($post['password']);
            }
            $user->role = $post['role'];
            $user->status = $post['status'];
            if($user->save()) {
                return $user;
            }
        }

        return null;
    }

    public function add()
    {
        if ($this->validate()) {
            $request = Yii::$app->request;
            $post = $request->post()['Users'];
            $user = new Users();

            $user->username = $post['username'];
            $user->email = $post['email'];
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->role = $post['role'];
            $user->status = $post['status'];
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    public function remove($id)
    {
        $user = parent::findOne($id);
        $user->delete();
    }
}