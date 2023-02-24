<?php
require_once MLK_PLUGIN_DIR . 'wp-verify.php';
class MLK_Admin {

    public function __construct() {
        wp_register_style( 'mlk-admin-panel-css', MLK_PLUGIN_URL . "admin/templates/styles/mlk-admin-panel.css" );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    public function admin_menu(): void {
        $icon = 'data:image/svg+xml;base64,' . base64_encode( '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.99998 18.0894C14.4901 18.0894 18.1301 14.4495 18.1301 9.95935C18.1301 5.46923 14.4901 1.82927 9.99998 1.82927C5.50986 1.82927 1.8699 5.46923 1.8699 9.95935C1.8699 14.4495 5.50986 18.0894 9.99998 18.0894ZM5.09548 4.70129L4.6687 4.27451V4.87807V14.5664H5.1687V5.48162L9.14024 9.45316V14.5664V14.8164H9.39024H16.0976V14.3164H14.1118V13.8212V4.87807V4.27451L13.685 4.70129L9.64024 8.74606V4.87805H9.14024V8.74605L5.09548 4.70129ZM9.64024 9.99132V9.45317L13.6118 5.48162V13.8212V13.9629L9.64024 9.99132ZM9.64024 10.6984V14.3164H13.2582L9.64024 10.6984Z" fill="black"/><path fill-rule="evenodd" clip-rule="evenodd" d="M10 20C15.5228 20 20 15.5228 20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10C0 15.5228 4.47715 20 10 20ZM10 18.8496C14.8875 18.8496 18.8496 14.8875 18.8496 10C18.8496 5.11252 14.8875 1.15044 10 1.15044C5.11253 1.15044 1.15045 5.11252 1.15045 10C1.15045 14.8875 5.11253 18.8496 10 18.8496Z" fill="black"/></svg>') ;
        add_menu_page( 'MLK >> Настройки плагина', 'MLK', 'manage_options', 'mlk_plugin', array( $this, 'render_main_page' ), $icon, 56 );
    }

    public function render_main_page(): void {
        wp_enqueue_style( "mlk-admin-panel-css" );
        require_once MLK_PLUGIN_DIR . 'admin/templates/mlk-admin-panel.php';
    }

}