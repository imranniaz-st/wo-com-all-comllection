<?php
/**
 * Template for displaying single product item in grid
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;

if (!$product) {
    return;
}

// Get visibility settings from global scope
$show_title = isset($GLOBALS['mcd_show_title']) ? $GLOBALS['mcd_show_title'] : true;
$show_description = isset($GLOBALS['mcd_show_description']) ? $GLOBALS['mcd_show_description'] : true;
$show_quick_view = isset($GLOBALS['mcd_show_quick_view']) ? $GLOBALS['mcd_show_quick_view'] : false;
?>

<li class="<?php echo esc_attr(implode(' ', wc_get_product_class('mcd-product-item', $product))); ?>">
    <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="mcd-product-link">
        
        <span class="mcd-product-image">
            <?php
            $image_size = apply_filters('marble_collection_product_image_size', 'medium');
            echo wp_kses_post($product->get_image($image_size));
            ?>
            <span class="mcd-watermark">GTA Marble</span>
            <span class="mcd-overlay"></span>
            
            <?php if ($show_quick_view): ?>
            <span class="mcd-quick-view-btn" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                <?php esc_html_e('Quick View', 'collection-for-woo'); ?>
            </span>
            <?php endif; ?>
        </span>
        
        <?php if ($show_title): ?>
        <h2 class="mcd-product-title">
            <?php echo esc_html($product->get_name()); ?>
        </h2>
        <?php endif; ?>

        <?php
        $sku = $product->get_sku();
        if (empty($sku)) {
            $sku = 'SKU-' . $product->get_id();
        }
        ?>
        <p class="mcd-product-code">
            <strong><?php esc_html_e('Product Code:', 'collection-for-woo'); ?></strong>
            <?php echo esc_html($sku); ?>
        </p>
        
        <?php
        // Display color swatches
        $show_swatches = get_option('mcd_show_color_swatches', 'yes') === 'yes';
        if ($show_swatches && $product->is_type('variable')) {
            $available_variations = $product->get_available_variations();
            $color_swatches = array();
            
            foreach ($available_variations as $variation) {
                if (isset($variation['attributes']['attribute_pa_color'])) {
                    $color_slug = $variation['attributes']['attribute_pa_color'];
                    $term = get_term_by('slug', $color_slug, 'pa_color');
                    
                    if ($term) {
                        // Get color value from term meta
                        $color_value = get_term_meta($term->term_id, 'color', true);
                        if (!$color_value) {
                            $color_value = get_term_meta($term->term_id, 'product_attribute_color', true);
                        }
                        if (!$color_value) {
                            // Use term name as fallback or generate from slug
                            $color_value = '#' . substr(md5($term->slug), 0, 6);
                        }
                        
                        if (!in_array($color_value, $color_swatches)) {
                            $color_swatches[] = array(
                                'color' => $color_value,
                                'name' => $term->name
                            );
                        }
                    }
                }
            }
            
            if (!empty($color_swatches)):
        ?>
        <div class="mcd-color-swatches">
            <?php foreach ($color_swatches as $swatch): ?>
                <span class="mcd-color-swatch" 
                      style="background-color: <?php echo esc_attr($swatch['color']); ?>;" 
                      title="<?php echo esc_attr($swatch['name']); ?>"></span>
            <?php endforeach; ?>
        </div>
        <?php 
            endif;
        }
        ?>
        
    </a>
</li>
