<?php
namespace Common\Util;

/**
* 百度翻译插件
*/
class BaiduFanyi
{

	public $appkey="";//百度应用appkey
    public $error="";//错误信息
    public $curltimeout=5000;//curl的超时时间设置
	
    
    /**
     * 翻译
     * @param string $text 待翻译的文本
     * @param string $from 原本语言 zh=>中文 en=>英文 jp=>日文
     * @param string $to 目标语言 zh=>中文 en=>英文 jp=>日文
     * @return boolean|string 翻译的结果，若错误则返回false，否则返回一个翻译后的字符串
     */
    function fanyi($text,$from="zh",$to="en"){
        $str="";
        if(!$this->appkey){
            $this->error="未定义appkey";
            return false;
        }
        //提交的查询字符串长度不能超过5KB
        if(strlen($text)>5000){
            $this->error="文本太长";
            return FALSE;
        }
        $postdata = "from={$from}&to={$to}&client_id={$this->appkey}&q={$text}";
        $url = "http://openapi.baidu.com/public/2.0/bmt/translate";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->curltimeout);//超时时间
        $html = curl_exec($ch);
        if (curl_error($ch)) {
            $curlerr=curl_error($ch);
        }
        curl_close($ch);
        //curl发生错误时直接返回
        if(!empty($curlerr)){
            $this->error="curl错误：".$curlerr;
            return false;
        }
        //对百度返回的json数据进行decode
        $html = json_decode($html, true);
        //如果有错误信息，则返回
        if(isset($html['error_code'])){
            $baiduerr="";
            switch($html['error_code']){
                case "52001":
                    $baiduerr="超时";
                    break;
                case "52002":
                    $baiduerr="翻译系统错误";
                    break;
                case "52003":
                    $baiduerr="未授权的appkey";
                    break;
                default :
                    $baiduerr="未知的错误";
            }
            $this->error="百度返回错误：{$baiduerr}";
            return FALSE;
        }
        //处理翻译结果，将多段合并成一段
        foreach ($html['trans_result'] as $v) {        
                $str.=$v['dst']."<br/>";        
        }
        
        return $str;
    }

    //获取错误信息
    function geterror(){
        return $this->error;
    }


}

?>