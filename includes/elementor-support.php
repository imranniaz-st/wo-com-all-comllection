<?php
/**
 * Elementor Support for Marble Collection Display
 *
 * Adds Elementor compatibility and font customization options
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_Elementor_Support {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Only initialize if Elementor is active
        if ($this->is_elementor_active()) {
            add_action('elementor/elements/categories_registered', array($this, 'register_category'));
            add_action('elementor/widgets/widgets_registered', array($this, 'register_widget'));
            add_action('elementor/editor/after_enqueue_styles', array($this, 'enqueue_editor_styles'));
        }
    }
    
    /**
     * Check if Elementor is installed and active
     */
    private function is_elementor_active() {
        return function_exists('elementor_load_plugin_textdomain');
    }
    
    /**
     * Register custom Elementor category
     */
    public function register_category($categories_manager) {
        $categories_manager->add_category(
            'marble-collection',
            array(
                'title' => esc_html__('Marble Collection', 'collection-for-woo'),
                'icon'  => 'fa fa-gem',
            )
        );
    }
    
    /**
     * Register Marble Collection Widget for Elementor
     */
    public function register_widget($widgets_manager) {
        // Include widget file
        require_once dirname(__FILE__) . '/elementor-widget.php';
        $widgets_manager->register(new \MCD_Elementor_Widget());
    }
    
    /**
     * Enqueue Elementor editor styles
     */
    public function enqueue_editor_styles() {
        wp_enqueue_style(
            'mcd-elementor-editor',
            plugins_url('../assets/css/elementor-editor.css', __FILE__),
            array(),
            MCD_VERSION
        );
    }
    
    /**
     * Get custom font settings from admin
     */
    public static function get_font_settings() {
        return array(
            'title_font' => get_option('mcd_title_font', 'Poppins'),
            'title_size' => get_option('mcd_title_size', '18px'),
            'title_weight' => get_option('mcd_title_weight', '600'),
            'title_color' => get_option('mcd_title_color', '#333'),
            
            'excerpt_font' => get_option('mcd_excerpt_font', 'Open Sans'),
            'excerpt_size' => get_option('mcd_excerpt_size', '14px'),
            'excerpt_weight' => get_option('mcd_excerpt_weight', '400'),
            'excerpt_color' => get_option('mcd_excerpt_color', '#666'),
            
            'filter_font' => get_option('mcd_filter_font', 'Open Sans'),
            'filter_size' => get_option('mcd_filter_size', '14px'),
            'filter_color' => get_option('mcd_filter_color', '#333'),
        );
    }
    
    /**
     * Generate inline CSS for custom fonts
     */
    public static function get_custom_font_css() {
        $settings = self::get_font_settings();
        
        $css = ":root {
            --mcd-title-font: '" . esc_attr($settings['title_font']) . "', sans-serif;
            --mcd-title-size: " . esc_attr($settings['title_size']) . ";
            --mcd-title-weight: " . esc_attr($settings['title_weight']) . ";
            --mcd-title-color: " . esc_attr($settings['title_color']) . ";
            
            --mcd-excerpt-font: '" . esc_attr($settings['excerpt_font']) . "', sans-serif;
            --mcd-excerpt-size: " . esc_attr($settings['excerpt_size']) . ";
            --mcd-excerpt-weight: " . esc_attr($settings['excerpt_weight']) . ";
            --mcd-excerpt-color: " . esc_attr($settings['excerpt_color']) . ";
            
            --mcd-filter-font: '" . esc_attr($settings['filter_font']) . "', sans-serif;
            --mcd-filter-size: " . esc_attr($settings['filter_size']) . ";
            --mcd-filter-color: " . esc_attr($settings['filter_color']) . ";
        }
        
        .mcd-product-title {
            font-family: var(--mcd-title-font);
            font-size: var(--mcd-title-size);
            font-weight: var(--mcd-title-weight);
            color: var(--mcd-title-color);
        }
        
        .mcd-product-excerpt {
            font-family: var(--mcd-excerpt-font);
            font-size: var(--mcd-excerpt-size);
            font-weight: var(--mcd-excerpt-weight);
            color: var(--mcd-excerpt-color);
        }
        
        .mcd-filter-item label,
        .mcd-filter-title,
        .mcd-search-field {
            font-family: var(--mcd-filter-font);
            font-size: var(--mcd-filter-size);
            color: var(--mcd-filter-color);
        }";
        
        return $css;
    }
}

// Initialize Elementor support
MCD_Elementor_Support::get_instance();
