<?php
namespace Common\Model;
use Think\Model;

/**
* 
*/
class AdminModel extends Model
{
    /**
     * 用户登录
     * @author 462193409@qq.com
     */
    public function login($username, $password, $map){
        //去除前后空格
        $username = trim($username);

        $map['admin_user'] = array('eq', $username); //用户名登陆
        $map['status'] = array('eq', 1);
        $user = $this->where($map)->find(); //查找用户
        if(!$user){
            $this->error = '用户不存在或被禁用！';
        }else{
            if(md5($password) !== $user['admin_pwd']){
                $this->error = '密码错误！';
            }else{
                //更新登录信息
                $data = array(
                    'admin_id'              => $user['admin_id'],
                    'login'           => array('exp', '`login`+1'),
                    'last_login_time' => NOW_TIME,
                    'last_login_ip'   => get_client_ip(1),
                );
                $this->save($data);
                $this->autoLogin($user);
                return $user['admin_id'];
            }
        }
        return false;
    }

    /**
     * 设置登录状态
     * @author 462193409@qq.com
     */
    public function autoLogin($user){
        //记录登录SESSION和COOKIES
        $auth = array(
            'uid'             => $user['admin_id'],
            'username'        => $user['admin_user'],
            'nicheng'         => $user['admin_name'],
            'last_login_time' => $user['last_login_time'],
            'last_login_ip'   => get_client_ip(1),
        );
        session('admin_auth', $auth);
        session('admin_auth_sign', $this->dataAuthSign($auth));
    }

    /**
     * 数据签名认证
     * @param  array  $data 被认证的数据
     * @return string       签名
     * @author 462193409@qq.com
     */
    public function dataAuthSign($data) {
        //数据类型检测
        if(!is_array($data)){
            $data = (array)$data;
        }
        ksort($data); //排序
        $code = http_build_query($data); //url编码并生成query字符串
        $sign = sha1($code); //生成签名
        return $sign;
    }

    /**
     * 检测用户是否登录
     * @return integer 0-未登录，大于0-当前登录用户ID
     * @author jry <598821125@qq.com>
     */
    public function isLogin(){
        $user = session('admin_auth');
        if (empty($user)) {
            return 0;
        }else{
            return session('admin_auth_sign') == $this->dataAuthSign($user) ? $user['uid'] : 0;
        }
    }

}