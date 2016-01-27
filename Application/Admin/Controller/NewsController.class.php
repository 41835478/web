<?php
namespace Admin\Controller;
use Think\Controller;

class NewsController extends AdminController{

	protected function init(){
   	return array(
         'menu' => array(
                    array(
                   'name' => '文档列表',
                   'icon' => 'bars',
                   'url' => U('index'),
                  ),
                ),
         'add' => array(
                   'name' => '添加文档',
                   'icon' => 'plus',
                   'url' => U('add'),
            ),
        );
	}

	function index(){

    $model=M('article');
    $id=$_GET['id'];
    
    if(!empty($id)){
      $map['class_id']=$id;
    }

    $keyword = I('keyword', '', 'string');
    $map['title'] = array('like','%'.$keyword.'%');
    
    $cm=M('category');
    $list=$cm->where('parent_id=0')->select();
    foreach ($list as $key => $value) {
        $list[$key]['class']=$cm->where('parent_id=%d',$list[$key]['class_id'])->select();
    }
 
    $count = $model->where($map)->count();// 查询满足要求的总记录数

      foreach($map as $key=>$val) {
          $Page->parameter[$key]   =   urlencode($val);
      }

    $Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    $show  = $Page->show();// 分页显示输出
    $news  = $model->where($map)->order('content_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

    $this->assign('news',$news);
    $this->assign('page',$show);
    $this->assign('cate',$list);
    $this->assign('keyword',$keyword);
    $this->assign('active','News');
    $this->assign('init',$this->init());
		$this->assign('a','cate');
		$this->assign('info',"文档列表");

		$this->display();

	}

  function add(){

    if(IS_POST){

      $dates['class_id']=$_POST['class_id'];
      $dates['hid']=$_POST['hid'];
      $dates['title']=$_POST['title'];
      $dates['keywords']=$_POST['keywords'];

      if(empty($_POST['description'])){
          $dates['description']=get_str(html2text($_POST['content']),0,64);
      }else{
        $dates['description']=$_POST['description'];
      }

      $dates['time']=time();
      $dates['image']=$_POST['image'];
      $dates['status']=1;
      $dates['hospitaltype']=$_POST['hospitaltype'];
      $dates['position']=implode($_POST['position'], ',');
      $dates['copyfrom']=$_POST['copyfrom'];
      $dates['views']=rand(120,300);
      $dates['content']=$_POST['content'];
      $dates['urltitle']=$_POST['urltitle'];

      $re=M('article')->add($dates);
      if($re){
        $this->success('新闻内容添加成功',U('index'));
      }else{
        $this->error('新闻内容添加失败');
      }

    }else{

      $cm=M('category');
      $list=$cm->where('parent_id=0')->select();
      foreach ($list as $key => $value) {
          $list[$key]['class']=$cm->where('parent_id=%d',$list[$key]['class_id'])->select();
      }

      $type=M('hospitaltype')->select();
      $this->assign('type',$type);
      $this->assign('cate',$list);
      $this->assign('active','News');
      $this->assign('init',$this->init());
      $this->assign('a','news');
      $this->assign('info',"文档列表");
      $this->display();

    }


  }

  function edit(){

    if(IS_POST){

      $cid=$_POST['content_id'];
      $dates['class_id']=$_POST['class_id'];
      $dates['hid']=$_POST['hid'];
      $dates['title']=$_POST['title'];
      $dates['keywords']=$_POST['keywords'];
      $dates['hospitaltype']=$_POST['hospitaltype'];
      $dates['description']=$_POST['description'];
      $dates['image']=$_POST['image'];
      $dates['position']=implode($_POST['position'], ',');
      $dates['content']=$_POST['content'];
      $dates['urltitle']=$_POST['urltitle'];
      $re=M('article')->where('content_id='.$cid)->save($dates);

      if($re !== false){
        $this->success('内容修改成功',U('index'));
      }else{
        $this->error('内容修改失败');
      }

    }else{

      $cid=$_GET['content_id'];
      $r=M('article')->where('content_id='.$cid)->find();
      $cm=M('category');
      $list=$cm->where('parent_id=0')->select();
      foreach ($list as $key => $value) {
          $list[$key]['class']=$cm->where('parent_id=%d',$list[$key]['class_id'])->select();
      }

      if(!empty($r['position'])){
        $str=$r['position'];
        switch ($str) {
          case 't':
            $tuijian=1;
            $lunbo=0;
            break;
          case 'l':
            $tuijian=0;
            $lunbo=1;
            break;
          case 't,l':
            $tuijian=1;
            $lunbo=1;
            break;
          default:
            # code...
            break;
        }
      }
      $type=M('hospitaltype')->select();
      $this->assign('type',$type);
      $this->assign('tuijian',$tuijian);
      $this->assign('lunbo',$lunbo);
      $this->assign('r',$r);
      $this->assign('cate',$list);
      $this->assign('active','News');
      $this->assign('init',$this->init());
      $this->assign('a','news');
      $this->assign('info',"文档列表");
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
        if(M('article')->where('content_id='.$contentId)->delete()){
            $this->success('文章删除成功！',U('index'));
        }else{
            $this->error('文章删除失败！');
        }
    }

    /**
     * 批量操作
     */
    public function batchAction(){
        
        $type = I('post.type',0,'intval');
        $ids = I('post.ids');
        $classId = I('post.class_id',0,'intval');
        if(empty($type)){
            $this->error('请选择操作！');
        }
        if(empty($ids)){
            $this->error('请先选择操作项目！');
        }
        if($type == 2){
            if(empty($classId)){
                $this->error('请选择操作栏目！');
            }
        }
        foreach ($ids as $id) {
            $data = array();
            switch ($type) {
                case 1:
                    //删除
                    M('article')->where('content_id='.$id)->delete();
                    break;
                case 2:
                    //移动分类
                    $data['class_id'] = $classId;
                    M('article')->where('content_id='.$id)->save($data);
                    break;
            }
        }

        $this->success('批量操作执行完毕！');
    }

public function caiji(){
  layout(false);
      $dates['class_id']=$_POST['class_id'];
      $dates['hid']=$_POST['hid'];
      $dates['title']=$_POST['title'];
      $dates['keywords']=$_POST['keywords'];

      if(empty($_POST['description'])){
          $dates['description']=get_str(html2text($_POST['content']),0,64);
      }else{
        $dates['description']=$_POST['description'];
      }

      $dates['time']=time();
      $dates['image']=$_POST['image'];
      $dates['status']=1;
      $dates['hospitaltype']=$_POST['hospitaltype'];
      $dates['position']=implode($_POST['position'], ',');
      $dates['copyfrom']=$_POST['copyfrom'];
      $dates['views']=rand(120,300);
      $dates['content']=$_POST['content'];
      $dates['urltitle']=$_POST['urltitle'];

      $re=M('article')->add($dates);
      if($re){
        $this->success('新闻内容添加成功',U('index'));
      }else{
        $this->error('新闻内容添加失败');
      }
}

	
}