<?php
/**
 * Elementor Widgets for Marble Collection Display
 * Registers all custom widgets if Elementor is installed
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_Elementor_Widgets {

    /**
     * Initialize Elementor widgets
     */
    public static function init() {
        // Check if Elementor is installed
        if (!defined('ELEMENTOR_VERSION')) {
            return;
        }
        
        // Register widgets
        add_action('elementor/widgets/register', array(__CLASS__, 'register_widgets'));
        add_action('elementor/elements/categories_registered', array(__CLASS__, 'add_category'));
    }
    
    /**
     * Add custom widget category
     */
    public static function add_category($elements_manager) {
        $elements_manager->add_category(
            'gta-marble',
            array(
                'title' => __('GTA Marble', 'marble-collection-display'),
                'icon' => 'fa fa-plug',
            )
        );
    }
    
    /**
     * Register all widgets
     */
    public static function register_widgets($widgets_manager) {
        // Hero Section Widget
        require_once MCD_PLUGIN_DIR . 'includes/elementor-widgets/hero-widget.php';
        $widgets_manager->register(new \MCD_Hero_Widget());
        
        // Kitchen Priority Widget
        require_once MCD_PLUGIN_DIR . 'includes/elementor-widgets/kitchen-widget.php';
        $widgets_manager->register(new \MCD_Kitchen_Widget());
        
        // Sticky Collection Bar Widget
        require_once MCD_PLUGIN_DIR . 'includes/elementor-widgets/collection-bar-widget.php';
        $widgets_manager->register(new \MCD_Collection_Bar_Widget());
        
        // Contact Info Widget
        require_once MCD_PLUGIN_DIR . 'includes/elementor-widgets/contact-widget.php';
        $widgets_manager->register(new \MCD_Contact_Widget());
        
        // Business Info Widget
        require_once MCD_PLUGIN_DIR . 'includes/elementor-widgets/business-widget.php';
        $widgets_manager->register(new \MCD_Business_Widget());
        
        // CTA Buttons Widget
        require_once MCD_PLUGIN_DIR . 'includes/elementor-widgets/cta-widget.php';
        $widgets_manager->register(new \MCD_CTA_Widget());
        
        // Locations Widget
        require_once MCD_PLUGIN_DIR . 'includes/elementor-widgets/locations-widget.php';
        $widgets_manager->register(new \MCD_Locations_Widget());
        
        // Collection Display Widget
        require_once MCD_PLUGIN_DIR . 'includes/elementor-widgets/collection-display-widget.php';
        $widgets_manager->register(new \MCD_Collection_Display_Widget());
    }
}

// Initialize if Elementor is active
if (defined('ELEMENTOR_VERSION')) {
    MCD_Elementor_Widgets::init();
}
