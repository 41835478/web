<?php
// +----------------------------------------------------------------------
// | CoreThink [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.fuzhen.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 462193409@qq.com <http://www.fuzhen.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
/**
 * 扩展后台管理页面
 * @author 462193409@qq.com
 */
class AddonController extends AdminController {

    protected function init(){
        return array(

            );
    }


    function index(){

        $model=M('Addon');
        $list=$model->select();
        $this->assign('list',$list);
        $this->assign('active','extend');
        $this->assign('init',$this->init());
        $this->assign('a','addon');
        $this->assign('info',"插件列表");
        $this->assign('desc',"管理网站第三方插件");
        $this->display('');

    }

    function config(){

        if(IS_POST){
            layout(false);

            $id  = (int)I('id');
            $config = I('config');
            $flag = M('Addon')->where("id={$id}")->setField('config', json_encode($config));
            if($flag !== false){
                $this->success('保存成功', U('index'));
            }else{
                $this->error('保存失败');
            }

        }else{

            $id=(int)I('id');

            $info  = M('Addon')->find($id);
            $db_config = $info['config'];

            if($db_config){
                $db_config = json_decode($db_config, true);
            }

            $this->assign('db_config',$db_config);
            $this->assign('active','extend');
            $this->assign('init',$this->init());
            $this->assign('a','addon');
            $this->assign('info',"插件列表");
            $this->assign('desc',"管理网站第三方插件");

            if($id==1){
                $this->display('adFloat');
            }else if($id==2){
                $this->display('Email');
            }else if($id==3){
                $this->display('syncLogin');
            }else if($id==4){
                $this->display('returnTop');
            }else if($id==5){
                $this->display('TelMsg');
            }else if($id==6){
                $this->display('payment');
            }else{
                $this->error('无插件模板！！！');
            }

        }

    }




}
