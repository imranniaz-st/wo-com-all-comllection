<?php
/**
 * Business Info Elementor Widget
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_Business_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mcd_business_info';
    }

    public function get_title() {
        return __('Business Information', 'marble-collection-display');
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return array('gta-marble');
    }

    protected function render() {
        echo do_shortcode('[mcd_business_info]');
        echo '<p style="background:#f0f0f0; padding:10px; margin:10px 0; border-left:3px solid #1a1a1a;"><strong>Shortcode:</strong> [mcd_business_info]</p>';
    }
}
