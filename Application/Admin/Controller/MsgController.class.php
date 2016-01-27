<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class MsgController extends AdminController
{
	

	function index(){
		
		$mModel = M('meau');
		$lists  = $mModel->where('cid=0')->select();
		foreach ($lists as $key => $value) {
			$lists[$key]['class']=$mModel->where('cid=%d',$lists[$key]['id'])->select();
		}
		$this->assign('lists',$lists);
		$this->assign('active','Index');
		$this->assign('init',$this->init());
		$this->assign('a','mu');
		$this->assign('info',"栏目管理");
		$this->display('index');
	}

}