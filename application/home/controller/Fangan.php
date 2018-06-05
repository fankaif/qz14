<?php


namespace app\home\controller;
use think\Db;
use think\Controller;
use app\home\model\Nav2 as M2;
use app\home\model\Nav as M;

class Fangan extends Controller
{
    public function index()
    {
    	
    	$case = Db::name('case')->where('cid',1)->select();
    	$n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
    	


        return view('fangan',['case'=>$case,'nav'=>$nav]);
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
