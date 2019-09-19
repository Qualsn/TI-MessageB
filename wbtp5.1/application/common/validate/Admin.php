<?php


namespace app\common\validate;

use think\Validate;

class Admin extends Validate
{
//验证类
        protected $rule=[
            'username|管理员账户'=>'require',
            'password|密码'=>'require',
            'compass|确认密码'=>'require|confirm:password',
            'nickname|昵称'=>'require',
            'oldpass|原密码' => 'require',
            'newpass|新密码' => 'require',
            'email|邮箱'=>'require|email|unique:admin',
            'catename|栏目名称' => 'require|unique:cate',
            'sort|排序'=>'require|number'
        ];
        //登录验证场景
    public function sceneLogin()
    {
        return $this->only(['username','password']);
    }
    //注册场景
    public function sceneRegister()
    {
        return $this->only(['username','password','compass','nickname','email'])
            ->append('username','unique:admin');
    }

    //添加管理员场景
    public function sceneAdd()
    {
        return $this->only(['username','password','compass','nickname','email']);
    }

    //修改管理员信息场景
    public function sceneEdit()
    {
        return $this->only(['oldpass','newpass','nickname']);
    }
}