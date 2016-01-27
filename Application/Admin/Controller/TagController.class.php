<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class TagController extends AdminController{

	protected function init(){
   	return array(
         'menu' => array(
                    array(
                   'name' => 'TAG列表',
                   'icon' => 'list',
                   'url' => U('index'),
                  ),
                ),
         'add' => array(
                   'name' => '添加TAG',
                   'icon' => 'plus',
                   'url' => U('add'),
            ),
        );
	}
 
	function index(){

    $model=M('tags');

    $keyword = I('keyword', '', 'string');
    $map['name'] = array('like','%'.$keyword.'%');

    $count = $model->where($map)->count();// 查询满足要求的总记录数
    $Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    $show  = $Page->show();// 分页显示输出
    $tag  = $model->where($map)->order('tag_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

    $this->assign('tag',$tag);
    $this->assign('active','extend');
    $this->assign('init',$this->init());
		$this->assign('a','tag');
		$this->assign('info',"TAG列表");
    $this->display('');

	}


  function add(){

    if(IS_POST){

      $dates['name']=$_POST['name'];
      $dates['url']=$_POST['url'];
      $dates['status']=1;

      $re=M('tags')->add($dates);
      if($re){
        $this->success('TAG标签添加成功！',U('index'));
      }else{
        $this->error('TAG标签添加失败！');
      }

    }else{

      $this->assign('active','extend');
      $this->assign('init',$this->init());
      $this->assign('a','tag');
      $this->assign('info',"TAG列表");
      $this->display('');

    }



  }


  function edit(){

    if(IS_POST){

      $id=$_POST['tag_id'];
      $dates['name']=$_POST['name'];
      $dates['url']=$_POST['url'];

      $re = M('tags')->where('tag_id='.$id)->save($dates);

      if($re !== false){
        $this->success('TAG标签修改成功！',U('index'));
      }else{
        $this->error('TAG标签修改失败！');
      }

    }else{

      $id=$_GET['tag_id'];
      $r=M('tags')->where('tag_id='.$id)->find();

      $this->assign('r',$r);
      $this->assign('active','extend');
      $this->assign('init',$this->init());
      $this->assign('a','tag');
      $this->assign('info',"TAG列表");
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
      if(M('tags')->where('tag_id='.$tagId)->delete()){
          $this->success('TAG删除成功！',U('index'));
      }else{
          $this->error('TAG删除失败！');
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
        M('tags')->where('tag_id='.$id)->delete();

      }

      $this->success('批量操作执行完毕！');
  }


}




