<?php

const THINK_ADDON_PATH = './Addons/';
return array(
	//'配置项'=>'配置值'
	//
	//
	//
	/*数据库配置
    'DB_TYPE'   => $_SERVER[ENV_PRE.'DB_TYPE'] ? : 'mysql', // 数据库类型
    'DB_HOST'   => $_SERVER[ENV_PRE.'DB_HOST'] ? : '127.0.0.1', // 服务器地址
    'DB_NAME'   => $_SERVER[ENV_PRE.'DB_NAME'] ? : 'fuzhen', // 数据库名
    'DB_USER'   => $_SERVER[ENV_PRE.'DB_USER'] ? : 'root', // 用户名
    'DB_PWD'    => $_SERVER[ENV_PRE.'DB_PWD']  ? : 'root', // 密码
    'DB_PORT'   => $_SERVER[ENV_PRE.'DB_PORT'] ? : '[DB_PORT]', // 端口
    'DB_PREFIX' => $_SERVER[ENV_PRE.'DB_PREFIX'] ? : 'fz_', // 数据库表前缀
    */
    //数据库配置
    'DB_TYPE'   => $_SERVER[ENV_PRE.'DB_TYPE'] ? : 'mysql', // 数据库类型
    'DB_HOST'   => $_SERVER[ENV_PRE.'DB_HOST'] ? : '127.0.0.1', // 服务器地址
    'DB_NAME'   => $_SERVER[ENV_PRE.'DB_NAME'] ? : 'kanbing', // 数据库名
    'DB_USER'   => $_SERVER[ENV_PRE.'DB_USER'] ? : 'kanbing', // 用户名
    'DB_PWD'    => $_SERVER[ENV_PRE.'DB_PWD']  ? : '139490wx', // 密码
    'DB_PORT'   => $_SERVER[ENV_PRE.'DB_PORT'] ? : '[DB_PORT]', // 端口
    'DB_PREFIX' => $_SERVER[ENV_PRE.'DB_PREFIX'] ? : 'fz_', // 数据库表前缀
    //
    'ERROR_PAGE' =>'/404/404.htm',
    'SHOW_PAGE_TRACE' => true,

    //URL模式
    'URL_MODEL' => '2',
    'URL_ROUTER_ON'   => true, //开启路由
    'URL_ROUTE_RULES' => array(
         //'/^hospital\/(\d+)-(\d+)-(\d+)$/' => 'hospital/index?sid=:1&yid=:2&p=:3',
         '/^hospital\/(\d+)-(\d+)-(\d+)$/' => 'hospital/index?tid=:1&yid=:2&p=:3',
         '/^doctor\/(\d+)-(\d+)$/' => 'doctor/index?tid=:1&p=:2',
         '/^oauth\/callback\/([a-z])$/' => '/Home/Plug/callback?type=:1',
         '/^p\/(\d+)$/' => 'Home/News/content?id=:1',
         '/^h\/(\d+)$/' => 'Home/hospital/index?id=:1',
         '/^faq$/' => 'Home/single/faq',
         '/^faq\/(\d+)$/' => 'Home/single/faq?id=:1',
         '/^about$/' => 'Home/single/about',
         '/^about\/(\d+)$/' => 'Home/single/about?id=:1',
         //'/^p/' => 'Home/News/',
    ),

    //URL配置
    'URL_CASE_INSENSITIVE' => true, //不区分大小写

    //应用配置
    'DEFAULT_MODULE'     => 'Home',
    'MODULE_DENY_LIST'   => array('Common'),
    'MODULE_ALLOW_LIST'  => array('Home','Admin'),

    'AUTOLOAD_NAMESPACE' => array('Addons' => THINK_ADDON_PATH), //扩展模块列表

    'TYPES'=>array('全部','综合医院','精神类医院','康复医院','一般医院','妇产医院','外科类医院','心脏类医院','整形医院','癌症医院','企业或政府医院','慢性病医院','儿科医院','癌症类医院','五官科医院'),
);