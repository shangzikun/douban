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

		$address = D('Address')->where(array('user_id'=>$_SESSION['me']['id']))->select();
		$pay_type = array(
			array("id"=>1,'name'=>'余额支付'),
			array("id"=>2,'name'=>'微信支付'),
			array("id"=>3,'name'=>'支付宝支付'),
		);
		$this->assign('pay_type',$pay_type);
		$this->assign('address',$address);
		$this->assign('orderInfo',$orderInfo);
		$this->display();
	}
	public function createOrder() {
		$oid = I('post.oid');
		$aid = I('post.aid');
		$pid = I('post.pid');
		$uid = $_SESSION['me']['id'];
		$res = array(
			'error_no'  => 0,
			'msg'		=> '',
			'data'		=> array()
			);
		if (empty($oid) || empty($pid) || empty($aid) || empty($uid) ) {
			$res['error_no'] = 1;
			$res['msg'] = "参数错误";
			echo json_encodo($res);
			die();
		}
		//遍历商品详细信息
 		$list = D('orderTmp')->getbasicInfo($oid);
		$orderInfo =json_decode($list['goods_info'],true);	
		//遍历商品  计算订单价格
		$money = 0;
		foreach ($orderInfo as $key => $value) {
			$goodsInfo = D('goods')->getBasicInfo($orderInfo[$key]['goods_id']);
			$goodsInfo['orderMoney'] = $value['goods_num'] * $goodsInfo['price'];
			$orderInfo[$key] = array_merge($orderInfo[$key],$goodsInfo);
			$money +=$goodsInfo['orderMoney'];
		}
		$orderData = array(
			'user_id'=>$uid,
			'money' =>$money,
			'address_id'=>$aid,
			'pay_type'=>$pid,
			'createtime'=>date('Y-m-d H:i:s'),
		);
		//插入订单表
		$orderId = D('order')->add($orderData);
		if($orderData) {
			foreach ($orderInfo as $key => $value) {
				//插入订单商品表
				$goodsData = array(
					'order_id' =>$orderId,
					'goods_id' =>$value['goods_id'],
					'goods_price' =>$value['price'],
					'goods_num' 	=> $value['goods_num'],
					'order_money' 	=> $value['orderMoney'],
					'createtime' 	=> date('Y-m-d H:i:s'),
				);
				$status = D('OrderGoods')->add($goodsData);
			}
			//事务，同时成功或失败
			$db = M();
			$db->startTrans();
			$accountStatus = D('user')->handleAccount($uid,$money,2);
			$orderStatus = D('order')->where(array('id'=>$orderId))->save(array('pay_status'=>1,'status'=>1));
			if ($accountStatus && $orderStatus) {
				$db->commit();  
			} else {
				$db->rollback();  
			}
		} else {
			$res['error_no'] = 2;
			$res['msg'] = "下单失败";
			echo json_encode($res);
			die();
		}
		$res['data']['id'] = $orderId;
		echo json_encode($res);
		die();
	}
}