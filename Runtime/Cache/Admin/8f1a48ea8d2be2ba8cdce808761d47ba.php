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
		    <div class="tab-body">
				<div class="tab-panel active">
				    <div class="form-group">
	                <div class="label"><label>开启同步登录：</label></div>
	                <div class="field">
						<label class="checkbox-inline">
						<?php if($db_config['type'][0] == Weixin): ?><input type="checkbox" name="config[type][]" value="Weixin" checked >
						<?php else: ?>
						<input type="checkbox" name="config[type][]" value="Weixin" ><?php endif; ?>
						Weixin</label>
						<label class="checkbox-inline">
						<?php if($db_config['type'][1] == Qq): ?><input type="checkbox" name="config[type][]" value="Qq" checked >
						<?php else: ?>
						<input type="checkbox" name="config[type][]" value="Qq" ><?php endif; ?>
						Qq</label>
						<label class="checkbox-inline">
						<?php if($db_config['type'][2] == Sina): ?><input type="checkbox" name="config[type][]" value="Sina" checked >
						<?php else: ?>
						<input type="checkbox" name="config[type][]" value="Sina" ><?php endif; ?>
						Sina</label>
						<label class="checkbox-inline">
						<?php if($db_config['type'][3] == Renren): ?><input type="checkbox" name="config[type][]" value="Renren" checked >
						<?php else: ?>
						<input type="checkbox" name="config[type][]" value="Renren" ><?php endif; ?>
						Renren</label>
	                </div>
					</div>

					<div class="form-group">
	                <div class="label"><label>接口验证代码：</label></div>
	                <div class="field">
						<textarea class="input" rows="5" cols="62" name="config[meta]" ><?php echo ($db_config["meta"]); ?></textarea>
						<div class="input-note">需要在Meta标签中写入验证信息时，拷贝代码到这里。</div>
	                </div>
	            	</div>
		    	</div>
			</div>
		</div>
	</div>
	<br />
    <div class="tab dux-tab">
        <div class="panel dux-box  active">
            <div class="panel-head">
                <div class="tab-head">
                    <strong>插件信息设置</strong>
                    <ul class="tab-nav">
                        <li class="active"><a href="#tab-1">微信配置</a></li>
                        <li><a href="#tab-2">QQ配置</a></li>
                        <li><a href="#tab-3">新浪配置</a></li>
                        <li><a href="#tab-4">人人配置</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-body">
                <div id="tab-1" class="tab-panel active">
                    <div class="form-group">
                        <div class="label"><label>微信APPKEY：</label></div>
                        <div class="field">
                            <input type="text" value="<?php echo ($db_config["WeixinKEY"]); ?>" size="60" name="config[WeixinKEY]" id="title" class="input">
                            <div class="input-note">（申请地址：http://open.weixin.qq.com/）</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>微信APPSECRET：</label></div>
                        <div class="field">
                            <input type="text" value="<?php echo ($db_config["WeixinSecret"]); ?>" size="60" name="config[WeixinSecret]" id="title" class="input">
                            <div class="input-note">（申请地址：http://open.weixin.qq.com/）</div>
                        </div>
                    </div>

                </div>

                <div id="tab-2" class="tab-panel">
                    <div class="form-group">
                        <div class="label"><label>QQ互联APPKEY：</label></div>
                        <div class="field">
                            <input type="text" value="<?php echo ($db_config["QqKEY"]); ?>" datatype="*" size="60" name="config[QqKEY]" id="title" class="input">
                            <div class="input-note">（申请地址：http://connect.qq.com）</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>QQ互联APPSECRET：</label></div>
                        <div class="field">
                            <input type="text" value="<?php echo ($db_config["QqSecret"]); ?>" datatype="*" size="60" name="config[QqSecret]" id="title" class="input">
                            <div class="input-note">（申请地址：http://connect.qq.com）</div>
                        </div>
                    </div>   
                </div>

                <div id="tab-3" class="tab-panel">  
                    <div class="form-group">
                        <div class="label"><label>新浪APPKEY：</label></div>
                        <div class="field">
                            <input type="text" value="<?php echo ($db_config["SinaKEY"]); ?>" datatype="*" size="60" name="config[SinaKEY]" id="title" class="input">
                            <div class="input-note">（申请地址：http://open.weibo.com/）</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>新浪APPSECRET：</label></div>
                        <div class="field">
                            <input type="text" value="<?php echo ($db_config["SinaSecret"]); ?>" datatype="*" size="60" name="config[SinaSecret]" id="title" class="input">
                            <div class="input-note">（申请地址：http://open.weibo.com/）</div>
                        </div>
                    </div>   
                </div>

                <div id="tab-4" class="tab-panel">
                    <div class="form-group">
                        <div class="label"><label>人人APPKEY：</label></div>
                        <div class="field">
                            <input type="text" value="<?php echo ($db_config["RenrenKEY"]); ?>" datatype="*" size="60" name="config[RenrenKEY]" id="title" class="input">
                            <div class="input-note">（申请地址：http://dev.renren.com/）</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>人人APPSECRET：</label></div>
                        <div class="field">
                            <input type="text" value="<?php echo ($db_config["RenrenSecret"]); ?>" datatype="*" size="60" name="config[RenrenSecret]" id="title" class="input">
                            <div class="input-note">（申请地址：http://dev.renren.com/）</div>
                        </div>
                    </div>   
                </div>
            </div>
            <div class="panel-foot">
                <div class="form-button">
                    <div id="tips"></div>
                    <input type="hidden" class="form-control input" name="id" value="3" >
                    <button type="submit" class="button bg-main">保存</button>
                    <button type="reset" class="button bg">重置</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
	//var content_editor = 'xxxx';
    Do.ready('base', function () {
        //表单综合处理
        //$('#form').duxFormPage();
    }); 
</script>
    </div>
</div>
</body>
</html>