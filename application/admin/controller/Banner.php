<?php
namespace app\admin\controller;
use app\admin\model\Banner as B;

class Banner extends Base
{
	/*
	浏览banner列表
	 */
	public function index()
	{
		$where= [];
        if (!empty(input('get.name'))) {
            $data['name']=input('get.name');
            $where['name'] =['like','%'.$data['name'].'%'] ;
        }
		$b = new B();
		$list = $b->order('id desc')->paginate(10);
		$num = $b->where($where)->count();

		return view('index',['list'=>$list,'num'=>$num]);
	}


	/*
	加载添加页面
	 */
	public  function add($info='')
	{
		return view('add',['info'=>$info]);
	}

	/*
	执行添加
	 */
	public  function save()
	{
		
		$b = new B(input('post.'));
		$b->allowField(true)->save();
		if ($b->id>0) {
            $this->redirect('add',['info'=>'添加成功']);
        }else{

            $this->redirect('add',['info'=>'添加失败']);
        }
	}

	/*
	执行删除
	*/
	public function delete($id)
	{
		$b = new B;
		$b = B::get($id);
		$b->delete();
		 if ($b->id>0) {
            $this->redirect('index',['info'=>'删除成功']);
        }else{
            $this->redirect('index',['info'=>'删除失败']);
        }
	}
	/*
	跳转修改页面
	*/
	public function edit($id,$info='')
	{
		$m = new B();
		$list = $m->where('id',$id)->find();
		
		return view('edit',['list'=>$list,'info'=>$info]);
	}
	/*
	执行修改
	*/
	public function update($info='')
	{
		$data = input('post.');
		

		$id = $data['id'];
		$m = new B();
		$m->allowField(true)->save($_POST,['id'=>$id]);
		if ($m->id>0) {
			$this->redirect('banner/index',['info'=>'添加成功']);
		}else{
			$this->redirect('index',['info'=>'添加失败']);
		}
	}

	/*
	修改状态
	 */
	public function upStatus()
    {
        $id = input('get.id');
        $m = new B();
        $status = $m->field('id,status')->find($id)->getData();
        $list = $m->where('id',$id)->find();
            switch ($status['status']) {
                case '1':
                    $data = ['status'=>2];
                    $m->allowField(true)->save($data,['id' =>$id]);
                    $this->redirect('banner/index',['info'=>"禁用成功"]);
                    break; 
                case '2':
                    $data = ['status'=>1];
                    $m->allowField(true)->save($data,['id' =>$id]);
                    $this->redirect('banner/index',['info'=>"显示成功"]);                
                break;
            }
    }
}