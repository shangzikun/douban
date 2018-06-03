<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	public function login() {
		$this->display();
	}
	public function doLogin() {
		$phone = I('post.phone','');
		$password = I('post.password','');
		if (empty($phone)||empty($password)) {
			$this->error('手机号或密码为空',U('Home/User/login'));
		}
		$data = D('User')->getInfoByPhone($phone);
		if (!$data) {
			$this->error('用户名不存在',U('Home/User/login'));
		}
		if ($password !== $data['password']) {
			$this->error('密码错误',U('Home/User/login'));
		}
		if ($data){
			unset($data['password']);
			$_SESSION['me'] =$data;
			$this->success('登陆成功',U('Home/index/index'));
		}
		
	}
	public function logout(){
		unset($_SESSION['me']);
		$this->success('注销成功',U('Home/index/index'));
	} 
	public function reg() {
		$this->display();

	}
	public function doReg() {
		$phone = I('post.phone','');
		$password = I('post.password','');
		$name = I('post.name','');
		if (empty($phone) || empty($password) || empty($name)) {
			$this->error('邮箱|手机号|昵称为空',U('Home/User/reg'));
		}
		$data = D('user')->getInfoByPhone($phone);
		if(isset($data)){
			$this->error('手机号已注册',U('Home/User/reg'));
		}
		$data = array(
			'phone'=>$phone,
			'password'=>$password,
			'name'=>$name,
		);
		$status = D('User')->add($data);
		if ($status) {
			$this->success('注册成功',U('Home/User/login'));
		}
	}
}
