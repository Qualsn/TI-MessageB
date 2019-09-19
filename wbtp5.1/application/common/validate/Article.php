<?php


namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule=[
        'title|文章标题' => 'require|unique:article',
        'tags|标题' => 'require',
        'cate_id|所属栏目'=>'require',
        'desc|文章概要' => 'require',
        'content|文章内容'=>'require',
        'is_top|推荐' =>'require'
    ];

    //添加文章场景
    public function sceneAdd()
    {
        return $this->only(['title','tags','cate_id','desc','content']);
    }

    //推荐文章场景
    public function sceneTop()
    {
        return $this->only(['is_top']);
    }
    //编辑文章场景
    public function sceneEdit()
    {
        return $this->only(['title','tags','cate_id','desc','content']);
    }
}