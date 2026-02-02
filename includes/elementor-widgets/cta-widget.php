<?php
/**
 * CTA Buttons Elementor Widget
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_CTA_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mcd_cta_buttons';
    }

    public function get_title() {
        return __('Call-to-Action Buttons', 'marble-collection-display');
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return array('gta-marble');
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => __('Layout', 'marble-collection-display'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'layout',
            array(
                'label' => __('Button Layout', 'marble-collection-display'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => array(
                    'horizontal' => __('Horizontal', 'marble-collection-display'),
                    'vertical' => __('Vertical', 'marble-collection-display'),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $layout = !empty($settings['layout']) ? $settings['layout'] : 'horizontal';
        
        echo do_shortcode('[mcd_cta_buttons layout="' . esc_attr($layout) . '"]');
        echo '<p style="background:#f0f0f0; padding:10px; margin:10px 0; border-left:3px solid #1a1a1a;"><strong>Shortcode:</strong> [mcd_cta_buttons layout="' . esc_attr($layout) . '"]</p>';
    }
}
