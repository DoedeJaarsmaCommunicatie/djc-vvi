<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://doedejaarsma.nl
 * @since      1.0.0
 *
 * @package    Djc_Vvi
 * @subpackage Djc_Vvi/admin
 */

use Carbon_Fields\Carbon_Fields;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Djc_Vvi
 * @subpackage Djc_Vvi/admin
 * @author     Doede Jaarsma communicatie <mitch@doedejaarsma.nl>
 */
class Djc_Vvi_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Adds carbon fields.
     *
     * @since 1.0.0
     */
    public static function addCarbonFields()
    {
        if (!Carbon_Fields::is_booted()) {
            Carbon_Fields::boot();
        }
    }
    
    /**
     * Adds user meta via Carbon fields.
     *
     * @since 1.0.0
     */
    public static function addUserMeta()
    {
        \Carbon_Fields\Container::make('user_meta', 'Api Settings')
            ->add_fields(
                [
                    \Carbon_Fields\Field::make('text', 'upscale_price', __('Price increase', 'djc-vvi'))
                ]
            );
    }
}
