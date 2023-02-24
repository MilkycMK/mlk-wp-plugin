<?php

class MLK_PLUGIN {

    public function __construct() {
        $this->load_dependencies();
        $this->init_hooks();
        $this->define_admin_hooks();
        $this->init_widget_manager();
    }

    public static function activation(): void {
        if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
            die( 'Невозможно активировать плагин без Elementor. Установите или активируйте Elementor и попробуйте снова' );
        }
    }

    private function load_dependencies(): void {
        require_once MLK_PLUGIN_DIR . 'admin/class-mlk-admin.php';
    }

    private function init_hooks(): void {

    }

    private function define_admin_hooks(): void {
        $plugin_admin = new MLK_Admin();
    }

    private function init_widget_manager(): void {
        require_once MLK_PLUGIN_DIR . 'widgets/class-mlk-wiget-manager.php';
        $widget_manager = new MLK_Widget_Manager();
    }

}