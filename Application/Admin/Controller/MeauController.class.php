<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class MeauController extends AdminController
{

	protected function init(){
		return array(
		 'menu' => array(
		 			array(
					'name' => '添加栏目',
					'icon' => 'plus',
	                'url' => U('add'),
		 		),
		 	),
		'add' => array(
			'name' => '更新排序',
           	'url' => U('update'),
           	),
		);
	}
	
	public function add(){
		$mModel = M('meau');
		$id = $_GET['id'];
		
	     if(IS_POST){

	     	if($mModel->add($_POST)){
	     		$this->success('添加成功,点击返回……',U('Meau/index'));
	     	}else{
	     		$this->error('添加失败~~');
	     	}

	     }else{

			$cates = $mModel->where('cid=0')->select();
			$this->assign('cates',$cates);
			$this->assign('cid',$id);
			$this->assign('init',$this->init());
		    $this->assign('active','Index');
		    $this->assign('a','mu');
			$this->assign('info',"栏目管理");
			$this->display('');

	     }
	}

	public function index(){

		$mModel = M('meau');
		$lists  = $mModel->where('cid=0')->order('orders')->select();
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

	public function edit(){
		$mModel = M('meau');
		
	     if(IS_POST){

			$id=$_POST['id'];
			$resule = $mModel->where('id=%d',$id)->save($_POST);
			if(false !== $resule){
				$this->success('修改成功！正在跳转……',U('index'));
			}else{
				$this->error('修改失败~~~ 正在返回……');
			}

	     }else{

	     	$id = $_GET['id'];
			if(empty($id) | $id <= 0){
				$this->error('非法的操作',U('index'));
			}

			$r = $mModel->where('id=%d',$id)->find();
            $this->assign('r',$r);
			$cates = $mModel->where('cid=0')->select();
			$this->assign('cates',$cates);
			$this->assign('cid',$id);
			$this->assign('init',$this->init());
		    $this->assign('active','Index');
		    $this->assign('a','mu');
			$this->assign('info',"栏目管理");
			$this->display('');

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
	  if(M('meau')->where('id='.$tagId)->delete()){
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
        M('meau')->where('id='.$id)->delete();

     }
      $this->success('批量操作执行完毕！');
    }


    function yuyue(){

    	$model=M('yuyue');
	    $count = $model->count();// 查询满足要求的总记录数
	    $Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	    $show  = $Page->show();// 分页显示输出
	    $lists  = $model->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('lists',$lists);
		$this->assign('active','Index');
	    $this->assign('a','yy');
		$this->assign('info',"预约信息");
    	$this->display('yuyue');
    }

	/**
	* 删除
	*/
	public function yuyuedel(){
	  $tagId = I('post.data',0,'intval');
	  if(empty($tagId)){
	      $this->error('参数不能为空！');
	  }
	  if(M('yuyue')->where('id='.$tagId)->delete()){
	      $this->success('预约信息删除成功！',U('index'));
	  }else{
	      $this->error('预约信息删除失败！');
	  }
	}

	
  	/**
   	* 批量操作
  	*/
 	public function yuyueAction(){
      $ids = I('post.ids');

      if(empty($ids)){
          $this->error('请先选择操作项目！');
    	}
      foreach ($ids as $id) {
        //删除
        M('yuyue')->where('id='.$id)->delete();

     }
      $this->success('批量操作执行完毕！');
    }


}