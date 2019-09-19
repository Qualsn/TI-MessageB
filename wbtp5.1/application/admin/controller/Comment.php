<?php

namespace app\admin\controller;

use think\Controller;

class Comment extends Controller
{
    //评论列表
    public function lists()
    {
        $comments = model('Comment')->order('create_time','desc')->paginate(10);
        $viewData =[
            'comments'=>$comments
        ];
        $this->assign($viewData);
        return view();
    }

    //删除评论
    public function del()
    {
        $del = model('Comment')->find(input('post.id'));
        $result = $del->delete();
        if ($result){
            $this->success('删除成功！','admin/comment/lists');
        }else{
            $this->error('删除失败！');
        }

    }
}
