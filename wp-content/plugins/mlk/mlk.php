<?php

/*
 * Plugin Name: MLK Studio
 * Description: Плагин создан для всего и только расширяется никаких шагов назад!
 * Author: Milkyc
 * Version: 1.0
 */
require_once 'wp-verify.php';
define( 'MLK_PLUGIN_DIR', plugin_dir_path(__FILE__));
define( 'MLK_PLUGIN_URL', plugin_dir_url(__FILE__));
require_once MLK_PLUGIN_DIR . 'includes/class-mlk-plugin.php';


register_activation_hook(__FILE__, 'mlk_plugin_activation');
function mlk_plugin_activation(): void {
    MLK_PLUGIN::activation();
}

function start_plugin(): void {
    $plugin = new MLK_PLUGIN();
}
start_plugin();