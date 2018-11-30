<?php
/**
 * @package SocialIconLinksWidget
 */

namespace SocialIconLinksWidget;

final class Init
{
    /**
     * Store all the classes inside of an array
     * @static
     * @return array Full list of classes
     */
    public static function get_services()
    {
        return [
            Api\Widgets\SocialIconLinks::class,
            Base\Enqueue::class
        ];
    }

    /**
     * Loop through the classes, creates a new instance of each, and call the register() method if it exists
     * @static
     * @return
     */
    public static function register_services()
    {
        foreach( self::get_services() as $class )
        {
            $service = self::instantiate( $class );

            if ( method_exists( $service, 'register' ) )
            {
                $service->register();
            }
        }
    }

    /**
     * Creates a new instance of a class
     * @static
     * @return class Instance of the $class parameter
     */
    public static function instantiate( $class )
    {
        return new $class();
    }
}