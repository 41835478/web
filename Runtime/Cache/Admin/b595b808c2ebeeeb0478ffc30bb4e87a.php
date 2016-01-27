<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="renderer" content="webkit">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/Public/common/css/pintuer.css">
<link rel="stylesheet" href="/Public/lib/css/admin.css">
<script src="/Public/js/jquery.js"></script>
<script src="/Public/common/js/pintuer.js"></script>
<script src="/Public/common/js/respond.js"></script>
<script>
var duxConfig = {
    //基础配置
    'baseDir' : '/Public/js/',
    'baseUrl' : '/',
    'uploadUrl' : "<?php echo U('Upload/upload',array('id'=>$action));?>",
    //自定义配置
    'libDir' : '/Public/lib/js/',
    'editorUploadUrl' : "<?php echo U('Upload/editor');?>",
    };
</script>
<script src="/Public/js/do.js"></script>
<script src="/Public/js/config.js"></script>
<script src="/Public/lib/js/definition.js"></script>
<title>网站后台系统管理系统 -- 复诊网</title>
</head>

<body>
<div class="dux-head clearfix">
    <div class="dux-logo">
        <a href="#" target="_blank"><img src="/Public/admin/images/logo.png" alt="后台管理系统"></a>
    </div>
    <div class="dux-nav">
        <ul class="nav nav-navicon nav-inline admin-nav">
          <?php if(is_array($meau)): foreach($meau as $k=>$vo): if($active == $k): ?><li class="active"><?php else: ?><li><?php endif; ?><a href="<?php echo ($vo['url']); ?>" class="icon-<?php echo ($vo['icon']); ?>"> <?php echo ($vo['name']); ?> </a></li><?php endforeach; endif; ?>
       </ul>
        <ul class="nav nav-navicon nav-inline admin-nav nav-tool">
           <li><a>欢迎您：<?php echo ($__ADMIN__["username"]); ?></a></li>
           <li><a href="/" target="_blank" class="icon-home"> 网站首页</a></li>
           <li><a href="<?php echo U('User/index');?>" class="icon-user"> 个人中心</a></li>
           <li><a href="<?php echo U('Public/logout');?>" class="dux-logout bg-red icon-power-off"> 退出</a></li>
        </ul>
    </div>
    </div>
    <div class="dux-sidebar">
       <ul class="nav  nav-navicon admin-menu">
          <div class="nav-head"><?php echo ($meau[$active]['name']); ?></div>
          <?php if(is_array($meau[$active]['menu'])): foreach($meau[$active]['menu'] as $k=>$vo): if($vo["active"] == $a): ?><li class="active"><?php else: ?><li><?php endif; ?>
              <a href="<?php echo ($vo['url']); ?>" class="icon-<?php echo ($vo['icon']); ?>"><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; ?>
       </ul>
    </div>
<div class="dux-bread">
    <ul class="bread">
        <li><a href="<?php echo U('Index/index');?>" class="icon-home">后台首页</a></li>
        <li><a href="<?php echo ($meau[$active]['url']); ?>"><?php echo ($meau[$active]['name']); ?></a></li>
    </ul>
</div>
<div class="dux-admin">       
    <div class="dux-tools">
        <div class="bread-head"><?php echo ($info); ?>
            <span class="small"><?php echo ($desc); ?></span>
        </div>
        <br>
    <?php if($init['menu']): ?><div class="tools-function clearfix">
          <div class="float-left">
            <?php if(is_array($init['menu'])): foreach($init['menu'] as $key=>$vo): if($vo['url'] == $self): ?><a class="button button-small bg-main icon-<?php echo ($vo["icon"]); ?>" href="<?php echo ($vo["url"]); ?>"> <?php echo ($vo["name"]); ?> </a>
              <?php else: ?>
              <a class="button button-small bg-back icon-<?php echo ($vo["icon"]); ?>" href="<?php echo ($vo["url"]); ?>"> <?php echo ($vo["name"]); ?> </a><?php endif; endforeach; endif; ?>
          </div>

          <?php if($init['add']): ?><div class="float-right">
              <a class="button button-small bg-dot icon-<?php echo ($init['add']['icon']); ?>" href="<?php echo ($init['add']['url']); ?>"> <?php echo ($init['add']['name']); ?></a> 
          </div><?php endif; ?>
      </div><?php endif; ?>
  </div>
<div class="line10"></div>
<style>
    .media-x .txt:before{    line-height: 80px;}
</style>
<div class="admin-main">
    <!--[if lte IE 8]>
