<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Users as M;
/**
 * 登陆控制器
 * 登陆
 * 注册
 * 退出
 * 继承Controller基类控制器
 */

class Login extends Controller
{
	/*
	加载登陆页面
	 */
	public function login($info='')
	{
		return view('login',['info'=>$info]);
	}

	/*
	执行登陆
	 */
	public function doLogin()
	{
		$data = input('post.');//接收数据
		$m = new M();//实例化模型Users
		//登陆验证,返回错误信息
		$info = $m->verLogin($data);
		if ($info) {
			$this->redirect('login',['info'=>$info]);
		}else{
			$this->redirect('index/index',['info'=>'登陆成功']);
		}
	}

	/*
	执行退出
	 */
	public function logout()
	{
		session('userinfo',null);
		$this->redirect('login',['info'=>'成功退出']);
	}
}