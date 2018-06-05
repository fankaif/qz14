<?php

namespace app\admin\controller;

use think\Request;
use app\admin\model\Users as M; 


class User extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($info='')
    {
        $data = [];
        $where= [];
        $b = input('get.username');
        if (!empty($b)) {
            $data['username']=input('get.username');
            $where['username'] =['like','%'.$data['username'].'%'] ;
        }
        //查询数据
        $m = new M();
        $list = $m->admin()->where($where)->order('create_time desc')->paginate(2,'',['query'=>$data]);
        $num = $m->admin()->where($where)->count();
        return view('index',['list'=>$list,'info'=>$info,'num'=>$num,'search'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add($info='')
    {
        return view('add',['info'=>$info]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = input('post.');
        $data['status']=1;
        $data['password'] = md5($data['password']);
        $data['avatar']='logo.png';
        $m = new M();
        $m->allowField(true)->save($data);
        if ($m->id>0) {
            $this->redirect('user/add',['info'=>'添加成功']);
        }else{
            $this->redirect('user/add',['info'=>'添加失败']);
        }
        
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id, $info='')
    {
        $m = new M();
        $list=$m->where('id',$id)->find();
        // echo "<pre>";
        // print_r($list);
        return view('edit',['list'=>$list,'info'=>$info]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $data = input('post.');
        $id = $data['id'];
        $data['password'] = md5($data['password']) ;
        $m = new M();
        $m->allowField(true)->save($_POST,['id'=>$id]);
        if ($m->id>0) {
            $this->redirect('user/add',['info'=>'修改成功']);
        }else{
            $this->redirect('user/add',['info'=>'修改失败']);
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
        $m = new M();
        $m = M::get($id);
        $m->delete();
        if ($m->id>0) {
            $this->redirect('index',['info'=>'删除成功']);
        }else{
            $this->redirect('index',['info'=>'删除失败']);
        }
    }

    public function member($info='')
    {
        $data = [];
        $where= [];
        $b = input('get.username');
        if (!empty($b)) {
            $data['username']=input('get.username');
            $where['username'] =['like','%'.$data['username'].'%'] ;
        }
        //查询数据
        $m = new M();
        $list = $m->where('role',3)->paginate(1,'',['query'=>$data]);
        $num = $m->where('role',3)->count();
        return view('member',['list'=>$list,'info'=>$info,'num'=>$num,'search'=>$data]);
    }
}
