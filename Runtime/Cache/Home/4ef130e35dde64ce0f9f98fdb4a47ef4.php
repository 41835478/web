<?php if (!defined('THINK_PATH')) exit(); if(!empty($config['type'])){ ?>
<div>
    <form action="<?php echo addons_url('PayMent://Pay/index'); ?>" method="post">
        <?php if(in_array('Alipay',$config['type'])): ?>
        <label><input type="radio" name="paytype" value="Alipay" />支付宝</label>
        <?php endif; ?>
        <?php if(in_array('Tenpay',$config['type'])): ?>
        <label><input type="radio" name="paytype" value="Tenpay" />财付通</label>
        <?php endif; ?>
        <?php if(in_array('Kuaiqian',$config['type'])): ?>
        <label><input type="radio" name="paytype" value="Kuaiqian" />快钱</label>
        <?php endif; ?>
        <?php if(in_array('Unionpay',$config['type'])): ?>
        <label><input type="radio" name="paytype" value="Unionpay" />银联</label>
        <?php endif; ?>
        <input type="text" name="money" value="200" />
        <input type="submit" value="提交" />
    </form>
</div>
<?php } ?>