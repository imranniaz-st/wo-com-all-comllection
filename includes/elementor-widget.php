<?php
/**
 * Marble Collection Elementor Widget
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_Elementor_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'marble_collection_widget';
    }
    
    public function get_title() {
        return esc_html__('Marble Collection', 'marble-collection');
    }
    
    public function get_icon() {
        return 'eicon-products';
    }
    
    public function get_categories() {
        return array('marble-collection');
    }
    
    public function get_keywords() {
        return array('marble', 'collection', 'products', 'woocommerce');
    }
    
    protected function register_controls() {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__('Settings', 'marble-collection'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        
        $this->add_control(
            'collection_layout',
            array(
                'label'   => esc_html__('Layout', 'marble-collection'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => array(
                    'grid'   => esc_html__('Grid with Filters', 'marble-collection'),
                    'simple' => esc_html__('Simple Grid', 'marble-collection'),
                ),
            )
        );
        
        $this->add_control(
            'columns',
            array(
                'label'   => esc_html__('Columns', 'marble-collection'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => array(
                    '2' => esc_html__('2 Columns', 'marble-collection'),
                    '3' => esc_html__('3 Columns', 'marble-collection'),
                    '4' => esc_html__('4 Columns', 'marble-collection'),
                ),
            )
        );
        
        $this->add_control(
            'show_filters',
            array(
                'label'        => esc_html__('Show Filters', 'marble-collection'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'marble-collection'),
                'label_off'    => esc_html__('No', 'marble-collection'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => array(
                    'collection_layout' => 'grid',
                ),
            )
        );
        
        $this->add_control(
            'show_search',
            array(
                'label'        => esc_html__('Show Search', 'marble-collection'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'marble-collection'),
                'label_off'    => esc_html__('No', 'marble-collection'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => array(
                    'collection_layout' => 'grid',
                ),
            )
        );
        
        $this->add_control(
            'show_title',
            array(
                'label'        => esc_html__('Show Product Title', 'marble-collection'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'marble-collection'),
                'label_off'    => esc_html__('No', 'marble-collection'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );
        
        $this->add_control(
            'show_description',
            array(
                'label'        => esc_html__('Show Product Description', 'marble-collection'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'marble-collection'),
                'label_off'    => esc_html__('No', 'marble-collection'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );
        
        $this->add_control(
            'show_quick_view',
            array(
                'label'        => esc_html__('Show Quick View Button', 'marble-collection'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'marble-collection'),
                'label_off'    => esc_html__('No', 'marble-collection'),
                'return_value' => 'yes',
                'default'      => 'no',
            )
        );
        
        $this->end_controls_section();
        
        // Style Tab
        $this->start_controls_section(
            'style_section',
            array(
                'label' => esc_html__('Styles', 'marble-collection'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );
        
        // Title Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => esc_html__('Title Typography', 'marble-collection'),
                'selector' => '{{WRAPPER}} .mcd-product-title',
            )
        );
        
        // Title Color
        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__('Title Color', 'marble-collection'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .mcd-product-title' => 'color: {{VALUE}};',
                ),
            )
        );
        
        // Description Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name'     => 'excerpt_typography',
                'label'    => esc_html__('Description Typography', 'marble-collection'),
                'selector' => '{{WRAPPER}} .mcd-product-excerpt',
            )
        );
        
        // Description Color
        $this->add_control(
            'excerpt_color',
            array(
                'label'     => esc_html__('Description Color', 'marble-collection'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .mcd-product-excerpt' => 'color: {{VALUE}};',
                ),
            )
        );
        
        // Product Card Background
        $this->add_control(
            'card_bg_color',
            array(
                'label'     => esc_html__('Card Background', 'marble-collection'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .mcd-product-item' => 'background-color: {{VALUE}};',
                ),
            )
        );
        
        // Gap between items
        $this->add_responsive_control(
            'item_gap',
            array(
                'label'      => esc_html__('Items Gap', 'marble-collection'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .mcd-products-grid' => 'gap: {{SIZE}}{{UNIT}};',
                ),
            )
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $atts = array(
            'columns' => $settings['columns'],
        );
        
        if ('simple' === $settings['collection_layout']) {
            $atts['filters'] = 'false';
            $atts['search']  = 'false';
        } else {
            $atts['filters'] = 'yes' === $settings['show_filters'] ? 'true' : 'false';
            $atts['search']  = 'yes' === $settings['show_search'] ? 'true' : 'false';
        }
        
        // Add visibility settings
        $atts['show_title'] = 'yes' === $settings['show_title'] ? 'true' : 'false';
        $atts['show_description'] = 'yes' === $settings['show_description'] ? 'true' : 'false';
        $atts['show_quick_view'] = 'yes' === $settings['show_quick_view'] ? 'true' : 'false';
        
        // Use the shortcode to render
        echo do_shortcode('[marble_collection_display ' . implode(' ', array_map(
            function($key, $value) {
                return $key . '="' . esc_attr($value) . '"';
            },
            array_keys($atts),
            $atts
        )) . ']');
    }
}
