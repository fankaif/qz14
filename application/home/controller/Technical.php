<?php


namespace app\home\controller;
use think\Db;
use think\Controller;
use app\home\model\Nav2 as M2;
use app\home\model\Nav as M;

class Technical extends Controller
{
    public function index()
    {
    	$list = Db::name('banner')->where('status',1)->select();
    	$wel = Db::name('welcome')->where('id',1)->find();
    	$news = Db::name('artical')->where('tid',1)->select();
    	$news1 = Db::name('artical')->where('tid',2)->select();
    	$case = Db::name('case')->select();
    	$n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
        return view('technical',['list'=>$list,'news'=>$news,'wel'=>$wel,'news1'=>$news1,'case'=>$case,'nav'=>$nav]);
    }
    public function aboutus()
    {
    	return view('aboutus/aboutus');
    }
    public function fangan()
    {
    	return view('fangan/fangan');
    }
    public function technical()
    {
    	return view('technical/technical');
    }
    public function news()
    {
    	return view('news/news');
    }
    public function contactus()
    {
    	return view('contactus/contactus');
    }
    public function product()
    {
    	return view('product/product');
    }
}
