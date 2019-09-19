<?php

namespace app\index\controller;


class Article extends Base
{
    //详细文章
    public function info()
    {
        $articleInfo = model('Article')->with('comments,comments.member')->find(input('id'));
        $articleInfo->setInc('click');
        $articletops=model('Article')->where('is_top',1)->order('create_time','desc')->limit(10)->select();
        $viewData =[
            'articleInfo' => $articleInfo,
            'articletops' =>$articletops
        ];
        $this->assign($viewData);
        return view();
    }
}
