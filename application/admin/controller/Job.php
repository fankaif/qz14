<?php
namespace app\admin\controller;
// use app\admin\model\Artical as M;
use app\admin\model\Job as M;
use app\admin\model\Arttype as aM;

class Job extends Base
{
	/*
	查看评论
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
             public function add($info='')
            {
                $j = new M();
                $list = $j->field('id,name')->select();
                return view('add',['list'=>$list,'info'=>$info]);
            }
              /*
    执行添加
     */
    
    public function save()
    {
        $j = new M(input('post.'));
        $j->allowField(true)->save();
        if ($j->id>0) {
            $this->redirect('add',['info'=>'添加成功']);
        }else{
            $this->redirect('add',['info'=>'添加失败']);
        }
    }
	/*
	删除
	 */
    public function delete($id)
    {
        $User = new M();
        $num = $User->where('id',$id)->delete();
        // echo $num;

        if ($num>0) {
               $this->redirect('job/index',['info'=>'删除成功']);
            }else{
                $this->redirect('job/index',['info '=>'删除失败']);
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
                $this->redirect('job/index',['info'=>"待审核"]);
                break; 
            case '2':
                $data = ['status'=>1];
                $m->allowField(true)->save($data,['id' =>$id]);
                $this->redirect('job/index',['info'=>"已审核"]);                
            break;
        }
    }


}