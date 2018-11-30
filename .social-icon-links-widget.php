<?php
/**
 * Plugin Name: Social Icon Links Widget
 * Plugin URI: http://manuela.sgedu.site/ivana-fashion-blog
 * Description: This plugin allows you to display social icons for your social networks with a widget
 * Version: 1.0.0
 * Author: Manuel Alvarado
 * Author URI: http://manuela.sgedu.site/ivana-fashion-blog
 * License: GPL 2
 */

class ivanasocialiconswidget_Social_Icon_Links extends WP_Widget
{
    private $social_icons_classes = [
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

    public function __construct()
    {
        $widget_options = [
            'classname'   => 'social-icon-links-widget',
            'description' => 'Add a # (octothorpe) for blank links'
        ];

        parent::__construct( 'social_icon_links', 'Social Icon Links', $widget_options );
    
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        add_action( 'admin_footer-widgets.php', [ $this, 'print_scripts' ], 9999 );
    }

    // I got this nice code from:
    // https://gist.github.com/rodica-andronache/54f3ea95bcaf76435e55
    // 😸
    public function enqueue_scripts()
    {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }

    public function print_scripts()
    { ?>
        <script>
            $(document).ready(function() {
                // I really, honestly, sincerely
                // don't know what is going on
                // in this piece of code, and i feel
                // a bit uncomfortable about using this.
                // However, i need it.
                // In regards to _.throttle,
                // it comes from underscore.js
                // and not from lodash ):
                // Thanks a lot to:
                // https://gist.github.com/rodica-andronache/54f3ea95bcaf76435e55
                // So no more _.throttle!
                // And it is a bit more understandable for me : D

                function initColorPicker(widget) {
                    widget.find('.color-picker').wpColorPicker({
						change: function(event, style) {
                            $(this).val(style.color.toString());
                            $(this).trigger('change');
                        },
                        clear: function(event, style) {
                            $(this).trigger('change');
                            console.log('Mou');
                        }
                    });
				}

				function onFormUpdate(event, widget) {
					initColorPicker(widget);
				}

				$(document).on('widget-added widget-updated', onFormUpdate);

                $(document).ready(function() {
					$('.widget:has(.color-picker)').each(function () {
						initColorPicker($(this));
					});
				});
            }); 
        </script>
    <?php
    }

    public function widget( $args, $instance )
    {
        $social_icons = [
            'instagram'   => $instance['instagram'],
            'facebook'    => $instance['facebook'],
            'twitter'     => $instance['twitter'],
            'youtube'     => $instance['youtube'],
            'github'      => $instance['github'],
            'patreon'     => $instance['patreon'],
            'behance'     => $instance['behance'],
            'dribbble'    => $instance['dribbble'],
            'snapchat'    => $instance['snapchat'],
            'tumblr'      => $instance['tumblr'],
            'google_plus' => $instance['google_plus']
        ];
        
        $social_icons_colors = [
            'instagram'   => $instance['instagram_icon_color'],
            'facebook'    => $instance['facebook_icon_color'],
            'twitter'     => $instance['twitter_icon_color'],
            'youtube'     => $instance['youtube_icon_color'],
            'github'      => $instance['github_icon_color'],
            'patreon'     => $instance['patreon_icon_color'],
            'behance'     => $instance['behance_icon_color'],
            'dribbble'    => $instance['dribbble_icon_color'],
            'snapchat'    => $instance['snapchat_icon_color'],
            'tumblr'      => $instance['tumblr_icon_color'],
            'google_plus' => $instance['google_plus_icon_color']
        ]; 
        
        echo $args['before_widget']; ?>
        
        <ul class="social-icon-links">
            <?php
            foreach ($social_icons as $social_site_name => $social_icon)
            {
                if ( ! empty( $social_icon ) )
                { ?>
                    <li class="social-icon-links__element">
                        <a 
                            href="<?php echo esc_url( $social_icon ); ?>"
                            class="social-icon-links__link"
                            style="<?php echo 'color: ' . $social_icons_colors[ $social_site_name ] . ';'; ?>;"
                        >
                            <i 
                                class="<?php echo 'social-icon-links__icon fab ' . 
                                       esc_attr( $this->social_icons_classes[ $social_site_name ] ); ?>"
                            ></i>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>

    <?php
    echo $args['after_widget'];

    }

    public function form( $instance )
    {
        $social_icons = [
            'instagram'   => $instance['instagram'],
            'facebook'    => $instance['facebook'],
            'twitter'     => $instance['twitter'],
            'youtube'     => $instance['youtube'],
            'github'      => $instance['github'],
            'patreon'     => $instance['patreon'],
            'behance'     => $instance['behance'],
            'dribbble'    => $instance['dribbble'],
            'snapchat'    => $instance['snapchat'],
            'tumblr'      => $instance['tumblr'],
            'google_plus' => $instance['google_plus']
        ];

        $social_icons_colors = [
            'instagram'   => $instance['instagram_icon_color'],
            'facebook'    => $instance['facebook_icon_color'],
            'twitter'     => $instance['twitter_icon_color'],
            'youtube'     => $instance['youtube_icon_color'],
            'github'      => $instance['github_icon_color'],
            'patreon'     => $instance['patreon_icon_color'],
            'behance'     => $instance['behance_icon_color'],
            'dribbble'    => $instance['dribbble_icon_color'],
            'snapchat'    => $instance['snapchat_icon_color'],
            'tumblr'      => $instance['tumblr_icon_color'],
            'google_plus' => $instance['google_plus_icon_color']
        ]; 
        
        foreach ( $social_icons as $social_site_name => $social_icon ) 
        { ?>
            <div>
                <label for="<?php echo $this->get_field_id( $social_site_name ); ?>">
                    <?php echo ucwords( str_replace( '_', ' ', $social_site_name ) ); ?>
                </label>

                <input 
                    type="text"
                    class="widefat"
                    id="<?php echo $this->get_field_id( $social_site_name ); ?>"
                    name="<?php echo $this->get_field_name( $social_site_name ); ?>"
                    value="<?php echo esc_attr( $social_icon ); ?>"
                />
            </div>
    
            <div>
                <label for="<?php echo $this->get_field_id( $social_site_name . '_icon_color' ); ?>">
                    <?php echo ucwords( str_replace( '_', ' ', $social_site_name . ' icon color' ) ); ?>
                </label>
                
                <input 
                    type="text" name="<?php echo $this->get_field_name( $social_site_name . '_icon_color' ); ?>" 
                    class="widefat color-picker" 
                    id="<?php echo $this->get_field_id( $social_site_name . '_icon_color' ); ?>" 
                    value="<?php echo esc_attr( $social_icons_colors[ $social_site_name ] ) ?>" 
                    data-default-color="#fff" 
                />
            </div>
        <?php } ?>
    <?php 
    }

    public function update( $new_instance, $old_instance )
    {
        $social_icons = [
            'instagram'   => $new_instance['instagram'],
            'facebook'    => $new_instance['facebook'],
            'twitter'     => $new_instance['twitter'],
            'youtube'     => $new_instance['youtube'],
            'github'      => $new_instance['github'],
            'patreon'     => $new_instance['patreon'],
            'behance'     => $new_instance['behance'],
            'dribbble'    => $new_instance['dribbble'],
            'snapchat'    => $new_instance['snapchat'],
            'tumblr'      => $new_instance['tumblr'],
            'google_plus' => $new_instance['google_plus']
        ];

        $social_icons_colors = [
            'instagram'   => $new_instance['instagram_icon_color'],
            'facebook'    => $new_instance['facebook_icon_color'],
            'twitter'     => $new_instance['twitter_icon_color'],
            'youtube'     => $new_instance['youtube_icon_color'],
            'github'      => $new_instance['github_icon_color'],
            'patreon'     => $new_instance['patreon_icon_color'],
            'behance'     => $new_instance['behance_icon_color'],
            'dribbble'    => $new_instance['dribbble_icon_color'],
            'snapchat'    => $new_instance['snapchat_icon_color'],
            'tumblr'      => $new_instance['tumblr_icon_color'],
            'google_plus' => $new_instance['google_plus_icon_color']
        ];

        foreach ($social_icons as $social_site_name => $social_icon)
        {
            $old_instance[ $social_site_name ] = strip_tags( $social_icon );
            $old_instance[ $social_site_name . '_icon_color' ] = strip_tags( $social_icons_colors[ $social_site_name ] );
        }
 
        return $old_instance;
    }
}

function ivanasocialiconswidget_register_social_icon_links_widget()
{
    register_widget( 'ivanasocialiconswidget_Social_Icon_Links' );
}
add_action( 'widgets_init', 'ivanasocialiconswidget_register_social_icon_links_widget' );

function ivanasocialiconswidget_scripts()
{
    wp_enqueue_style( 'ivanasocialiconswidget-font-awesome-brands-cdn', 'https://use.fontawesome.com/releases/v5.4.1/css/brands.css' );
    wp_enqueue_style( 'ivanasocialiconswidget-font-awesome-cdn', 'https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css' );
    wp_enqueue_style( 'ivanasocialiconswidget-style', plugin_dir_url( __FILE__ ) . 'public/styles/style.css', [], '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'ivanasocialiconswidget_scripts' );