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
        Typecho_Plugin::factory('Widget_Archive_footer')->footer = array('yiyan_Plugin', 'footer');      
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
        $api = new Typecho_Widget_Helper_Form_Element_Text('api', NULL, NULL, _t('填你的API地址,加上http://'),);
        $form->addInput($api);
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
    public static function footer()
    {
        $options = Helper::options();
        if( is_null($options->plugin('yiyan')->api) )
        {
            return('没有API');
        }
        $api = $options->plugin('yiyan')->api;
        $say = file_get_contents($api);
        echo '<h5>$say</h5>';
    }
}
