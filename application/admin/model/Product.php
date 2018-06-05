<?php
namespace app\admin\model;
use think\Model;
class Product extends Model
{
	protected function getContentAttr($value)
	{
		//去除html标记
		return mb_substr(strip_tags($value),0,20,'utf-8').'...';
	}

	public function getStatusAttr($value)
	{
		$status = ['1'=>'<span class="layui-btn layui-btn-normal layui-btn-mini">使用</span>','2'=>'<span class="layui-btn layui-btn-danger layui-btn-mini">禁用</span>'];
		return $status[$value];
	}
}