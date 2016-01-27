<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class ZhuantiController extends AdminController
{
	
	protected function init(){
   	return array(
         'menu' => array(
                    array(
                   'name' => '专题列表',
                   'icon' => 'bars',
                   'url' => U('index'),
                  ),
                ),
         'add' => array(
                   'name' => '添加专题',
                   'icon' => 'plus',
                   'url' => U('add'),
            ),
        );
	}

	function index(){

	    $model=M('zhuanti');

	    $count = $model->count();// 查询满足要求的总记录数
	    $Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	    $show  = $Page->show();// 分页显示输出
	    $news  = $model->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

	    $this->assign('news',$news);
	    $this->assign('page',$show);
	    $this->assign('active','News');
	    $this->assign('init',$this->init());
		$this->assign('a','zt');
		$this->assign('info',"专题列表");
		$this->display();

	}

  function add(){

    if(IS_POST){

      $dates['title']=$_POST['title'];
      $dates['keywords']=$_POST['keywords'];
      $dates['description']=$_POST['description'];
      $dates['url']=$_POST['url'];
      $dates['images']=$_POST['image'];
      $dates['ctime']=time();
      $dates['status']=$_POST['status'];

      $re=M('zhuanti')->add($dates);
      if($re){
        $this->success('专题内容添加成功',U('index'));
      }else{
        $this->error('专题内容添加失败');
      }

    }else{

      $this->assign('active','News');
      $this->assign('init',$this->init());
      $this->assign('a','zt');
      $this->assign('info',"专题列表");
      $this->display();

    }


  }

  function edit(){

    if(IS_POST){

      $cid=$_POST['id'];

      $dates['title']=$_POST['title'];
      $dates['keywords']=$_POST['keywords'];
      $dates['description']=$_POST['description'];
      $dates['url']=$_POST['url'];
      $dates['images']=$_POST['image'];
      $dates['status']=$_POST['status'];

      $re=M('zhuanti')->where('id='.$cid)->save($dates);

      if($re !== false){
        $this->success('专题修改成功',U('index'));
      }else{
        $this->error('专题修改失败');
      }

    }else{

      $cid=$_GET['id'];
      $r=M('zhuanti')->where('id='.$cid)->find();
      $this->assign('r',$r);
      $this->assign('active','News');
      $this->assign('init',$this->init());
      $this->assign('a','zt');
      $this->assign('info',"专题列表");
      $this->display("edit");
    }

  }


   /**
     * 删除
     */
    public function del(){
        $contentId = I('post.data',0,'intval');
        if(empty($contentId)){
            $this->error('参数不能为空！');
        }
        if(M('zhuanti')->where('id='.$contentId)->delete()){
            $this->success('专题删除成功！',U('index'));
        }else{
            $this->error('专题删除失败！');
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
        M('zhuanti')->where('content_id='.$id)->delete();

      }
      $this->success('批量操作执行完毕！');
  }

}