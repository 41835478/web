<?php
namespace Admin\Controller;
use Think\Controller;

class GuestbookController extends AdminController{

	protected function init(){
		return array(
			'menu' => array(
				array(
					'name' => '留言板',
					'icon' => 'comments',
					'url' => U('Guestbook/index'),
					),
				array(
					'name' => '文章评论',
					'icon' => 'group',
					'url' => U('Guestbook/comment'),
					),
				),
	        'add' => array(
	                'name' => '预览',
	                'icon' => 'eye',
	                'url' => U('../Home/Guestbook'),
	        	),
			);
	}
/**
*留言
*/
	public function index(){

		//$DuoShuo=new \Common\Util\DuoShuo;
		//$pl=$DuoShuo->getTop();

		$mModel= M('Guestbook');
		$count = $mModel->where('aid=0')->count();// 查询满足要求的总记录数
	    $Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	    $show  = $Page->show();// 分页显示输出
	    $lists = $mModel->where('aid=0')->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
	    $this->assign('list',$lists);
	    $this->assign('page',$show);		

	    $this->assign('active','extend');
	    $this->assign('init',$this->init());
	    $this->assign('a','aa');
	    $this->assign('info',"留言列表");
	    $this->display();
	}

/**
*文章评论
*/
	public function comment(){

		$mModel= M('Guestbook');
		$count = $mModel->where('aid!=0')->count();// 查询满足要求的总记录数
	    $Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	    $show  = $Page->show();// 分页显示输出
	    $lists = $mModel->join('LEFT JOIN fz_article ON fz_Guestbook.aid = fz_article.content_id' )->field('fz_Guestbook.*,fz_article.title,fz_article.content_id')->where('aid!=0')->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
	    foreach ($lists as $key => $value) {
	    	
	    }

	    $this->assign('list',$lists);
	    $this->assign('page',$show);	
		$this->assign('active','extend');
		$this->assign('init',$this->init());
		$this->assign('a','aa');
		$this->assign('info',"留言列表");
		$this->display();

	}
	   /**
     * 删除
     */
	public function del(){
	   	$contentId = I('post.data',0,'intval');
	   	if(empty($contentId)){
	   		$this->error('参数不能为空！');
	   	}
	   	if(M('Guestbook')->where('id='.$contentId)->delete()){
	   		$this->success('留言删除成功！',U('Guestbook/index'));
	   	}else{
	   		$this->error('留言删除失败！');
	   	}
	}

	public function edit(){
	   	if(IS_POST){

	   		$id=$_POST['id'];
	   		$dates['id']=$_POST['id'];
	   		$dates['email']=$_POST['email'];
	   		$dates['username']=$_POST['username'];
	   		$dates['updatetime']=$_POST['description'];
	   		$dates['ip']=$_POST['ip'];
	   		$dates['tel']=$_POST['tel'];
	   		$dates['updatetime']=time();
	   		$dates['content']=$_POST['content'];
	   		$dates['verify']=$_POST['verify'];
	   		$dates['status']=$_POST['status'];
	   		$re=M('Guestbook')->where('id='.$id)->save($dates);

	   		if($re !== false){
	   			$this->success('留言修改成功',U('Guestbook/index'));
	   		}else{
	   			$this->error('留言修改失败！');
	   		}

	   	}else{

	   		$id=$_GET['id'];

	   		$r=M('Guestbook')->where('id='.$id)->find();

	   		$this->assign('r',$r);
	   		$this->assign('active','extend');
	   		$this->assign('init',$this->init());
	   		$this->assign('a','aa');
	   		$this->assign('info',"留言列表");
	   		$this->display();

	   	}
	}
	   /**
     * 批量操作
     */
	public function batchAction(){

	   	$type = I('post.type',0,'intval');
	   	$ids = I('post.ids');
	   	if(empty($type)){
	   		$this->error('请选择操作！');
	   	}
	   	foreach ($ids as $id) {
	   		/*if(empty($id)){
	   		$this->error('请先选择操作项目o！');
	   		}*/
	   		switch ($type) {
	   			case 1:
                    //删除
	   			//M('Guestbook')->where('id='.$id)->delete();
	   			break;
	   			case 2:
                    //禁用
	   			$data['status'] = 2;
	   			M('Guestbook')->where('id='.$id)->save($data);
	   			break;
	   			case 3:
                    //审核通过
	   			$data['status'] = 1;
	   			M('Guestbook')->where('id='.$id)->save($data);
	   			break;
	   		}
	   	}

	   	$this->success('批量操作执行完毕！');
	}
}