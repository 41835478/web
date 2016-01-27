<?php
// +----------------------------------------------------------------------
// | CoreThink [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.corethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com> <http://www.corethink.cn>
// +----------------------------------------------------------------------

//开发者二次开发公共函数统一写入此文件，不要修改function.php以便于系统升级。

//费用计算
function getMoney($money,$percent){
    return $money*$percent;
}
//获取图片存放的地址
//如果图片不存在显示默认的图片
function getImageUrl($img){

    if (!empty($img)) {
        if ($img == "doctor-male.jpg") {
            $url = '/Uploads/doctor/doctor-male.jpg';
        }elseif ($img == "doctor-female.jpg") {
            $url = '/Uploads/doctor/doctor-female.jpg';
        }else{
            $url = '/Uploads/doctor/'.$img;
            if(!file_exists($_SERVER['DOCUMENT_ROOT'].$url)){
                $url = '/Uploads/doctor/doctor-female.jpg';
            }
        }
    }
    return $url;
}

//从医生页面获取所属的医院的名称
function getOneHospital($hid){

    $id=explode(',',rtrim($hid,','));
    $name_cn=M('hospital')->where("hid=".$id[0])->find();
    if(!empty($name_cn )){
        $url=getHospitalUrl($name_cn['id']);
        $info.="<a target='_blank' href='{$url}'>{$name_cn['name_cn']}".'&nbsp;&nbsp;</a>';
    }
    return $info;
}

//从医生页面获取所属的医院的名称
function docTohos($hid,$type){

    $id=explode(',',rtrim($hid,','));
    if(count($id)>1){
        if(!empty($type)){
            $name_cn=M('hospital')->where("hid=".$id[0])->find();
            if(!empty($name_cn )){
                $url=getHospitalUrl($name_cn['id']);
                $info.="<a target='_blank' href='{$url}'>{$name_cn['name_cn']}".'&nbsp;&nbsp;</a>';
            }
        }else{
            foreach ($id as $key => $value) {
                $name_cn=M('hospital')->where("hid=".$value)->find();
                if(!empty($name_cn )){
                    $url=getHospitalUrl($name_cn['id']);
                    $info.="<p><a target='_blank' href='{$url}'>{$name_cn['name_cn']}".'&nbsp;&nbsp;</a></p>';
                }
            }
        }
        
    }else{
        $hid=trim($hid,',');
        $name_cn=M('hospital')->where("hid=".$hid)->find();
        if(!empty($name_cn)){
            $url=getHospitalUrl($name_cn['id']);
            $info="<a target='_blank' href='{$url}'>{$name_cn['name_cn']}".'</a>';
        }
    }

    return $info;
}


function getCateTitle($cid){
    $re=M('category')->where('class_id='.$cid)->getField('name');
    return $re;
}

//获取医院的URL地址
function getHospitalUrl($id){
    $name_en=M('hospital')->where('id=%d',$id)->getField('name_en');
    $names=preg_replace('/[~!@#$%\()^&*,.?;:\'\"\/]/', '', $name_en);
    $str=str_replace(" ", "-", $names);
    $html=$str.'-'.$id;
    $url='http://hospital.fuzhen.com/'.$html.C(HTML_FILE_SUFFIX);
    return $url;
}

//获取新闻的URL地址
function getNewsUrl($id){
    $url=C('c_weburl').'/p/'.$id.C(HTML_FILE_SUFFIX);
    return $url;
}

//获取医生的URL地址
function getDoctorUrl($id){

    $name_en=M('doctor')->where('id=%d',$id)->getField('name_en');
    $names=preg_replace('/[~!@#$%\()^&*,.?;:\'\"\/]/', '', $name_en);
    $str=str_replace(" ", "-", $names);
    $html=$str.'-'.$id;
    $url='/d/'.$html.C(HTML_FILE_SUFFIX);
    return $url;
}

//获取医生的URL地址
function getZhuantiUrl($id){
    $html=M('zhuanti')->where('id=%d',$id)->getField('url');
    $url='/zt/'.$html.C(HTML_FILE_SUFFIX);
    return $url;
}

