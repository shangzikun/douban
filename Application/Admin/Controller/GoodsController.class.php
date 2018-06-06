<?php
namespace Admin\Controller;
use Admin\Controller;
class GoodsController extends CommonController {
    public function lists() {
        //搜索
        //拼where
        $name = I('get.name','');
        $status = I('get.status','all');
        $where = array();
        if(!empty($name)) {
            $where['title']=array('like',"%{$name}%");
        }
        if ($status !=='all') {
            $where['status']=$status;
        }
        //查数据
        
        $lists = D('Goods')->getList($where);
        foreach ($lists as $key => $value) {
            $arrTags = explode(',', $value['tag_id']);
            $tags='';
            foreach ($arrTags as $k => $v) {
                $tagInfo = D('Tag')->getBasicInfo($v);
                $tags.=$tagInfo['name'].",";
            }
            $tags=rtrim($tags,',');
            $value['tag_id']=$tags;
            $lists[$key] = $value;
        }
        $this->assign('lists',$lists);
        $this->display();
    }
    public function add() {
        $tags = D('tag')->getList();
        $this->assign('tags',$tags);
        $this->display();
    }
    public function doAdd() {
        $title = I('post.title','');
        $price = I('post.price','');
        $desc = I('post.desc','');
        $content = I('post.content','');
        $image = uploadFile('image','good');
        $tag = I('post.tags','');
        $tag = implode(",", $tag);
        $data = array(
            'title'=>$title,
            'price'=>$price,
            'desc' =>$desc,
            'content'=>$content,
            'image' =>$image,
            'tag_id' =>$tag,
            'createtime'=>date('Y-m-d H:i:s'),
            'updatetime'=>date('Y-m-d H:i:s'),
        );
        $status=D('Goods')->add($data);
        if($status){
            $this->success('添加成功',U('Admin/Goods/lists'));
        }
    }
    public function edit() {
        $id = I('get.id','');
        if (empty($id)) {
            $this->error('参数错误',U('Admin/goods/lists'));
        }
        //读取所有tag
        $tags = D('tag')->getList();      
        $info = D('goods')->getBasicInfo($id);
        //拆分id，做默认选中
        $info['tag_id'] = explode(',', $info['tag_id']);
        $this->assign('tags',$tags);
        $this->assign('info',$info);
        $this->display();
    }
    public function doEdit() {
        $id = I('post.id','');
        $title = I('post.title','');
        $price = I('post.price','');
        $desc = I('post.desc','');
        $content = I('post.content','');
        $image = uploadFile('image','good');
        $tag = I('post.tags','');
        $tag = implode(",", $tag);
        $data = array(
            'title'=>$title,
            'price'=>$price,
            'desc' =>$desc,
            'content'=>$content,
            'tag_id' =>$tag,
            'createtime'=>date('Y-m-d H:i:s'),
            'updatetime'=>date('Y-m-d H:i:s'),
        );
        if (!empty($image)) {
            $data['image']=$image;
        }
        $status=D('Goods')->where(array('id'=>$id))->save($data);
        if($status){
            $this->success('添加成功',U('Admin/Goods/lists'));
        }
    }
    public function onLine() {
        $id = I('get.id','');
        $data =array(
            'status'=> 1,
            'updatetime'=>date('Y-m-d H:i:s'));
        $status=D('Goods')->where(array('id'=>$id))->save($data);
        if($status){
            $this->success('修改成功',U('Admin/Goods/lists'));
        }
    }
     public function offLine() {
        $id = I('get.id','');
        $data =array(
            'status'=> 2,
            'updatetime'=>date('Y-m-d H:i:s'));
        $status=D('Goods')->where(array('id'=>$id))->save($data);
        if($status){
            $this->success('修改成功',U('Admin/Goods/lists'));
        }
    }
}