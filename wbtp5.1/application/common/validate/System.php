<?php


namespace app\common\validate;


use think\Validate;

class System extends Validate
{
    protected $rule = [
      'webname|网站标题'=> 'require',
        'copyright|权限信息' => 'require'
    ];

}