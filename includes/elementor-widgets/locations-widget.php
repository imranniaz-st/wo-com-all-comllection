<?php
/**
 * Locations Elementor Widget
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_Locations_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mcd_locations';
    }

    public function get_title() {
        return __('Business Locations', 'marble-collection-display');
    }

    public function get_icon() {
        return 'eicon-map-pin';
    }

    public function get_categories() {
        return array('gta-marble');
    }

    protected function render() {
        echo do_shortcode('[mcd_locations]');
        echo '<p style="background:#f0f0f0; padding:10px; margin:10px 0; border-left:3px solid #1a1a1a;"><strong>Shortcode:</strong> [mcd_locations]</p>';
    }
}
