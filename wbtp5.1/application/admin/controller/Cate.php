<?php

namespace app\admin\controller;


use think\model\concern\SoftDelete;

class Cate extends Base
{
    use SoftDelete;
    //添加栏目
    public function add()
    {
        if(request()->isAjax()){
            $data=[
                'catename' => input('post.catename'),
                'sort'=> input('post.sort')
            ];
            $result = model('Cate')->add($data);
            if ($result == 1){
                $this->success('栏目添加成功','admin/cate/lists');
            }else{
                $this->error($result);
            }

        }

        return view();
    }

    //栏目列表
    public function lists()
    {
        $cate= model('Cate')->order('sort','asc')->paginate('10');

        //定义一个模板数据变量
        $viewData=[
            'cate' => $cate
        ];
        $this->assign($viewData);
        return view();
    }

    //排序
    public function sort()
    {
        if (request()->isAjax()){
            $data = [
                'id' =>input('post.id'),
                'sort' => input('post.sort')
            ];
            $result = model('Cate')->sort($data);
            if ($result == 1){
                $this->success('排序成功','admin/cate/lists');
            }else{
                $this->error($result);
            }
        }
    }

    //更新数据
    public function edit()
    {
        if (request()->isAjax()){
            $data = [
                'id'=>input('post.id'),
                'catename' =>input('post.catename')
            ];
            $result = model('Cate')->edit($data);
            if ($result == 1){
                $this->success('编辑成功！','admin/cate/lists');
            }else{
                $this->error($result);
            }
        }
        $cateInfos =model('Cate')->find(input('id'));
        $viewData = [
            'cateInfos' => $cateInfos
        ];
        $this->assign($viewData);
        return view();
    }

    //删除数据
    public function del()
    {
        $findData = model('Cate')->with('article,article.comments')->find(input('post.id'));
        foreach ($findData['article'] as $key=>$v) {
            $v->together('comments')->delete();
        }
        $result = $findData->together('article')->delete();
        if ($result){
            $this->success('栏目删除成功！','admin/cate/lists');
        }else{
            $this->error('栏目删除失败！');
        }
    }
}
