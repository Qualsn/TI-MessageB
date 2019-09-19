<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    //共享视图
    public function initialize()
    {
        $cates = model('Cate')->order('sort','asc')->select();
        $webInfo = model('System')->find();
        $articletops=model('Article')->where('is_top',1)->order('create_time','desc')->limit(10)->select();
        $viewData = [
            'cates' => $cates,
            'articletops'=>$articletops,
            'webInfo' =>$webInfo
        ];
        $this->view->share($viewData);
    }
}
