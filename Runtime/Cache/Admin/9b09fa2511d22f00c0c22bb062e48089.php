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
    <div class="panel dux-box">
    <div class="table-responsive">
        <table class="table table-hover " id="table">
            <tbody>
                <tr>
                    <th width="60">选择</th>
                    <th width="100">编号</th>
                    <th width="*">标题</th>
                    <th width="*">描述</th>
                    <th width="120">状态</th>
                    <th width="160">更新时间</th>
                    <th width="140">操作</th>
                </tr>

                <?php if(is_array($news)): foreach($news as $key=>$v): ?><tr>
                    <td>
                        <input type="checkbox" value="<?php echo ($v["id"]); ?>" name="id[]">
                    </td>
                    <td><?php echo ($v["id"]); ?></td>
                    <td><?php echo ($v["title"]); ?></td>
                    <td><?php echo ($v["desc"]); ?></td>
                    <td align="center">
                        <?php if($v['status'] == 0): ?><span class="tag bg-red">隐藏</span>
                        <?php else: ?>
                            <span class="tag bg-green">显示</span><?php endif; ?>
                    </td>
                    <td><?php echo (date('Y-m-d h:i:s',$v["ctime"])); ?></td>
                    <td>
                        <a title="预览" href="<?php echo U("/zt/$v[id]");?>" target="_blank" class="button bg-blue button-small icon-eye"></a>
                        <a title="修改" href="<?php echo U('edit',array('id'=>$v['id']));?>" class="button bg-blue button-small icon-pencil"></a>
                        <a title="删除" data="<?php echo ($v["id"]); ?>" href="javascript:;" class="button bg-red button-small icon-trash-o js-del"></a>
                    </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <div class="panel-foot table-foot clearfix">
        <div class="float-left">
            <div class="form-inline">
                <div class="form-button">
                    <a type="button" id="selectAll" class="button bg-blue button-small">全选</a>
                    <a type="submit" id="selectSubmit" class="button bg-blue button-small">删除</a>
                </div>
            </div>
            <br>
        </div>
        <div class="float-right">
            <ul class="pagination pagination-small"><?php echo ($page); ?></ul>
        </div>
    </div>
</div>
<script charset="utf-8" type="text/javascript">
	Do.ready('base',function() {
		//表格处理
		$('#table').duxTable({
			actionUrl : "<?php echo U('batchAction');?>",
			deleteUrl: "<?php echo U('del');?>",
		});
	});
</script>
</div>
</div>
</body>
</html>