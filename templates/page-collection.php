<?php
/**
 * Template Name: Marble Collection Page
 * Full page template for displaying marble collections
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Get settings
$columns = get_option('mcd_columns', 3);
$columns_tablet = get_option('mcd_columns_tablet', 3);
$columns_mobile = get_option('mcd_columns_mobile', 2);
$per_page = get_option('mcd_per_page', 24);
$orderby = get_option('mcd_default_orderby', 'menu_order');
$show_filters = get_option('mcd_show_filters', 'true');
$show_search = get_option('mcd_show_search', 'true');
$show_sorting = get_option('mcd_show_sorting', 'true');

// Force responsive columns: Desktop 3, Tablet 3, Mobile 2
$columns = 3;
$columns_tablet = 3;
$columns_mobile = 2;

// Add inline CSS for responsive columns
$custom_css = "
    <style>
        @media (min-width: 981px) {
            .mcd-products-grid { grid-template-columns: repeat({$columns}, 1fr) !important; }
        }
        @media (min-width: 768px) and (max-width: 980px) {
            .mcd-products-grid { grid-template-columns: repeat({$columns_tablet}, 1fr) !important; }
        }
        @media (max-width: 767px) {
            .mcd-products-grid { grid-template-columns: repeat({$columns_mobile}, 1fr) !important; }
        }
    </style>
";
echo wp_kses_post($custom_css);

// Prepare attributes array
$atts = array(
    'columns' => $columns,
    'per_page' => $per_page,
    'orderby' => $orderby,
    'show_filters' => $show_filters,
    'show_search' => $show_search,
    'show_sorting' => $show_sorting,
);

?>

<div id="main-content">
    <div class="container">
        <div id="content-area" class="clearfix">
            <div id="left-area">
                
                <?php while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('et_pb_post'); ?>>
                    
                    <div class="entry-content">
                        
                        <?php if (get_the_title()): ?>
                        <h1 class="entry-title main_title"><?php the_title(); ?></h1>
                        <?php endif; ?>
                        
                        <?php
                        // Display page content if any
                        the_content();
                        ?>
                        
                        <?php
                        // Display marble collection
                        include MCD_PLUGIN_DIR . 'templates/collection-display.php';
                        ?>
                        
                    </div>
                    
                </article>
                
                <?php endwhile; ?>
                
            </div>
        </div>
    </div>
</div>

<?php

get_footer();
