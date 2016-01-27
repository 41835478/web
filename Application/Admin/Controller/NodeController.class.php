<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class NodeController extends AdminController
{
	protected function init(){
        return array(
        'menu' => array(
        			array(
                		'name' => '节点列表',
                		'icon' => 'list',
                		'url' => U('Node/index'),
                	),
                	array(
                		'name' => '添加节点',
                		'icon' => 'plus',
                		'url' => U('Node/addNode'),
                	),
        	    ),
        'add' => array(),
         );
	}
	
	function qx(){	
		if(!IS_POST){

			$rid = $_GET['id'];

			$access = M('access')->where(array('role_id' => $rid))->getField('node_id' ,true);
			if (!$access) {
				$access = array();
			}
			$where = array('status' => 1);
			$node = M('node')->where($where)->order('sort')->select();
			$node = node2layer($node, $access);
			//
			$meau=getAdminMeau();
			$this->assign('node',$node);
	        $this->assign('init',$this->init());
	        $this->assign('active','Sys');
	        $this->assign('rid',$rid);
	        $this->assign('meau',$meau);
	        $this->assign('info',"权限编辑");
	        $this->assign('a','gg');
			$this->display();
		}else{
			$rid = $_GET['id'];
			$access =array();

			//组合权限
			foreach (I('access', array()) as $v) {
				$tmp = explode('_', $v);
				$access[]= array('role_id' => $rid, 'node_id' => $tmp[0], 'level' => $tmp[1]);
			}

			//清空原权限
			M('access')->where(array('role_id'=>$rid))->delete();
			if (empty($access)) {
				$this->success('配置成功', U('Group/group'));
			}

			//插入新权限
			//mysql,支持addAll
			$ret = 0;
			if (in_array(strtolower(C('DB_TYPE')), array('mysql','mysqli','mongo'))) {
				$ret = M('access')->addAll($access);
			} else {
				foreach ($access as $v) {
					$ret = M('access')->add($access);
				}
			}

			if($ret){
				$this->success('添加成功', U('Group/group'));
			} else {
				$this->error('添加失败');
			}
		}
	}

	//节点列表
	public function index(){
		$node = M('node')->order('sort')->select();
		$node = node2layer($node);
		$this->assign('node', $node);
        $this->assign('init',$this->init());
        $this->assign('active','Sys');
        $this->assign('info',"节点列表");
        $this->assign('a','jd');
        $this->display('Node/index');
	}

	//添加管理员
	public function addNode(){
		if(!IS_POST){
            $meau=getAdminMeau();
            $this->assign('init',$this->init());
            $this->assign('active','Sys');
            $this->assign('meau',$meau);
            $this->assign('info',"节点列表");
            $this->assign('a','jd');
            $this->display('Node/add');
		}else{
			$pid = $_GET['pid'];
			$level = $_GET['level'];
			if(empty($pid)){
				$pid=0;
			}else{
				$pid=$pid;
			}
			$date=$_POST;
			$date['pid']=$pid;
			$date['level']=$level;
			$re = M('node')->add($date);
			if($re){
				$this->success("节点添加成功！",U('index'));
			}else{
				$this->error("添加节点出错");
			}
		}
	}

	//修改管理员
	function editNode(){
		 $id = $_GET['id'];
		 $uModel = M('node');
		if(empty($id) | $id <= 0){
			$this->error('非法的操作',U('index'));
		}
		
		if(!IS_POST){
			$date = $uModel->where('id=%d',$id)->find();
            $meau=getAdminMeau();
            $this->assign('date',$date);
            $this->assign('init',$this->init());
            $this->assign('active','Sys');
            $this->assign('meau',$meau);
            $this->assign('info',"节点列表");
            $this->assign('a','jd');
			$this->display('Node/edit');
		}else{
			$id=$_GET['id'];
			$date = $_POST;
			$resule = $uModel->where('id=%d',$id)->save($_POST);
			if(false !== $resule){
			    //记录操作日志
			    $this->success('修改成功！正在跳转……',U('index'));
			}else{
			  $this->error('修改失败~~~ 正在返回……');
			}
		}
	}

	function delNode(){

		$u_id = I('post.data');
		$uModel = M('node');
		if($uModel->where('id=%d',$u_id)->delete()){
			$this->success('删除成功！正在跳转……');
		}else{
		$this->error('删除失败！正在返回……');
		}
	}

}
