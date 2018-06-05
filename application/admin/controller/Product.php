<?php
namespace app\admin\controller;
use app\admin\model\Product as M;
class Product extends Base
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
		$b = new M();
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
		
		$b = new M(input('post.'));
		$b->allowField(true)->save();
		if ($b->id>0) {
            $this->redirect('add',['info'=>'添加成功']);
        }else{

            $this->redirect('add',['info'=>'添加失败']);
        }
	}


	/*
	查看文件详情
	 */
	public function show($id)
	{	
		$m = new M();
		$list = $m->find($id);
		return view('show',['list'=>$list]);
	}

	/*
	执行删除
	*/
	public function delete($id)
	{
		$b = new M;
		$b = M::get($id);
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
		$m = new M();
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
		$m = new M();
		$m->allowField(true)->save($_POST,['id'=>$id]);
		if ($m->id>0) {
			$this->redirect('index',['info'=>'添加成功']);
		}else{
			$this->redirect('index',['info'=>'添加失败']);
		}
	}


	public function upStatus()
        {
            $id = input('get.id');
            $m = new M();
            $status = $m->field('id,status')->find($id)->getData();
            $list = $m->where('id',$id)->find();
                switch ($status['status']) {
                    case '1':
                        $data = ['status'=>2];
                        $m->allowField(true)->save($data,['id' =>$id]);
                        $this->redirect('product/index',['info'=>"禁用"]);
                        break; 
                    case '2':
                        $data = ['status'=>1];
                        $m->allowField(true)->save($data,['id' =>$id]);
                        $this->redirect('product/index',['info'=>"使用"]);                
                    break;
                }
         }
}