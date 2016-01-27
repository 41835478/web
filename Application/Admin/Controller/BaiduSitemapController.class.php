<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 百度提交
*/
class BaiduSitemapController extends AdminController{
	protected function init(){
		return array(
			'menu' => array(
				array(
					'name' => '主动提交',
					'icon' => 'location-arrow',
					'url' => U('index'),
					),
				array(
					'name' => '自动推送',
					'icon' => 'location-arrow',
					'url' => U('autoPost'),
					),
				array(
					'name' => 'sitemap',
					'icon' => 'location-arrow',
					'url' => U('sitemap'),
					),
				),
			'add' => array(

				),
			);
	}
	public function index(){

		if(IS_POST){
			layout(false);
			$cModel = M('config');
			//$baidu['data'] =I('post.baidu_api');
			$baidu['data'] =$_POST['baidu_api'];

			$state = $cModel->where('name = "baidu_api"')->save($baidu);
			if($state === false){
				$this->error('修改失败！');
			}
			$this->success("Api接口修改成功！");

		}else{

			$newsNum=M('article')->count();
			$hospitalNum=M('hospital')->count();

			$updateNews=M('sitemap')->where('type=1 and state=1')->count();
			$updateHospital=M('sitemap')->where('type=2 and state=1')->count();	

			$baidu = M('config')->where('name = "baidu_api"')->find();

			$this->assign('news',$newsNum);
			$this->assign('hospital',$hospitalNum);
			$this->assign('updateNews',$updateNews);
			$this->assign('updateHospital',$updateHospital);
			$this->assign('bd',$baidu);

			$this->assign('active','extend');
			$this->assign('init',$this->init());
			$this->assign('a','baidu');
			$this->assign('info',"百度提交");
			$this->display();
		}	
	}

	/*新闻更新到sitemap表*/
	public function newsUpdate(){

		$max=M('config')->field('data')->where('name="baidu_articlenum"')->find();
		$maxId=$max['data'];

		$news=M('article')->field('content_id')->where('content_id>'.$maxId)->select();
		if (empty($news)) {
			exit("已经更新到最新！");
		} else {
			foreach ($news as $key => $value) {

				$sitemap['tid']=$value['content_id'];			
				$sitemap['type']='1';
				$sitemap['url']='http://www.fuzhen.com/p/'.$value['content_id'].'.html';

				M('sitemap')->add($sitemap);
			}
			$newMax=M('article')->field('content_id')->order('content_id  desc')->limit(1)->select();
			$data['data']=$newMax[0]['content_id'];
			$re=M('config')->where('name="baidu_articlenum"')->save($data);
			if ($re) {
				exit("更新成功！");
			} 		

		}	
		
	}

	/*医院更新到sitemap表*/
	public function hospitalUpdate(){

		$news=M('hospital')->field('id')->select();
		foreach ($news as $key => $value) {

			$sitemap['tid']=$value[id];			
			$sitemap['type']='2';
			$sitemap['url']=getHospitalUrl($value[id]);

			$re=M('sitemap')->add($sitemap);
		}
		if ($re) {
			exit("更新成功！");
		} 

	}

	/*推送操作*/
	public function doPost(){

		if (IS_POST) {
			$num=I('post.data');
			$updateUrl=M('sitemap')->field('id,url')->where('state=0')->limit($num)->select();
			foreach($updateUrl as $key => $value){
				$urls[$key]=$value['url'];
				/*$data['state']=1;
				$re=M('sitemap')->where('id='.$value['id'])->save($data);*/
			}			
			$baidu= M('config')->field('data')->where('name = "baidu_api"')->find();
			$api=$baidu['data'];
			//$api = 'http://data.zz.baidu.com/urls?site=www.fuzhen.com&token=H8etpDaorKvv1AAZ';
			$ch = curl_init();
			$options =  array(
				CURLOPT_URL => $api,
				CURLOPT_POST => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POSTFIELDS => implode("\n", $urls),
				CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
				);
			curl_setopt_array($ch, $options);
			$result = curl_exec($ch);
			$re = json_decode($result);
			if (empty($re->{'message'})) {
				foreach($updateUrl as $key => $value){
					$data['state']=1;
					M('sitemap')->where('id='.$value['id'])->save($data);
				}
			}
			
			exit($result);

		} else {
			$msg=array('error'=>'none','message'=>'暂无更新！');
			exit($msg);
		}


	}


	/*自动推送*/
	public function autoPost(){

		if(IS_POST){
			layout(false);
			$cModel = M('config');
			$baidu['data'] =I('post.baidu_autopost');

			$state = $cModel->where('name = "baidu_autopost"')->save($baidu);
			if($state === false){
				$this->error('修改失败！');
			}
			$this->success("修改百度结构化数据参数成功！");

		}else{

			$cModel = M('config');
			$baidu = $cModel->where('name = "baidu_autopost"')->find();

			$this->assign('bd',$baidu);
			$this->assign('active','extend');
			$this->assign('init',$this->init());
			$this->assign('a','baidu');
			$this->assign('info',"百度提交");
			$this->display();
		}


	}


	public function sitemap(){

		if(IS_POST){
			$txt = fopen("sitemap.txt", "w") or die("Unable to open file!");
			$urlsArry=M('sitemap')->field('url')->select();
			///dump($urlsArry);exit;
			foreach ($urlsArry as $key => $value) {
				$urls = ($urlsArry[$key]['url']."\r\n");
				fwrite($txt, $urls);
			}
			
			fclose($txt);
			$this->success("创建sitemap成功！");

		}else{
			$this->assign('active','extend');
			$this->assign('init',$this->init());
			$this->assign('a','baidu');
			$this->assign('info',"百度提交");
			$this->display();	
		}
	}
}