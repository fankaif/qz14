<?php


namespace app\home\controller;
use think\Db;
use think\Controller;
use app\home\model\Nav2 as M2;
use app\home\model\Nav as M;

class Product extends Controller
{
    public function index()
    {
    	$pro = Db::name('product')->select();
    	$n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
        return view('product',['nav'=>$nav,'pro'=>$pro]);
    }
    public function pro1()
    {
        $pro = Db::name('product')->select();
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
    	return view('product/pro1',['pro'=>$pro,'nav'=>$nav]);
    }
    public function pro2()
    {
        $pro = Db::name('product')->select();
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
    	return view('product/pro2',['pro'=>$pro,'nav'=>$nav]);
    }
    public function pro3()
    {
        $pro = Db::name('product')->select();
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
    	return view('product/pro3',['pro'=>$pro,'nav'=>$nav]);
    }
   
}
