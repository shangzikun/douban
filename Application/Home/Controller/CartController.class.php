<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends Controller {
	public function cartList() {
		if (empty($_SESSION['me']['id'])) {
			$this->error('请先登录',U('Home/User/login'));
		}
		$list = D('Cart')->getList();
		$this->assign('list',$list);
		$this->display();
	}
	public function addCart() {
        $res = array(
            'error_no' => 0,
            'msg'      => 'OK',
            'data'     => array(),
            );
        $goodsId = I('post.goods_id');
        $num = I('post.num');
        if (empty($goodsId) || empty($num)) {
            $res['error_no'] = 1;
            $res['msg'] = "参数错误";
            echo json_encode($res);
            die();
        }
        //判断购物车是否已经有相同商品，有就改数目
        $goodsInfo = D('Goods')->getBasicInfo($goodsId);
    	$where = array(
	   		'goods_id'=>$goodsId,
	   		'user_id' =>$_SESSION['me']['id']);
       	$cartInfo =D('Cart')->getList($where);
       	if(!empty($cartInfo)){
	       	$data =array(
	       		'num'=>$cartInfo['0']['num']+$num,
	       	);
	    $status = D('Cart')->where(array('id'=>$cartInfo['0']['id']))->save($data); 
	    echo json_encode($res);
        die();      	
       	} else {
       		$data = array(
       		'goods_id' 		=>$goodsId,
       		'goods_name'	=>$goodsInfo['title'],
       		'goods_price' 	=>$goodsInfo['price'],
       		'goods_img' 	=>$goodsInfo['image'],
       		'user_id'		=>$_SESSION['me']['id'],
       		'user_name'		=>$_SESSION['me']['name'],
       		'num'			=>$num
       	);	
       	$status = D('Cart')->add($data);      	
       	echo json_encode($res);
        die();      
       	}      	
    }
  public function delete() {
    $id = I('get.id','');
    $status = D('Cart')->where(array('id'=>$id))->delete();
    if ($status) {
      $this->success('删除成功',U('Home/Cart/cartList'));
    }
  }
}