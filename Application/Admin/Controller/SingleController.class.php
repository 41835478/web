<?php
namespace Admin\Controller;
use Think\Controller;
/**
* Single单页管理
*/
class SingleController extends AdminController{




  protected function init(){
    return array(
     'menu' => array(
      array(
       'name' => '单页管理',
       'icon' => 'paste',
       'url' => U('Single/index'),
       ),
      ),
     'add' => array(
       'name' => '添加单页',
       'icon' => 'plus',
       'url' => U('add'),
       ),
     );
  }


    /**
*单页管理
*/

public function index(){
  $model= M('single');
  $count = $model->count();
  $Page  = new \Think\Page($count,15);
  $show  = $Page->show();
  $news  = $model->limit($Page->firstRow.','.$Page->listRows)->select();

  foreach ($news as $key => $value) {
    $news[$key]['type']=M('singletype')->field('name')->where('class_id=%d',$news[$key]['typeid'])->find();
  }
    // dump($news);
    // exit();
  $this->assign('news',$news);
  $this->assign('page',$show);    
  $this->assign('active','News');
  $this->assign('init',$this->init());
  $this->assign('a','single');
  $this->assign('info',"单页管理");
  $this->assign('desc',"管理网站独立页面");
  $this->display();
}


public function article(){
 $model= M('single');
 empty($_GET['id'])?$this->redirect('index',0,0,'页面跳转中...'): $map['typeid']=$_GET['id']; 

 $count = $model->where($map)->count();
 $Page  = new \Think\Page($count,15);
 $show  = $Page->show();
 $news  = $model->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();

 foreach ($news as $key => $value) {
  $news[$key]['type']=M('singletype')->field('name')->where('class_id=%d',$news[$key]['typeid'])->find();
}

$this->assign('news',$news);
$this->assign('page',$show);    
$this->assign('active','News');
$this->assign('init',$this->init());
$this->assign('a','single');
$this->assign('info',"单页管理");
$this->assign('desc',"管理网站独立页面");
$this->display('index');
}



function add(){
  if(IS_POST){
    $dates['title']=$_POST['title'];
    $dates['content']=$_POST['content'];
    $dates['typeid']=$_POST['typeid'];
    $dates['ctime']=time();
    $re=M('single')->add($dates);
    if($re){
      $this->success('单页内容添加成功',U('index'));
    }else{
      $this->error('单页内容添加失败');
    }
  }else{

    $cm=M('singletype');
    $list=$cm->where('parent_id=0')->select();
    foreach ($list as $key => $value) {
      $list[$key]['class']=$cm->where('parent_id=%d',$list[$key]['class_id'])->select();
    }
    $this->assign('list',$list);
    $this->assign('active','News');
    $this->assign('init',$this->init());
    $this->assign('a','single');
    $this->assign('info',"单页管理");
    $this->display();
  }
}

function edit(){
  if(IS_POST){
    $cid=$_POST['id'];
    $dates['title']=$_POST['title'];
    $dates['content']=$_POST['content'];
    $dates['typeid']=$_POST['typeid'];
    $re=M('single')->where('id='.$cid)->save($dates);
    if($re !== false){
      $this->success('修改成功！',U('index'));
    }else{
      $this->error('修改失败！');
    }
  }else{
    $cid=$_GET['id'];
    $r=M('single')->where('id='.$cid)->find();
    $r['type']=M('singletype')->field('name')->where('class_id='.$r['typeid'])->find();
    $t=M('singletype')->select();

    $cm=M('singletype');
    $list=$cm->where('parent_id=0')->select();
    foreach ($list as $key => $value) {
      $list[$key]['class']=$cm->where('parent_id=%d',$list[$key]['class_id'])->select();
    }

    $this->assign('r',$r);
    $this->assign('t',$list);
    $this->assign('active','News');
    $this->assign('init',$this->init());
    $this->assign('a','single');
    $this->assign('info',"单页管理"); 
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

    if(M('single')->where('id='.$contentId)->delete()){
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
      M('single')->where('id='.$id)->delete();
    }
    $this->success('批量操作执行完毕！');
  }


}