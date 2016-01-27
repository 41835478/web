<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class DoctorController extends AdminController
{

	protected function init(){
        return array(
        'menu' => array(
        			array(
                		'name' => '医生库列表',
                		'icon' => 'list',
                		'url' => U('Doctor/index'),
                	),
                ),
        'add' => array(
                'name' => '添加医生',
                'icon' => 'plus',
                'url' => U('Doctor/add'),
                ),
         );
	} 
	
	public function index(){
		
	    $model=M('doctor');
        $keyword = I('keyword', '', 'string');
        $map['name_cn'] = array('like','%'.$keyword.'%');

        $count = $model->where($map)->count();// 查询满足要求的总记录数
	    $Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)

        foreach($map as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }

	    $show  = $Page->show();// 分页显示输出
	    $news  = $model->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
	    $this->assign('news',$news);
        $this->assign('page',$show);
        $this->assign('keyword',$keyword);

	    $this->assign('active','Doctor');
	    $this->assign('init',$this->init());
		$this->assign('a','doc');
		$this->assign('info',"医生列表");
		$this->display();
	}

	public function edit(){
	    $this->assign('active','Doctor');
	    $this->assign('init',$this->init());
		$this->assign('a','doc');
		$this->assign('info',"修改医生");
		$this->display();
	}


}