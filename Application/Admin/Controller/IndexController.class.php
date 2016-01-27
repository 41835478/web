<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends AdminController{


	protected function init(){
       	return array(
             'menu' => array(),
             'add' => array(),
            );
	}

    public function index(){

        $bot=M('spider')->order('id desc')->limit(8)->select();

    	$this->assign('bot',$bot);
        $this->assign('chartArray',D('Visitor')->getJson(7,'day','m-d'));
        $this->assign('active','Index');
    	$this->assign('init',$this->init());
		$this->assign('a','tj');
    	$this->display('');

    }

}