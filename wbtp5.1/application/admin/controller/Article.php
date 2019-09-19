<?php

namespace app\admin\controller;

use think\Model;
use think\Db;
use think\model\concern\SoftDelete;

class article extends Base
{
    //软删除
    use SoftDelete;

    //文章列表
    public function lists()
    {
        $articles = model('Article')->order(['is_top','create_time'=>'desc'])->paginate('10');
        $viewData=[
           'articles'=>$articles
        ];
        $this->assign($viewData);
        return view();
    }

    //添加文章
    public function add()
    {
        if (request()->isAjax()){
            $data = [
                'title' =>input('post.title'),
                'desc' =>input('post.desc'),
                'tags' => input('post.tags'),
                'content' => input('post.content'),
                'is_top' => input('post.is_top','0'),
                'cate_id' => input('post.cateid'),
            ];
            $result = model('Article')->add($data);
            if ($result == 1){
                $this->success('文章添加成功！','admin/article/lists');
            }else{
                $this->error($result);
            }
        }
        $cates = Db::name('cate')->select();
//        $cates=model('Cate')->select();
        $viewData=[
            'cates'=>$cates
        ];
        $this->assign($viewData);
      return view();
    }

    //推荐文章
    public function top()
    {
        $data = [
            'id' => input('post.id'),
            'is_top' => input('post.is_top')?0 : 1
        ];
        $result = model('Article')->top($data);
        if ($result == 1){
            $this->success('操作成功！','admin/article/lists');
        }else{
            $this->error($result);
        }
    }

    //编辑文章
    public function edit()
    {
        if (request()->isAjax()){
            $data=[
                'id' =>input('post.id'),
                'title' =>input('post.title'),
                'desc' =>input('post.desc'),
                'tags' => input('post.tags'),
                'content' => input('post.content'),
                'is_top' => input('post.is_top','0'),
                'cate_id' => input('post.cateid'),
            ];
            $result = model('Article')->edit($data);
            if ($result == 1){
                return $this->success('编辑文章成功！','admin/article/lists');
            }else{
                return $this->error('修改文章失败！');
            }
        }

        $articleInfo = Model('Article')->find(input('id'));
        $cates = Db::name('cate')->select();
        $viewData=[
            'cates'=>$cates,
            'articleInfo'=>$articleInfo
        ];
        $this->assign($viewData);
        return view();
    }

    //删除文章
    public function del()
    {
        $articleDel = model('Article')->with('comments')->find(input('post.id'));
//        $articleDel = Db::name('article')->find(input('post.id'));
        $result = $articleDel->together('comments')->delete();
        if($result){
            return $this->success('删除成功！','admin/article/lists');
        }else{
            return $this->error('删除失败！');
        }
    }
}
