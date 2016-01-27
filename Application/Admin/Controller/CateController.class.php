<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class CateController extends AdminController
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
		$model=M('category');
		$list=$model->where('parent_id=0')->select();

	    foreach ($list as $key => $value) {
	        $list[$key]['class']=$model->where('parent_id=%d',$list[$key]['class_id'])->order('sequence asc')->select();
	    }

    	$this->assign('list',$list);
    	$this->assign('active','News');
    	$this->assign('init',$this->init());
		$this->assign('a','cate');
		$this->assign('info',"栏目列表");
		$this->assign('desc',"管理网站新闻栏目");
		$this->display();
	}


	function add(){

		$model=M('category');

		if(IS_POST){

			$re=$model->add($_POST);
			if($re){
				$this->success('分类添加成功……',U('Cate/index'));
			}else{
				$this->error('分类添加失败……');
			}

		}else{

			$list=$model->where('parent_id=0')->select();

    		$this->assign('list',$list);
	    	$this->assign('active','News');
	    	$this->assign('init',$this->init());
			$this->assign('a','cate');
			$this->assign('info',"栏目列表");
			$this->assign('desc',"管理网站新闻栏目");
			$this->display();

		}
	}

 
	function edit(){
		$model=M('category');

		if(IS_POST){
			$id=$_POST['class_id'];

			$dates['parent_id']=$_POST['parent_id'];
			$dates['sequence']=$_POST['sequence'];
			$dates['type']=$_POST['type'];
			$dates['name']=$_POST['name'];
			$dates['subname']=$_POST['subname'];
			$dates['keywords']=$_POST['keywords'];
			$dates['description']=$_POST['description'];

			$re=$model->where('class_id='.$id)->save($dates);
			if($re !== false){
				$this->success('分类修改成功……',U('Cate/index'));
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
			$this->assign('a','cate');
			$this->assign('info',"栏目列表");
			$this->assign('desc',"管理网站新闻栏目");
			$this->display();

		}
	}

	/**
     * 删除
     */
    public function del(){
        $classId = I('post.data');
        if(empty($classId)){
            $this->error('参数不能为空！');
        }
        //判断子栏目
        $re=M('Category')->where('parent_id='.$classId)->select();
        if(!empty($re)){
            $this->error('请先删除子栏目！');
        }
        //判断栏目下内容
        $rs=M('article')->where('class_id='.$classId)->select();
        if(!empty($rs)){
            $this->error('请先删除该栏目下的内容！');
        }
        //删除栏目操作
        if(M('Category')->where('class_id='.$classId)->delete()){
            $this->success('栏目删除成功！');
        }else{
            $this->error('栏目删除失败！');
        }

    }


}