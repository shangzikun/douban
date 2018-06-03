<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {
	public function orderTmp() {
		$res = array(
            'error_no' => 0,
            'msg'      => 'OK',
            'data'     => array(),
            );
		$goodsId = I('post.goods_id','');
		$goodsNum = I('post.goods_num','');
		$cart = I('post.cart','');
		$goodsInfo = array();		
		if(!empty($cart)){//购物车入口
			if(!is_array($cart)){//前段传来json字符串时，强制转换
				$cart = json_decode($cart,true);
			}
			foreach ($cart as $key => $value) {
				$cartInfo = D('cart')->getBasicInfo($value);
				$tmp = array('goods_id' =>$cartInfo['goods_id'],'goods_num'=>$cartInfo['num'],);
				$goodsInfo[]=$tmp;
			}
		} else {//详情页入口
			$goodsInfo[] = array('goods_id' =>$goodsId,'goods_num'=>$goodsNum,);
		}
		$userId = $_SESSION['me']['id'];
		$goodsInfo = json_encode($goodsInfo);
		$data =array(
			'user_id'=>$userId,
			'goods_info'=>$goodsInfo,);
		$id= D('orderTmp')->add($data);
		$res['data']['oid'] = $id;
		echo json_encode($res);
            die();
	}
	public function confirmOrder(){
		$oid = I('get.oid','');
		$list = D('orderTmp')->getbasicInfo($oid);
		$goodsInfo =json_decode($list['goods_info']);
		var_dump($goodsInfo);
		die();
		$this->assign('list',$list);
		$this->display();
	}
}