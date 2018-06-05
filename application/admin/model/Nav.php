<?php
namespace app\admin\model;
use think\Model;

class Nav extends Model
{
	//自动添加
	protected $insert = ['path'=>'0,'];
	public function getPidAttr($value)
	{
		$list = $this->field('name')->find($value);

		return $list['name']?$list['name']:'顶级类别';
	}

	public function setPathAttr($value)
	{
		$pid = input('post.pid');
		if ($pid==0) {
			return '0,';
		}
		$list = $this->field('path,id')->find($pid);
		return $list['path'].$list['id'].',';
	}
}