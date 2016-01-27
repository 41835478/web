<?php

namespace Admin\Controller;
use Think\Controller;
/**
 * 后台公共控制器
 * @author jry <598821125@qq.com>
 */
class PublicController extends Controller{
    /**
     * 后台登陆
     * @author jry <598821125@qq.com>
     */
    public function login(){
    	layout(false);
        if(IS_POST){
            $username = I('username');
            $password = I('password');
            $type=I('type');
            if ($type=='admin') {
                //极限验证
                $verify = new \Common\Util\Geetestlib();
                $key = "74a8c0341094c32d788f28fa7e6b878c";
                $validate_response= $verify->geetest_validate(@$_POST['geetest_challenge'], @$_POST['geetest_validate'], @$_POST['geetest_seccode'],$key);
                if(empty($validate_response)){
                    $this->error('验证码错误！');
                }
            }else{
                 //图片验证码校验
                if(!check_verify(I('post.verify'))){
                 $this->success('验证码不正确!');exit;
                }

            }

            $map['group'] = array('egt', 1); //后台部门

            $user_object = D('Admin');
            $uid = $user_object->login($username, $password, $map); //查找用户
            if(0 < $uid){
                $this->success('登录成功！', U('Admin/Index/index'));
            }else{
                $this->error($user_object->getError(),U('Admin/Public/login'));
            }
        }else{

            $this->meta_title = '用户登录';
            $this->display();
        }
    } 

    /**
     * 注销
     * @author jry <598821125@qq.com>
     */
    public function logout(){
        layout(false);
        session('admin_auth', null);
        session('admin_auth_sign', null);
        $this->success('退出成功！', U('Public/login'));
    }

    /**
     * 图片验证码生成，用于登录和注册
     * @author jry <598821125@qq.com>
     */
    public function verify($vid = 1){
        $verify = new \Think\Verify();
        $verify->length = 4;
        $verify->entry($vid);
    }
    

}
