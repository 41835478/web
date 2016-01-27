<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class MakehtmlController extends AdminController
{

    protected function init(){
        return array(
         'menu' => array(),
         'add' => array(),
         );
    }


    function index(){

       $this->assign('active','Index');
       $this->assign('init',$this->init());
       $this->assign('a','mh');
       $this->assign('info',"生成静态页");
       $this->assign('desc',"");
       $this->display('');
   }

   function makeindex(){
      layout(false);

		//$id=$_GET['id'];
      $menu=M('meau')->where('cid=0 and isview=1')->order('orders')->select();
      foreach ($menu as $key => $value) {
        $menu[$key]['class']=M('meau')->where('isview=1 and cid='.$value['id'])->order('orders asc')->select();
    }
                //dump($meau);
                //exit;
    $ob = M("config");
    $config=$ob->field('name,data')->select();
    foreach ($config as $key => $value) {
        C($value['name'],$value['data']);
    }
    $this->assign('bannon',$menu);

		/*buildHtml($htmlfile,$htmlpath,$templateFile,$charset,$contentType='text/html')
		$htmlfile生成的静态文件名称
		$htmlpath生成的静态文件路径
		$templateFile 指定要生成静态的模板文件
		$charset生成静态文件的编码格式
		$contentType生成静态文件的类型
		$this->buildHtml('1',HTML_PATH.'/','list','utf8');
		*/
        //获取头部6副图片广告
        //获取头部6副图片广告
        $aModel=M('adver');
        $ad1=$aModel->where('id=1')->find();
        $ad2=$aModel->where('id=2')->find();
        $ad3=$aModel->where('id=3')->find();
        $ad4=$aModel->where('id=4')->find();
        $ad5=$aModel->where('id=5')->find();
        $ad6=$aModel->where('id=6')->find();
        //获取新闻的列表
        $cModel=M('article');
        $cList=$cModel->order('time desc')->limit(0,20)->select();
        //获取当前新闻下的分类
        $gModel=M('category');
        $gList=$gModel->where('parent_id=10')->order('sequence asc')->limit(0,5)->select();

        //首页疾病快速导航
        //癌症相关医院
        $oneList  = M('ranking')->where('cid=6')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,11)->select();
        foreach ($oneList as $key => $value) {
            $oneList[$key]['class']=M('hospital')->field('id,name_cn,xingzhi,hos_years,doc_num')->where("hid='%s'",$oneList[$key]['hid'])->select();
        }
        //儿童相关医院
        $twoList  = M('ranking')->where('cid=25')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,11)->select();
        foreach ($twoList as $key => $value) {
            $twoList[$key]['class']=M('hospital')->field('id,name_cn,xingzhi,hos_years,doc_num')->where("hid='%s'",$twoList[$key]['hid'])->select();
        }
        //罕见病相关医院
        $threeList  = M('ranking')->where('cid=9')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,11)->select();
        foreach ($threeList as $key => $value) {
            $threeList[$key]['class']=M('hospital')->field('id,name_cn,xingzhi,hos_years,doc_num')->where("hid='%s'",$threeList[$key]['hid'])->select();
        }
        //心血管相关医院
        $fourList  = M('ranking')->where('cid=22')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,11)->select();
        foreach ($fourList as $key => $value) {
            $fourList[$key]['class']=M('hospital')->field('id,name_cn,xingzhi,hos_years,doc_num')->where("hid='%s'",$fourList[$key]['hid'])->select();
        }
        //神经系统相关医院
        $fiveList  = M('ranking')->where('cid=12')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,11)->select();
        foreach ($fiveList as $key => $value) {
            $fiveList[$key]['class']=M('hospital')->field('id,name_cn,xingzhi,hos_years,doc_num')->where("hid='%s'",$fiveList[$key]['hid'])->select();
        }
        //五官相关医院
        $sixList  = M('ranking')->where('cid=7')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,11)->select();
        foreach ($sixList as $key => $value) {
            $sixList[$key]['class']=M('hospital')->field('id,name_cn,xingzhi,hos_years,doc_num')->where("hid='%s'",$sixList[$key]['hid'])->select();
        }
        //肠道相关医院
        $sevenList  = M('ranking')->where('cid=8')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,11)->select();
        foreach ($sevenList as $key => $value) {
            $sevenList[$key]['class']=M('hospital')->field('id,name_cn,xingzhi,hos_years,doc_num')->where("hid='%s'",$sevenList[$key]['hid'])->select();
        }
        //肾脏相关医院
        $eightList  = M('ranking')->where('cid=11')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,11)->select();
        foreach ($eightList as $key => $value) {
            $eightList[$key]['class']=M('hospital')->field('id,name_cn,xingzhi,hos_years,doc_num')->where("hid='%s'",$eightList[$key]['hid'])->select();
        }

        //获取医院的排名(综合实力)
        $Zhonghe=M('hospital')->order('r_zonghe desc')->limit(0,10)->select();;
        //获取医院的排名(科研创新)
        $Shuiping=M('hospital')->order('r_shuiping desc')->limit(0,10)->select();
        //获取医院的排名(中国思维)
        $Fuwu=M('hospital')->order('r_fuwu desc')->limit(0,10)->select();
        //获取医院的排名(历史悠久)
        $Lishi=M('hospital')->order('hos_years asc')->limit(0,10)->select();
        //获取癌症的医院排名
        $aizheng  = M('ranking')->where('cid=6')->group('hid')->order('score desc')->limit(0,15)->select();
        foreach ($aizheng as $key => $value) {
            $aizheng[$key]['class']=M('hospital')->where("hid='%s'",$oneList[$key]['hid'])->select();
        }
        //获取专题列表
        $zhuanti=M('zhuanti')->where("status=1")->select();

        //科室信息
        $cr=M('hospitalclass')->where('type=2')->limit(0,12)->select();
        $cr2=M('hospitalclass')->where('type=2')->limit(12,12)->select();
        $et=M('hospitalclass')->where('type=1')->limit(0,12)->select();

        $this->assign('cr',$cr);
        $this->assign('cr2',$cr2);
        $this->assign('et',$et);
        $this->assign('zhuanti',$zhuanti);
        $this->assign('Zhonghe',$Zhonghe);
        $this->assign('Shuiping',$Shuiping);
        $this->assign('Fuwu',$Fuwu);
        $this->assign('Lishi',$Lishi);
        $this->assign('aizheng',$aizheng);
        $this->assign('oneList',$oneList);
        $this->assign('twoList',$twoList);
        $this->assign('threeList',$threeList);
        $this->assign('fourList',$fourList);
        $this->assign('fiveList',$fiveList);
        $this->assign('sixList',$sixList);
        $this->assign('sevenList',$sevenList);
        $this->assign('eightList',$eightList);
        $this->assign('ad1',$ad1);
        $this->assign('ad2',$ad2);
        $this->assign('ad3',$ad3);
        $this->assign('ad4',$ad4);
        $this->assign('ad5',$ad5);
        $this->assign('ad6',$ad6);
        $this->assign('cList',$cList);
        $this->assign('gList',$gList);
        $html='index';
        $mobans=T('Extend://Home@Index/index');
        $this->buildHtml($html,'./',$mobans);
        $message="网站首页生成成功！";
        exit( $message);

    }

    function makeHosIndex(){

        $tid=$_GET['tid'];  //医院类型
        $yid=$_GET['yid'];  //医院星级(成人、儿童)
        if(empty($yid)){
            $yid=2;
        }

        switch ($yid) {
            case 1:
            $info='儿童';
            break;
            case 2:
            $info='成人';
            break;
            default:
            $info='慢性阻塞';
            break;
        }

        $p=0;               //分页
        if(!empty($tid)){
            $map['cid']=$tid;
        }else{
            $tid=6;
            $map['cid']=$tid;
        }
        $types=M('hospitalclass')->where('type='.$yid)->order('orders')->select();
        $model = M('ranking');
        $count = $model->where($map)->count('DISTINCT hid');// 查询满足要求的总记录数
        $Page  = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show  = $Page->show();// 分页显示输出
        //$list  = $model->distinct(true)->field('hid,rank,score')->where($map)->order('score desc,rank asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $list  = $model->group('hid')->where($map)->order('rank asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => $value) {
            //$where['hid']=array('like','%'.$list[$key]['hid'].'%');
            $list[$key]['class']=M('hospital')->where("hid='%s'",$list[$key]['hid'])->select();
        }
        //最新的新闻信息
        $map['position']=array('like','t');
        $tjNews=M('article')->where($map)->order('time desc')->limit(0,8)->select();
        //新闻图片轮播
        $map['position']=array('like','l');
        $lbNews=M('article')->where($mpp)->order('time desc')->limit(0,4)->select();
        //排名文章调用
        $faqs=M('single')->field('id,title')->where('typeid=36')->limit(3)->select();

        //dump($model->_sql());
        //dump($list);
        //exit;

        $this->assign('count',$count);
        $this->assign('list',$list);
        $this->assign('lbNews',$lbNews);
        $this->assign('tjNews',$tjNews);
        $this->assign('classes',$classes);
        $this->assign('page',$show);
        $this->assign('types',$types);
        $this->assign('info',$info);
        $this->assign('tid',$tid);
        $this->assign('yid',$yid);
        $this->assign('p',$p);
        $this->assign('faqs',$faqs);

        $html='index';
        $mobans=T('Extend://Home@Hospital/index');
        $this->buildHtml($html,'./h/',$mobans);
        $message="医院首页生成成功！";
        exit( $message);

    }



    /* 生成医院 */
    function makehospital($id){

        set_time_limit(0);
        //头部菜单和全局配置参数start
        $menu=M('meau')->where('cid=0 and isview=1')->order('orders')->select();
        foreach ($menu as $key => $value) {
            $menu[$key]['class']=M('meau')->where('isview=1 and cid='.$value['id'])->order('orders asc')->select();
        }
        //dump($meau);
        //exit;
        $ob = M("config");
        $config=$ob->field('name,data')->select();
        foreach ($config as $key => $value) {
            C($value['name'],$value['data']);
        }
        $this->assign('bannon',$menu);
        //头部菜单和全局配置参数End

        $hid=M('hospital')->where('id='.$id)->getField('hid');
        $r=M('hospital')->where('id='.$id)->find();
        $nums=$r['acc_num']+$r['hos_num']+$r['sur_num']+$r['eme_num'];
			//获取当前医院下的科室
        $zy=M('hosdoc')->where('hid=%d',array($hid))->limit(0,11)->select();

        $model=M('ranking');
        $depart_1 = $model->where("type=%d and hid='%s'",array(1,$hid))->order('rank')->limit(0,12)->select();
        $depart_2 = $model->where("type=%d and hid='%s'",array(2,$hid))->order('rank')->limit(0,12)->select();
        $depart_3 = $model->where("type=%d and hid='%s'",array(3,$hid))->order('rank')->limit(0,12)->select();
			//获取当前科室下的相关疾病
        $depart=$model->distinct(true)->field('mid')->where("hid='%s'",array($hid))->select();
        foreach ($depart as $key => $value) {
				//$list[$key]=M('page')->where('class_id='.$value['mid'])->select();
            $in.=$value['mid'].",";
        }

			//获取相关的新闻
        $news['hid']=array('like','%'.$hid.'%');
        $news=M('article')->where($news)->order('time desc')->limit(0,15)->select();
        $count=count($news);
        if($count<15){
            $oneNews=M('article')->where('class_id=1 and hospitaltype='.$r['type_cn'])->order('time desc')->limit(0,15-$count)->select();
        }
        $count2=count($oneNews);
        if($count+$count2 <15){
            $twoNews=M('article')->where('class_id=1')->order('time desc')->limit(0,15-($count+$count2))->select();
        }
		    //相关解答信息
        $faq=M('single')->where('typeid > 1')->limit(0,10)->select();
        $in=trim($in,',');
        $mpa['class_id']  = array('in',$in);
			$count = M('page')->where($mpa)->count();// 查询满足要求的总记录数
			$map['hid']=$hid;
			$map['rank']=array('lt',50);
			$depart_4 = $model->where($map)->order('rank')->limit(0,5)->select();
			/**坐标处理**/
			$r["zuobiao"]=explode(",",$r["coords"]);
			$this->assign('oneNews',$oneNews);
			$this->assign('twoNews',$twoNews);
			$this->assign('depart_1',$depart_1); 
			$this->assign('depart_2',$depart_2);
			$this->assign('depart_3',$depart_3);
			$this->assign('depart_4',$depart_4);
			$this->assign('zy',$zy);
			$this->assign('nums',$nums);
			$this->assign('faq',$faq);
			$this->assign('news',$news);
			$this->assign('count',$count);
			$this->assign('r',$r);
			$this->assign('id',$id);
			//$re=$v['name_en'];
            $names=preg_replace('/[~!@#$%()\^&*,.?;:\'\"\/]/', '', $r['name_en']);
            $str=str_replace(" ", "-", $names);
            $html=$str.'-'.$r['id'];
            $moban=T('Extend://Home@Hospital/detail');
            $this->buildHtml($html,'./h/',$moban);
            //dump($html);
			//dump($r);
            //echo "OK";
            return true;
		//}
        }

        /* 生成医生 */
        function makedoctor($id){

            $types=M('doczy')->order('id')->limit(0,12)->select();
            $t=M('doctor')->where('id='.$id)->find();
            $hid=explode(',',$t['hid']);
            $lists=M('doctor')->where('hid='.$hid[0])->order('workyears desc')->limit(0,11)->field('id,name_en,summary_cn,specialty_cn,images,workyears,positional_cn')->select();
            $this->assign('types',$types);
            $this->assign('lists',$lists);
            $this->assign('t',$t);

        //$names=preg_replace('/[~!@#$%()\^&*,.?;:\'\"\/]/', '', $r['name_en']);
        //$str=str_replace(" ", "-", $names);
            $html=$t['id'];
            $moban=T('Extend://Home@Doctor/detail');
            $this->buildHtml($html,'./d/',$moban);
            return true;

        }

        /* 生成新闻 */
        public function makearticle($id){

            $cModel=M('article');
            $contentInfo=$cModel->where('content_id='.$id)->find();
        //获取内容页广告位
            $aModel=M('adver');
            $ad7=$aModel->where('id=7')->find();
            $ad8=$aModel->where('id=8')->find();
        // 获取当然新闻的栏目
            $lanmu=M('category')->where('class_id='.$contentInfo['class_id'])->getField('name');
        //获取收藏的次数
            $map['sc_id']=$id;
            $map['sc_type']=1;
            $num=M('collect')->where($map)->count();
        //按浏览量获取
            $nClick=$cModel->where('class_id='.$contentInfo['class_id'])->order('views')->limit(8)->select();
        //当前页面地址
        //$currentUrl=$_SERVER['REQUEST_URI'];
            $webUrl='http://'.$_SERVER['HTTP_HOST'];
            $currentUrl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
            if(empty($contentInfo['image'])){
                $contentInfo['image']=$webUrl.'/Public/home/images/hosimg.jpg';
            }
            $share=array('text'=>$contentInfo['title'],'desc'=>$contentInfo['description'],'url'=>$currentUrl,'pic'=>$contentInfo['image']);
            $this->assign('nClick',$nClick);
            $this->assign('share',$share);
            $this->assign('ad7',$ad7);
            $this->assign('ad8',$ad8);
            $this->assign('num',$num);
            $this->assign('lanmu',$lanmu);
            $this->assign('contentInfo',$contentInfo);
            $html=$id;
            $moban=T('Extend://Home@News/content');
            $this->buildHtml($html,'./p/',$moban);
            return true;

        }


