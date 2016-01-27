<?php
namespace Admin\Controller;
use Think\Controller;

class GroupController extends AdminController
{

	protected function init(){
        return array(
        'menu' => array(array(
                'name' => '组列表',
                'icon' => 'group',
                'url' => U('Group/group'),
                ),
        	),
        'add' => array(
                'name' => '添加组',
                'icon' => 'plus-square',
                'url' => U('Group/groupadd'),
        	),
         );
	}

	//管理员列表
	public function group(){

		$cateModel = M('role');
		$list  = $cateModel -> select();
		$meau=getAdminMeau();
		$this->assign('list',$list);
		$this->assign('init',$this->init());
		$this->assign('active','Sys');
		$this->assign('meau',$meau);
		$this->assign('info',"组列表");
		$this->assign('a','gg');
		$this->display('');
	}

	//添加管理员
	public function groupadd(){
		if(!IS_POST){
			$meau=getAdminMeau();
	        $this->assign('list',$list);
			$this->assign('init',$this->init());
            $this->assign('active','Sys');
            $this->assign('meau',$meau);
            $this->assign('info',"组列表");
            $this->assign('a','gg');
            $this->display('');
		}else{

			$date=$_POST;
			$re = M('role')->add($date);
			if($re){
				$this->success("组添加成功！",U('Group'));
			}else{
				$this->error("添加组出错");
			}
		}
	}

	//修改管理员
	function groupedit(){
		 $id = $_GET['id'];
		 $uModel = M('role');
		if(empty($id) | $id <= 0){
			$this->error('非法的操作',U('Group'));
		}
		
		if(!IS_POST){
			$date = $uModel->where('id=%d',$id)->find();
            $meau=getAdminMeau();
            $this->assign('date',$date);
            $this->assign('init',$this->init());
            $this->assign('active','Sys');
            $this->assign('meau',$meau);
            $this->assign('info',"节点列表");
            $this->assign('a','gg');
			$this->display('');
		}else{
			$id=$_GET['id'];
			$date = $_POST;
			$resule = $uModel->where('id=%d',$id)->save($_POST);
			if(false !== $resule){
			    $this->success('修改成功！正在跳转……',U('Group'));
			}else{
			  $this->error('修改失败~~~ 正在返回……');
			}
		}
	}

	function groupdel(){

		$id = I('post.data');
		$uModel = M('role');
		$name = $uModel->where('id=%d',$id)->getField('name');
		if($uModel->where('id=%d',$id)->delete()){
			//记录操作日志
			load("@.fun");
			$log['desc'] = "删除：".$name."--管理员";
			adminLog($log);

			$this->success('删除成功！正在跳转……');
		}else{
			$this->error('删除失败！正在返回……');
		}
	}

	//批量删除用户
	public function gdelAll(){
		  $ids = I('post.ids');
		  if(empty($ids)){
		 	$this->error('错误的参数，请检查操作是否正确！');
		  }else{
		 	$qModel=M('role');
			foreach ($ids as $id) {
				$qModel->where('id=%d',$id)->delete();
			}
		 $this->success('批量删除成功！正在返回……');
		}
	}

}
?>