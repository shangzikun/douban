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
		$goodsNum = I('post.num','');
		$cart = I('post.cart','');
		$goodsInfo = array();		
		if(!empty($cart)){//购物车入口
			$is_cart = 1;
			if(!is_array($cart)){//前段传来json字符串时，强制转换
				$cart = json_decode($cart,true);
			}
			foreach ($cart as $key => $value) {
				$cartInfo = D('cart')->getBasicInfo($value);
				$tmp = array('goods_id' =>$cartInfo['goods_id'],'goods_num'=>$cartInfo['num'],);
				$goodsInfo[]=$tmp;
			}
		} else {//详情页入口
			$is_cart = 0;
			$goodsInfo[] = array('goods_id' =>$goodsId,'goods_num'=>$goodsNum,);
		}
		$userId = $_SESSION['me']['id'];
		$goodsInfo = json_encode($goodsInfo);
		$data =array(
			'user_id'=>$userId,
			'goods_info'=>$goodsInfo,);

		$id= D('orderTmp')->add($data);
		if($is_cart == 1) {
			foreach ($cart as $key => $value) {
				$resTmp = D('cart')->where(array('id'=>$value))->delete();				
			}
		}
		$res['data']['oid'] = $id;
		echo json_encode($res);
            die();
	}
	public function confirmOrder(){
		//获取临时订单id
		$oid = I('get.oid','');
		$list = D('orderTmp')->getbasicInfo($oid);
		$orderInfo =json_decode($list['goods_info'],true);
		//遍历商品详细信息
		foreach ($orderInfo as $key => $value) {
			$goodsInfo = D('Goods')->getbasicInfo($orderInfo[$key]['goods_id']);
			$orderInfo[$key] = array_merge($orderInfo[$key],$goodsInfo);
		}
		$this->assign('orderInfo',$orderInfo);
		$this->display();
	}
}