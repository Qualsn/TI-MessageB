<?php

namespace app\admin\controller;



class System extends Base
{
    //系统设置
    public function set()
    {
        $setInfo = model('System')->find();
        $viewData = [
            'sets' => $setInfo
        ];
        $this->assign($viewData);
        return view();
    }

    //修改系统设置
    public function edit()
    {
        $data=[
            'id' =>input('post.id'),
            'webname' =>input('post.webname'),
            'copyright' =>input('post.copyright')
        ];

        $result = model('System')->edit($data);
        if ($result == 1){
            $this->success('修改成功！','admin/system/set');
        }else{
            $this->error($result);
        }
    }
}
