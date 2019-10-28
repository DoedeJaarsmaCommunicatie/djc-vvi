<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://doedejaarsma.nl
 * @since      1.0.0
 *
 * @package    Djc_Vvi
 * @subpackage Djc_Vvi/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Djc_Vvi
 * @subpackage Djc_Vvi/public
 * @author     Doede Jaarsma communicatie <mitch@doedejaarsma.nl>
 */
class Djc_Vvi_Public
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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * @param \WP_REST_Response $response
     * @param $object
     * @param \WP_REST_Request $request
     */
    public static function bumpApiPrice($response, $object, $request)
    {
        $upscale = carbon_get_user_meta(get_current_user_id(), 'upscale_price');
        if (null === $upscale || '' === $upscale) {
            return $response;
        }
        $upscale               = (int) $upscale;
        $upscale               /= 100;
        $data                  = $response->get_data();
        $oldprice              = $data['price'];
        $data['price']         = round((float) $data['price'] * $upscale, 2);
        $data['regular_price'] = round((float) $data['regular_price'] * $upscale, 2);
        $data['sale_price']    = round((float) $data['sale_price'] * $upscale, 2);
        $data['price_html']    = str_replace(
            str_replace('.', ',', $oldprice),
            $data['price'],
            $data['price_html']
        );
        
        $response->set_data($data);
        
        return $response;
    }
}
