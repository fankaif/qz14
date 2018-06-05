<?php
namespace app\admin\controller;
use app\admin\model\Arttype as M;

class Arttype extends Base
{
	/*
	浏览新闻类别
	 */
	public function index()
	{
		$m = new M();
		$list = $m->order('concat(path,id)')->paginate(10);
		return view('index',['list'=>$list]);
	}

	/*
	加载添加页面
	 */
	public  function add($info='')
	{
		$m = new M();
		$list = $m->field('id,name')->select();
		return view('add',['list'=>$list,'info'=>$info]);
	}

	/*
	执行添加
	 */
	public  function save()
	{
		$m = new M(input('post.'));
		$m->allowField(true)->save();
		if ($m->id>0) {
            $this->redirect('add',['info'=>'添加成功']);
        }else{
            $this->redirect('add',['info'=>'添加失败']);
        }
	}
	/*
	跳转到修改页面
	*/
	public function edit($id,$info='')
	{
		$m = new M();
		$lone = $m->where('id',$id)->find();
		$list = $m->field('id,name')->select();
		return view('edit',['lone'=>$lone,'list'=>$list,'info'=>$info]);
	}
	/*
	执行修改
	*/
	public function update()
	{
		$data = input('post.');

		$id = $data['id'];
		$m = new M();
		$m->allowField(true)->save($_POST,['id'=>$id]);
		if ($m->id>0) {
			$this->redirect('index',['info'=>'添加成功']);
		}else{
			$this->redirect('index',['info'=>'添加失败']);
		}
	}
	/*
	执行删除
	*/
	public function delete($id)
	{
		$m = new M;
		$m = M::get($id);
		$m->delete();
		 if ($m->id>0) {
            $this->redirect('index',['info'=>'删除成功']);
        }else{
            $this->redirect('index',['info'=>'删除失败']);
        }
	}
}
