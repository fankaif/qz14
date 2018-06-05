<?php
namespace app\admin\model;
use think\Model;
class Banner extends Model
{
	public function getStatusAttr($value)
	{
		$status = ['1'=>'<span class="layui-btn layui-btn-normal layui-btn-mini">显示</span>','2'=>'<span class="layui-btn layui-btn-danger layui-btn-mini">不显示</span>'];
		return $status[$value];
	}
}