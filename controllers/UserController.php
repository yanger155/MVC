<?php

namespace controllers;

use models\User;

class UserController
{
    // 创建hello方法
    public function hello(){

        // 一般这里是去数据库里查询，并返回数据
        $user = new User;
        $name = $user->getName();
        // $name = tom
        
        // 加载视图
        view('user.hello', [
            'name' => $name
        ]);
    }

    // 创建world方法
    public function world()
    {
        echo 'world';
    }
}