<?php
/**
 * Collection Display Elementor Widget
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_Collection_Display_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'marble_collection';
    }

    public function get_title() {
        return __('Product Collection Gallery', 'marble-collection-display');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array('gta-marble');
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => __('Collection Settings', 'marble-collection-display'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'category',
            array(
                'label' => __('Category', 'marble-collection-display'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => __('superstone-quartz, kitchen, etc.', 'marble-collection-display'),
            )
        );

        $this->add_control(
            'columns',
            array(
                'label' => __('Columns', 'marble-collection-display'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '4',
                'options' => array(
                    '2' => __('2 Columns', 'marble-collection-display'),
                    '3' => __('3 Columns', 'marble-collection-display'),
                    '4' => __('4 Columns', 'marble-collection-display'),
                    '5' => __('5 Columns', 'marble-collection-display'),
                ),
            )
        );

        $this->add_control(
            'limit',
            array(
                'label' => __('Number of Products', 'marble-collection-display'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 12,
                'min' => 1,
                'max' => 100,
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $shortcode_atts = array();
        
        if (!empty($settings['category'])) {
            $shortcode_atts[] = 'category="' . esc_attr($settings['category']) . '"';
        }
        
        if (!empty($settings['columns'])) {
            $shortcode_atts[] = 'columns="' . esc_attr($settings['columns']) . '"';
        }
        
        if (!empty($settings['limit'])) {
            $shortcode_atts[] = 'limit="' . esc_attr($settings['limit']) . '"';
        }
        
        $shortcode = '[marble_collection ' . implode(' ', $shortcode_atts) . ']';
        
        echo do_shortcode($shortcode);
        echo '<p style="background:#f0f0f0; padding:10px; margin:10px 0; border-left:3px solid #1a1a1a;"><strong>Shortcode:</strong> ' . esc_html($shortcode) . '</p>';
    }
}
