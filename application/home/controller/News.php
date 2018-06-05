<?php
namespace app\home\controller;
use think\Db;
use think\Controller;
use app\home\model\Nav2 as M2;
use app\home\model\Nav as M;
use app\home\model\Comment as Mc;

class News extends Controller
{
    public function index()
    {
        $news = Db::name('artical')->where('tid',0)->paginate(8);
    	$num = Db::name('artical')->where('tid',0)->count();
        $news1 = Db::name('artical')->where('id',7)->find();
    	$n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
        return view('news',['news'=>$news,'nav'=>$nav,'news1'=>$news1,'num'=>$num]);
    }
    public function news1()
    {
        $about = Db::name('artical')->where('create_time',20151010)->select();
        
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
    	return view('news/news1',['nav'=>$nav,'about'=>$about]);
    }
    public function news2()
    {
        $about = Db::name('artical')->where('create_time',20151010)->select();
        
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
    	return view('news/news2',['nav'=>$nav,'about'=>$about]);
    }
    public function news3()
    {
        $about = Db::name('artical')->where('create_time',20151010)->select();
        
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
    	return view('news/news3',['nav'=>$nav,'about'=>$about]);
    }
    public function news4()
    {
        $about = Db::name('artical')->where('create_time',20151010)->select();
        
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
    	return view('news/news4',['nav'=>$nav,'about'=>$about]);
    }
    public function news5()
    {
        $about = Db::name('artical')->where('create_time',20151010)->select();
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
    	return view('news/news5',['nav'=>$nav,'about'=>$about]);
    }
    
    
}
