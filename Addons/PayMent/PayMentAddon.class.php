<?php
// +----------------------------------------------------------------------
// | CoreThink [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.corethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com> <http://www.corethink.cn>
// +----------------------------------------------------------------------
namespace Addons\PayMent;
use Common\Controller\Addon;
 
/**
 * 通用支付接口类
 * @author yunwuxin<448901948@qq.com>
 */

class PayMentAddon extends Addon{

    /**
     * 插件信息
     * @author jry <598821125@qq.com>
     */
    public $info = array(
        'name' => 'PayMent',
        'title' => '第三方支付系统',
        'description' => '第三方支付系统',
        'status' => 1,
        'author' => 'CoreThink',
        'version' => '0.1'
    );

    /**
     * 插件安装方法
     * @author jry <598821125@qq.com>
     */
    public function install(){
        return true;
    }

    /**
     * 插件卸载方法
     * @author jry <598821125@qq.com>
     */
    public function uninstall(){
        return true;
    }

    /**
     * 支付按钮钩子
     * @author jry <598821125@qq.com>
     */
    public function PayMent($param){
        $this->assign($param);
        $config = $this->getConfig();
        $this->assign('config',$config);
        $this->display('pay');
    }

}
