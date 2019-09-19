<?php

namespace app\admin\controller;


use think\Db;

class Member extends Base
{

    //添加会员
    public function add()
    {
        if (request()->isAjax()){
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email')
            ];
            $result = model('Member')->add($data);
            if ($result == 1){
                $this->success('会员添加成功！', 'admin/member/lists');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //会员列表
    public function lists()
    {
//        $members = Db::name('member')->where('delete_time','')->order('create_time','desc')->paginate('10');
        $members = model('Member')->order('create_time','desc')->paginate('10');
        $viewData = [
            'members' => $members
        ];
        $this->assign($viewData);
        return view();
    }

    //会员编辑
    public function edit()
    {
        if (request()->isAjax()){
            $data = [
                'id' => input('post.id'),
                'nickname' => input('post.nickname'),
                'oldpass' => input('post.oldpass'),
                'newpass' => input('post.newpass')
            ];
            $result = model('Member')->edit($data);
            if ($result == 1){
                $this->success('修改成功！','admin/member/lists');
            }else{
                $this->error($result);
            }

        }
        $member = Db::name('member')->find(input('id'));
        $viewData = [
            'member' => $member
        ];
        $this->assign($viewData);
        return view();
    }

    //删除会员
    public function del()
    {
//        $result = Db::name('member')
//            ->where('id', input('post.id'))
//            ->useSoftDelete('delete_time',time())
//            ->delete();
        $members = model('Member')->with('comments')->find(input('post.id'));
        $result = $members->together('comments')->delete();
        if ($result){
            $this->success('删除成功！','admin/member/lists');
        }else{
            $this->error('删除失败！');
        }
    }
}
