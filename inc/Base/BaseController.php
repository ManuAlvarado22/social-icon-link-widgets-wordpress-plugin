<?php
/**
 * @package SocialIconLinksWidget
 */

namespace SocialIconLinksWidget\Base;

class BaseController
{
    /**
     * @var string|null Plugin path
     */
    protected $plugin_path = null;
    
    /**
     * @var string|null Plugin URL
     */
    protected $plugin_url = null;
    
    /**
     * @var string|null Plugin name
     */
    protected $plugin_name = null;

    /**
     * Assigns values for class properties
     */
    public function __construct()
    {
        $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
        $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
        // $this->plugin_name = plugin_basename( dirname( __FILE__, 2 ) ) . '/featured-page.php';
        $this->plugin_name = plugin_basename( dirname( __FILE__ ) ) . '/featured-page.php';
    }
}