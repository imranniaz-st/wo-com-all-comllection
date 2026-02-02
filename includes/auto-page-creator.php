<?php
/**
 * Auto Page Creator for Marble Collection Display
 * Creates all necessary pages automatically with shortcodes
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_Auto_Page_Creator {

    /**
     * Create all pages automatically
     */
    public static function create_all_pages() {
        $pages_created = array();
        
        // Homepage/Hero Section
        $pages_created[] = self::create_page(array(
            'title' => 'GTA Marble - Home',
            'slug' => 'gta-marble-home',
            'content' => self::get_homepage_content(),
            'template' => 'elementor_header_footer',
            'meta_description' => 'Premium European Quartz & Kitchen Countertops in GTA. 21+ years experience. In-stock collections. Professional installation.',
            'focus_keyword' => 'Kitchen Countertops GTA'
        ));
        
        // Kitchen Countertops Page
        $pages_created[] = self::create_page(array(
            'title' => 'Kitchen Countertops - Professional Installation',
            'slug' => 'kitchen-countertops',
            'content' => self::get_kitchen_content(),
            'meta_description' => 'Premium kitchen countertops in Toronto. Quartz, marble, granite. Professional fabrication & installation. Free quotes.',
            'focus_keyword' => 'Kitchen Countertops'
        ));
        
        // Superstone Quartz Collection
        $pages_created[] = self::create_page(array(
            'title' => 'Superstone Quartz Collection',
            'slug' => 'superstone-quartz-collection',
            'content' => self::get_collection_content('Superstone Quartz', 'superstone-quartz'),
            'meta_description' => 'Shop Superstone quartz with 50+ colors. Premium European quartz. Professional installation. In-stock.',
            'focus_keyword' => 'Superstone Quartz'
        ));
        
        // Goodstone Quartz Collection
        $pages_created[] = self::create_page(array(
            'title' => 'Goodstone Quartz Collection',
            'slug' => 'goodstone-quartz-collection',
            'content' => self::get_collection_content('Goodstone Quartz', 'goodstone-quartz'),
            'meta_description' => 'Shop Goodstone quartz with 40+ colors. Quality European quartz. Professional installation. In-stock.',
            'focus_keyword' => 'Goodstone Quartz'
        ));
        
        // Kstone Quartz Collection
        $pages_created[] = self::create_page(array(
            'title' => 'Kstone Quartz Collection',
            'slug' => 'kstone-quartz-collection',
            'content' => self::get_collection_content('Kstone Quartz', 'kstone-quartz'),
            'meta_description' => 'Shop Kstone quartz with 35+ colors. Reliable European quartz. Professional installation. In-stock.',
            'focus_keyword' => 'Kstone Quartz'
        ));
        
        // Lucent Quartz Collection
        $pages_created[] = self::create_page(array(
            'title' => 'Lucent Quartz Collection',
            'slug' => 'lucent-quartz-collection',
            'content' => self::get_collection_content('Lucent Quartz', 'lucent-quartz'),
            'meta_description' => 'Shop Lucent quartz with 45+ colors. Modern European quartz. Professional installation. In-stock.',
            'focus_keyword' => 'Lucent Quartz'
        ));
        
        // Fortezza Quartz Collection
        $pages_created[] = self::create_page(array(
            'title' => 'Fortezza Quartz - Custom Orders',
            'slug' => 'fortezza-quartz-collection',
            'content' => self::get_collection_content('Fortezza Quartz (Custom)', 'fortezza-quartz'),
            'meta_description' => 'Custom Fortezza quartz orders. Premium quality. 60+ colors available. Professional installation.',
            'focus_keyword' => 'Fortezza Quartz'
        ));
        
        // Natural Stone Collection
        $pages_created[] = self::create_page(array(
            'title' => 'Natural Stone Collection',
            'slug' => 'natural-stone-collection',
            'content' => self::get_natural_stone_content(),
            'meta_description' => 'Natural marble, granite & porcelain. Premium quality. Professional installation. GTA.',
            'focus_keyword' => 'Natural Stone GTA'
        ));
        
        // All Collections Page
        $pages_created[] = self::create_page(array(
            'title' => 'All Collections - Browse Our Full Range',
            'slug' => 'all-collections',
            'content' => self::get_all_collections_content(),
            'meta_description' => 'Browse all quartz and natural stone collections. 1000s of slabs in stock. Free consultation.',
            'focus_keyword' => 'Quartz Collections'
        ));
        
        // About Page
        $pages_created[] = self::create_page(array(
            'title' => 'About GTA Marble',
            'slug' => 'about-us',
            'content' => self::get_about_content(),
            'meta_description' => '21 years of experience in stone fabrication. European quartz suppliers. Professional installation in GTA.',
            'focus_keyword' => 'About GTA Marble'
        ));
        
        // Contact Page
        $pages_created[] = self::create_page(array(
            'title' => 'Contact Us',
            'slug' => 'contact',
            'content' => self::get_contact_content(),
            'meta_description' => 'Contact GTA Marble. Phone: +1 (647) 291-2686. Locations in Etobicoke & GTA. Free quotes.',
            'focus_keyword' => 'Contact GTA Marble'
        ));

        // Legacy Gallery Pages (WooCommerce Products)
        $pages_created[] = self::create_page(array(
            'title' => 'All Collections Gallery',
            'slug' => 'collection-gallery',
            'content' => self::get_legacy_gallery_content('All Collections Gallery', 'all'),
            'meta_description' => 'Browse all collections. 1000s of slabs. Quartz, marble, granite, and more.',
            'focus_keyword' => 'All Collections Gallery'
        ));

        $pages_created[] = self::create_page(array(
            'title' => 'Quartz Gallery',
            'slug' => 'quartz-gallery',
            'content' => self::get_legacy_gallery_content('Quartz Gallery', 'quartz'),
            'meta_description' => 'Quartz gallery with all quartz products from WooCommerce.',
            'focus_keyword' => 'Quartz Gallery'
        ));

        $pages_created[] = self::create_page(array(
            'title' => 'Marble Gallery',
            'slug' => 'marble-gallery',
            'content' => self::get_legacy_gallery_content('Marble Gallery', 'marble'),
            'meta_description' => 'Marble gallery with all marble products from WooCommerce.',
            'focus_keyword' => 'Marble Gallery'
        ));

        $pages_created[] = self::create_page(array(
            'title' => 'Granite Gallery',
            'slug' => 'granite-gallery',
            'content' => self::get_legacy_gallery_content('Granite Gallery', 'granite'),
            'meta_description' => 'Granite gallery with all granite products from WooCommerce.',
            'focus_keyword' => 'Granite Gallery'
        ));

        $pages_created[] = self::create_page(array(
            'title' => 'European Gallery',
            'slug' => 'european-gallery',
            'content' => self::get_legacy_gallery_content('European Gallery', 'european'),
            'meta_description' => 'European collection gallery from WooCommerce products.',
            'focus_keyword' => 'European Gallery'
        ));

        $pages_created[] = self::create_page(array(
            'title' => 'Onyx Gallery',
            'slug' => 'onyx-gallery',
            'content' => self::get_legacy_gallery_content('Onyx Gallery', 'onyx'),
            'meta_description' => 'Onyx gallery with all onyx products from WooCommerce.',
            'focus_keyword' => 'Onyx Gallery'
        ));

        $pages_created[] = self::create_page(array(
            'title' => 'Sink Gallery',
            'slug' => 'sink-gallery',
            'content' => self::get_legacy_gallery_content('Sink Gallery', 'sink'),
            'meta_description' => 'Sink gallery with all sink products from WooCommerce.',
            'focus_keyword' => 'Sink Gallery'
        ));
        
        return $pages_created;
    }
    
    /**
     * Create a single page
     */
    private static function create_page($args) {
        // Check if page already exists
        $existing = get_page_by_path($args['slug']);
        if ($existing) {
            return array(
                'id' => $existing->ID,
                'title' => $args['title'],
                'status' => 'exists',
                'url' => get_permalink($existing->ID)
            );
        }
        
        // Create new page with all data
        $page_data = array(
            'post_title' => $args['title'],
            'post_name' => $args['slug'],
            'post_content' => $args['content'],
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_author' => get_current_user_id(),
            'comment_status' => 'closed',
            'ping_status' => 'closed',
        );
        
        // Insert page into database (this saves it permanently)
        $page_id = wp_insert_post($page_data, true);
        
        if ($page_id && !is_wp_error($page_id)) {
            // Set page template if specified
            if (!empty($args['template'])) {
                update_post_meta($page_id, '_wp_page_template', $args['template']);
            }
            
            // Set Yoast SEO meta if plugin is active
            if (class_exists('WPSEO_Options')) {
                update_post_meta($page_id, '_yoast_wpseo_metadesc', $args['meta_description']);
                update_post_meta($page_id, '_yoast_wpseo_focuskw', $args['focus_keyword']);
            }
            
            // Set for Elementor if active
            if (defined('ELEMENTOR_VERSION')) {
                update_post_meta($page_id, '_elementor_edit_mode', 'builder');
            }
            
            // Mark page as auto-created for reference
            update_post_meta($page_id, '_mcd_auto_created', true);
            update_post_meta($page_id, '_mcd_created_date', current_time('mysql'));
            
            // Clear any caches to ensure page appears immediately
            clean_post_cache($page_id);
            
            // Flush rewrite rules so permalinks work
            flush_rewrite_rules();
            
            return array(
                'id' => $page_id,
                'title' => $args['title'],
                'status' => 'created',
                'url' => get_permalink($page_id),
                'saved' => true
            );
        }
        
        // If failed, return error details
        $error_message = is_wp_error($page_id) ? $page_id->get_error_message() : 'Unknown error';
        return array(
            'status' => 'failed', 
            'title' => $args['title'],
            'error' => $error_message,
            'saved' => false
        );
    }
    
    /**
     * Get homepage content
     */
    private static function get_homepage_content() {
        return '<!-- wp:heading {"level":1} -->
<h1>PREMIUM EUROPEAN QUARTZ COLLECTIONS</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_hero_section]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_hero_section]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Kitchen Countertops - Our Specialty</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_kitchen_priority]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_kitchen_priority]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Browse Our Collections</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_sticky_collection_bar]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_sticky_collection_bar]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Featured Products</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [marble_collection]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[marble_collection]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>About GTA Marble</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_business_info]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_business_info]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Contact Information</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_contact_info]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_contact_info]
<!-- /wp:shortcode -->';
    }
    
    /**
     * Get kitchen countertops content
     */
    private static function get_kitchen_content() {
        return '<!-- wp:heading {"level":1} -->
<h1>Professional Kitchen Countertops</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Premium European Quartz | Professional Installation | In Stock</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_kitchen_priority]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_kitchen_priority]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Browse Kitchen Countertop Samples</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [marble_collection category="kitchen"]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[marble_collection category="kitchen"]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Request a Quote</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_cta_buttons layout="horizontal"]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_cta_buttons layout="horizontal"]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Contact Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_contact_info]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_contact_info]
<!-- /wp:shortcode -->';
    }
    
    /**
     * Get collection content
     */
    private static function get_collection_content($title, $category) {
        return '<!-- wp:heading {"level":1} -->
<h1>' . esc_html($title) . ' Gallery</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Premium European Quartz | In Stock | Professional Installation</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_sticky_collection_bar]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_sticky_collection_bar]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Browse ' . esc_html($title) . ' Colors</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [marble_collection category="' . esc_attr($category) . '"]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[marble_collection category="' . esc_attr($category) . '"]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Request a Quote</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_cta_buttons]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_cta_buttons]
<!-- /wp:shortcode -->';
    }
    
    /**
     * Get natural stone content
     */
    private static function get_natural_stone_content() {
        return '<!-- wp:heading {"level":1} -->
<h1>Natural Stone Collection</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Premium Marble, Granite & Porcelain | Professional Installation</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_sticky_collection_bar]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_sticky_collection_bar]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Browse Natural Stone</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [marble_collection category="natural-stone"]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[marble_collection category="natural-stone"]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Contact Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_contact_info]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_contact_info]
<!-- /wp:shortcode -->';
    }
    
    /**
     * Get all collections content
     */
    private static function get_all_collections_content() {
        return '<!-- wp:heading {"level":1} -->
<h1>All Collections - Browse Our Full Range</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>1000s of Slabs In Stock | 100+ Colors & Designs | Professional Installation</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_sticky_collection_bar]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_sticky_collection_bar]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>All Products</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [marble_collection]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[marble_collection]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>About Our Business</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_business_info]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_business_info]
<!-- /wp:shortcode -->';
    }
    
    /**
     * Get about content
     */
    private static function get_about_content() {
        return '<!-- wp:heading {"level":1} -->
<h1>About GTA Marble</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>21+ Years of Trust & Experience in GTA</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_business_info]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_business_info]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Our Locations</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_locations]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_locations]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Contact Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_contact_info]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_contact_info]
<!-- /wp:shortcode -->';
    }
    
    /**
     * Get contact content
     */
    private static function get_contact_content() {
        return '<!-- wp:heading {"level":1} -->
<h1>Contact GTA Marble</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Get in Touch | Free Quotes | Professional Service</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_contact_info]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_contact_info]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Our Locations</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_locations]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_locations]
<!-- /wp:shortcode -->

