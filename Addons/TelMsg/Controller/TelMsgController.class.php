<?php
// +----------------------------------------------------------------------
// | CoreThink [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.corethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com> <http://www.corethink.cn>
// +----------------------------------------------------------------------
namespace Addons\TelMsg\Controller;
use Home\Controller\AddonController;
/**
 * 邮件控制器
 * @author jry <598821125@qq.com>
 */
class TelMsgController extends AddonController{
    /**
     * 系统邮件发送函数
     * @param string $mail_data 邮件信息结构
     * @$mail_data['receiver'] 收件人
     * @$mail_data['subject'] 邮件主题
     * @$mail_data['content']邮件内容
     * @$mail_data['attachment'] 附件列表
     * @return boolean
     * @author jry <598821125@qq.com>
     */
    function sendTel($tel_data){

        $addon_config = \Common\Controller\Addon::getConfig('TelMsg');

        //$mail_body_template = $addon_config['default']; //获取邮件模版配置
        // $mail_body = str_replace("[MAILBODY]", $mail_data['content'], $mail_body_template); //使用邮件模版
        // 
        $mobile=$tel_data['tel'];
        $content=$tel_data['content'];
        $TelMsg = new \Common\Util\TelMsg();
        $re=$TelMsg->sendTel($addon_config['TEL_URL'],$addon_config['TEL_USER'],$addon_config['TEL_PWD'],$mobile,$content);

        if(!$re){
            return false;
        }else{
            exit('验证码发送成功，请注意查收您手机或邮箱');
        }


    }
    
}
