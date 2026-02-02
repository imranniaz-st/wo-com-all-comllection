<?php
/**
 * Plugin Name: Marble Collection Display
 * Plugin URI: https://github.com/imranniaz-st/wo-com-all-comllection
 * Description: Professional WooCommerce product collection display plugin for marble and stone products with filtering and grid layout
 * Version: 2.0.1
 * Author: Bicodev Ltd 
 * Author URI: https://Bicodev.com
 * Text Domain: collection-for-woo
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * WC requires at least: 5.0
 * WC tested up to: 8.5
 *
 * @package Marble_Collection_Display
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('MCD_VERSION', '2.0.1');
define('MCD_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MCD_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MCD_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main Marble Collection Display Class
 */
class Marble_Collection_Display {
    
    /**
     * Instance of this class
     */
    private static $instance = null;
    
    /**
     * Get instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        $this->init_hooks();
    }
    
    /**
     * Initialize hooks
     */
    private function init_hooks() {
        add_action('plugins_loaded', array($this, 'check_dependencies'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_shortcode('marble_collection', array($this, 'render_collection'));
        add_action('init', array($this, 'register_assets'));
        
        // AJAX handlers
        add_action('wp_ajax_mcd_filter_products', array($this, 'ajax_filter_products'));
        add_action('wp_ajax_nopriv_mcd_filter_products', array($this, 'ajax_filter_products'));
        
        // Load admin settings
        if (is_admin()) {
            require_once MCD_PLUGIN_DIR . 'includes/admin-settings.php';
            
            // Load GitHub updater
            require_once MCD_PLUGIN_DIR . 'includes/github-updater.php';
            new MCD_GitHub_Updater(__FILE__);
        }
        
        // Load Elementor support (gracefully if not present)
        add_action('elementor/loaded', array($this, 'load_elementor_support'));
    }
    
    /**
     * Load Elementor support when Elementor is ready
     */
    public function load_elementor_support() {
        require_once MCD_PLUGIN_DIR . 'includes/elementor-support.php';
    }
    
    /**
     * Check if WooCommerce is active
     */
    public function check_dependencies() {
        if (!class_exists('WooCommerce')) {
            add_action('admin_notices', array($this, 'woocommerce_missing_notice'));
            return false;
        }
        return true;
    }
    
    /**
     * WooCommerce missing notice
     */
    public function woocommerce_missing_notice() {
        ?>
        <div class="notice notice-error">
            <p><?php esc_html_e('Marble Collection Display requires WooCommerce to be installed and active.', 'collection-for-woo'); ?></p>
        </div>
        <?php
    }
    
    /**
     * Register assets
     */
    public function register_assets() {
        // Register styles
        wp_register_style(
            'marble-collection-style',
            MCD_PLUGIN_URL . 'assets/css/marble-collection.css',
            array(),
            MCD_VERSION
        );
        
        // Register scripts
        wp_register_script(
            'marble-collection-script',
            MCD_PLUGIN_URL . 'assets/js/marble-collection.js',
            array('jquery'),
            MCD_VERSION,
            true
        );
    }
    
    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts() {
        $collection_page_id = get_option('mcd_collection_page');
        $should_enqueue = false;
        
        // Check if on collection page or has shortcode
        if ($collection_page_id && is_page($collection_page_id)) {
            $should_enqueue = true;
        } elseif (has_shortcode(get_post()->post_content ?? '', 'marble_collection')) {
            $should_enqueue = true;
        }
        
        if ($should_enqueue) {
            wp_enqueue_style('marble-collection-style');
            wp_enqueue_script('marble-collection-script');
            
            // Get responsive column settings
            $columns_desktop = get_option('mcd_columns', 3);
            $columns_tablet = get_option('mcd_columns_tablet', 2);
            $columns_mobile = get_option('mcd_columns_mobile', 2);
            
            // Get color swatch settings
            $swatch_size_desktop = get_option('mcd_swatch_size_desktop', '20px');
            $swatch_size_mobile = get_option('mcd_swatch_size_mobile', '16px');
            
            // Add inline CSS for responsive columns
            $custom_css = "
                @media (min-width: 981px) {
                    .mcd-products-grid { grid-template-columns: repeat({$columns_desktop}, 1fr); }
                    .mcd-color-swatch { width: {$swatch_size_desktop}; height: {$swatch_size_desktop}; }
                }
                @media (min-width: 768px) and (max-width: 980px) {
                    .mcd-products-grid { grid-template-columns: repeat({$columns_tablet}, 1fr); }
                }
                @media (max-width: 767px) {
                    .mcd-products-grid { grid-template-columns: repeat({$columns_mobile}, 1fr); }
                    .mcd-color-swatch { width: {$swatch_size_mobile}; height: {$swatch_size_mobile}; }
                }
            ";
            
            // Add custom font CSS
            $custom_css .= $this->get_custom_font_css();
            
            wp_add_inline_style('marble-collection-style', $custom_css);
            
            wp_localize_script('marble-collection-script', 'mcdAjax', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('mcd_filter_nonce')
            ));
        }
    }
    
    /**
     * Generate custom font CSS from settings
     */
    private function get_custom_font_css() {
        $title_font = get_option('mcd_title_font', 'Poppins');
        $title_size = get_option('mcd_title_size', '18px');
        $title_weight = get_option('mcd_title_weight', '600');
        $title_color = get_option('mcd_title_color', '#333');
        
        $excerpt_font = get_option('mcd_excerpt_font', 'Open Sans');
        $excerpt_size = get_option('mcd_excerpt_size', '14px');
        $excerpt_weight = get_option('mcd_excerpt_weight', '400');
        $excerpt_color = get_option('mcd_excerpt_color', '#666');
        
        $filter_font = get_option('mcd_filter_font', 'Open Sans');
        $filter_size = get_option('mcd_filter_size', '14px');
        $filter_color = get_option('mcd_filter_color', '#333');
        
        return ":root {
            --mcd-title-font: '" . esc_attr($title_font) . "', sans-serif;
            --mcd-title-size: " . esc_attr($title_size) . ";
            --mcd-title-weight: " . esc_attr($title_weight) . ";
            --mcd-title-color: " . esc_attr($title_color) . ";
            
            --mcd-excerpt-font: '" . esc_attr($excerpt_font) . "', sans-serif;
            --mcd-excerpt-size: " . esc_attr($excerpt_size) . ";
            --mcd-excerpt-weight: " . esc_attr($excerpt_weight) . ";
            --mcd-excerpt-color: " . esc_attr($excerpt_color) . ";
            
            --mcd-filter-font: '" . esc_attr($filter_font) . "', sans-serif;
            --mcd-filter-size: " . esc_attr($filter_size) . ";
            --mcd-filter-color: " . esc_attr($filter_color) . ";
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
    }
    
    /**
     * Render collection shortcode
     * 
     * @param array $atts Shortcode attributes
     * @return string HTML output
     */
    public function render_collection($atts) {
        if (!$this->check_dependencies()) {
            return '<p>' . __('WooCommerce is required for this plugin to work.', 'collection-for-woo') . '</p>';
        }
        
        $atts = shortcode_atts(array(
            'category' => '',
            'columns' => '3',
            'per_page' => '24',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'show_filters' => 'true',
            'show_search' => 'true',
            'show_sorting' => 'true',
        ), $atts, 'marble_collection');
        
        ob_start();
        include MCD_PLUGIN_DIR . 'templates/collection-display.php';
        return ob_get_clean();
    }
    
    /**
     * AJAX filter products
     */
    public function ajax_filter_products() {
        // Verify nonce
        if (!check_ajax_referer('mcd_filter_nonce', 'nonce', false)) {
            wp_send_json_error(array('message' => 'Security check failed'));
            return;
        }
        
        // Check WooCommerce
        if (!class_exists('WooCommerce')) {
            wp_send_json_error(array('message' => 'WooCommerce is not active'));
            return;
        }
        
        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
        $color = isset($_POST['color']) ? sanitize_text_field($_POST['color']) : '';
        $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
        $orderby = isset($_POST['orderby']) ? sanitize_text_field($_POST['orderby']) : 'menu_order';
        $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $per_page = isset($_POST['per_page']) ? intval($_POST['per_page']) : 24;
        $columns = isset($_POST['columns']) ? intval($_POST['columns']) : 3;
        
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => $per_page,
            'paged' => $paged,
            'orderby' => $orderby,
            'order' => 'ASC',
        );
        
        // Add category filter
        if (!empty($category)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category,
            );
        }
        
