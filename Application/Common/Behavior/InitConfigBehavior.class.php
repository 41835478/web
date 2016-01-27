<?php
// +----------------------------------------------------------------------
// | CoreThink [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.corethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com> <http://www.corethink.cn>
// +----------------------------------------------------------------------
namespace Common\Behavior;
use Think\Behavior;
defined('THINK_PATH') or exit();
/**
 * 根据不同情况读取数据库的配置信息并与本地配置合并
 * 本行为扩展很重要会影响核心系统前后台、模块功能及模版主题使用
 * 如非必要或者并不是十分了解系统架构不推荐更改
 * @author jry <598821125@qq.com>
 */
class InitConfigBehavior extends Behavior{
    /**
     * 行为扩展的执行入口必须是run
     * @author jry <598821125@qq.com>
     */
    public function run(&$content){
        //安装模式下直接返回
        if(defined('BIND_MODULE') && BIND_MODULE === 'Install') return;

        //系统主页地址配置
        $config['HOME_PAGE'] = 'http://'.$_SERVER['HTTP_HOST'].__ROOT__;

        //获取ThinkPHP控制器分级时控制器名称
        $controller_name = explode('/', CONTROLLER_NAME);

    }
}
