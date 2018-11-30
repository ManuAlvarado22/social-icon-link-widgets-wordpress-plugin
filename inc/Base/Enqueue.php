<?php
/**
 * @package SocialIconLinksWidget
 */

namespace SocialIconLinksWidget\Base;

use SocialIconLinksWidget\Base\BaseController;

class Enqueue extends BaseController
{
    /**
     * Register hooks and actions from WordPress
     * @return
     */
    public function register()
    {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Enqueue scripts and stylesheets
     * @return
     */
    public function enqueue_scripts()
    {
        wp_enqueue_style( 'ivanasocialiconswidget-font-awesome-cdn', 'https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css' );
        wp_enqueue_style( 'ivanasocialiconswidget-font-awesome-brands-cdn', 'https://use.fontawesome.com/releases/v5.4.1/css/brands.css' );
        wp_enqueue_style( 'social-icon-links-widget-style', $this->plugin_url . 'assets/dist/css/style.css' );
    }
}