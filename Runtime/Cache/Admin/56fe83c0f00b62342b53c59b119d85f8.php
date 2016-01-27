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
    <form action="" id="form" class="form-x dux-form form-auto" method="post">
    <div class="tab dux-tab">
        <div class="panel dux-box  active">
            <div class="panel-head">
                <div class="tab-head">
                    <strong>站点信息</strong>
                    <ul class="tab-nav">
                        <li class="active"><a href="#tab-1">网站设置</a></li>
                        <li><a href="#tab-2">网站信息</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-body">
                <div id="tab-1" class="tab-panel active">
                    <div class="form-group">
                        <div class="label"><label>站点标题：</label></div>
                        <div class="field">
                        <input type="text" class="input input_big" value="<?php echo ($config["c_title"]); ?>" datatype="*" name="c_title" size="60" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>站点关键词：</label></div>
                        <div class="field">
                        <input type="text" class="input input_big" value="<?php echo ($config["c_keyword"]); ?>" name="c_keyword" size="60" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>站点描述：</label></div>
                        <div class="field">
                        <textarea class="input" name="c_desc" id="c_desc" cols="62" rows="3"><?php echo ($config["c_desc"]); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>开启会员功能：</label></div>
                        <div class="field button-group button-group-small radio">
                        <?php if($config['c_user'] == 1): ?><label class="button active"><input type="radio" value="1" name="c_user" checked="checked">
                        <?php else: ?>
                            <label class="button"><input type="radio" value="1" name="c_user"><?php endif; ?>
                            <span class="icon icon-check"></span> 启用</label>
                        <?php if($config['c_user'] == 0): ?><label class="button active"><input type="radio" value="0" name="c_user" checked="checked">
                        <?php else: ?>
                            <label class="button"><input type="radio" value="0" name="c_user"><?php endif; ?>
                            <span class="icon icon-times"></span> 禁用</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>禁用词语：</label></div>
                        <div class="field"><textarea class="input" name="c_Nword" id="c_Nword" cols="55" rows="3"><?php echo ($config["c_Nword"]); ?></textarea></div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>网站状态：</label></div>
                        <div class="field button-group button-group-small radio">
                        <?php if($config['c_isoff'] == 1): ?><label class="button active"><input type="radio" value="1" name="c_isoff" checked="checked">
                        <?php else: ?>
                            <label class="button"><input type="radio" value="1" name="c_isoff"><?php endif; ?>
                            <span class="icon icon-check"></span> 启用</label>
                        <?php if($config['c_isoff'] == 0): ?><label class="button active"><input type="radio" value="0" name="c_isoff" checked="checked">
                        <?php else: ?>
                            <label class="button"><input type="radio" value="0" name="c_isoff"><?php endif; ?>
                            <span class="icon icon-times"></span> 禁用</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>故障描述：</label></div>
                        <div class="field">
	                	<textarea class="input" name="c_offdesc" id="c_offdesc" cols="55" rows="3"><?php echo ($config["c_offdesc"]); ?></textarea>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-panel">

                    <div class="form-group">
                        <div class="label"><label>站点网址：</label></div>
                        <input type="text" class="input input_big" name="c_weburl" size="60" value="<?php echo ($config["c_weburl"]); ?>" />
                    </div>
                    <div class="form-group">
                        <div class="label"><label>站长邮箱：</label></div>
                        <div class="field">
                        <input type="text" class="input input_big" datatype="e" size="60"  name="c_email" value="<?php echo ($config["c_email"]); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>联系电话：</label></div>
                        <div class="field">
                        <input type="text" class="input input_small" name="c_tel" size="60" value="<?php echo ($config["c_tel"]); ?>" />
                        </div>
                    </div>                 
                    <div class="form-group">
                        <div class="label"><label>联系地址：</label></div>
                        <div class="field">
                        <input type="text" class="input"  name="c_address" size="60" value="<?php echo ($config["c_address"]); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>站点版权：</label></div>
                        <div class="field">
                        <input type="text" class="input" name="c_copy" size="60" value="<?php echo ($config["c_copy"]); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>备案编号：</label></div>
                        <div class="field">
                        <input type="text" class="input input_small" name="c_icp" size="60" value="<?php echo ($config["c_icp"]); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>站点统计：</label></div>
                        <div class="field">
                        <textarea class="input" name="c_tongji" id="c_tongji" cols="62" rows="3"><?php echo ($config["c_tongji"]); ?></textarea>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="panel-foot">
                <div class="form-button">
                    <div id="tips"></div>
                    <button type="submit" class="button bg-main">保存</button>
                    <button type="reset" class="button bg">重置</button>
                </div>
            </div>
    </div>
</form>
<script>
    Do.ready('base', function () {
       $('#form').duxFormPage();
    });
</script>
</div>
</div>
</body>
</html>