<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Cate extends Model
{
    //软删除
    use SoftDelete;

    //关联文章
    public function article()
    {
        return $this->hasMany('Article','cate_id','id');
    }

    //栏目添加
    public function add($data)
    {
        $validate = new \app\common\validate\Cate();
        if (!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result =$this->allowField(true)->save($data);
        if ($result){
            return 1;
        }else{
            return '栏目添加失败';
        }
    }

    //排序
    public function sort($data)
    {
        $validate = new \app\common\validate\Cate();
        if (!$validate->scene('sort')->check($data)){
            return $validate->getError();
        }

//        $result =Db::name('cate')
//            ->where('id',$data['id'])
//            ->setField('sort', $data['sort']);
        $sort = $this->find($data['id']);
        $sort->sort = $data['sort'];
        $result = $sort->save();
        if ($result){
            return 1;
        }else{
            return '排序失败！';
        }
    }

    //编辑cate
    public function edit($data)
    {
        $validate = new \app\common\validate\Cate();
        if (!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
//        $result = Db::name('cate')->where('id',$data['id'])->setField('catename',$data['catename']);
        $edits = $this->find($data['id']);
        $edits->catename=$data['catename'];
        $result = $edits->save();
        if ($result){
            return 1;
        }else{
            return '编辑失败！';
        }

    }
}
