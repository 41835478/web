<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class SingletypeController extends AdminController
{
	protected function init(){
		return array(
			'menu' => array(
				array(
					'name' => '栏目列表',
					'icon' => 'list',
					'url' => U('index'),
					),
				),
			'add' => array(
				'name' => '添加栏目',
				'icon' => 'plus',
				'url' => U('add'),
				),
			);
	}


	function index()
	{
		$model=M('Singletype');
		$list=$model->where('parent_id=0')->order('sort')->select();

		foreach ($list as $key => $value) {
			$list[$key]['class']=$model->where('parent_id=%d',$list[$key]['class_id'])->order('sort')->select();
		}

		$this->assign('list',$list);
		$this->assign('active','News');
		$this->assign('init',$this->init());
		$this->assign('a','singlety');
		$this->assign('info',"栏目列表");
		$this->assign('desc',"管理网站单页栏目");
		$this->display();
	}

	function add(){

		$model=M('Singletype');

		if(IS_POST){

			$re=$model->add($_POST);
			if($re){
				$this->success('分类添加成功……',U('Singletype/index'));
			}else{
				$this->error('分类添加失败……');
			}

		}else{

			$list=$model->where('parent_id=0')->select();

			$this->assign('list',$list);
			$this->assign('active','News');
			$this->assign('init',$this->init());
			$this->assign('a','singlety');
			$this->assign('info',"栏目列表");
			$this->assign('desc',"管理网站单页栏目");
			$this->display();

		}
	}


	function edit(){
		$model=M('Singletype');

		if(IS_POST){
			$id=$_POST['class_id'];

			$dates['parent_id']=$_POST['parent_id'];
			$dates['name']=$_POST['name'];
			$dates['sort']=$_POST['sort'];

			$re=$model->where('class_id='.$id)->save($dates);
			if($re !== false){
				$this->success('分类修改成功……',U('Singletype/index'));
			}else{
				$this->error('分类修改失败……');
			}

		}else{

			$id=$_GET['id'];

			$list=$model->where('parent_id=0')->select();
			$r=$model->where('class_id='.$id)->find();

			$this->assign('list',$list);
			$this->assign('r',$r);
			$this->assign('active','News');
			$this->assign('init',$this->init());
			$this->assign('a','singlety');
			$this->assign('info',"栏目列表");
			$this->assign('desc',"管理网站单页栏目");
			$this->display();

		}
	}
	     /**
     * 排序
     */
	     public function sort(){
	     	layout(false);
	     	$sort = I('post.sort',0,'intval');
	     	foreach ($sort as $id => $sortValue) {      	
	     		if(empty($sortValue)){
	     			$sortValue=0;
	     		}
	     		$dates['sort']= $sortValue;
	     		$single=M('Singletype')->where('class_id='.$id)->save($dates);
	     	}    
	     	$this->success('更新排序成功！');
	     }

	/**
     * 删除
     */
	public function del(){
		$classId = $_POST['data'];	
		if(empty($classId)){
			$this->error('参数不能为空！');
		}
        //判断子栏目
		$re=M('Singletype')->where('parent_id='.$classId)->select();
		if(!empty($re)){
			$this->error('请先删除子栏目！');
		}
		//删除栏目下文章
		M('single')->where('typeid='.$classId)->delete();
        //删除栏目操作
		if(M('Singletype')->where('class_id='.$classId)->delete()){
			$this->success('栏目删除成功！',U('index'));
		}else{
			$this->error('栏目删除失败！');
		}

	}


}