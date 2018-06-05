<?php
namespace app\admin\controller;
use app\admin\model\Aboutus as M;
use app\admin\model\Arttype as aM;
class Aboutus extends Base
{
	/*
	浏览新闻类别
	 */
	public function index($info='')
	{ 
		$data = [];
        $where= [];
        if (!empty(input('get.name'))) {
            $data['name']=input('get.name');
            $where['name'] =['like','%'.$data['name'].'%'] ;
        }
        //查询数据
        $m = new M();
        $list = $m->where($where)->order('create_time desc')->paginate(10,'',['query'=>$data]);
        $num = $m->where($where)->count();
        return view('index',['list'=>$list,'info'=>$info,'num'=>$num,'search'=>$data]);
	}

	/*
	加载添加页面
	 */
	public  function add($info='')
	{

		$am = new aM();
		$list = $am->field('id,name,pid')->select();
		$pid = [];
		foreach ($list as $k=> $v) {

			$pid[] =$v['pid'];
		}
		$linfo = $am->where('id','not in',$pid)->select();
		return view('add',['list'=>$linfo,'info'=>$info]);
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
	查看文章详情
	 */
	public function show($id)
	{	
		$m = new M();
		$list = $m->find($id);
		return view('show',['list'=>$list]);
	}
	/*
	加载修改页面
	 */
	 public function edit($id,$info='')
	{
		$m = new M();
		$lone = $m->where('id',$id)->find();
		$am = new aM();
		$list = $am->field('id,name')->select();
		return view('edit',['lone'=>$lone,'list'=>$list,'info'=>$info]);
	}
    /**
     * 保存更新的资源
     *
    
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
           	    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
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
	                    $this->redirect('aboutus/index',['info'=>"禁用成功"]);
	                    break; 
	                case '2':
	                    $data = ['status'=>1];
	                    $m->allowField(true)->save($data,['id' =>$id]);
	                    $this->redirect('aboutus/index',['info'=>"显示成功"]);                
	                break;
	            }
	     }
}
