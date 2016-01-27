<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.modal{background-clip: padding-box; background-color: #fff; border: 1px solid rgba(0, 0, 0, 0.3); border-radius: 6px; box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3); left: 50%; margin: -250px 0 0 -280px; overflow: auto; position: fixed; top: 50%; width: 560px; z-index: 1050;}
.modal-header{border-bottom: 1px solid #eee; padding: 9px 15px;}
.modal-header h3{line-height: 30px; margin: 0;}
h3{font-size: 24px; line-height: 40px;}
.modal-body{max-height: 400px; overflow-y: auto; padding: 15px;}
p{margin: 0 0 10px;}
.system-message .jump{padding-top: 10px}
.system-message .jump a{color: #a9302a;}
.system-message .success,.system-message .error{line-height: 1.8em; font-size: 20px;}
.system-message .error{color: #a9302a;}
.system-message .right{color: #00a60c;}
.system-message .detail{font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
.modal{margin:0px; position:static; margin:auto; margin-top:10%;}
.modal-header{text-align:center; background-color: #F6F6F6; background-image: -moz-linear-gradient(top, #FAFAFA, #F2F2F2); background-image: -ms-linear-gradient(top, #FAFAFA, #F2F2F2); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#FAFAFA), to(#F2F2F2)); background-image: -webkit-linear-gradient(top, #FAFAFA, #F2F2F2); background-image: -o-linear-gradient(top, #FAFAFA, #F2F2F2); background-image: linear-gradient(top, #FAFAFA,#F2F2F2); background-repeat: repeat-x; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFAFAFA', endColorstr='#FFF2F2F2', GradientType=0); border-bottom:solid 1px #ccc; margin-top: 1px;}
</style>
</head>
<body>
<div class="modal" id="myModal">
    <div class="modal-header">
        <h3>页面跳转提示</h3>
    </div>
    <div class="modal-body" >
        <div class="system-message">
        	<present name="message">
             	<p class="right"><?php echo($message); ?></p> <p class="detail"></p>
             <else/>
             	<p class="error"><?php echo($error); ?></p> <p class="detail"></p>
             </present>
            <p class="jump">
                页面自动 <a id="href"  href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
            </p>
        </div>
    </div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>