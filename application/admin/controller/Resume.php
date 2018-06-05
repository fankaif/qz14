<?php
namespace app\admin\controller;
use app\admin\model\Resume as R;
use app\admin\model\Job as J;
use think\File;
use think\Controller;
class Resume extends Controller
{
	/*
	浏览新闻类别
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
        $m = new R();
        $list = $m->where($where)->order('create_time desc')->paginate(10,'',['query'=>$data]);
        $num = $m->where($where)->count();
        return view('index',['list'=>$list,'info'=>$info,'num'=>$num,'search'=>$data]);
	}

	/*
	加载添加页面
	 */
	public  function add($info='')
	{
		$am = new J();
		$list = $am->field('id,name,pid')->select();
		$pid = [];
		foreach ($list as $k=> $v) {

			$pid[] =$v['pid'];
		}
		$linfo = $am->where('id','not in',$pid)->select();
		return view('add',['list'=>$linfo,'info'=>$info]);
	}

	/*
	执行添加
	 */

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

   public function down($file){
	    	
			$fname =  $file;
			// 2.获取图片信息
			//3.设置头部信息
		
			// //4.执行下载
			header("Content-Disposition:attachment;filename=".$fname);//文件下载名字指定
			header("Content-Length:".filesize("/static/admin/uploads/resume/".$fname));//下载时是否显示文件大小
			readfile('/static/admin/uploads/resume/'.$fname);//读取服务器上的文件,并输出
		}
/*
删除
	 */
public function delete($id)
	{
		$r= new R("message");
		$a = $r->where('id='.$id)->select(); 
		$url=$_SERVER["DOCUMENT_ROOT"].'/static/admin/uploads/resume/'.$a[0]['file'];
		$mmm = unlink($url);
		$num = $r->where('id',$id)->delete();
		// echo $num;
		if ($num>0) {
		       $this->redirect('index',['info'=>'删除成功']);
		    }else{
		        $this->redirect('index',['info '=>'删除失败']);
		    }
	}


}