<script src="/public/js/chart/excanvas.compiled.js"></script>
<![endif]-->
<div class="line-big">
    <div class="xm12">
        <div class="alert alert-yellow"><strong>提示：</strong>尊敬的&nbsp;&nbsp;<?php echo ($__ADMIN__["username"]); ?>&nbsp;,&nbsp;欢迎您的使用，您的本次登录时间为 <?php echo date('y-m-d h:i:s',time()); ?> ，登录IP为<?php echo $_SERVER['REMOTE_ADDR']; ?></div>
    </div>
</div>
<div class="line-big">
    <div class="xm3">
        <div class="panel dux-box dux-dashboard">
            <div class="clearfix">
                <div class="media media-x ">
                    <div class="float-left">
                        <div class="txt dashboard-head radius-small bg-red  icon-dashboard"></div>
                    </div>
                    <div class="media-body text-center">
                        <h2><strong>40%</strong></h2>
                        安全检测
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="xm3">
        <div class="panel dux-box dux-dashboard">
            <div class="clearfix">
                <div class="media media-x ">
                    <div class="float-left">
                        <div class="txt dashboard-head radius-small bg-yellow icon-bar-chart-o"></div>
                    </div>
                    <div class="media-body text-center">
                        <h2><strong>34</strong></h2>
                        今日网站访问
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="xm3">
        <div class="panel dux-box dux-dashboard">
            <div class="clearfix">
                <div class="media media-x ">
                    <div class="float-left">
                        <div class="txt dashboard-head radius-small bg-blue icon-paw"></div>
                    </div>
                    <div class="media-body text-center">
                        <h2><strong>0</strong></h2>
                        今日蜘蛛访问
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="xm3">
        <div class="panel dux-box dux-dashboard">
            <div class="clearfix">
                <div class="media media-x ">
                    <div class="float-left">
                        <div class="txt dashboard-head radius-small bg-green icon-puzzle-piece"></div>
                    </div>
                    <div class="media-body text-center">
                        <h2><strong>0</strong></h2>
                        碎片使用数量
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

<div class="line-big">
    <div class="xm12">
        <div class="panel dux-box">
            <div class="panel-head">网站近期访问概况</div>
            <div class="panel-body">
                <div style="height:200px;">
                    <canvas id="chart" style="width: 1651px; height: 200px;" height="200" width="1651"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="line-big">
    <div class="xm6">
        <div class="panel dux-box">
            <div class="panel-head"><strong>系统信息</strong>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td width="100" align="right">当前IP：</td>
                            <td><?php echo $_SERVER['REMOTE_ADDR']; ?></td>
                        </tr>
                        <tr>
                            <td align="right">网址：</td>
                            <td><?php echo $_SERVER['SERVER_NAME']; ?> </td>
                        </tr>
                        <tr>
                            <td align="right">服务器时间：</td>
                            <td><?php echo date('y-m-d h:i:s',time()); ?> </td>

                        </tr>
                        <tr>
                            <td align="right">PHP版本：</td>
                            <td><?php echo PHP_VERSION; ?></td>
                        </tr>
                        <tr>
                            <td align="right">物理路径：</td>
                            <td><?php echo $_SERVER['DOCUMENT_ROOT']; ?></td>
                        </tr>
                        <tr>
                            <td align="right">系统类型：</td>
                            <td><?php echo php_uname('s'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">服务器引擎：</td>
                            <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>

                        </tr>

                        <tr>
                            <td align="right">Thinkphp：</td>
                            <td><?php echo (THINK_VERSION); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
        </div>
        <div class="xm6">
            <div class="panel dux-box">
                <div class="panel-head"><strong>蜘蛛访问</strong>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th align="center">时间</th>
                                <th align="center"><a href="https://www.baidu.com/s?wd=site%3Afuzhen.com" target="_blank">百度</a></th>
                                <th align="center">Google</th>                                  
                                <th align="center">sogou</th>
                                <th align="center">soso</th>
                                <th align="center"><a href="http://www.haosou.com/s?ie=utf-8&shb=1&src=sug-local&q=site%3Afuzhen.com" target="_blank">360</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($bot)): foreach($bot as $key=>$bot): ?><tr>
                                    <td align="center"><?php echo (friendly_date($bot["time"],"ymd")); ?></td>
                                    <td align="center"><?php echo ($bot["baidu"]); ?></td>
                                    <td align="center"><?php echo ($bot["google"]); ?></td>
                                    <td align="center"><?php echo ($bot["sogou"]); ?></td>
                                    <td align="center"><?php echo ($bot["soso"]); ?></td>
                                    <td align="center"><?php echo ($bot["360spider"]); ?></td>
                                </tr><?php endforeach; endif; ?> 

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <script>
        Do.ready('base', function () {
            var data = <?php echo ($chartArray); ?>;
            $("#chart").duxChart({
                data: data
            });
        });
    </script>
</div>
</div>
</body>
</html>