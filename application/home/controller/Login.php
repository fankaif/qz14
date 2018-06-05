<?php
namespace app\home\controller;
use think\Db;
use think\Controller;
use app\home\model\Nav2 as M2;

use app\home\model\Users as M;


class Login extends Controller
{
    public function index()
    {
        
        return view('login');
    }
    public function register()
    {
        
        return view('register');
    }
    

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
		$this->redirect('login/index',['info'=>'成功退出']);
	}


	/*
	用户注册
	 */
	
	public function save()
    {
        $data = input('post.');
        $data['status']=1;
        $data['password'] = md5($data['password']);
        $data['avatar']='logo.png';
        $data['role']=3;
        $m = new M();
        $m->allowField(true)->save($data);
        if ($m->id>0) {
            $this->redirect('login/login',['info'=>'添加成功']);
        }else{
            $this->redirect('login/register',['info'=>'添加失败']);
        }
        
    }
}
