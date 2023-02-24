<?php
require_once MLK_PLUGIN_DIR . 'wp-verify.php';

if ( isset( $_POST['create_cat_name'] ) ) {
    $parent = 0;
    if ( $_POST['create_cat_parent'] != 'none' ) {
        $parent = $_POST['create_cat_parent'];
    }
    wp_insert_term(
        $_POST['create_cat_name'],
        'product_cat',
        [
                'parent' => $parent,
        ],
    );
    wp_create_category($_POST['create_cat_name'], $parent);
}
$chose = null;
if ( isset( $_POST['remove_cat_parent'] ) ) {
    if ( $_POST['remove_cat_parent'] != 'none' ) {
        $chose = $_POST['remove_cat_parent'];
    }
    $to_remove = $_POST['remove_cat_parent'];
    if ( isset( $_POST['remove_cat_child'] ) && $_POST['remove_cat_child'] != 'none') {
        $to_remove = $_POST['remove_cat_child'];
    }
    if ($_POST['todo'] == 'delete') {
        $all_categories = get_categories( [
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent' => $to_remove,
        ] );
        foreach ($all_categories as $category) {
            wp_delete_term($category->term_id, 'product_cat');
        }
        wp_delete_term($to_remove, 'product_cat');
    }
}

?>

<div class="wc_content">
    <div class="wc_content_create_cat">
        <h2>Создать категорию фильтров</h2>
        <form method="post">
            <input type="hidden" name='cat' value="<?php echo $_GET['cat'] ?>">
            <input type="text" placeholder="Название" name="create_cat_name" required class="wc_fields">
            <select name="create_cat_parent" class="wc_fields">
                <option value="none">Выберите родителя (не обязательно)</option>
                <?php
                $all_categories = get_categories( [
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                ] );
                foreach ( $all_categories as $category ) {
                    if ($category->category_parent == 0) {
                        echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                    }
                }
                ?>
            </select>
            <br>
            <input type="submit" class="wc-submit" value="Создать">
        </form>
    </div>
    <div class="wc_content_edit_cat">
        <h2>Редактировать категорию фильтров</h2>
        <form method="post">
            <select name="remove_cat_parent" class="wc_fields" required>
                <option value="none">Выберите Категорию-родителя</option>
                <?php
                $all_categories = get_categories( [
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                ] );
                foreach ( $all_categories as $category ) {
                    if ($category->category_parent == 0) {
                        $selected = '';
                        if ($category->term_id == $chose) {
                            $selected = 'selected';
                        }
                        echo '<option value="' . $category->term_id . '" ' . $selected . '>' . $category->name . '</option>';
                    }
                }
                ?>
            </select>
            <button name="todo" value="choose" class="wc-submit">выбрать</button>
            <button name="todo" value="delete" class="wc-submit">удалить</button>
            <br>
            <select name="remove_cat_child" class="wc_fields" required>
                <option value="none">Выберите Категорию</option>
                <?php
                if ($chose != null) {
                    $all_categories = get_categories([
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                        'parent' => $chose,
                    ]);
                    foreach ($all_categories as $category) {
                        echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                    }
                }
                ?>
            </select>
            <button name="todo" value="delete" class="wc-submit">удалить</button>
        </form>
    </div>
</div>