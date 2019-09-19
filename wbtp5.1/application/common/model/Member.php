<?php

namespace app\common\model;

use think\Db;
use think\Model;
use think\model\concern\SoftDelete;

class Member extends Model
{
    //软删除
    use SoftDelete;

    //只读文段
    protected $readonly = ['username','email'];

    //关联评论
    public function comments()
    {
        return $this->hasMany('Comment','member_id','id');
    }

    //添加会员
    public function  add($data)
    {
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
//        $result = Db::name('member')->data($data)->insert();
        if ($result){
            return 1;
        }else{
            return "会员添加失败！";
        }
    }

    //修改会员信息
    public function edit($data)
    {
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $memberInfo = Db::name('member')->find($data['id']);
        if ($data['oldpass']!=$memberInfo['password']){
            return '原密码错误！';
        }
        /*
         * 经常用不了model方式
        $memberInfo->password = $data['newpss'];
        $memberInfo->nickname = $data['nickname'];
        $result = $memberInfo->save();
        */
        $result = Db::name('member')->where('id', $data['id'])->update(['nickname' => $data['nickname'],'password'=>$data['newpass']]);
//        $result= Db::name('member')->where('id',$data['id'])->setField('password','123');
        if ($result){
            return 1;
        }else{
            return '会员信息修改失败！';
        }
    }

    //会员注册
    public function register($data)
    {
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('register')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result){
            return 1;
        }else{
            return '注册失败！';
        }

    }

    //会员登录
    public function login($data)
    {
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        unset($data['verify']);
        $result = $this->where($data)->find();
        if ($result){
            $sessionData = [
              'id' => $result['id'],
                'nickname'=> $result['nickname']
            ];
            session('index',$sessionData);
            return 1;
        }else{
            return '登录失败！';
        }
    }
}
