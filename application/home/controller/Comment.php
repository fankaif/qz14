<?php
namespace app\home\controller;
use think\Db;

use app\home\model\Nav2 as M2;
use app\home\model\Nav as M;
use app\home\model\Comment as Mc;
class Comment 
{
	public  function save()
	{
	    $m = new Mc(input('post.'));
	    $m->allowField(true)->save();


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

	    return view('news/news',['nav'=>$nav,'news1'=>$news1,'num'=>$num,'news'=>$news]);
	}
}