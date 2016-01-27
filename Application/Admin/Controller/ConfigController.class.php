<?php
namespace Admin\Controller;
use Think\Controller;
/**
*  
*/
class ConfigController extends AdminController
{

	protected function init(){
        return array(
        'menu' => array(
                array(
               'name' => '站点信息',
               'icon' => 'list',
               'url' => U('adList'),
               ),
            ),
        );
    }
    
    protected function db(){
        return array(
        'menu' => array(
                    array(
                    'name' => '备份列表',
                    'icon' => 'list',
                    'url' => U('sysBackup'),
                    ),
                ),
        'add' => array(
                'name' => '添加备份',
                'icon' => 'plus',
                'url' => U('sysAddBk'),
            ),
        );
    }
	
    /**
     * 访问统计
     */
    public function tj(){
        $breadCrumb = array('访问统计'=>U());
        $meau=getAdminMeau();
        $this->assign('meau',$meau);
        $this->assign('a','tj');
        $this->assign('info',"访问统计");
        $this->assign('active','Index');
        $this->assign('breadCrumb',$breadCrumb);
        $this->assign('jsonArray1',D('Visitor')->getJson(7,'day','m-d'));
        $this->assign('jsonArray2',D('Visitor')->getJson(30,'day','m-d'));
        $this->assign('jsonArray3',D('Visitor')->getJson(12,'month','Y-m'));
        $this->display('visitor');
    }
 

public function sysUpload(){
        $cModel = M('config');
        if(IS_POST){

            $list = $_POST;
            foreach ($list as $k => $v) {
                $currentData = array();
                $currentData['data'] = $v;
                $state = $cModel->where('name = "'.$k.'"')->save($currentData);
                if($state === false){
                    $this->error('修改失败！');
                }
            }
            $this->success("修改网站配置信息成功！");
 
        }else{

           $list = $cModel->where('groupid = 1')->select();

            foreach ($list as $key => $value) {
                $config[$value['name']] = $value['data'];
            }

            $meau=getAdminMeau();
            $this->assign('config',$config);
            $this->assign('init',$this->init());
            $this->assign('active','Sys');
            $this->assign('meau',$meau);
            $this->assign('info',"上传配置");
            $this->assign('a','su');
            $this->display('sysUpload');  

        }

    }

    /**
     * 站点缓存设置
     */
    public function sysCatch(){

            $this->assign('list',D('Catch')->getCacheList());
            $this->assign('active','Sys');
            $this->assign('info',"网站缓存");
            $this->assign('a','st');
            $this->display('sysCatch');

    }


    public function catchDel(){
            layout(false);
            $key = $_POST['data'];
            if(empty($key)){
                $this->error('没有获取到清除动作！');
            }
            if(D('Catch')->delCache($key)){
                $this->success('缓存清空成功！');
            }else{
                $this->error('缓存清空失败！');
            }
    }

    //备份数据库
    public function sysBackup(){

            $dbModel = D('Database');
            $dblist = $dbModel->backupList();

            $meau=getAdminMeau();
            $this->assign('list',$dblist);
            $this->assign('config',$config);
            $this->assign('init',$this->db());
            $this->assign('active','Sys');
            $this->assign('meau',$meau);
            $this->assign('info',"数据备份");
            $this->assign('a','sb');
            $this->display('sysBackup');
    }


    public function sysAddBk(){
        if(IS_POST){

            $type = $_POST['type'];
            switch ($type) {
                case 1:
                    $action = 'optimizeData';
                    break;
                case 2:
                    $action = 'repairData';
                    break;
                default:
                    $action = 'backupData';
                    break;
            }

            if(D('Database')->$action()){
                $this->success('数据库操作执行完毕！');
            }else{
                $msg = D('Database')->error;
                if(empty($msg)){
                    $this->error('数据库操作执行失败');
                }else{
                    $this->error($msg);
                }
                
            }

        }else{

            //查询数据
            $list = D('Database')->loadTableList();

            $meau=getAdminMeau();
            $this->assign('list',$list);
            $this->assign('config',$config);
            $this->assign('init',$this->db());
            $this->assign('active','Sys');
            $this->assign('meau',$meau);
            $this->assign('info',"数据备份");
            $this->assign('a','sb');
            $this->display('sysAddBk');

        }
    }

    //网站核心配置文件
    public function sysconfig(){
        if(IS_POST){
            $cModel = M('config');
            $list = $_POST;
            foreach ($list as $k => $v) {
                $currentData = array();
                $currentData['data'] = $v;
                $state = $cModel->where('name = "'.$k.'"')->save($currentData);
                if($state === false){
                    $this->error('修改失败！');
                }
            }
            $this->success("修改网站配置信息成功！");

        }else{

            $cModel = M('config');
            $list = $cModel->where('groupid = 3')->select();

            foreach ($list as $key => $value) {
                $config[$value['name']] = $value['data'];
            }

            $meau=getAdminMeau();
            $this->assign('config',$config);
            $this->assign('init',$this->init());
            $this->assign('active','Sys');
            $this->assign('meau',$meau);
            $this->assign('info',"网站设置");
            $this->assign('a','sc');
            $this->display('');
        }
    }

}