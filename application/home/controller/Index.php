<?php
namespace app\home\controller;
use think\Db;
use think\Controller;
use app\home\model\Nav2 as M2;
use app\home\model\Nav as M;

class Index 
{
    public function index()
    {
    	$list = Db::name('banner')->where('status',1)->select();
    	$wel = Db::name('welcome')->where('id',1)->find();
    	$news = Db::name('artical')->where('tid',1)->select();
    	$news1 = Db::name('artical')->where('tid',2)->select();
    	$case = Db::name('case')->where('cid',2)->select();
    	
		
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         } 
    	


        return view('index',['list'=>$list,'news'=>$news,'wel'=>$wel,'news1'=>$news1,'case'=>$case,'nav'=>$nav]);
    }
    public function aboutus()
    {
    	return view('aboutus/aboutus');
    }
    public function fangan()
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
        


        return view('fangan/fangan',['case'=>$case,'nav'=>$nav]);
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
        $pro = Db::name('product')->select();
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         }
        return view('product/product',['nav'=>$nav,'pro'=>$pro]);
    
    }
    public function jingdiananli()
    {
        $case = Db::name('case')->where('cid',2)->select();
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         } 
        return view('anli/jingdiananli',['nav'=>$nav,'case'=>$case]);
    }


    public function about4()
    {
        
        $list1 = Db::name('aboutus')->where('id',14)->find();
        $list11 = Db::name('aboutus')->where('tid',2)->select();

        $list2 = Db::name('aboutus')->where('id',15)->find();
        $list22 = Db::name('aboutus')->where('tid',3)->select();

        $list3 = Db::name('aboutus')->where('id',16)->find();
        $list33 = Db::name('aboutus')->where('tid',4)->select();

        $list4 = Db::name('aboutus')->where('id',17)->find();
        $list44 = Db::name('aboutus')->where('tid',5)->select();

        $list5 = Db::name('aboutus')->where('id',18)->find();
        $list55 = Db::name('aboutus')->where('tid',6)->select();
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         } 
        return view('aboutus/about4',['nav'=>$nav,'list1'=>$list1,
                                                'list11'=>$list11,
                                                'list2'=>$list2,
                                                'list22'=>$list22,
                                                'list3'=>$list3,
                                                'list33'=>$list33,
                                                'list4'=>$list4,
                                                'list44'=>$list44,
                                                'list5'=>$list5,
                                                'list55'=>$list55
                                    ]);
    }


    public function about5()
    {
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         } 
        return view('aboutus/about5',['nav'=>$nav]);
    }
    
    
    public function fangan1()
    {
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         } 
        return view('fangan/fangan1',['nav'=>$nav]);
    }
    public function fangan2()
    {
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         } 
        return view('fangan/fangan2',['nav'=>$nav]);
    }
    
    public function pro2()
    {
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         } 
        return view('product/pro2',['nav'=>$nav]);
    }
    public function pro3()
    {
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         } 
        return view('product/pro3',['nav'=>$nav]);
    }
    public function contact1()
    {
        $n = new M();
        $sub = new M2();
        $nav = $n->where('path','0,')->select();
        // dump($nav); die();
        foreach ($nav as $k => $v) {
            $id = $v['id'];
            $nav[$k]['sub'] = $sub->where('pid',$id)->select();
         } 
        return view('contactus/contact1',['nav'=>$nav]);
    }
    public function create(){
        return 111;
    }
}
