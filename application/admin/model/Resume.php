<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Resume extends Model
{
	protected function getTidAttr($value)
	{
		return DB::name('job')->field('name')->find($value)['name'];
	}

	public function getStatusAttr($value)
	{
		$data = ['1'=>'<span class="layui-btn layui-btn-normal layui-btn-mini">已录用</span>','0'=>'<span class="layui-btn layui-btn-danger layui-btn-mini">未录用</span>'];
		return $data[$value];
	}
}