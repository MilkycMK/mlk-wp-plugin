<?php

require_once MLK_PLUGIN_DIR . 'wp-verify.php';

class MLK_Widget_Manager {

    public function __construct() {
        add_action( 'elementor/widgets/register', array( $this, 'register_elementor_widgets' ) );
        add_action( 'elementor/elements/categories_registered', array( $this, 'register_elementor_categories' ) );
    }

    public function register_elementor_widgets( $widgets_manager ): void {
        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            require_once MLK_PLUGIN_DIR . 'widgets/WooCommerce/class-woo-filter-widget.php';

            // WooCommerce filter
            wp_register_style( 'mlk-woo-filter-css', MLK_PLUGIN_URL . "widgets/templates/styles/mlk-woo-filter.css" );
            $widgets_manager->register( new Woo_Filter() );

        }
    }

    public function register_elementor_categories( $elements_manager ): void {
        $elements_manager->add_category(
            'mlk',
            [
                'title' => 'MLK',
            ]
        );
    }

}