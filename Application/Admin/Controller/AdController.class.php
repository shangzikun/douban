<?php
namespace Admin\Controller;
use Admin\Controller;
class AdController extends CommonController {
	 public function lists() {
        //搜索
        //拼where
        $name = I('get.name','');
        $status = I('get.status','all');
        $where = array();
        if(!empty($name)) {
            $where['title']=array('like',"%{$name}%");
        }
        if (!empty($status) && $status !=='all') {
            $where['status']=$status;
        }
        //查数据
        
        $lists = D('Ad')->getList($where);
        $this->assign('lists',$lists);
        $this->display();
    }
    public function add() {
        $this->display();
    }
    public function doAdd() {
    	$title = I('post.title','');
    	$url = I('post.url','');
    	$starttime = I('post.starttime','');
    	$endtime = I('post.endtime','');
        $image = uploadFile('image','ad');
        $data = array(
        	'title'=>$title,
        	'url'=>$url,
        	'starttime'=>$starttime,
        	'endtime'=>$endtime,
            'image' =>$image,
            'createtime'=>date('Y-m-d H:i:s'),
            'updatetime'=>date('Y-m-d H:i:s'),
        );
        $status=D('ad')->add($data);
        if($status){
            $this->success('添加成功',U('Admin/ad/lists'));
        }
    }
    public function edit() {
    	$id = I('get.id','');
    	if (empty($id)) {
    		$this->error('参数错误',U('admin/ad/lists'));
    	}
    	$info = D('ad')->getBasicInfo($id);
    	$this->assign('info',$info);
    	$this->display(); 
    }
    public function doEdit() {
    	$id = I('post.id','');
    	$title = I('post.title','');
    	$url = I('post.url','');
    	$starttime = I('post.starttime','');
    	$endtime = I('post.endtime','');
        $image = uploadFile('image','ad');
        $data = array(
        	'title'=>$title,
        	'url'=>$url,
        	'starttime'=>$starttime,
        	'endtime'=>$endtime,
            'createtime'=>date('Y-m-d H:i:s'),
            'updatetime'=>date('Y-m-d H:i:s'),
        );
        if (!empty($image)) {
        	$data['image']=$image;
        }
        $status=D('ad')->where(array('id'=>$id))->save($data);
        if($status){
            $this->success('添加成功',U('Admin/ad/lists'));
        }
    }
    public function onLine() {
        $id = I('get.id','');
        $data =array(
            'status'=> 1,
            'updatetime'=>date('Y-m-d H:i:s'));
        $status=D('ad')->where(array('id'=>$id))->save($data);
        if($status){
            $this->success('修改成功',U('Admin/ad/lists'));
        }
    }
    public function offLine() {
        $id = I('get.id','');
        $data =array(
            'status'=> 2,
            'updatetime'=>date('Y-m-d H:i:s'));
        $status=D('ad')->where(array('id'=>$id))->save($data);
        if($status){
            $this->success('修改成功',U('Admin/ad/lists'));
        }
    }
}

