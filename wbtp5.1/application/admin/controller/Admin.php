<?php

namespace app\admin\controller;

class Admin extends Base
{
    //管理员列表
    public function lists()
    {
        $adminInfo = model('Admin')->order(['is_super' => 'desc', 'status' => 'desc'])->paginate(10);
        $viewData = [
            'admins' => $adminInfo
        ];
        $this->assign($viewData);
        return view();
    }

    //管理员添加
    public function add()
    {
        if (request()->isAjax()){
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'compass' => input('post.compass'),
                'email' => input('post.email'),
                'nickname' => input('post.nickname'),
            ];
            $result = model('Admin')->add($data);
            if ($result==1){
                $this->success('管理员添加成功！','admin/admin/lists');
            }else{
                $this->error($result);
            }
        }

        return view();
    }

    //修改管理员状态
    public function status()
    {
        $data = [
            'id' => input('post.id'),
            'status' => input('post.status')?0:1
        ];
        $statusInfo = model('Admin')->find($data['id']);
        $statusInfo->status = $data['status'];
        $result = $statusInfo->save();
        if ($result){
            $this->success('操作成功！','admin/admin/lists');
        }else{
            $this->error('操作失败！');
        }
    }

    //编辑管理员信息
    public function edit()
    {
        if (request()->isAjax()){
            $data = [
                'id' => input('post.id'),
                'oldpass' => input('post.oldpass'),
                'newpass' => input('post.newpass'),
                'nickname' => input('post.nickname'),
                'status' => input('post.status','0')

            ];

            $result = model('Admin')->edit($data);
            if ($result == 1){
                $this->success('修改管理员信息成功！','admin/admin/lists');
            }else{
                $this->error($result);
            }
        }

        $admins = model('Admin')->find(input('id'));
        $viewData = [
            'admins' => $admins
        ];
        $this->assign($viewData);

        return view();
    }

    //删除管理员
    public function del()
    {
        $adminInfo = model('Admin')->find(input('post.id'));
        $result = $adminInfo->delete();
        if ($result){
            $this->success('删除管理员成功！','admin/admin/lists');
        }else{
            $this->error('删除失败！');
        }
    }
}
