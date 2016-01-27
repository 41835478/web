<?php if (!defined('THINK_PATH')) exit();?><html>
<!DOCTYPE html>
<html lang="zh" class="no-js">
<head>
    <meta charset="utf-8">
    <title>登录(Login)  --  复诊网</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="description" content="">
    <!-- CSS -->
    <link rel="stylesheet" href="/Public/home/assets/css/reset.css">
    <link rel="stylesheet" href="/Public/home/assets/css/supersized.css">
    <link rel="stylesheet" href="/Public/home/assets/css/style.css">
  <!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src=/Public/home/js/amazeui.ie8polyfill.min.js"></script>
<![endif]--> 

<!--[if (gte IE 9)|!(IE)]><!--> 
<script src="/Public/home/js/jquery.min.js"></script> 
<!--<![endif]--> 
<script src="/Public/home/js/amazeui.min.js"></script>
</head>
<body>
    <div class="page-container">
        <h1><a href="http://www.fuzhen.com"><img src="/Public/home/images/logo.png"></a></h1>
        <form action="" method="post">
            <input type="text" name="username" class="username" placeholder="请输入您的用户名！">
            <input type="password" name="password" class="password" placeholder="请输入您的用户密码！">
            <input type="hidden" name="type" value="admin">
            <div id="geeverify" style=" margin-top: 25px;">
                <script async type="text/javascript" src="http://api.geetest.com/get.php?gt=e1405677bb2aaaf51778d17bab13d3c8"></script>
            </div> 
            <button type="submit" class="submit_button">登录</button>
            <div class="error"><span>+</span></div>
        </form>
        
    </div>
</div>     
<!-- Javascript -->

<script src="/Public/home/assets/js/supersized.3.2.7.min.js" ></script>
<script src="/Public/home/assets/js/supersized-init.js" ></script>
<script src="/Public/home/assets/js/scripts.js" ></script>

</body>
</html>