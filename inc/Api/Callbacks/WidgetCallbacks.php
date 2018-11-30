<?php
/**
 * @package SocialIconLinksWidget
 */

namespace SocialIconLinksWidget\Api\Callbacks;

use SocialIconLinksWidget\Base\BaseController;

class WidgetCallbacks extends BaseController
{
    /**
     * Social Icon Links widget front-end view
     * @param class $widget_instance Instance of the SocialIconLinksWidget class
     * @return
     */
    public function social_icon_links_widget( $widget_instance )
    { 
        echo '<ul class="social-icon-links">';
        
        foreach ( $widget_instance->social_icons as $social_icon_name => $social_icon )
        {
            if ( ! empty( $social_icon ) )
            { ?>

                <li class="social-icon-links__element">
                    <a 
                        href="<?php echo esc_url( $social_icon ); ?>"
                        class="<?php echo 'social-icon-links__link social-icon-links__link--' . $social_icon_name; ?>"
                    >
                        <i class="<?php echo 'social-icon-links__icon fab ' . esc_attr( $widget_instance->social_icons_classes[ $social_icon_name ] ); ?>">
                    </i>
                </a>
            </li>

            <?php
            }    
        }

        echo '</ul>';
    }

    /**
     * Social Icon Links form view
     * @param class $widget_instance Instance of the SocialIconLinksWidget class
     * @return
     */
    public function social_icon_links_form( $widget_instance )
    { 
        foreach ( $widget_instance->social_icons as $social_icon_name => $social_icon )
        { ?>

            <div>
                <label for="<?php echo $widget_instance->get_field_id( $social_icon_name ); ?>">
                    <?php echo ucwords( str_replace( '_', ' ', $social_icon_name ) ); ?>
                </label>

                <input 
                    type="text" 
                    class="widefat"
                    id="<?php echo $widget_instance->get_field_id( $social_icon_name ); ?>"
                    name="<?php echo $widget_instance->get_field_name( $social_icon_name ); ?>"
                    value="<?php echo esc_attr( $social_icon ); ?>"
                >
            </div>

            <div>
                <label for="<?php echo $widget_instance->get_field_id( $social_icon_name . '_icon_color' ); ?>">
                    <?php echo ucwords( str_replace( '_', ' ', $social_icon_name . ' icon color' ) ); ?>
                </label>

                <input 
                    type="text" 
                    class="widefat"
                    id="<?php echo $widget_instance->get_field_id( $social_icon_name . '_icon_color' ); ?>"
                    name="<?php echo $widget_instance->get_field_name( $social_icon_name . '_icon_color' ); ?>"
                    value="<?php echo esc_attr( $widget_instance->social_icons_colors[ $social_icon_name . '_icon_color' ] ); ?>"
                >
            </div>

            <?php
        }
    }

    /**
     * Social Icon Links widget custom CSS
     * @param class $widget_instance Instance of the SocialIconLinksWidget class
     * @return
     */
    public function custom_css( $widget_instance )
    { 

        echo '<style type="text/css">';

        foreach ( $widget_instance->social_icons as $social_icon_name => $social_icon ) 
        {
            if ( ! empty( $widget_instance->social_icons_colors[ $social_icon_name . '_icon_color' ] ) )
            { ?>
                /*.social-icon-links__link--<?php echo $social_icon_name; ?> {
                    color: <?php echo $widget_instance->social_icons_colors[ $social_icon_name . '_icon_color' ]; ?> !important;
                }*/       
            <?php } ?>

            body {
                background-color: <?php echo $widget_instance->social_icons_colors[ 'instagram_icon_color' ]; ?> !important;
            }
        <?php
        }

        echo '</style>';
    }
}