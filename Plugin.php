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
    //获取句子文件的绝对路径
    //如果你介意别人可能会拖走这个文本，可以把文件名自定义一下，或者通过Nginx禁止拉取也行。
    $path = dirname(__FILE__);
    $file = file($path."/hitokoto.txt");
 
    //随机读取一行
    $arr  = mt_rand( 0, count( $file ) - 1 );
    $content  = trim($file[$arr]);
 
    //编码判断，用于输出相应的响应头部编码
    if (isset($_GET['charset']) && !empty($_GET['charset'])) {
    $charset = $_GET['charset'];
    if (strcasecmp($charset,"gbk") == 0 ) {
        $content = mb_convert_encoding($content,'gbk', 'utf-8');
    }
    } else {

    $charset = 'utf-8';
    }
    header("Content-Type: text/html; charset=$charset");
 
    //格式化判断，输出js或纯文本
    if ($_GET['format'] === 'js') {
    echo "function hitokoto(){document.write('" . $content ."');}";
    } else {
    echo $content;
    }
    }
}
