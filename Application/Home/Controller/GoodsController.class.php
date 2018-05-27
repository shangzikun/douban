<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
	public function info() {
		$id = I('get.id','');
		$info = D('goods')->getBasicInfo($id);
		$this->assign('info',$info);
		$this->display();
	}
}