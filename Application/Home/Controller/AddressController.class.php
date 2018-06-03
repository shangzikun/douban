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

	}
}