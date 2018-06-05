<?php
namespace app\home\controller;
use think\Db;
use think\Controller;
use app\home\model\Nav2 as M2;
use app\home\model\Nav as M;
use app\home\model\Resume as R;


class Aboutus extends Controller
{
    public function index()
    {
        $aboutus = Db::name('aboutus')->where('tid',1)->select();
        $aboutus2 = Db::name('aboutus')->where('tid',7)->select();

        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
        return view('aboutus',['nav'=>$nav,'aboutus'=>$aboutus,'aboutus2'=>$aboutus2]);
    }


    public  function save()
    { 
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }

        $m = new R(input('post.'));
        $m->allowField(true)->save();
        if ($m->id>0) {
            $this->redirect('aboutus.html',['nav'=>$nav]);
        }else{

            $this->redirect('aboutus.html',['nav'=>$nav]);
        }
    }

    public function insert()
    {
        $info = $this->upload();
        if ($info['error']) {
            $data = input('post.');

            $data['file'] = $info['info'];
            $r = new R($data);
            $num = $r->allowField(true)->save();
            if ($num>0) {
                $this->redirect('add',['info'=>'成功']);
            }else{
                $this->redirect('add',['info'=>'失败']);
                
            }
        }else{
            return '文件上传失败'.$info['info'];
        }
    }




    public function upload() 
  { 
    //获取表单上传文件 
    $file = request()->file('file'); 

    if (empty($file)) { 
      $this->error('请选择上传文件'); 
    } 
    //移动到框架应用根目录/public/uploads/ 目录下 
    $info = $file->move(ROOT_PATH . 'public' . DS . '/static/admin/uploads/resume'); 
    if ($info) { 
        //获取文件后缀
            $ext = $info->getExtension();
            //获取路径加文件名
            $fpath = $info->getSaveName();
            //获取文件名
            $fname = $info->getFilename();
            session('file',$info->getFilename());
            return $info = ['info'=>$fname,'error'=>true];

    } else { 
      //上传失败获取错误信息 
      // $this->error($file->getError()); 
        return $info = ['info'=>$file->getError(),'error'=>false];;
    } 
  } 
    
}