<!-- wp:heading -->
<h2>Request a Quote</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> [mcd_cta_buttons layout="vertical"]</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mcd_cta_buttons layout="vertical"]
<!-- /wp:shortcode -->';
    }

    /**
     * Get legacy gallery content (WooCommerce products)
     */
    private static function get_legacy_gallery_content($title, $category) {
        $shortcode = $category === 'all'
            ? '[marble_collection]'
            : '[marble_collection category="' . esc_attr($category) . '"]';

        $shortcode_display = str_replace(array('[', ']'), array('&#91;', '&#93;'), $shortcode);

        return '<!-- wp:heading {"level":1} -->
<h1>' . esc_html($title) . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>All products shown on this page come from WooCommerce products.</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Shortcode Used:</strong> <code>' . $shortcode_display . '</code></p>
<!-- /wp:paragraph -->

    <!-- wp:shortcode -->
    ' . $shortcode . '
    <!-- /wp:shortcode -->

<!-- wp:paragraph -->
<p>Use the filters on the left to narrow by category or color.</p>
<!-- /wp:paragraph -->';
    }
    
    /**
     * Auto-link created pages to plugin settings
     */
    public static function auto_link_pages($pages) {
        $page_map = array(
            'kitchen-countertops' => 'mcd_kitchen_page_id',
            'superstone-quartz-collection' => 'mcd_superstone_page',
            'goodstone-quartz-collection' => 'mcd_goodstone_page',
            'kstone-quartz-collection' => 'mcd_kstone_page',
            'lucent-quartz-collection' => 'mcd_lucent_page',
            'fortezza-quartz-collection' => 'mcd_fortezza_page',
            'natural-stone-collection' => 'mcd_natural_stone_page',
            'all-collections' => 'mcd_all_collections_page',
            'collection-gallery' => 'mcd_collection_page',
            'quartz-gallery' => 'mcd_quartz_page',
            'marble-gallery' => 'mcd_marble_page',
            'granite-gallery' => 'mcd_granite_page',
            'european-gallery' => 'mcd_european_page',
            'onyx-gallery' => 'mcd_onyx_page',
            'sink-gallery' => 'mcd_sink_page',
        );
        
        foreach ($pages as $page) {
            if ($page['status'] === 'created' || $page['status'] === 'exists') {
                $slug = get_post_field('post_name', $page['id']);
                if (isset($page_map[$slug])) {
                    update_option($page_map[$slug], $page['id']);
                }
            }
        }
    }
}
