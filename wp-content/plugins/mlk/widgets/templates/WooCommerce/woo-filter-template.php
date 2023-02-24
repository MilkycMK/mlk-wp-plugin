<?php
    require_once MLK_PLUGIN_DIR . 'wp-verify.php';

    $filter_settings = $this->get_settings_for_display()['mlk_filters'];
    if ( ! $filter_settings ) {
        return;
    }

    add_filter( 'woocommerce_shortcode_products_query', function ( $query_args ) {
        if ( isset( $_GET['mlk_cat'] ) ) {
            $tax_query = [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'term_taxonomy_id',
                    'terms' => [$_GET['mlk_cat']],
                ],
            ];
            $query_args['tax_query'] = $tax_query;
        }
        return $query_args;
   } );
?>

<form method="get">
    <ul class="mlk_filter">
        <li class="mlk_filter_element mlk_filter_reset_button mlk_filter_text"><button>Сбросить фильтры</button></li>
        <?php
            foreach ( $filter_settings as $filter ) {
                $id = $filter['list_cat'];
                if ($filter['list_cat'] == 'default' || get_the_category_by_ID( $id ) == null) {
                    continue;
                }
                echo '<ul class="mlk_filter_category">';

                if ( $filter['cat_name'] != '') {
                    $title = $filter['cat_name'];
                } else {
                    $title = get_the_category_by_ID( $id );
                }

                echo '<li class="mlk_filter_header mlk_filter_text"> ' . $title . ' </li>';

                $sub_categories = get_categories( [
                    'taxonomy' => 'product_cat',
                    'parent' => $filter['list_cat'],
                    'hide_empty' => false,
                ] );
                if ( $filter['switch_parent'] == 'true' ) {
                    echo '<li class="mlk_filter_element">
                             <button value="'. $id .'" name="mlk_cat" class="mlk_filter_text"> ' . get_the_category_by_ID( $id ) . ' </button>
                         </li>';
                }
                foreach ( $sub_categories as $category ) {
                    $sub_id = $category->term_id;
                    $name = $category->name;

                    echo '<li class="mlk_filter_element">
                            <button value="' . $sub_id . '" name="mlk_cat" class="mlk_filter_text"> ' . $name . ' </button>
                         </li>';
                }
                echo '</ul>';
            }
        ?>
    </ul>
</form>

<script>
    Array.from(document.getElementsByClassName("mlk_filter_category")).forEach(function (list) {
        Array.from(list.getElementsByClassName("mlk_filter_header")).forEach(function (element) {
            const list_of_sub_elements = Array.from(list.getElementsByClassName("mlk_filter_element"));
            const now_cat = new URLSearchParams(window.location.search).get('mlk_cat');
            const ids = [];
            Array.from(list.getElementsByTagName('button')).forEach(function (button) {
                ids.push(button.value);
            });
            if (ids.indexOf(now_cat) === -1) {
                list_of_sub_elements.forEach(function (el) {
                    el.style.display = 'none';
                });
            }
            element.addEventListener("click", function () {
                list_of_sub_elements.forEach(function (sub_element) {
                    sub_element.style.display = sub_element.style.display === '' ? 'none' : '';
                });
            });
        });
    });
</script>
