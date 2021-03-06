<?php


namespace app\common\validate;

use think\Validate;

class Cate extends Validate
{
    protected $rule = [
      'catename|栏目名称' => 'require|unique:cate',
        'sort|排序' => 'require|number'
    ];
    public function sceneAdd()
    {
        return $this->only(['catename','sort']);
    }

    //排序校验
    public function sceneSort()
    {
        return $this->only(['sort']);
    }

    //校验编辑内容
    public function sceneEdit(){
        return $this->only(['catename']);
    }
}