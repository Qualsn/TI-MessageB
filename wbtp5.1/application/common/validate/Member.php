<?php


namespace app\common\validate;


use think\Validate;

class Member extends Validate
{
    protected $rule = [
        'username|会员名称' => 'require|unique:member',
        'password|会员密码' => 'require',
        'compass|确认密码' => 'require|confirm:password',
        'nickname|昵称' => 'require',
        'oldpass|原密码' => 'require',
        'newpass|新密码' => 'require',
        'email|邮箱' => 'require|email|unique:member',
        'verify|验证码' => 'require|captcha'
    ];

    //会员添加场景
    public function sceneAdd()
    {
        return $this->only(['username','password','nickname','email']);
    }

    //会员修改场景
    public function sceneEdit()
    {
        return $this->only(['oldpass','newpass','nickname']);
    }

    //会员注册场景
    public function sceneRegister()
    {
        return $this->only(['username','password','compass','nickname','email','verify']);
    }

    //登录场景
    public function sceneLogin()
    {
        return $this->remove('username','unique')->only(['username','password','verify']);
    }
}