//获取医生的URL地址
function getSingleUrl($id){
    $html=M('single')->where('id=%d',$id)->getField('url');
    $url='/faq/'.$html.C(HTML_FILE_SUFFIX);
    return $url;
}

//多选
function getMultiple($class,$cid){

    $class=explode(',',$class);
    if(in_array($cid, $class)){
        return "selected='selected'";
    }else{
        return  false;
    }
}

//获取医生的工作年龄
function getDocOld($info){
    $b=preg_match_all('/\d+/',$info,$arr);
    $ToYear=date('Y');
    //dump($ToYear);
    //dump($year);
    return $ToYear-$arr[0][1];

}

//内容关键词自动加链接
//
function keyword_replace($str){

    $re=M('tags')->field('tag_id,name,url')->select();

    $array_first = $re;
    $array_last = array();
    foreach($array_first as $key=>$value){
        $array_last[$key] = array(md5($value[tag_id]), $value[name], '<a target="_blank" href="' . $value[url] . '">' . $value[name] . '</a>');    
    }
    $count = count($array_last);
    for($i=0;$i<$count;$i++){    
        for($j=$count-1;$j>$i;$j--){    
            //如果后一个元素长度大于前一个则调换位置    
            if(strlen($array_last[$j][1]) > strlen($array_last[$j-1][1])){
                $tmp = $array_last[$j];
                $array_last[$j] = $array_last[$j-1];
                $array_last[$j-1] = $tmp;
            }
        }
    }
    $keys = $array_last;
    foreach($keys as $nkeys){
        //$str = str_ireplace($nkeys[1], $nkeys[0], $str);
        if(strpos($str, $nkeys[1])!== false){
            $str=preg_replace("/$nkeys[1]/",$nkeys[2],$str,1);
        }else{
            $str=$str;
        }
    }
    foreach($keys as $nkeys){
        //$str = str_ireplace($nkeys[0], $nkeys[2], $str);
        $str=preg_replace("/$nkeys[0]/",$nkeys[2],$str,1);
    }
    $str.='<p>（注：转载时请注明复诊网）</p>';
    return $str;

}

//判断用户输入的用户名的类型
//返回值为：1 邮件   2  手机   0  用户名
function userLoginType($user){
    if(preg_match("/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$/i",$user)){
        return 1;
    }else if(preg_match("/^(1(([35][0-9])|(47)|[8][01236789]))\d{8}$/",$user)){
        return 2;
    }else{
        return 0;
    }
}



function Post($curlPost,$url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
    $return_str = curl_exec($curl);
    curl_close($curl);
    return $return_str;
}

function xml_to_array($xml){
    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
    if(preg_match_all($reg, $xml, $matches)){
        $count = count($matches[0]);
        for($i = 0; $i < $count; $i++){
            $subxml= $matches[2][$i];
            $key = $matches[1][$i];
            if(preg_match( $reg, $subxml )){
                $arr[$key] = xml_to_array( $subxml );
            }else{
                $arr[$key] = $subxml;
            }
        }
    }
    return $arr;
}

