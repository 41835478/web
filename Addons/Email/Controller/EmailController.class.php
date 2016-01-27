<?php
// +----------------------------------------------------------------------
// | CoreThink [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.corethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com> <http://www.corethink.cn>
// +----------------------------------------------------------------------
namespace Addons\Email\Controller;
use Home\Controller\AddonController;
/**
 * 邮件控制器
 * @author jry <598821125@qq.com>
 */
class EmailController extends AddonController{
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
    function sendMail($mail_data){

        $addon_config = \Common\Controller\Addon::getConfig('Email');

        if($addon_config['status']){

            $mail_body_template = $addon_config['default']; //获取邮件模版配置
            $mail_body = str_replace("[MAILBODY]", $mail_data['content'], $mail_body_template); //使用邮件模版

            $mail = new \Common\Util\PHPMailer();
            $mail->IsSMTP(); // 使用SMTP方式发送
            $mail->CharSet='UTF-8';// 设置邮件的字符编码
            $mail->Host = $addon_config['MAIL_SMTP_HOST']; // 您的企业邮局服务器
            $mail->Port = $addon_config['MAIL_SMTP_PORT']; // 设置端口
            $mail->SMTPAuth = true; // 启用SMTP验证功能
            $mail->Username = $addon_config['MAIL_SMTP_USER']; // 邮局用户名(请填写完整的email地址)
            $mail->Password = $addon_config['MAIL_SMTP_PASS']; // 邮局密码
            $mail->From = $addon_config['MAIL_SMTP_USER']; //邮件发送者email地址
            $mail->FromName = "复诊网";
            $mail->AddAddress($mail_data['receiver'], '复诊网');//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
            
            $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
            $mail->Subject = $mail_data['subject'];//"PHPMailer测试邮件"; //邮件标题
            $mail->Body = $mail_body; //邮件内容

            if(!$mail->Send())
            {
                return false; 
            }else{
                exit('验证码发送成功，请注意查收您手机或邮箱');
            }

        }else{
            return false;
        }

    }
    
}
