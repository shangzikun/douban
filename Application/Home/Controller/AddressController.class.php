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
		'user_id'=>$_SESSION['me']['id'],
		'name' => I('post.name'),
		'phone' => I('post.phone'),
		'province' =>I('post.province'),
		'city'	=>I('post.city'),
		'area'=>I('post.area'),
		'address'=>I('post.address'),
		'createtime'=>date('Y-m-d H:i:s'),
        'updatetime'=>date('Y-m-d H:i:s'),
		);
		if (empty($data['name']) || empty($data['phone']) || empty($data['area'])) 
		{
			$this->error('参数错误',U('Home/Address/lists'));
		}
		$status = D('Address')->add($data);
		if ($status) {
			$this->success('新增成功',U('Home/Address/lists'));
		}
	}
	public function delete() {
		$id = I('get.id','');
		$status = D('Address')->where(array('id'=>$id))->delete();
		if ($status) {
			$this->success('删除成功',U('Home/Address/lists'));
		}
	}
}