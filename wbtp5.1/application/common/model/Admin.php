<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    // 软删除
    use SoftDelete;

    //只读字段
    protected $readonly=['email'];

    //登录校验
    public function login($data)
    {
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        $result=$this->where($data)->find();
        if($result){
            if($result['status']!=1){
                return '该账号已经被禁用';
            }
            $sessionData=[
                'id'=>$result['id'],
                'nickname'=>$result['nickname'],
                'is_super'=>$result['is_super']
            ];
            session('admin',$sessionData);
            //1表示用户名密码都正确
            return 1;
        }else{
            return '用户名或密码错误!';
        }
    }

    //注册校验
    public function register($data)
    {
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('register')->check($data)){
                return $validate->getError();
        }else{
                $result =$this->allowField(true)->save($data);
                if($result){
//                    $res=mailto($data['email'],'注册管理员账号成功！','注册管理员账号成功！');

                    return 1;
                }else{
                    return '注册失败!';
                }
        }

    }

    //添加管理员
    public function add($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result){
            return 1;
        }else{
            return '管理员添加失败！';
        }
    }

    //修改管理员信息
    public function edit($data)
    {
        $validate = new \app\common\validate\Admin();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $adminInfo = $this->find($data['id']);

        if ($data['oldpass'] != $adminInfo['password']){
            return '原密码错误！';
        }

        $adminInfo->password = $data['newpass'];
        $adminInfo->nickname = $data['nickname'];
        $adminInfo->status = $data['status'];
        $result = $adminInfo->save();
        if ($result){
            return 1;
        }else{
            return '管理员信息修改成功！';
        }

    }
}
