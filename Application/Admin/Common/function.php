<?php
    //网站后台菜单列表
function getAdminMeau(){
    return array(

        'Index' => array(
           'name' => '后台首页',
           'url'  => U('Index/index'),
           'icon' => 'home',
           'menu' => array(
            array(
                'name'  => '站点统计',
                'icon' => 'tachometer',
                'url'   => U('Config/tj'),
                'active'=> 'tj'
                ),
            array(
                'name'  => '菜单导航',
                'icon'  => 'th',
                'url'   => U('Meau/index'),
                'active'=> 'mu'
                ),
            array(
                'name'  => '生成静态页',
                'icon'  => 'flag',
                'url'   => U('Makehtml/index'),
                'active'=> 'mh'
                ),
            )
           ),
        'News' => array(
            'name'  => '新闻',
            'icon' => 'reorder',
            'url'   => U('News/index'),
            'menu'  => array(
                array(
                    'name'  => '新闻栏目及文章管理',
                    'icon' => 'sitemap',
                    'url'   => U('Cate/index'),
                    'active'=> 'cate'
                    ),
                array(
                    'name'  => '文章管理',
                    'url'   => U('News/index'),
                    'icon' => 'bars',
                    'active'=> 'news'
                    ),
                array(
                    'name'  => '专题列表',
                    'url'   => U('Zhuanti/index'),
                    'icon' => 'filter',
                    'active'=> 'zt'
                    ),
                array(
                    'name'  => '单页面',
                    'url'   => U('singletype/index'),
                    'icon' => 'cogs',
                    'active'=> 'singlety'
                    ),
                // array(
                //     'name'  => 'FAQ文章管理',
                //     'url'   => U('single/index'),
                //     'icon' => 'paste',
                //     'active'=> 'single'
                //     ),
                )
            ),
        'User' => array(
            'name'  => '用户',
            'icon' => 'user',
            'url'   => U('User/index'),
            'menu'  => array(
                array(
                    'name'  => '添加用户',
                    'icon' => 'user',
                    'url'   => U('User/add'),
                    'active'=> 'add'
                    ),
                array(
                    'name'  => '用户列表',
                    'icon' => 'group',
                    'url'   => U('User/index'),
                    'active'=> 'user'
                    ),
                )
            ),
        'extend' => array(
            'name'  => '扩展',
            'icon' => 'puzzle-piece',
            'url'   => U('Tag/index'),
            'menu'  => array(
                array(
                    'name'  => 'TAG管理',
                    'icon' => 'tags',
                    'url'   => U('Tag/index'),
                    'active'=> 'tag'
                    ),
                array(
                    'name'  => '插件列表',
                    'icon'  => 'puzzle-piece',
                    'url'   => U('Addon/index'),
                    'active'=> 'addon'
                    ),
                array(
                    'name'  => '广告列表',
                    'icon'  => 'adn',
                    'url'   => U('Adver/index'),
                    'active'=> 'adver'
                    ),
                array(
                    'name'  => '留言管理',
                    'icon'  => 'comments',
                    'url'   => U('Guestbook/index'),                        
                    'active'=> 'aa'
                    ),
                array(
                    'name'  => '百度提交',
                    'icon'  => 'location-arrow',
                    'url'   => U('BaiduSitemap/index'),                        
                    'active'=> 'baidu'
                    ),
                )
            ),
        'Sys'  => array(
            'name'  => '系统配置',
            'url'   => U('Config/sysConfig'),
            'icon' => 'tachometer',
            'menu'  => array(
                array(
                    'name' => '网站信息设置',
                    'icon' => 'cogs',
                    'url'  => U('Config/sysConfig'),
                    'active'=> 'sc'
                    ),
                array(
                    'name' => '上传配置',
                    'icon' => 'upload',
                    'url'  => U('Config/sysUpload'),
                    'active'=> 'su'
                    ),
                array(
                    'name' => '缓存管理',
                    'icon' => 'inbox',
                    'url'  => U('Config/sysCatch'),
                    'active'=> 'st'
                    ),
                array(
                    'name' => '操作记录',
                    'icon' => 'calendar',
                    'url'  => U('Config/sysLog'),
                    'active'=> 'sl'
                    ),
                array(
                    'name' => '备份还原',
                    'icon' => 'database',
                    'url'  => U('Datebase/import'),
                    'active'=> 'sb'
                    ),
                array(
                    'name' => '管理员',
                    'icon' => 'user-md',
                    'url'  => U('Manager/index'),
                    'active'=> 'mi'
                    ),
                array(
                    'name' => '管理员组',
                    'icon' => 'users',
                    'url'  => U('Group/group'),
                    'active'=> 'gg'
                    ),
                array(
                    'name' => '权限管理',
                    'icon' => 'link',
                    'url'  => U('Node/index'),
                    'active'=> 'jd'
                    )
                )
            ),
        );



}
