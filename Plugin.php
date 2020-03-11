<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 一言骚话（<a href="http://blog.kjun.wang">emmm...还没写手册</a>）
 * 
 * @package yiyan
 * @author kjundada
 * @version 0.1.1 (beta)
 * @link http://blog.kjun.wang/
 */
class yiyan_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        return("成功开启插件,快去设置吧~");
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
        return("成功卸载");
    }
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        /** 分类名称 */
        preg_match("/^(http(s)?:\/\/)?([^\/]+)/i", Helper::options()->siteUrl, $matches);
        $domain = $matches[2] ? $matches[2] : '';
        $site = new Typecho_Widget_Helper_Form_Element_Text('site', NULL, $domain, _t('站点域名'), _t('如果是本站请填写https://yousite/usr/plugins/yiyan/php/'));
        echo '骚话在php文件夹下的txt文件中,请把yiyan.php放到主题目录下,再加一个yiyan页面(自定义模板里选择yiyan),你可以修改yiyan.php';
        $form->addInput($site);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 显示一言(自制骚话)
     * 语法: yiyan_Plugin::output();
     * 输出：'骚话'
     * @author kjundada
     * @param string $before
     * @throws Typecho_Exception
     */
    public static function output($say)
    {
        $options = Helper::options();
        Typecho_Widget::widget('Widget_Options')->plugin('yiyan_Plugin');
        $site = $options->plugin('yiyan_Plugin')->site;
        $say = file_get_contents('$site');
        echo '$say';
    }
}
