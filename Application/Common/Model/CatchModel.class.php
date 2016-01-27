<?php
namespace Common\Model;
use Think\Model;

class CatchModel extends Model{

    //完成
    Protected $autoCheckFields = false;

    /**
     * 获取缓存列表
     * @param int $key 缓存key
     * @return array 用户信息
     */
    public function getCacheList($key = '')
    {
        $list = array(
            'logs' => array('id'=>'logs','name'=>'应用日志目录', 'dir'=>RUNTIME_PATH.'Logs', 'size'=>(dir_size(RUNTIME_PATH.'Logs')%1024).'KB'),
            'cache' => array('id'=>'cache','name'=>'模板缓存目录', 'dir'=>RUNTIME_PATH.'Cache', 'size'=>(dir_size(RUNTIME_PATH.'Cache')%1024).'KB'),
            'temp' => array('id'=>'temp','name'=>'应用缓存目录', 'dir'=>RUNTIME_PATH.'Temp', 'size'=>(dir_size(RUNTIME_PATH.'Temp')%1024).'KB'),
            'data' => array('id'=>'data','name'=>'应用数据目录', 'dir'=>RUNTIME_PATH.'Data', 'size'=>(dir_size(RUNTIME_PATH.'Data')%1024).'KB'),
            );
        if($key){
            return $list[$key];
        }
        return $list;
    }
    /**
     * 清空指定缓存
     * @param int $key 缓存key
     * @return array 用户信息
     */
    public function delCache($key)
    {
        $info = $this->getCacheList($key);
        if(empty($info)){
            return;
        }
        $file = $info['dir'];
        if(is_dir($file)){
            deldir($file);
        }elseif(is_file($file)){
            unlink($file);
        }
        return true;
    }

		
}