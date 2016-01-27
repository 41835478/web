<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class UserController extends AdminController{

	protected function init(){
        return array(
        'menu' => array(
	        		array(
	                'name' => '用户列表',
	                'icon' => 'list',
	                'url' => U('User/index'),
	                ),
                ),
        'add' => array(
                'name' => '添加用户',
                'icon' => 'plus',
                'url' => U('User/add'),
                ),
         );
	}

	function index()
	{
        $list=M('User')->select();
        $this->assign('list',$list);
        $this->assign('init',$this->init());
        $this->assign('active','User');
        $this->assign('info',"用户列表");
        $this->assign('a','user');
        $this->display('User/index');
	}

	//添加管理员
	public function add(){
		if(IS_POST){

			$date=$_POST;
			$date['admin_pwd']=md5($_POST['admin_pwd']);
			$date['admin_addtime']=time();
			$date['admin_logintime']=time();
			$re = M('User')->add($date);
			if($re){
				$this->success("用户添加成功！",U('index'));
			}else{
				$this->error("添加用户出错");
			}

		}else{

             $this->assign('init',$this->init());
             $this->assign('active','User');
             $this->assign('info',"用户列表");
             $this->assign('a','add');
             $this->display('add');
		}
	}

	//修改管理员
	function edit(){
		
		$uModel = M('User');
		if(IS_POST){

			$u_id=$_POST['admin_id'];
			$pwd = $uModel->where('admin_id=%d',$u_id)->getField('admin_pwd');
			if($pwd!=$_POST['admin_pwd']){
			 	$_POST['admin_pwd'] = md5($_POST['admin_pwd']);
			}

			$resule = $uModel->where('admin_id=%d',$u_id)->save($_POST);
			if(false !== $resule){
				$this->success('修改成功！正在跳转……',U('index'));
			}else{
			  $this->error('修改失败~~~ 正在返回……');
			}

		}else{

			$u_id = $_GET['admin_id'];
			if(empty($u_id) | $u_id <= 0){
				$this->error('非法的操作',U('index'));
			}

			$r = $uModel->where('admin_id=%d',$u_id)->find();
            $this->assign('r',$r);
            $this->assign('init',$this->init());
            $this->assign('active','User');
            $this->assign('info',"用户列表");
            $this->assign('a','user');
			$this->display('edit');
		}
	}

	/**
	* 删除
	*/
	public function del(){
	  $tagId = I('post.data',0,'intval');
	  if(empty($tagId)){
	      $this->error('参数不能为空！');
	  }
	  if(M('User')->where('id='.$tagId)->delete()){
	      $this->success('用户删除成功！',U('index'));
	  }else{
	      $this->error('用户删除失败！');
	  }
	}

	/**
	* 批量操作
	*/
	public function batchAction(){
	  $ids = I('post.ids');
	  if(empty($ids)){
	      $this->error('请先选择要删除的用户！');
	  }
	  foreach ($ids as $id) {
	    //删除
	    M('User')->where('id='.$id)->delete();
	  }
	  $this->success('批量操作执行完毕！');
	}


	public function bingli(){

		$model=M('bingli');

	    $count = $model->where('status=1')->count();// 查询满足要求的总记录数
	    $Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	    $show  = $Page->show();// 分页显示输出
	    $bl  = $model->where('status=1')->limit($Page->firstRow.','.$Page->listRows)->select();

	    $this->assign('bl',$bl);
	    $this->assign('page',$show);
	    $this->assign('active','User');
		$this->assign('a','bl');
		$this->assign('info',"病例列表");
		$this->display();

	}
		/**
	* 删除
	*/
	public function bldel(){
	  $tagId = I('post.data',0,'intval');
	  if(empty($tagId)){
	      $this->error('参数不能为空！');
	  }
	  if(M('bingli')->where('id='.$tagId)->delete()){
	      $this->success('用户删除成功！',U('bingli'));
	  }else{
	      $this->error('用户删除失败！');
	  }
	}

	/**
	* 批量操作
	*/
	public function batchbl(){
	  $ids = I('post.ids');
	  if(empty($ids)){
	      $this->error('请先选择要删除的用户！');
	  }
	  foreach ($ids as $id) {
	    //删除
	    M('bingli')->where('id='.$id)->delete();
	  }
	  $this->success('批量操作执行完毕！');
	}


	public function xinxi(){

		$model=M('patient');

	    $count = $model->count();// 查询满足要求的总记录数
	    $Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	    $show  = $Page->show();// 分页显示输出
	    $bl  = $model->limit($Page->firstRow.','.$Page->listRows)->select();

	    $this->assign('bl',$bl);
	    $this->assign('page',$show);
	    $this->assign('active','User');
		$this->assign('a','xx');
		$this->assign('info',"病例列表");
		$this->display();

	}
		/**
	* 删除
	*/
	public function xxdel(){
	  $tagId = I('post.data',0,'intval');
	  if(empty($tagId)){
	      $this->error('参数不能为空！');
	  }
	  if(M('patient')->where('id='.$tagId)->delete()){
	      $this->success('用户删除成功！',U('xinxi'));
	  }else{
	      $this->error('用户删除失败！');
	  }
	}

	/**
	* 批量操作
	*/
	public function batchxx(){
	  $ids = I('post.ids');
	  if(empty($ids)){
	      $this->error('请先选择要删除的用户！');
	  }
	  foreach ($ids as $id) {
	    //删除
	    M('patient')->where('id='.$id)->delete();
	  }
	  $this->success('批量操作执行完毕！');
	}

}