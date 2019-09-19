<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class System extends Model
{
    //软删除
    use SoftDelete;

    //修改系统设置
    public function edit($data)
    {
        $validate = new \app\common\validate\System();
        if (!$validate->check($data)){
            return $validate->getError();
        }
        $sets = $this->find();
//        $sets['webname'] = 'weeb123';
//        $sets['copyright'] = $data['copyright'];
//        $result = $sets-$this->save();
        $result =$sets->save([
            'webname'  => $data['webname'],
            'copyright' => $data['copyright']
        ],['id' => $data['id']]);
        if ($result){
            return 1;
        }else{
            return '修改失败！';
        }
    }
}
