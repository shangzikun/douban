<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $goods = D('goods')->getList();
     	foreach ($goods as $key => $value) {
     		$arrTags = explode(',', $value['tag_id']);
     		$tags = '';
     		foreach ($arrTags as $k => $v) {
     			$tagInfo = D('Tag')->getBasicInfo($v);
     			$tags.=$tagInfo['name'].',';
     		}
     		$tags=rtrim($tags,',');
            $value['tag_id']=$tags;
            $goods[$key] = $value;
     	}
     	$ad = D('ad')->getList();
     	$this->assign('ad',$ad);
        $this->assign('goods',$goods);    
        $this->display();
    }
}