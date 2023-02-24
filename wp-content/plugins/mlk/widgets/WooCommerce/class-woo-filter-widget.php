<?php

require_once MLK_PLUGIN_DIR . 'wp-verify.php';

class Woo_Filter extends Elementor\Widget_Base {

    public function get_name(): string {
        return 'MLK_Filter';
    }

    public function get_title(): string {
        return 'MLK Фильтр';
    }

    public function get_icon(): string {
        return 'eicon-product-categories';
    }

    public function get_custom_help_url(): string {
        return 'https://t.me/Milkyc_A';
    }

    public function get_style_depends(): array {
        return ['mlk-woo-filter-css'];
    }

    public function get_categories(): array {
        return ['woocommerce-elements', 'mlk'];
    }

    protected function register_controls(): void {

        $this->start_controls_section(
            'section_categories',
            [
                'label' => 'Категории',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $options = ['default' => 'Выберите...',];
        $all_categories = get_categories( [
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ] );
        foreach ( $all_categories as $category ) {
            $id = $category->term_id;
            if ( $category->category_parent == 0 ) {
                $options[$id] = $category->name;
            }
        }

        $this->add_control(
            'mlk_filters',
            [
                'label' => 'Список категорий',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    'list_title' => [
                        'name' => 'list_title',
                        'label' => 'Название ячейки',
                        'default' => 'Фильтр',
                        'type' => \Elementor\Controls_Manager::TEXT,
                    ],
                    'cat_name' => [
                        'name' => 'cat_name',
                        'label' => 'Заголовок категории',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    'list_cat' => [
                        'name' => 'list_cat',
                        'label' => 'Категория-родитель',
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => $options,
                        'default' => 'default',
                    ],
                    'switch_parent' => [
                        'name' => 'switch_parent',
                        'label' => 'Отображать родителя в фильтрах',
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => 'Да',
                        'label_off' => 'Нет',
                        'return_value' => 'true',
                        'default' => 'true',
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
                'prevent_empty' => false,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            [
                'label' => 'СКОРО!!!! Настройки Категорий',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        require MLK_PLUGIN_DIR . 'widgets/templates/WooCommerce/woo-filter-template.php';
    }

}