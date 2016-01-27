<?php
const THINK_ADDON_PATH = './Addons/';
return array(
	//'配置项'=>'配置值'
	//
	//
	//
	//数据库配置
    'DB_TYPE'   => $_SERVER[ENV_PRE.'DB_TYPE'] ? : 'mysql', // 数据库类型
    'DB_HOST'   => $_SERVER[ENV_PRE.'DB_HOST'] ? : '127.0.0.1', // 服务器地址
    'DB_NAME'   => $_SERVER[ENV_PRE.'DB_NAME'] ? : 'lycms', // 数据库名
    'DB_USER'   => $_SERVER[ENV_PRE.'DB_USER'] ? : 'root', // 用户名
    'DB_PWD'    => $_SERVER[ENV_PRE.'DB_PWD']  ? : 'root', // 密码
    'DB_PORT'   => $_SERVER[ENV_PRE.'DB_PORT'] ? : '[DB_PORT]', // 端口
    'DB_PREFIX' => $_SERVER[ENV_PRE.'DB_PREFIX'] ? : 'fz_', // 数据库表前缀
    //
    /*数据库配置
    'DB_TYPE'   => $_SERVER[ENV_PRE.'DB_TYPE'] ? : 'mysql', // 数据库类型
    'DB_HOST'   => $_SERVER[ENV_PRE.'DB_HOST'] ? : '127.0.0.1', // 服务器地址
    'DB_NAME'   => $_SERVER[ENV_PRE.'DB_NAME'] ? : 'kanbing', // 数据库名
    'DB_USER'   => $_SERVER[ENV_PRE.'DB_USER'] ? : 'kanbing', // 用户名
    'DB_PWD'    => $_SERVER[ENV_PRE.'DB_PWD']  ? : '139490wx', // 密码
    'DB_PORT'   => $_SERVER[ENV_PRE.'DB_PORT'] ? : '[DB_PORT]', // 端口
    'DB_PREFIX' => $_SERVER[ENV_PRE.'DB_PREFIX'] ? : 'fz_', // 数据库表前缀
    */
    'ERROR_PAGE' =>'/404/404.htm',
    //'SHOW_PAGE_TRACE' => true,
    'HTML_FILE_SUFFIX'     => '.html',

    'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名或者IP配置
    'APP_SUB_DOMAIN_RULES'    =>    array( 
            'hospital.fuzhen.com' => 'Home/hospital',
        ),
    
    //URL模式
    'URL_MODEL' => '2',
    'URL_ROUTER_ON'   => true, //开启路由
    'URL_ROUTE_RULES' => array(
         '/^d\/(\d+)-(\d+)-(\d+)$/' => 'doctor/index?tid=:1&yid=:2&p=:3',
         //'/^d\/(\d+)$/' => 'doctor/detail?id=:1',
         '/^d\/[a-zA-Z-]*(\d+)$/' => 'doctor/detail?id=:1',
         '/^d$/' => '/doctor/',
         '/^h\/(\d+)-(\d+)-(\d+)$/' => 'hospital/index?tid=:1&yid=:2&p=:3',
         '/^h\/ranking\/(\d+)$/' => 'hospital/ranking?id=:1',
         '/^h\/jibing\/(\d+)$/' => 'hospital/jibing?id=:1',
         '/^jiucuo\/(\d+)$/' => 'hospital/jiucuo?id=:1',
         '/^rank\/(\d+)$/' => 'hospital/rank?rank=:1',
         '/^[a-zA-Z-]*(\d+)$/' => 'hospital/detail?id=:1',
         '/^d\/(\d+)-(\d+)$/' => 'doctor/index?tid=:1&p=:2',
         //'/^oauth\/callback\/([a-z])$/' => '/Home/Plug/callback?type=:1',
         '/^p\/(\d+)$/' => 'News/content?id=:1',
         '/^p$/' => 'News/index',
         '/^faq$/' => 'Home/single/index',
         '/^faq\/(\d+)$/' => 'Home/single/index?id=:1',
         '/^mo$/' => '/home/disease_cost/',
         '/^zt\/(\d+)$/' => 'zhuanti/index?id=:1',
         '/^zh$/' => 'hospital/rank?rank=14',
         '/^jm$/' => 'hospital/rank?rank=19',
         '/^ky$/' => 'hospital/rank?rank=17',
         '/^ls$/' => 'hospital/rank?rank=20',
         //'/^p/' => 'Home/News/',
    ),
    //URL配置
    'URL_CASE_INSENSITIVE' => true, //不区分大小写
    //应用配置
    'DEFAULT_MODULE'     => 'Home',
    'MODULE_DENY_LIST'   => array('Common'),
    'MODULE_ALLOW_LIST'  => array('Home','Admin'),
    'AUTOLOAD_NAMESPACE' => array('Addons' => THINK_ADDON_PATH), //扩展模块列表


        /* 支付设置 */
    'payment' => array(
        'tenpay' => array(
            // 加密key，开通财付通账户后给予
            'key' => 'e82573dc7e6136ba414f2e2affbe39fa',
            // 合作者ID，财付通有该配置，开通财付通账户后给予
            'partner' => '1900000113'
        ),
        'alipay' => array(
            // 收款账号邮箱
            'email' => 'admin@cscss.com.cn',
            // 加密key，开通支付宝账户后给予
            'key' => 'd2xikoqf3u6lgduu2cvcwhwlzxyg921s',
            // 合作者ID，支付宝有该配置，开通易宝账户后给予
            'partner' => '2088802787884316'
        ),
        'aliwappay' => array(
            // 收款账号邮箱
            'email' => 'chenf003@yahoo.cn',
            // 加密key，开通支付宝账户后给予
            'key' => 'aaa',
            // 合作者ID，支付宝有该配置，开通易宝账户后给予
            'partner' => '2088101000137799'
        ),
        'palpay' => array(
            'business' => 'zyj@qq.com'
        ),
        'yeepay' => array(
            'key' => '69cl522AV6q613Ii4W6u8K6XuW8vM1N6bFgyv769220IuYe9u37N4y7rI4Pl',
            'partner' => '10001126856'
        ),
        'kuaiqian' => array(
            'key' => '1234567897654321',
            'partner' => '1000300079901'
        ),
        'unionpay' => array(
            'key' => '88888888',
            'partner' => '105550149170027'
        )
    )

);