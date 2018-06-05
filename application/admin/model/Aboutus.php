<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Aboutus extends Model
{	
	//自动写入时间戳
	protected $autoWriteTimestamp = true;
	//关闭自动添加修改时间
	protected $updateTime = false;

	protected function getTidAttr($value)
	{
		return DB::name('arttype')->field('name')->find($value)['name'];
	}
	
	public function getStatusAttr($value)
	{
		$status = ['1'=>'<span class="layui-btn layui-btn-normal layui-btn-mini">显示</span>','2'=>'<span class="layui-btn layui-btn-danger layui-btn-mini">不显示</span>'];
		return $status[$value];
	}
	//文章列表页截取关键字
	protected function getContentAttr($value)
	{
		//去除html标记
		return mb_substr(strip_tags($value),0,20,'utf-8').'...';
	}
}