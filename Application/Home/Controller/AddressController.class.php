<?php
namespace Home\Controller;
use Think\Controller;
class AddressController extends Controller {
	public function lists(){
		$lists = D('Address')->getList();		
		$this->assign('lists',$lists);
		$this->display();
	}
	public function doAdd(){
		$data = array(
		'name' => I('post.name'),
		'phone' => I('post.phone'),
		'province' =>I('post.province'),
		'city'	=>I('post.city'),
		'area'=>I('post.area'),
		'createtime'=>date('Y-m-d H:i:s'),
        'updatetime'=>date('Y-m-d H:i:s'),
		);
		var_dump($data);
		die();
		$status = D('Address')->add($data);
	}
}