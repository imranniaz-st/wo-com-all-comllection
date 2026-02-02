<?php
/**
 * Contact Info Elementor Widget
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_Contact_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mcd_contact_info';
    }

    public function get_title() {
        return __('Contact Information', 'marble-collection-display');
    }

    public function get_icon() {
        return 'eicon-info-circle';
    }

    public function get_categories() {
        return array('gta-marble');
    }

    protected function render() {
        echo do_shortcode('[mcd_contact_info]');
        echo '<p style="background:#f0f0f0; padding:10px; margin:10px 0; border-left:3px solid #1a1a1a;"><strong>Shortcode:</strong> [mcd_contact_info]</p>';
    }
}
