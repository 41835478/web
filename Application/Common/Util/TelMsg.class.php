<?php
namespace Common\Util;

/**
* 
*/
class TelMsg
{
	
	function sendTel($target,$user,$pwd,$mobile,$mobile_code){

		if(empty($mobile)){
			exit('手机号码不能为空');
		}

		$contens='亲爱的用户，您的验证码是'.$mobile_code.',有疑问请致电4006610606';

		$post_data = "account=".$user."&password=".$pwd."&mobile=".$mobile."&content=".rawurlencode($contens);
				
		$gets =  xml_to_array(Post($post_data, $target));
		if($gets['SubmitResult']['code']==2){
			$_SESSION['mobile_code'] = $mobile_code;
			return true;
		}else{
			return flase;
		}
	}


}