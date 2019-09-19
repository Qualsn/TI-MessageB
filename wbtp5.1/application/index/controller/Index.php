<?php
namespace app\index\controller;


class Index extends Base
{
   public function index()
   {
       $where = [];
       $catename = null;
       if(input('?id')){
           $where=[
               'cate_id' => input('id')
           ];
           $catename = model('Cate')->where('catename',input('id'))->value('catename');
       }
        $articles = model('Article')->where($where)->order('create_time','desc')->paginate(5);

        $viewData = [
            'articles' =>$articles,
            'catename' =>$catename
        ];
        $this->assign($viewData);
       return view();
   }

   //注册
    public function register()
    {
        if (request()->isAjax()){
            $data = [
                'username' => input('post.username'),
                'nickname' => input('post.nickname'),
                'password' => input('post.password'),
                'compass' => input('post.compass'),
                'email' => input('post.email'),
                'verify' => input('post.verify')
            ];
            $result = model('Member')->register($data);
            if ($result == 1){
                return $this->success('注册成功！','index/index/login');
            }else{
                return $this->error($result);
            }
        }

        return view();
    }

    //登录
    public function login()
    {
        if (request()->isAjax()){
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'verify' => input('post.verify')
            ];
            $result = model('Member')->login($data);
            if ($result == 1){
                $this->success('登录成功！','index/index/index');
            }else{
                $this->error($result);
            }
        }

        return view();
    }

    //退出登录
    public function loginout()
    {
        session(null);
        if (session('?index.id')){
           $this->error('退出失败！');
        }else{
            $this->success('退出成功！');
        }
    }

    //搜索
    public function search()
    {
        $where[] = ['title','like','%'.input('keyword').'%'];
        $catename = input('keyword');
        $articles = model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $viewData = [
            'articles' =>$articles,
            'catename' => $catename
        ];
        $this->assign($viewData);
        return view('index');

    }

    //评论
    public function comment()
    {
        $data = [
            'article_id' => input('post.article_id'),
            'member_id' => input('post.member_id'),
            'content' => input('post.content')
        ];
        $result= model('Comment')->comm($data);
        if ($result == 1){
            $this->success('评论成功！');
        }else{
            $this->error($result);
        }

    }


}