function random($length = 6 , $numeric = 0) {
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
    if($numeric) {
        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
    } else {
        $hash = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return $hash;
}

/*
php屏蔽电话号码中间四位
 */
function hidtel($phone){
     $IsWhat = preg_match('/(0[0-9]{2,3}[\-]?[2-9][0-9]{6,7}[\-]?[0-9]?)/i',$phone); //固定电话
     if($IsWhat == 1){
       return preg_replace('/(0[0-9]{2,3}[\-]?[2-9])[0-9]{3,4}([0-9]{3}[\-]?[0-9]?)/i','$1****$2',$phone);
   }else{
       return  preg_replace('/(1[358]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$phone);
   }
}

//增加网站的访问的数据
function addData(){
    //当天时间
    $time = strtotime(date('Y-m-d'));
    $where = array();
    $where['time'] = $time;
    $info = M('visitor')->where($where)->find();
    if($info){
        $where = array();
        $where['id'] = $info['id'];
        M('visitor')->where($where)->setInc('count');
    }else{
        $data = array();
        $data['time'] = $time;
        $data['count'] = 1;
        M('visitor')->add($data);
    }
}

/**
 * 判断蜘蛛爬行
 */
function addSpiderData(){
    $useragent = addslashes(strtolower($_SERVER['HTTP_USER_AGENT']));
    if (strpos($useragent, 'googlebot')!== false){$bot = 'Google';}
    elseif (strpos($useragent,'mediapartners-google') !== false){$bot = 'GoogleAdsense';}
    elseif (strpos($useragent,'baiduspider') !== false){$bot = 'Baidu';}
    elseif (strpos($useragent,'sogou spider') !== false){$bot = 'Sogou';}
    elseif (strpos($useragent,'sogou web') !== false){$bot = 'Sogouweb';}
    elseif (strpos($useragent,'sosospider') !== false){$bot = 'SOSO';}
    elseif (strpos($useragent,'360spider') !== false){$bot = '360Spider';}
    elseif (strpos($useragent,'yahoo') !== false){$bot = 'Yahoo';}
    elseif (strpos($useragent,'msn') !== false){$bot = 'MSN';}
    elseif (strpos($useragent,'msnbot') !== false){$bot = 'msnbot';}
    elseif (strpos($useragent,'sohu') !== false){$bot = 'Sohu';}
    elseif (strpos($useragent,'yodaoBot') !== false){$bot = 'Yodao';}
    elseif (strpos($useragent,'twiceler') !== false){$bot = 'Twiceler';}
    elseif (strpos($useragent,'ia_archiver') !== false){$bot = 'Alexa_';}
    elseif (strpos($useragent,'iaarchiver') !== false){$bot = 'Alexa';}
    elseif (strpos($useragent,'slurp') !== false){$bot = 'Yahoo';}
    elseif (strpos($useragent,'bot') !== false){$bot = 'other';}
    if(empty($bot)){
        return ;
    }
    //当天时间
    $time = strtotime(date('Y-m-d'));
    $where = array();
    $where['time'] = $time;
    $info = M('spider')->where($where)->find();
    if($info){
        $where = array();
        $where['id'] = $info['id'];
        M('spider')->where($where)->setInc($bot);
    }else{
        $data = array();
        $data['time'] = $time;
        $data[$bot] = 1;
        M('spider')->add($data);
    }
}


/**
 * 获取文件或文件大小
 * @param string $directoty 路径
 * @return int
 */
function dir_size($directoty)
{
    $dir_size = 0;
    if ($dir_handle = @opendir($directoty)) {
        while ($filename = readdir($dir_handle)) {
            $subFile = $directoty . DIRECTORY_SEPARATOR . $filename;
            if ($filename == '.' || $filename == '..') {
                continue;
            } elseif (is_dir($subFile)) {
                $dir_size += dir_size($subFile);
            } elseif (is_file($subFile)) {
                $dir_size += filesize($subFile);
            }
        }
        closedir($dir_handle);
    }
    return ($dir_size);
}


function getDirSize($dir)
{
    $handle = opendir($dir);
    while (false!==($FolderOrFile = readdir($handle)))
    {
        if($FolderOrFile != "." && $FolderOrFile != "..")
        {
            if(is_dir("$dir/$FolderOrFile"))
            {
                $sizeResult += getDirSize("$dir/$FolderOrFile");
            }
            else
            {
                $sizeResult += filesize("$dir/$FolderOrFile");
            }
        }   
    }
    closedir($handle);
    return $sizeResult;
}

/**
 * 遍历删除目录和目录下所有文件
 * @param string $dir 路径
 * @return bool
 */
function del_dir($dir){
    if (!is_dir($dir)){
        return false;
    }
    $handle = opendir($dir);
    while (($file = readdir($handle)) !== false){
        if ($file != "." && $file != ".."){
            is_dir("$dir/$file")?   del_dir("$dir/$file"):@unlink("$dir/$file");
        }
    }
    if (readdir($handle) == false){
        closedir($handle);
        @rmdir($dir);
    }
}


function deldir($dir) {
  //先删除目录下的文件：
  $dh=opendir($dir);
  while ($file=readdir($dh)) {
    if($file!="." && $file!="..") {
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {
          unlink($fullpath);
      } else {
          deldir($fullpath);
      }
  }
}

closedir($dh);
  //删除当前文件夹：
if(rmdir($dir)) {
    return true;
} else {
    return false;
}
}

//医院科室排名类别
//98   高分
//99   平均分
//100  低于平均分
//101  未分级

function rankClass($type){
    switch ($type) {
        case '98':
        return '优秀水平'; 
        break;
        case '99':
        return '中等水平';
            # code...
        break;
        case '100':
        return '基本水平';
            # code...
        break;
        case '101':
        return '水平不详';
            # code...
        break;
        case '102':
        return '普通水平';
            # code...
        break;   
        default:
            if($type <10){
                return '排名前十';
            }elseif ($type>10 && $type<20) {
                return '排名前二十';
            }elseif ($type>20 && $type<30) {
                return '排名前三十';
            }else{
                return '排名前五十';
            }
            # code...
        break;
    }
}

function rankScore($type){
    switch ($type) {
        case '0':
        return '无排名';
        break;
        default:
        return $type."/100";
        break;
    }
}

//$kid 医生专业的ID
function getZy($kid){
    $re = M('doczy')->where('id=%d',array($kid))->getField('name_cn');
    return $re;
}

//$kid 获取医院名称
function getHosName($hid){

    $id=explode(',',rtrim($hid,','));
    if(count($id)>1){
        $name_cn=M('hospital')->where("hid='%s'",$id[1])->find();
        if(!empty($name_cn)){
            $url=getHospitalUrl($name_cn['id']);
            $info="<a target='_blank' href='{$url}'>{$name_cn['name_cn']}</a>";
        }else{
            $info="私人医生";            
        }

    }else{
        $hid=trim($hid,',');
        $name_cn=M('hospital')->where("hid=".$hid)->find();
        if(!empty($name_cn)){
            $url=getHospitalUrl($name_cn['id']);
            $info="<a target='_blank' href='{$url}'>{$name_cn['name_cn']}</a>";
        }
    }

    return $info;
}

//从教育背景中获取第一个年份
//
function getDocYear($id){
    $r=M('doctor')->where('id='.$id)->getField('education_cn');
    $b=preg_match_all('/\d+/',$r,$arr);
    $yeaes=$arr[0][0];
    return $yeaes;
}



//$kid 获取医院所有医生的科室名称
function getHosdoc($kid){
    $re = M('doczy')->where('id=%d',array($kid))->getField('name_cn');
    return $re;
}

function getHosdocDesc($kid){
    $re = M('doczy')->where('id=%d',array($kid))->getField('desc_cn');
    return $re;   
}

//$kid 获取医院科室的名称(缩写)
function getHosZy($kid){
    $re = M('hospitalclass')->where('id=%d',array($kid))->getField('name_jh');
    return $re;
}

//$kid 获取医院科室的名称(全名)
function getHosAll($kid){
    $re = M('hospitalclass')->where('id=%d',array($kid))->getField('name_cn');
    return $re;
}

//$kid 获取医院类型的名称
function getHosType($kid){
    $list=M('hospitaltype')->where('id='.$kid)->find();
    $re=$list['name_cn'];
    return $re;
}

function getMeauDesc($rank){
    $re = M('meau')->where('id=%d',array($rank))->getField('description');
    return $re;  
}

//获取医院服务的等级
function getServer($id){

    switch ($id) {
        case 1:
        $re="差";
        break;
        case 2:
        $re="中等";
        break;
        case 3:
        $re="非常好";
        break;
    }
    return $re;
}

//获取医院的星级
function getStar($hid,$rank){
    if($rank==0){
        //$map['hid']=$hid;
        $r=M('ranking')->where("hid='%s'",$hid)->order('score desc')->limit(0,1)->find();
        $num=(int)$r['score'];
        if ($num==100||$num==99) {
            for ($i=0; $i < 5; $i++) { 
                $info.="<span class='am-fl start'></span>";
            }
        }elseif($num<99&&$num>=90){
            for ($i=0; $i < 4; $i++) { 
                $info.="<span class='am-fl start'></span>";
            }
            $info.="<span class='am-fl starts'></span>";
        }else{
            for ($i=0; $i < 3; $i++) { 
                $info.="<span class='am-fl start'></span>";
            }
            $info.="<span class='am-fl starts'></span>";
            $info.="<span class='am-fl starts'></span>";
        }

    }else{
        for ($i=0; $i < $rank; $i++) { 
            $info.="<span class='am-fl start'></span>";
        }
        for ($i=0; $i < (5-$rank); $i++) { 
            $info.="<span class='am-fl starts'></span>";
        }
    }
    return $info;
}
//获取医院的星级
function getStarNum($hid){
    //$map['hid']=$hid;
    $r=M('ranking')->where("hid='%s'",$hid)->order('score desc')->limit(0,1)->find();
    $num=(int)$r['score'];
    if($num==100||$num==99){
        $info=5;
    }elseif($num<99&&$num>=90){
        $info=4;
    }else{
        $info=3;
    }
    return $info;
}


//获取医院的星级
function getDocStar($id){

        $workyears=M('doctor')->where('id='.$id)->getField('workyears');
        if ($workyears>50) {
            for ($i=0; $i < 5; $i++) { 
                $info.="<span class='am-fl start'></span>";
            }
        }elseif($workyears>30 && $workyears<50){
            for ($i=0; $i < 4; $i++) { 
                $info.="<span class='am-fl start'></span>";
            }
            $info.="<span class='am-fl starts'></span>";
        }elseif ($workyears>20 && $workyears<30) {
            for ($i=0; $i < 3; $i++) { 
                $info.="<span class='am-fl start'></span>";
            }
            $info.="<span class='am-fl starts'></span>";
            $info.="<span class='am-fl starts'></span>";
        }elseif ($workyears>10 && $workyears<20) {
            $info.="<span class='am-fl start'></span>";
            $info.="<span class='am-fl start'></span>";
            $info.="<span class='am-fl starts'></span>";
            $info.="<span class='am-fl starts'></span>";
            $info.="<span class='am-fl starts'></span>";
        }else{
            $info.="<span class='am-fl start'></span>";
            $info.="<span class='am-fl starts'></span>";
            $info.="<span class='am-fl starts'></span>";
            $info.="<span class='am-fl starts'></span>";
            $info.="<span class='am-fl starts'></span>";
        }

    return $info;
}

//获取医生的星级
//$id 医生的ID
function getDocStarNum($id){

    $workyears=M('doctor')->where('id='.$id)->getField('workyears');
    if ($workyears>10 && $workyears<20) {
        return 2;
    }elseif ($workyears>20 && $workyears<30) {
        return 3;
    }elseif ($workyears>30 && $workyears<50) {
        return 4;
    }elseif ($workyears>50) {
        return 5;
    }else{
        return 1;
    }

}

//$kid 医院的ID
//获取医院科室的排行
function getRank($hid,$cid,$id){
    $info="";
    //$map['hid']=$hid;
    //$map['cid']=$id;
    //$map['rank']=array('lt',50);
    $re = M('ranking')->where("cid=%d and hid='%s' and rank < 50",array($cid,$hid))->order('rank')->limit(0,1)->select();
    foreach ($re as $key => $value) {
        $info .="<li class='rankbox'><p class='ranktitle'><a href='".U('/ranking',array('id'=>$id))."'>".getHosZy($value['cid'])."</a></p><p class='rankno'>$value[rank]</p><p class='rankbottom'>复诊排行</p></li>";
    }
    return $info;
}

//$kid 医院的ID
//获取医院科室的排行(前四)
function getDocRank($hid){
    $numid=explode(',',rtrim($hid,','));
    if(count($numid)>1){
        foreach ($numid as $k => $v) {
            $re = M('ranking')->where("hid='%s' and rank < 100",$v)->order('rank')->limit(0,4)->select();
            if(!empty($re)){
                $info .="<h4  style='border-left: 5px solid #FFA200; padding-left: 5px'>医院科室水平：".docTohos($v)."</h4>";
                $info .="<div class='radius_box am-cf'>";
                foreach ($re as $key => $value) {
                    $info .="<div class='radius_one radius_one_r am-fl'>";
                    $info .="<canvas id='procanvas".$k.'h'.$key."' class='procanvas' value='{$value['score']}%'></canvas>";
                    $info .="<div class='radius_o'>".getHosZy($value['cid'])."<span>第{$value['rank']}名</span></div>";
                    $info .="</div>";
                    $info .="<script>process('procanvas".$k.'h'.$key."',100,100)";
                    $info .="</script>";
                }
                $info .="</div>";
            }
        }

    }else{

        $info .="<h4  style='border-left: 5px solid #FFA200; padding-left: 5px'>医院科室水平：".docTohos($hid)."</h4>";
        $info .="<div class='radius_box am-cf'>";
        $re = M('ranking')->where("hid='%s' and rank < 100",$hid)->order('rank')->limit(0,4)->select();
        foreach ($re as $key => $value) {
            $info .="<div class='radius_one radius_one_r am-fl'>";
            $info .="<canvas id='procanvas".($key+1)."' class='procanvas' value='{$value['score']}%'></canvas>";
            $info .="<div class='radius_o'>".getHosZy($value['cid'])."<span>第{$value['rank']}名</span></div>";
            $info .="</div>";
            $info .="<script>process('procanvas".($key+1)."',100,100)";
            $info .="</script>";
        }
        $info .="</div>";
    }

    return $info;
}




function getHosRank($hid){

    $info="";
    //$map['hid']=$hid;
    //$map['rank']=array('lt',100);
    $re = M('ranking')->where("hid='%s' and rank < 50",$hid)->order('rank')->limit(0,1)->select();
    foreach ($re as $key => $value) {
        $info .="<li class='rankbox'><p class='ranktitle'><a href='".U('/ranking',array('id'=>$id))."'>".getHosZy($value['cid'])."</a></p><p class='rankno'>$value[rank]</p><p class='rankbottom'>复诊排行</p></li>";
    }
    return $info;
}

//获得建院年数
function getYearNum($year){
    $ToYear=date('Y');
    //dump($ToYear);
    //dump($year);
    if($year == 9999){
        $years="不详";
    }else{
        $years=$ToYear-$year."年";
    }
    return $years;
}

//组合医院的简介
function getDesc($id){

    $r=M('hospital')->where('id='.$id)->find();
    $info.=$r['name_cn'].'，坐落于'.$r['province_cn'].'的'.$r['city_cn'].',';

    if(!empty($r['hos_years'])){
        $info.='始建于'.$r['hos_years'].'年';
    }
    if(!empty($r['suoshu'])){
        $info.=',所属'.$r['suoshu'];
    }
    if(!empty($r['xingzhi'])){
        $info.=',是一所'.$r['xingzhi'].'性质的';
    }
    if(!empty($r['type_cn'])){
        $info.=getHosType($r['type_cn']);
    }
    if(!empty($r['bed_num'])){
        $info.=',该医院设床位'.$r['bed_num'].'张';
    }
    if(!empty($r['doc_num'])){
        $info.=',拥有医生数量'.$r['doc_num'];
    }
    if(!empty($r['acc_num'])){
        $info.=',年接诊人数'.$r['acc_num'].'次';
    }
    if(!empty($r['sur_num'])){
        $info.=',手术'.$r['sur_num'].'次';
    }
    if(!empty($r['hos_num'])){
        $info.=',住院人数'.$r['hos_num'].'次';
    }
    if(!empty($r['eme_num'])){
        $info.=',其急诊室有'.$r['eme_num'];
    }

    $model=M('ranking');
    $depart_1 = $model->where("type=%d and hid='%s' and rank<10",array(1,$r['hid']))->order('rank')->select();
    $depart_2 = $model->where("type=%d and hid='%s' and rank<10",array(2,$r['hid']))->order('rank')->select();
    $depart_3 = $model->where("type=%d and hid='%s' and rank<10",array(3,$r['hid']))->order('rank')->select();

    if(!empty($depart_2)){
        $info.='。医院拥有成人科室:';
        foreach ($depart_2 as $key => $value) {
            $info.=getHosAll($value['cid']).'、';
        }
    }

    if(!empty($depart_1)){
        $info.='。儿童科室:';
        foreach ($depart_1 as $key => $value) {
            $info.=getHosAll($value['cid']).'、';
        }
    }

    if(!empty($depart_3)){
        $info.='可参与临床研究科室:';
        foreach ($depart_3 as $key => $value) {
            $info.=getHosAll($value['cid']).'、';
        }
    }

    if($r['carf'] == 1){
        $info.=',被授予委员会认可的康复设施（ CARF ）';
    }

    return $info;
}

//根据|||拆分成列表
function getList($string){
    $arr=explode("|||",$string);
    if(count($arr)>1){
        foreach ($arr as $key => $value) {
            $info.="<p>$value</p>";
        }
        return $info;
    }else{
        return $string;
    }
}

//获取有多少条信息
function getListNum($string){
    return count(explode("|||",$string));
}

//获取有多少条信息
function getListNumHospital($string){
    return count(explode(",",$string));
}

function getImages($string){

    if(!empty($string)){
        $arr=explode("|||",$string);
        foreach ($arr as $key => $value) {
            # code...
            $info.="<div class='radius clearfix' draggable='true' style='float:left;'>";
            $info.="<a alt='删除' href='javascript:;' class='del'><img width='45' height='45' src='{$value}''></a>";
            $info.="<div class='media-body'>";
            $info.="<input type='hidden' value='{$value}' class='input' name='image[url][]'>";
            $info.="</div>";
            $info.="</div>";
        }
    }else{
        $info="";
    }
    return $info;
}

/*医院页面轮播图*/
function getLunbo($string){
    $arr=explode("|||",$string);
    foreach ($arr as $key => $value) {
        $info.="<li><img src='{$value}' height='360' width='360' ></li>";
    }
    return $info;
}

/*医院缩略图*/
function getHospitalPic($string){
    $arr=explode("|||",$string);
    foreach ($arr as $key => $value) {
        $imgUrl=$value;
        break;
    }
    if (empty($imgUrl)) {
        $imgUrl="/Public/home/images/hosimg_large.png";
    }     
    return $imgUrl;
}

/*获取文章缩略图*/
function getPic($string){
    $preg = "/<img.*?src=[\'\"](.+?)[\'\"].*?>/i"; 
    preg_match_all($preg, $string, $match); 
//print_r($match); 
    return $match[1][0]; 
}
/**
 * 返回节点权限列表(多维数组)
 * @param array $node 节点数据数组
 * @param array $access 权限数据数组
 * @param integer $pid 父级id
 * @return array
 */
function node2layer($node, $access = null, $pid = 0) {

    if($node == '') return array();
    $arr = array();

    foreach ($node as $v) {
        if (is_array($access)) {

            $v['access'] =in_array($v['id'], $access)? 1 : 0;
        }
        if ($v['pid'] == $pid) {
            $v['child'] = node2layer($node, $access, $v['id']);
            $arr[] =$v;
        }
    }
    return $arr;
}


function getArcicleType($id){
    return $re=M('category')->where('class_id='.$id)->getField('name');
}

//获取相关分类下的新闻数量
function getArticleNum($id){
    $count=M('article')->where('class_id='.$id)->count();
    return $count;
}

/**
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean 检测结果
 */
function check_verify($code, $vid = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $vid);
}


function getHostpitalClass($hid){
    $list=M('hosdoc')->where("hid='%s'",$hid)->limit(0,8)->select();
    //dump($hid);
    foreach ($list as $key => $value) {
        $info.=M("hospitalclass")->where('id=%d',$value['kid'])->getField('name_cn');
        $info.=",";
        //dump($info);
    }
    return $info;
}