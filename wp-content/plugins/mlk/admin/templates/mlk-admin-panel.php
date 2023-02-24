<?php
require_once MLK_PLUGIN_DIR . 'wp-verify.php';

?>

    <div class="container">
        <form method="get">
            <div class="l-menu">
                <span>MLK настройки</span>
            </div>
            <div class="h-menu">
                    <input type="hidden" name='page' value="<?php echo $_GET['page'] ?>">
                    <button class="woocommerce_choose_button" name="cat" value="woocommerce">WooCommerce</button>
                    <img class="mlk-logo" src="<?php echo MLK_PLUGIN_URL . 'admin/templates/images/Logo.png' ?>">
            </div>
        </form>
        <div class="body">
            <?php
                if ( ! isset( $_GET['cat'] ) ) {
                    require_once MLK_PLUGIN_DIR . 'admin/templates/pages/mlk-admin-main.php';
                } else {
                    if ($_GET['cat'] == 'woocommerce') {
                        require_once MLK_PLUGIN_DIR . 'admin/templates/pages/mlk-admin-woocommerce.php';
                    }
                }
            ?>
        </div>
    </div>

<script>
</script>