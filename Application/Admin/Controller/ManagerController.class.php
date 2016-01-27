<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class ManagerController extends AdminController
{
	
	protected function init(){
        return array(
        'menu' => array(
        			array(
                		'name' => '管理员列表',
                		'icon' => 'list',
                		'url' => U('Manager/index'),
                	),
                ),
        'add' => array(
                'name' => '添加管理员',
                'icon' => 'plus',
                'url' => U('Manager/add'),
                ),
         );
	}

	//管理员列表
	public function index(){ 

        $list=M('admin')->select();
        $this->assign('list',$list);
        $this->assign('init',$this->init());
        $this->assign('active','Sys');
        $this->assign('info',"管理员列表");
        $this->assign('a','mi');
        $this->display('Manager/index');
	}

	//添加管理员
	public function add(){
		if(IS_POST){

			$date=$_POST;
			$date['admin_pwd']=md5($_POST['admin_pwd']);
			$date['admin_addtime']=time();
			$date['admin_logintime']=time();
			$re = M('admin')->add($date);
			if($re){
				$this->success("用户添加成功！",U('index'));
			}else{
				$this->error("添加用户出错");
			}

		}else{

             $this->assign('init',$this->init());
             $this->assign('active','Sys');
             $this->assign('info',"管理员列表");
             $this->assign('a','mi');
             $this->display('add');
		}
	}
 
	//修改管理员
	function edit(){
		
		$uModel = M('admin');
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
            $this->assign('active','Sys');
            $this->assign('info',"管理员列表");
            $this->assign('a','mi');
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
	  if(M('admin')->where('admin_id='.$tagId)->delete()){
	      $this->success('管理员删除成功！',U('index'));
	  }else{
	      $this->error('管理员删除失败！');
	  }
	}

	/**
	* 批量操作
	*/
	public function batchAction(){
	  
	  $ids = I('post.ids');

	  if(empty($ids)){
	      $this->error('请先选择操作项目！');
	  }

	  foreach ($ids as $id) {
	    //删除
	    M('admin')->where('admin_id='.$id)->delete();

	  }

	  $this->success('批量操作执行完毕！');
	}

}
