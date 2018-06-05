<?php
namespace app\home\controller;
use think\Db;
use think\Controller;
use app\home\model\Nav2 as M2;
use app\home\model\Nav as M;

class Contactus extends Controller
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


        return view('contactus',['list'=>$list,'news'=>$news,'wel'=>$wel,'news1'=>$news1,'case'=>$case,'nav'=>$nav]);
    }
    
}
