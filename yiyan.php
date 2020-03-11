<?php
/** 
 * yiyan
 *
 * @package custom
 *  
 * @author      kjundada
 * @version     0.1.1 (beta)
 * 
*/ 
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php $this->need('head.php'); ?>
<!--post-item start-->
<?php echo file_get_contents('http://blog.kjun.wang/yulu/'); ?>
<?php yiyan_Plugin::yiyan() ?>
<?php echo file_get_contents('http://blog.kjun.wang/yulu/'); ?>
<?php 
        $options = Helper::options();
        $site = $options->plugin('yiyan_Plugin')->site;
        echo file_get_contents('$site');
?>
<!--post-item end-->
<?php $this->need('comments.php'); ?>
<?php $this->need('footer-info.php'); ?>
<?php $this->need('footer.php'); ?>
