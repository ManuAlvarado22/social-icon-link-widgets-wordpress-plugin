<?php
/**
 * @package SocialIconLinksWidget
 */

namespace SocialIconLinksWidget\Api\Widgets;

use SocialIconLinksWidget\Api\Callbacks\WidgetCallbacks;
use WP_Widget;

class SocialIconLinks extends WP_Widget
{
    /**
     * WidgetCallbacks instance
     * @var class
     */
    public $callbacks;

    /**
     * Widget unique identifier
     * @var string
     */
    public $widget_id;

    /**
     * Widget name
     * @var string
     */
    public $widget_name;

    /**
     * Widget options array
     * @var array
     */
    public $widget_options = [];

    /**
     * Widget instance options for social icon links
     * @var array
     */
    public $social_icons = [
        'instagram'   => '',
        'facebook'    => '',
        'twitter'     => '',
        'youtube'     => '',
        'github'      => '',
        'patreon'     => '',
        'behance'     => '',
        'dribbble'    => '',
        'snapchat'    => '',
        'tumblr'      => '',
        'google_plus' => ''
    ];

    /**
     * Widget instance options for icons colors
     * @var array
     */
    public $social_icons_colors = [
        'instagram_icon_color'   => '',
        'facebook_icon_color'    => '',
        'twitter_icon_color'     => '',
        'youtube_icon_color'     => '',
        'github_icon_color'      => '',
        'patreon_icon_color'     => '',
        'behance_icon_color'     => '',
        'dribbble_icon_color'    => '',
        'snapchat_icon_color'    => '',
        'tumblr_icon_color'      => '',
        'google_plus_icon_color' => ''
    ];

    /**
     * CSS classes for social Font Awesome icons
     * @var array
     */
    public $social_icons_classes = [
        'instagram'   => 'fa-instagram',
        'facebook'    => 'fa-facebook',
        'twitter'     => 'fa-twitter',
        'youtube'     => 'fa-youtube',
        'github'      => 'fa-github',
        'patreon'     => 'fa-patreon',
        'behance'     => 'fa-behance',
        'dribbble'    => 'fa-dribbble',
        'snapchat'    => 'fa-snapchat',
        'tumblr'      => 'fa-tumblr',
        'google_plus' => 'fa-google-plus-g'
    ];

    /**
     * Assigns values to the widget properties
     * @return
     */
    public function __construct()
    {
        $this->callbacks = new WidgetCallbacks;
        
        $this->widget_id = 'social_icon_links_widget';
        $this->widget_name = 'Social Icon Links';

        $this->widget_options['classname'] = $this->widget_id;
        $this->widget_options['description'] = 'Nicely display social icons for your social networks';
        $this->widget_options['customize_selective_refresh'] = true;
    }

    /**
     * Calls the parent constructor and calls register hooks and actions from WordPress
     * @return
     */
    public function register()
    {
        parent::__construct( $this->widget_id, $this->widget_name, $this->widget_options );
        
        // add_action( 'wp_footer', [ $this, 'custom_css' ] );
        add_action( 'widgets_init', [ $this, 'register_widget' ] );
        add_action( 'wp_print_styles', [ $this, 'custom_css' ] );
    }

    /**
     * Register hook for WordPress widgets
     * @return
     */
    public function register_widget()
    {
        register_widget( $this );
    }

    /**
     * Calls the Widget's custom CSS callback
     * @return
     */
    public function custom_css()
    { 
        $this->callbacks->custom_css( $this );
    }

    /**
     * Outputs the options form on admin
     * @param array $args Sidebar arguments array
     * @param array $instance This instance options array
     * @return
     */
    public function widget( $args, $instance )
    {
        foreach ( $this->social_icons as $social_icon_name => $social_icon )
        {
            $this->social_icons[ $social_icon_name ] = $instance[ $social_icon_name ];  
        }
        
        foreach ( $this->social_icons_colors as $social_icon_name => $social_icon_color )
        {
            $this->social_icons_colors[ $social_icon_name ] = $instance[ $social_icon_name ];

            echo $social_icon_color;
        }

        echo $args['before_widget'];

        $this->callbacks->social_icon_links_widget( $this );

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     * @param array $instance This instance options array
     * @return
     */
    public function form( $instance )
    {
        foreach ( $this->social_icons as $social_icon_name => $social_icon )
        {
            $this->social_icons[ $social_icon_name ] = $instance[ $social_icon_name ];  
        }
        
        foreach ( $this->social_icons_colors as $social_icon_name => $social_icon_color )
        {
            $this->social_icons_colors[ $social_icon_name ] = $instance[ $social_icon_name ];
        }
        
        $this->callbacks->social_icon_links_form( $this ); ?>

    <?php
    }

    /**
     * Process widget options on save
     * @param array $new_instance New instance options
     * @param array $old_instance Current instance options
     * @return array Updated instance options
     */
    public function update( $new_instance, $old_instance )
    {
        foreach ( $this->social_icons as $social_icon_name => $social_icon )
        {
            $old_instance[ $social_icon_name ] =  sanitize_text_field( $new_instance[ $social_icon_name ] );
        }

        foreach ( $this->social_icons_colors as $social_icon_name => $social_icon )
        {
            $old_instance[ $social_icon_name ] =  sanitize_text_field( $new_instance[ $social_icon_name ] );
        }

        return $old_instance;
    }
}
