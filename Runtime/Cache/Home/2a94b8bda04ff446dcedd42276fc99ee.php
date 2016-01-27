<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title><?php echo C('c_title');?></title>
    <meta name="Description" content="<?php echo C('c_desc');?>" />
    <meta name="Keywords" content="<?php echo C('c_keyword');?>" />
</head>
<body>
<?php echo hook('PageFooter');?>
<?php echo hook('PayMent');?>
<?php echo hook('SyncLogin');?>
</body>
</html>