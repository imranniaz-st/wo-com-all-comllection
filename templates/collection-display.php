<?php
/**
 * Template for displaying marble collection
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

// Check if this is a specific gallery page
$gallery_category = isset($GLOBALS['mcd_gallery_category']) ? $GLOBALS['mcd_gallery_category'] : '';

// If gallery category is set, use it; otherwise use shortcode category
$category = !empty($gallery_category) ? $gallery_category : (!empty($atts['category']) ? sanitize_text_field($atts['category']) : '');

$columns = intval($atts['columns']);
$per_page = intval($atts['per_page']);
$orderby = sanitize_text_field($atts['orderby']);
$show_filters = $atts['show_filters'] === 'true';
$show_search = $atts['show_search'] === 'true';
$show_sorting = $atts['show_sorting'] === 'true';

// Get visibility settings
$show_title = isset($atts['show_title']) ? $atts['show_title'] === 'true' : true;
$show_description = isset($atts['show_description']) ? $atts['show_description'] === 'true' : true;
$show_quick_view = isset($atts['show_quick_view']) ? $atts['show_quick_view'] === 'true' : false;

// Set global visibility for template
$GLOBALS['mcd_show_title'] = $show_title;
$GLOBALS['mcd_show_description'] = $show_description;
$GLOBALS['mcd_show_quick_view'] = $show_quick_view;

// Get product categories
$categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
));

// Get color attribute terms
$colors = get_terms(array(
    'taxonomy' => 'pa_color',
    'hide_empty' => true,
));
?>

<div class="marble-collection-wrapper" data-category="<?php echo esc_attr($category); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-per-page="<?php echo esc_attr($per_page); ?>">
    
    <div class="mcd-container">
        
        <?php if ($show_filters || $show_search): ?>
        <div class="mcd-sidebar">
            
            <?php if ($show_search): ?>
            <div class="mcd-search-widget">
                <form class="mcd-search-form" role="search">
                    <label class="screen-reader-text"><?php esc_html_e('Search for:', 'collection-for-woo'); ?></label>
                    <input type="search" class="mcd-search-field" placeholder="<?php esc_attr_e('Search products...', 'collection-for-woo'); ?>" value="" name="s">
                    <button type="submit" class="mcd-search-button">
                        <span><?php esc_html_e('Search', 'collection-for-woo'); ?></span>
                    </button>
                </form>
            </div>
            <?php endif; ?>
            
            <?php if ($show_filters): ?>
            <div class="mcd-filters">
                
                <!-- Category Filter -->
                <?php if (!empty($categories) && !is_wp_error($categories)): ?>
                <div class="mcd-filter-group">
                    <h4 class="mcd-filter-title"><?php esc_html_e('Product Categories', 'collection-for-woo'); ?></h4>
                    <ul class="mcd-filter-list mcd-category-filter">
                        <li>
                            <label>
                                <input type="radio" name="mcd_category" value="" checked>
                                <span><?php esc_html_e('All Categories', 'collection-for-woo'); ?></span>
                            </label>
                        </li>
                        <?php foreach ($categories as $cat): ?>
                        <li>
                            <label>
                                <input type="radio" name="mcd_category" value="<?php echo esc_attr($cat->slug); ?>">
                                <span><?php echo esc_html($cat->name); ?></span>
                                <span class="mcd-count">(<?php echo esc_html($cat->count); ?>)</span>
                            </label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <!-- Color Filter -->
                <?php if (!empty($colors) && !is_wp_error($colors)): ?>
                <div class="mcd-filter-group">
                    <h4 class="mcd-filter-title"><?php esc_html_e('Product Color', 'collection-for-woo'); ?></h4>
                    <ul class="mcd-filter-list mcd-color-filter">
                        <?php foreach ($colors as $color): ?>
                        <?php
                            $color_slug = sanitize_title($color->slug);
                            $color_hex = get_term_meta($color->term_id, 'color', true);
                            if (empty($color_hex)) {
                                $color_hex = get_term_meta($color->term_id, 'color_hex', true);
                            }
                            $color_hex = sanitize_hex_color($color_hex);
                            $swatch_style = $color_hex ? ' style="background-color: ' . esc_attr($color_hex) . ';"' : '';
                        ?>
                        <li>
                            <label>
                                <input type="checkbox" name="mcd_color" value="<?php echo esc_attr($color->slug); ?>">
                                <span class="mcd-color-swatch mcd-color-swatch--<?php echo esc_attr($color_slug); ?>"<?php echo $swatch_style; ?>></span>
                                <span><?php echo esc_html($color->name); ?></span>
                                <span class="mcd-count">(<?php echo esc_html($color->count); ?>)</span>
                            </label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                
            </div>
            <?php endif; ?>
            
        </div>
        <?php endif; ?>
        
        <div class="mcd-main-content">
            
            <div class="mcd-top-bar">
                <p class="mcd-result-count" role="alert">
                    <?php esc_html_e('Loading products...', 'collection-for-woo'); ?>
                </p>
                
                <?php if ($show_sorting): ?>
                <form class="mcd-ordering">
                    <select name="orderby" class="mcd-orderby" aria-label="<?php esc_attr_e('Shop order', 'collection-for-woo'); ?>">
                        <option value="menu_order" selected="selected"><?php esc_html_e('Default sorting', 'collection-for-woo'); ?></option>
                        <option value="popularity"><?php esc_html_e('Sort by popularity', 'collection-for-woo'); ?></option>
                        <option value="date"><?php esc_html_e('Sort by latest', 'collection-for-woo'); ?></option>
                        <option value="title"><?php esc_html_e('Sort by name', 'collection-for-woo'); ?></option>
                    </select>
                </form>
                <?php endif; ?>
            </div>
            
            <div class="mcd-products-container">
                <div class="mcd-loading">
                    <span class="spinner"></span>
                    <p><?php esc_html_e('Loading products...', 'collection-for-woo'); ?></p>
                </div>
            </div>
            
        </div>
        
    </div>
    
</div>
