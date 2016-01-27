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
<div class="admin-main">
    <form id="form" class="form-x dux-form form-auto">
    <div class="tab dux-tab">
        <div class="panel dux-box  active">
            <div class="panel-head">
                <div class="tab-head">
                    <strong>静态页生成列表</strong>
                    <ul class="tab-nav">
                        <li class="active"><a href="#tab-1">生成网站</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-body">
                <div id="tab-1" class="tab-panel active">
                    <div class="form-group">
                        <div class="label"><label>网站首页：</label></div>
                        <div class="field">
                            <a class="button bg-main" href="javascript:void" id="makeIndex">点击生成</a>
                            <span id="re"></span>
                        </div>
                    </div>
                    <hr />
<!--                     <div class="form-group">
                        <div class="label"><label>医院首页：</label></div>
                        <div class="field">
                            <a class="button bg-main" href="javascript:void" id="makeIndex">点击生成</a>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <div class="label"><label>生成全部医院页面：</label></div>
                        <div class="field">
                            <a class="button bg-main" href="<?php echo U('updateHtml',array('type'=>'hospital'));?>" id="">点击生成</a>
                        </div>
                    </div>

                    <hr />
<!--                     <div class="form-group">
                        <div class="label"><label>生成医生列表：</label></div>
                        <div class="field">
                            <a class="button bg-main" class="button bg-main" href="javascript:void" id="makeIndex">点击生成</a>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <div class="label"><label>生成全部医生页面：</label></div>
                        <div class="field">
                            <a class="button bg-main" href="<?php echo U('updateHtml',array('type'=>'doctor'));?>" id="">点击生成</a>
                        </div>
                    </div>

                    <hr />
<!--                     <div class="form-group">
                        <div class="label"><label> 生成当天的新闻：</label></div>
                        <div class="field">
                            <a class="button bg-main" href="<?php echo U('updateHtml',array('type'=>'article'));?>" id="">点击生成</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label"><label> 生成一周内的新闻：</label></div>
                        <div class="field">
                            <a class="button bg-main" href="<?php echo U('updateHtml',array('type'=>'article'));?>" id="">点击生成</a>
                        </div>
                    </div>  -->  

                    <div class="form-group">
                        <div class="label"><label> 生成全部新闻：</label></div>
                        <div class="field">
                            <a class="button bg-main" href="<?php echo U('updateHtml',array('type'=>'article'));?>" id="">点击生成</a>
                        </div>
                    </div>

                    <hr />
                    <div class="form-group">
                        <div class="label"><label>生成专题页：</label></div>
                        <div class="field">
                            <a class="button bg-main" href="<?php echo U('updateHtml',array('type'=>'zhuanti'));?>" id="">点击生成</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label"><label>生成网站单页：</label></div>
                        <div class="field">
                            <a class="button bg-main" href="<?php echo U('updateHtml',array('type'=>'single'));?>" id="">点击生成</a>
                        </div>
                    </div>


                </div>
            </div>
            <div class="panel-foot">
                <div class="form-button">
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function(){
      $("#makeIndex").click(function(){
        htmlobj=$.ajax({url:"<?php echo U('makeIndex');?>",dataType:"text",async:false,success:function(data){ $("#re").text(data);} });         
      });
  });
</script>
</div>
</body>
</html>