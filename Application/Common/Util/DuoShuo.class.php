<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://826v.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: qiandutianxia <852997402@qq.com>
// +----------------------------------------------------------------------
namespace Common\Util;
/**
 *  多说评论扩展类
 */
class Duoshuo {
    // 站点注册的多说二级域名
    private $short_name;
    //站点密钥
    private $secret;

    public function __construct(){
        $this->short_name="fuzhenwang";
        $this->secret="88c7c1bfe653ac6c7d21b6ddb3dab0d3";
    }

    /**
     * 获取文章评论、转发数
     * @param  id(int) 文章id
     * return response(json) 包含评论数和转发数
     **/
    public function getComments($id){
        $url="http://api.duoshuo.com/threads/counts.json";
        $param['short_name']=$this->short_name;
        $param['threads']=$id;
        $param =http_build_query($param,'','&');
        $url=$url."?".$param;
        $response=$this->getUrl($url);
        if(empty($response)) exit("返回结果错误");
        if(json_decode($response)->code==0){
            return $response;
        }else{
            exit(json_decode($response)->errorMessage);
        }
    }

    /**
     * 获取热评文章
     * @param range 可选值daily：每日热评文章 weekly：每周热评文章 monthly：每月热评文章；all：总热评文章
     * @param num_items(int)评论的条数 默认是5条
     * @param channel_key(int) 文章所属分类
     * return response(json) 包含文章的id，title等信息
     **/
    public function getTop($range="all",$num_items=5,$channel_key=""){
        $url="http://api.duoshuo.com/sites/listTopThreads.json";
        $param['short_name']=$this->short_name;
        $param['range']=$range;
        $param['num_items']=$num_items;
        $param['channel_key']=$channel_key;
        $param =http_build_query($param,'','&');
        $url=$url."?".$param;
        $response=$this->getUrl($url);
        if(empty($response)) exit("返回结果错误");
        if(json_decode($response)->code==0){
            return $response;
        }else{
            exit(json_decode($response)->errorMessage);
        }
    }

    /**
     * 获取文章评论
     * @param range 可选值daily：每日热评文章 weekly：每周热评文章 monthly：每月热评文章；all：总热评文章
     * @param id(int) 文章id
     * @param page(int) 获取第几页
     * @param limit(int) 每一页显示的条数
     * @param order(string)  返回的评论的排序规则，可选择desc或者asc，默认是desc
     * return response(json)
     **/
    public function getComment($id,$page,$limit,$order="desc"){
        $url="http://api.duoshuo.com/threads/listPosts.json";
        $param['short_name']=$this->short_name;
        $param['thread_key']=$id;
        $param['page']=$page;
        $param['limit']=$limit;
        $param['order']=$order;
        $param =http_build_query($param,'','&');
        $url=$url."?".$param;
        $response=$this->getUrl($url);
        if(empty($response)) exit("返回结果错误");
        if(json_decode($response)->code==0){
            return $response;
        }else{
            exit(json_decode($response)->errorMessage);
        }
    }

    /**
     * 获取多说用户信息
     * @param id 用户id
     * return response(json)
     **/
    public function getUsrInfo($id){
        $url="http://api.duoshuo.com/users/profile.json";
        $param['user_id']=$id;
        $param =http_build_query($param,'','&');
        $url=$url."?".$param;
        $response=$this->getUrl($url);
        if(empty($response)) exit("返回结果错误");
        if(json_decode($response)->code==0){
            return $response;
        }else{
            exit(json_decode($response)->errorMessage);
        }
    }

    /**
     * 同步用户到多说
     * @param usr(array) 是一个数组可以是一维数组也可以是二维
     * 例如：$usr['user_key']=1111  这个一般就是用户数据库的ID
     * $usr['name']="zhangsan" 这个一般就是用户数据库的name
     * 可选参数role(角色)，avatar_url(头像)，url(网站)，email(邮箱)，created_at(时间)
     **/
    public function syncUsr($usr){
        $url="http://api.duoshuo.com/users/import.json";
        $param['short_name']=$this->short_name;
        $param['secret']=$this->secret;
        $s=$this->isOneOrTwo($usr);
        if($s==1){
            $param['users'][]=$usr;
        }else{
            foreach($usr as $k=>$v){
                $param['users']=$v;
            }
        }
        $param =http_build_query($param,'','&');
        $response=$this->postUrl($url,$param);
        if(empty($response)) exit("返回结果错误");
        if(json_decode($response)->code==0){
            return $response;
        }else{
            exit(json_decode($response)->errorMessage);
        }
    }

    /**
     * SSO登录用户同步到多说
     * 多说的js代码中设置回调登录地址 然后回调地址中有code
     **/
    public function ssoSync($code){
        $url="http://api.duoshuo.com/sites/join.json";
        $param['short_name']=$this->short_name;
        $param['code']=$code;
        $param =http_build_query($param, '', '&');
        $response=$this->postUrl($url,$param);
        if(empty($response)) exit("返回结果错误");
        if(json_decode($response)->code==0){
            return $response;
        }else{
            exit(json_decode($response)->errorMessage);
        }
    }

    //判断是几维数组
    private function isOneOrTwo($arr){
        if(is_array($arr)){
            $s=1;
            foreach($arr as $v){
                if(is_array($v)){
                    $s=2;
                    break;
                }
            }
            return $s;
        }else{
            exit("数组错误");
        }
    }

    //CURL GET
    private function getUrl($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        if (!empty($options)){
            curl_setopt_array($ch, $options);
        }
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    //CURL POST
    private function postUrl($url,$post_data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        ob_start();
        curl_exec($ch);
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}