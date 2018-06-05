<?php

namespace app\home\model;

use think\Model;

class Users extends Model
{	
	//自动写入时间戳
	protected $autoWriteTimestamp = true;
	//关闭自动添加修改时间
	protected $updateTime = false;

	/*
	角色获取器<span class="layui-btn layui-btn-normal layui-btn-mini">
                        已启用
                    </span>
	 */
	public function getRoleAttr($value)
	{
		$status = ['1'=>'超级管理员','2'=>'普通管理员','3'=>'前台会员'];
		return $status[$value];
	}
	/*
	权限获取器<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
	 */
	public function getStatusAttr($value)
	{
		$status = ['1'=>'<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>','2'=>'<span class="layui-btn layui-btn-danger layui-btn-mini">已禁用</span>'
			,'3'=>'<span class="layui-btn layui-btn-danger layui-btn-mini">已禁用</span>'];
		return $status[$value];
	}
	/*
	最有一次登陆时间获取
	 */
	public function getLastlogtimeAttr($value)
	{
		return date('Y-m-d H:i:s',$value);
	}
	/*
	管理员
	 */
	public function scopeAdmin($query)
	{
		$query->where('status','in',[1,2]);
	}
	/*
	会员
	 */
	public function scopeMember($query)
	{
		$query->where('status',4);
	}
    /*
    登陆验证
     */
    public function verLogin($data)
    {
    	//验证码验证
    	if(!captcha_check($data['captcha'])){
		//验证失败
		return '验证码错误';
		};
    	//账号验证
    	$result = $this->where('username|phone',$data['username'])->find();
    	if (empty($result)) {
    		return '账号不存在';
    	}
    	//密码验证
    	if ($result['password']!==md5($data['password'])) {
    		return '密码错误';
    	}
    	//验证状态
    	if ($result['status']==3) {
    		return '此账号为普通会员，无法登陆后台';
    	}
    	if ($result['status']==4) {
    		return '此账号已被禁用';
    	}

    	//所有验证通过，执行登陆
    	session('userinfo',$result);
    	//修改登陆次数，登陆时间，登陆地址
    	$ndata['lognum'] = $result['lognum']+1;
    	$ndata['lastlogtime'] = time();
    	$ndata['lastlogaddr'] = ip2addr();
    	$this->save($ndata,['id'=>$result['id']]);
    	return '';
    }
}