function makezt($id){


        $meau=M('meau')->where('cid=0 and isview=1')->order('orders')->select();
        foreach ($meau as $key => $value) {
            $meau[$key]['class']=M('meau')->where('isview=1 and cid='.$value['id'])->order('orders asc')->select();
        }
        //dump($meau);
        //exit;
        $ob = M("config");

        $config=$ob->field('name,data')->select();
        foreach ($config as $key => $value) {
            C($value['name'],$value['data']);
        }

        $r=M('zhuanti')->where('id='.$id)->find();
        //癌症相关医院
        $oneList  = M('ranking')->where('cid=6')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($oneList as $key => $value) {
            $oneList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$oneList[$key]['hid'])->select();
        }
        //妇科相关医院
        $twoList  = M('ranking')->where('cid=10')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($twoList as $key => $value) {
            $twoList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$twoList[$key]['hid'])->select();
        }
        //精神病学相关医院
        $threeList  = M('ranking')->where('cid=12')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($threeList as $key => $value) {
            $threeList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$threeList[$key]['hid'])->select();
        }
        //心脏介入和心脏外科手术相关医院
        $fourList  = M('ranking')->where('cid=22')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($fourList as $key => $value) {
            $fourList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$fourList[$key]['hid'])->select();
        }
        //肾脏病相关医院
        $fiveList  = M('ranking')->where('cid=11')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($fiveList as $key => $value) {
            $fiveList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$fiveList[$key]['hid'])->select();
        }
        //肺病相关医院
        $sixList  = M('ranking')->where('cid=14')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($sixList as $key => $value) {
            $sixList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$sixList[$key]['hid'])->select();
        }
        //糖尿病及内分泌相关医院
        $sevenList  = M('ranking')->where('cid=16')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($sevenList as $key => $value) {
            $sevenList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$sevenList[$key]['hid'])->select();
        }
        //神经病学与神经外科学相关医院
        $eightList  = M('ranking')->where('cid=5')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($eightList as $key => $value) {
            $eightList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$eightList[$key]['hid'])->select();
        }
        //复原相关医院
        $nineList  = M('ranking')->where('cid=23')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($nineList as $key => $value) {
            $nineList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$nineList[$key]['hid'])->select();
        }
        //耳，鼻和咽喉相关医院
        $tenList  = M('ranking')->where('cid=7')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($tenList as $key => $value) {
            $tenList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$tenList[$key]['hid'])->select();
        }
        //眼科相关医院
        $elevenList  = M('ranking')->where('cid=28')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($elevenList as $key => $value) {
            $elevenList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$elevenList[$key]['hid'])->select();
        }
        //风湿病相关医院
        $twelveList  = M('ranking')->where('cid=31')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($twelveList as $key => $value) {
            $twelveList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$twelveList[$key]['hid'])->select();
        }
        //消化内科和外科GI相关医院
        $thirteenList  = M('ranking')->where('cid=8')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($thirteenList as $key => $value) {
            $thirteenList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$thirteenList[$key]['hid'])->select();
        }
        //骨科相关医院
        $fourteenList  = M('ranking')->where('cid=13')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($fourteenList as $key => $value) {
            $fourteenList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$fourteenList[$key]['hid'])->select();
        }
        //泌尿科相关医院
        $fiveteenList  = M('ranking')->where('cid=15')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($fiveteenList as $key => $value) {
            $fiveteenList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$fiveteenList[$key]['hid'])->select();
        }
        //老年病学相关医院
        $sixteenList  = M('ranking')->where('cid=9')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($sixteenList as $key => $value) {
            $sixteenList[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$sixteenList[$key]['hid'])->select();
        }

        //癌症相关医院
        $oneLists = M('ranking')->where('cid=17')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($oneLists as $key => $value) {
            $oneLists[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$oneLists[$key]['hid'])->select();
        }
        //新生儿相关医院
        $twoLists  = M('ranking')->where('cid=19')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($twoLists as $key => $value) {
            $twoLists[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$twoLists[$key]['hid'])->select();
        }
        //儿童骨科相关医院
        $threeLists  = M('ranking')->where('cid=21')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($threeLists as $key => $value) {
            $threeLists[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$threeLists[$key]['hid'])->select();
        }
        //儿童心脏介入和心脏外科手术相关医院
        $fourLists  = M('ranking')->where('cid=24')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($fourLists as $key => $value) {
            $fourLists[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$fourLists[$key]['hid'])->select();
        }
        //儿童肾脏病相关医院
        $fiveLists  = M('ranking')->where('cid=20')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($fiveLists as $key => $value) {
            $fiveLists[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$fiveLists[$key]['hid'])->select();
        }
        //肺病相关医院
        $sixLists  = M('ranking')->where('cid=26')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($sixLists as $key => $value) {
            $sixLists[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$sixLists[$key]['hid'])->select();
        }
        //糖尿病及内分泌相关医院
        $sevenLists  = M('ranking')->where('cid=18')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($sevenLists as $key => $value) {
            $sevenLists[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$sevenLists[$key]['hid'])->select();
        }
        //神经病学与神经外科学相关医院
        $eightLists  = M('ranking')->where('cid=29')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($eightLists as $key => $value) {
            $eightLists[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$eightLists[$key]['hid'])->select();
        }
        //复原相关医院
        $nineLists  = M('ranking')->where('cid=27')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($nineLists as $key => $value) {
            $nineLists[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$nineLists[$key]['hid'])->select();
        }
        //耳，鼻和咽喉相关医院
        $tenLists  = M('ranking')->where('cid=25')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,7)->select();
        foreach ($tenLists as $key => $value) {
            $tenLists[$key]['class']=M('hospital')->field('id,name_cn,province_cn,city_cn,hos_images')->where("hid='%s'",$tenLists[$key]['hid'])->select();
        }

        //心血管
        $heartList  = M('ranking')->where('cid=6')->group('hid')->field('hid,rank')->order('rank asc')->limit(0,8)->select();
        foreach ($heartList as $key => $value) {
            $heartList[$key]['class']=M('hospital')->field('id,name_cn,summary_bc,hos_images')->where("hid='%s'",$heartList[$key]['hid'])->select();
        }

        $news=M('article')->order('time desc')->limit(0,40)->select();
        $doc=M('doctor')->where('specialty_cn=34')->order('workyears desc')->limit(0,10)->select();
        $this->assign('doc',$doc);
        $this->assign('news',$news);
        $this->assign('heartList',$heartList);
        $this->assign('oneList',$oneList);
        $this->assign('twoList',$twoList);
        $this->assign('threeList',$threeList);
        $this->assign('fourList',$fourList);
        $this->assign('fiveList',$fiveList);
        $this->assign('sixList',$sixList);
        $this->assign('sevenList',$sevenList);
        $this->assign('eightList',$eightList);
        $this->assign('nineList',$nineList);
        $this->assign('tenList',$tenList);
        $this->assign('elevenList',$elevenList);
        $this->assign('twelveList',$twelveList);
        $this->assign('thirteenList',$thirteenList);
        $this->assign('fourteenList',$fourteenList);
        $this->assign('fiveteenList',$fiveteenList);
        $this->assign('sixteenList',$sixteenList);
        $this->assign('oneLists',$oneLists);
        $this->assign('twoLists',$twoLists);
        $this->assign('threeLists',$threeLists);
        $this->assign('fourLists',$fourLists);
        $this->assign('fiveLists',$fiveLists);
        $this->assign('sixLists',$sixLists);
        $this->assign('sevenLists',$sevenLists);
        $this->assign('eightLists',$eightLists);
        $this->assign('nineLists',$nineLists);
        $this->assign('tenLists',$tenLists);
        $this->assign('bannon',$meau); 
        $this->assign('r',$r);
        $this->assign('name',"Home@Zhuanti/".$r['url']);

        $html=$r['url'];
        $moban=T('Extend://Home@Zhuanti/index');
        $this->buildHtml($html,'./zt/',$moban);
        return true;

}


    function makesingle($id){

        $meau=M('meau')->where('cid=0 and isview=1')->order('orders')->select();
        foreach ($meau as $key => $value) {
            $meau[$key]['class']=M('meau')->where('isview=1 and cid='.$value['id'])->order('orders asc')->select();
        }
        //dump($meau);
        //exit;
        $ob = M("config");

        $config=$ob->field('name,data')->select();
        foreach ($config as $key => $value) {
            C($value['name'],$value['data']);
        }

        $single=M('single');
        $r=$single->where('id=%d',$id)->find();

        $single=M('single');
        $r=$single->where('id=%d',$id)->find();
        $list=$single->where('typeid=1')->select();

        $type=M('singletype')->where('parent_id=2')->order('sort')->select();

        foreach ($type as $key => $value) {
            $type[$key]['url']=$this->getSingleList($type[$key]['class_id']);       
            
        } 
        $this->assign('bannon',$meau); 
        $this->assign('r',$r);
        $this->assign('type',$type);

        $html=$r['url'];
        $moban=T('Extend://Home@Single/faq');
        $this->buildHtml($html,'./faq/',$moban);
        return true;
    }

    private function getSingleList($id){
        $map['typeid']=$id;
        $list=M('single')->field('id,title')->where($map)->select();
        foreach ($list as $key => $value) {
            $href=getSingleUrl($list[$key]['id']);
            $info.="<a href='".$href."' class='am-u-md-6'>".$list[$key]['title']."</a>";

        }
        return $info;
    }




        function updateHtml(){
            $type=I('get.type');
            $model=M($type);
            $data = array();
            $counts=$model->count();
            if(IS_POST){
                $n=intval($_POST['n']);      
                if ( $n != '999999') {
                    if ($n>$counts){
                        $n = '999999';
                        $data = array('n' => $n, 'msg' => '<li>恭喜，全部数据已经更新完成！！！</li>','speed'=>'100');
                        $data=json_encode($data);
                        echo $data;
                        exit;
                    }
                    for ($i = $n; $i <=$counts; $i++){
                        layout(false);
                        $start=$n-1;
                        $hos=$model->limit($start,1)->select();
                        switch ($type) {
                            case 'hospital':
                            $re=$this->makehospital($hos[0]['id']);
                            $name=$hos[0]['name_cn'];
                            break;
                            case 'doctor':
                            $re=$this->makedoctor($hos[0]['id']);
                            $name=$hos[0]['name_en'];
                            break;
                            case 'article':
                            $re=$this->makearticle($hos[0]['content_id']);
                            $name=$hos[0]['title'];
                            break;
                            case 'zhuanti':
                            $re=$this->makezt($hos[0]['id']);
                            $name=$hos[0]['title'];
                            break;
                            case 'single':
                            $re=$this->makesingle($hos[0]['id']);
                            $name=$hos[0]['title'];
                            break;
                            default:
                            # code...
                            break;
                        }
                        if ($re) {

                         $message = '<li style="color:green;">第'.$i.'条数据更新成功！'.$name.'</li> ';

                     } else {
                        $message = '<li style="color:red;">第'.$i.'条数据更新失败！</li> ';
                    }
                    $i++;
                    $data = array('n' =>$i, 'msg' => $message,'speed'=>floor(($i-1)/$counts*10000)/100);
                    $data=json_encode($data);
                    echo $data;
                    exit;
                }
            }
        }else{
            $data=array('n'=>'1','msg'=>'准备更新。。。','speed'=>'1');
            $data=json_encode($data);
            $this->assign('data',$data);
            $this->assign('active','Index');
            $this->assign('type',$type);
            $this->assign('init',$this->init());
            $this->assign('a','mh');
            $this->assign('info',"管理首页");
            $this->assign('desc',"站点运行信息");
            $this->display('');
        }
    }


    function onehospital(){
        layout(false);
        $id=$_GET['id'];
        $this->makehospital($id);
    }

}
