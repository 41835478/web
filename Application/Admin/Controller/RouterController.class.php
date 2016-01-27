<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class RouterController extends AdminController
{

	protected function init(){
		return array(
			'menu' => array(
				array(
					'name' => '路由管理',
					'icon' => 'paste',
					'url' => U('Router/index'),
					),
				),
			'add' => array(
			'name' => '添加路由',
			'icon' => 'plus',
			'url' => U('add'),
			),
		);
	}
	
	function index(){

		$list=M('router')->select();
		$this->assign('list',$list);
		$this->assign('init',$this->init());
		$this->assign('active','Index');
		$this->assign('a','rt');
		$this->assign('info',"路由管理");
		$this->assign('desc',"管理静态路由规则");
		$this->display();

	}


	function add(){

		if(IS_POST){
		    $dates['title']=$_POST['title'];
		    $dates['sjurl']=$_POST['sjurl'];
		    $dates['lyurl']=$_POST['lyurl'];
		    $re=M('router')->add($dates);
		    if($re){
		    	//成功之后更新配置文件
		      $this->success('路由规则添加成功',U('index'));
		    }else{
		      $this->error('路由规则添加失败');
		    }
		}else{
			$this->assign('init',$this->init());
			$this->assign('active','Index');
			$this->assign('a','rt');
			$this->assign('info',"路由管理");
			$this->assign('desc',"管理静态路由规则");
			$this->display();
		}

	}


	function edit(){
		if(IS_POST){
			$id=$_POST['id'];
		    $dates['title']=$_POST['title'];
		    $dates['sjurl']=$_POST['sjurl'];
		    $dates['lyurl']=$_POST['lyurl'];
		    $re=M('router')->where('id='.$id)->save($dates);
		    if($re){
		      $this->success('路由规则修改成功',U('index'));
		    }else{
		      $this->error('路由规则修改失败');
		    }
		}else{
			$id=$_GET['id'];
		    $r=M('router')->where('id='.$id)->find();
			$this->assign('init',$this->init());
			$this->assign('r',$r);
			$this->assign('active','Index');
			$this->assign('a','rt');
			$this->assign('info',"路由管理");
			$this->assign('desc',"管理静态路由规则");
			$this->display();
		}
	}



}