        // Add color filter (handle multiple colors)
        if (!empty($color)) {
            $color_array = explode(',', $color);
            $color_array = array_filter(array_map('trim', $color_array));
            
            if (!empty($color_array)) {
                if (!isset($args['tax_query'])) {
                    $args['tax_query'] = array();
                }
                $args['tax_query'][] = array(
                    'taxonomy' => 'pa_color',
                    'field' => 'slug',
                    'terms' => $color_array,
                    'operator' => 'IN',
                );
            }
        }
        
        // Set tax_query relation if multiple taxonomies
        if (isset($args['tax_query']) && count($args['tax_query']) > 1) {
            $args['tax_query']['relation'] = 'AND';
        }
        
        // Add search
        if (!empty($search)) {
            $args['s'] = $search;
        }
        
        $query = new WP_Query($args);
        
        ob_start();
        
        if ($query->have_posts()) {
            echo '<ul class="products columns-' . esc_attr($columns) . ' mcd-products-grid">';
            
            while ($query->have_posts()) {
                $query->the_post();
                global $product;
                
                include MCD_PLUGIN_DIR . 'templates/product-item.php';
            }
            
            echo '</ul>';
            
            // Pagination
            if ($query->max_num_pages > 1) {
                echo '<nav class="woocommerce-pagination mcd-pagination">';
                echo wp_kses_post(paginate_links(array(
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                    'format' => '?paged=%#%',
                    'type' => 'list',
                )));
                echo '</nav>';
            }
        } else {
            echo '<p class="mcd-no-products">' . esc_html__('No products found.', 'collection-for-woo') . '</p>';
        }
        
        wp_reset_postdata();
        
        $html = ob_get_clean();
        
        wp_send_json_success(array(
            'html' => $html,
            'found_posts' => $query->found_posts,
            'max_pages' => $query->max_num_pages,
        ));
    }
}

// Initialize the plugin
function marble_collection_display() {
    return Marble_Collection_Display::get_instance();
}

// Start the plugin
marble_collection_display();
