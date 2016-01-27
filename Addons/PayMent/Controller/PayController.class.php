<?php
// +----------------------------------------------------------------------
// | CoreThink [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.corethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: Liguang <462193409@qq.com> <http://www.corethink.cn>
// +----------------------------------------------------------------------
namespace Addons\PayMent\Controller;
use Think\Hook;
use Home\Controller\AddonController;

class PayController extends AddonController {


    public function index() {

            $user=session('user_auth.username');
            //页面上通过表单选择在线支付类型，支付宝为alipay 财付通为tenpay
            $paytype = I('post.paytype');
            $order_id = '的业务订单';
            $title = '在线支付：';
            $money=0.01;

            $addon_config = \Common\Controller\Addon::getConfig('PayMent');
            if(empty($addon_config[$paytype.'Key']) || empty($addon_config[$paytype.'Partner'])){
                $this->error('请配置您申请的APP_KEY和APP_Partner');
            } else {
                $conf["email"] = $addon_config[$paytype.'Email'];
                $conf["key"] = $addon_config[$paytype.'Key'];
                $conf["partner"] = $addon_config[$paytype.'Partner'];
            }
            //$pay = new \Think\Pay($paytype, C('payment.' . $paytype));
            $pay = new \Addons\PayMent\Think\Pay($paytype, $conf);
            $order_no = $pay->createOrderNo();
            $vo = new \Think\Pay\PayVo();
            $vo->setBody("商品描述")
                    ->setFee($money) //支付金额
                    ->setOrderNo($order_no)
                    ->setTitle($title)
                    ->setCallback("Pay/pay")
                    ->setUrl(U("User/order"))
                    ->setParam(array('order_id' => $order_id));
            echo $pay->buildRequestForm($vo);

    }

    /**
     * 订单支付成功
     * @param type $money
     * @param type $param
     */
    public function pay($money, $param) {
        if (session("pay_verify") == true) {
            session("pay_verify", null);
            //处理goods1业务订单、改名good1业务订单状态
            //M("GoodsOrder")->where(array('order_id' => $param['order_id']))->setInc('haspay', $money);
            M("Order")->where(array('order_id' => $param['order_id']))->save(array('haspay' => $money));
        } else {
            E("Access Denied");
        }
    }

}
