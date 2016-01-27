<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class AdminController extends Controller
{
	
	protected function _initialize(){

        //登录检测
        if(!admin_login()){ //还没登录跳转到登录页面
            $this->redirect('Admin/Public/login');
        }

		//获取系统菜单导航	
		$meau=getAdminMeau();
		$this->assign('self',__SELF__);
		$this->assign('meau',$meau);
		$this->assign('__ADMIN__', session('admin_auth')); //用户登录信息

	}

	
}