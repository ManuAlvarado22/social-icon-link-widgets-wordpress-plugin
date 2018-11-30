<?php
/**
 * @package SocialIconLinksWidget
 * 
 * Plugin Name: Social Icon Links Widget
 * Plugin URI: http://manuela.sgedu.site/ivana-fashion-blog
 * Description: This plugin allows you to display social icons for your social networks with a widget
 * Version: 1.0.0
 * Author: Manuel Alvarado
 * Author URI: http://manuela.sgedu.site/ivana-fashion-blog
 * License: GPL 2
 */

if ( ! defined( 'ABSPATH' ) )
{
    die;
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) )
{
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Calls the activate method to activate the Social Icon Links Widget plugin
 */
function activate_social_icon_links_widget_plugin()
{
    SocialIconLinksWidget\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_social_icon_links_widget_plugin' );

/**
 * Calls the deactivate method to activate the Social Icon Links Widget plugin
 */
function deactivate_social_icon_links_widget_plugin()
{
    SocialIconLinksWidget\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_social_icon_links_widget_plugin' );

if ( class_exists( 'SocialIconLinksWidget\\Init' ) )
{
    SocialIconLinksWidget\Init::register_services();
}