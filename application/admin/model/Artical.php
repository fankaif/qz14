<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Artical extends Model
{
	//自动写入时间戳
	protected $autoWriteTimestamp = true;
	//关闭自动添加修改时间
	protected $updateTime = false;
	
	protected function _getTidAttr($value)
	{
		return DB::name('arttype')->field('name')->find($value)['name'];
	}

	//文章列表页截取关键字
	protected function getContentAttr($value)
	{
		//去除html标记
		return mb_substr(strip_tags($value),0,20,'utf-8').'...';
	}
}