<?php
/**
 * Frontend Display Features for Marble Collection Display
 *
 * Handles displaying all documented features on the WordPress website
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_Frontend_Display {

    /**
     * Initialize frontend display
     */
    public function __construct() {
        add_shortcode('mcd_hero_section', array($this, 'render_hero_section'));
        add_shortcode('mcd_kitchen_priority', array($this, 'render_kitchen_priority'));
        add_shortcode('mcd_collection_showcase', array($this, 'render_collection_showcase'));
        add_shortcode('mcd_contact_info', array($this, 'render_contact_info'));
        add_shortcode('mcd_business_info', array($this, 'render_business_info'));
        add_shortcode('mcd_cta_buttons', array($this, 'render_cta_buttons'));
        add_shortcode('mcd_locations', array($this, 'render_locations'));
        add_shortcode('mcd_sticky_collection_bar', array($this, 'render_sticky_collection_bar'));
        add_shortcode('mcd_quick_view', array($this, 'render_quick_view'));
        add_filter('wp_footer', array($this, 'add_custom_css'));
    }

    /**
     * Render hero section - Premium introduction
     */
    public function render_hero_section($atts) {
        $show_hero = get_option('mcd_show_hero', 'true');
        if ($show_hero !== 'true') {
            return '';
        }

        $title = get_option('mcd_hero_title', 'PREMIUM EUROPEAN QUARTZ COLLECTIONS');
        $subtitle = get_option('mcd_hero_subtitle', 'In Stock | Professional Installation');
        $cta_text = get_option('mcd_hero_cta_text', 'Browse Collections');
        $hero_image_id = get_option('mcd_hero_image', '');

        $hero_image = $hero_image_id ? wp_get_attachment_url($hero_image_id) : '';

        ob_start();
        ?>
        <div class="mcd-hero-section" <?php echo $hero_image ? 'style="background-image: url(\'' . esc_url($hero_image) . '\');"' : ''; ?>>
            <div class="mcd-hero-overlay"></div>
            <div class="mcd-hero-content">
                <h1 class="mcd-hero-title"><?php echo esc_html($title); ?></h1>
                <p class="mcd-hero-subtitle"><?php echo esc_html($subtitle); ?></p>
                <a href="#collections" class="mcd-btn mcd-btn-primary"><?php echo esc_html($cta_text); ?></a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Kitchen Countertops Priority Display
     */
    public function render_kitchen_priority($atts) {
        $kitchen_priority = get_option('mcd_kitchen_priority', 'true');
        if ($kitchen_priority !== 'true') {
            return '';
        }

        $kitchen_page_id = get_option('mcd_kitchen_page_id', 0);
        if (!$kitchen_page_id) {
            return '';
        }

        $kitchen_url = get_permalink($kitchen_page_id);

        ob_start();
        ?>
        <div class="mcd-kitchen-priority-section">
            <div class="mcd-kitchen-header">
                <h2><?php esc_html_e('Professional Kitchen Countertops', 'collection-for-woo'); ?></h2>
                <p><?php esc_html_e('Premium European Quartz | In Stock | Professional Installation', 'collection-for-woo'); ?></p>
            </div>
            <div class="mcd-kitchen-cta">
                <a href="<?php echo esc_url($kitchen_url); ?>" class="mcd-btn mcd-btn-primary">
                    <?php esc_html_e('View Kitchen Countertops', 'collection-for-woo'); ?>
                </a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Display sticky collection bar/carousel
     */
    public function render_sticky_collection_bar($atts) {
        $collections = array(
            'superstone' => array('label' => 'Superstone', 'option' => 'mcd_superstone_page'),
            'goodstone' => array('label' => 'Goodstone', 'option' => 'mcd_goodstone_page'),
            'kstone' => array('label' => 'Kstone', 'option' => 'mcd_kstone_page'),
            'lucent' => array('label' => 'Lucent', 'option' => 'mcd_lucent_page'),
        );

        ob_start();
        ?>
        <div class="mcd-sticky-collection-bar">
            <div class="mcd-collection-bar-inner">
                <?php foreach ($collections as $key => $collection) : ?>
                    <?php $page_id = get_option($collection['option'], 0); ?>
                    <?php if ($page_id) : ?>
                        <a href="<?php echo esc_url(get_permalink($page_id)); ?>" class="mcd-collection-link">
                            <?php echo esc_html($collection['label']); ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <a href="<?php echo esc_url(get_permalink(get_option('mcd_all_collections_page', 0))); ?>" class="mcd-collection-link mcd-see-all">
                    <?php esc_html_e('See All', 'collection-for-woo'); ?>
                </a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Display collection showcase grid
     */
    public function render_collection_showcase($atts) {
        $atts = shortcode_atts(array(
            'collection' => '',
            'limit' => 12,
            'columns' => 4,
        ), $atts);

        ob_start();
        ?>
        <div class="mcd-collection-showcase" data-columns="<?php echo esc_attr($atts['columns']); ?>">
            <?php
            // Display products from collection
            echo do_shortcode('[marble_collection category="' . esc_attr($atts['collection']) . '" per_page="' . intval($atts['limit']) . '"]');
            ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Display contact information
     */
    public function render_contact_info($atts) {
        $business_name = get_option('mcd_business_name', 'GTA Marble');
        $phone_1 = get_option('mcd_phone_1', '');
        $phone_2 = get_option('mcd_phone_2', '');
        $email = get_option('mcd_email', '');
        $address = get_option('mcd_address', '');

        ob_start();
        ?>
        <div class="mcd-contact-info-section">
            <h3><?php echo esc_html($business_name); ?></h3>
            
            <?php if ($address) : ?>
                <div class="mcd-contact-item">
                    <strong><?php esc_html_e('Address:', 'collection-for-woo'); ?></strong>
                    <p><?php echo nl2br(esc_html($address)); ?></p>
                </div>
            <?php endif; ?>

            <?php if ($phone_1) : ?>
                <div class="mcd-contact-item">
                    <strong><?php esc_html_e('Phone:', 'collection-for-woo'); ?></strong>
                    <a href="tel:<?php echo esc_attr(str_replace(array(' ', '(', ')', '-'), '', $phone_1)); ?>">
                        <?php echo esc_html($phone_1); ?>
                    </a>
                    <?php if ($phone_2) : ?>
                        <span> / </span>
                        <a href="tel:<?php echo esc_attr(str_replace(array(' ', '(', ')', '-'), '', $phone_2)); ?>">
                            <?php echo esc_html($phone_2); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($email) : ?>
                <div class="mcd-contact-item">
                    <strong><?php esc_html_e('Email:', 'collection-for-woo'); ?></strong>
                    <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                </div>
            <?php endif; ?>

            <div class="mcd-contact-buttons">
                <a href="tel:<?php echo esc_attr(str_replace(array(' ', '(', ')', '-'), '', $phone_1)); ?>" class="mcd-btn mcd-btn-primary">
                    <?php esc_html_e('Call Now', 'collection-for-woo'); ?>
                </a>
                <a href="mailto:<?php echo esc_attr($email); ?>" class="mcd-btn mcd-btn-secondary">
                    <?php esc_html_e('Email Us', 'collection-for-woo'); ?>
                </a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Display business information / About section
     */
    public function render_business_info($atts) {
        $business_name = get_option('mcd_business_name', 'GTA Marble');
        $hours = get_option('mcd_hours', '');
        $service_area = get_option('mcd_service_area', '');

        ob_start();
        ?>
        <div class="mcd-business-info-section">
            <div class="mcd-business-content">
                <h2><?php echo esc_html($business_name); ?></h2>
                <p class="mcd-tagline"><?php esc_html_e('Suppliers of European Quartz & Fabricator and installer of Quartz, Porcelain and all natural stone', 'collection-for-woo'); ?></p>

                <div class="mcd-business-details">
                    <?php if ($hours) : ?>
                        <div class="mcd-detail-item">
                            <h4><?php esc_html_e('Business Hours', 'collection-for-woo'); ?></h4>
                            <p><?php echo nl2br(esc_html($hours)); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($service_area) : ?>
                        <div class="mcd-detail-item">
                            <h4><?php esc_html_e('Service Area', 'collection-for-woo'); ?></h4>
                            <p><?php echo nl2br(esc_html($service_area)); ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mcd-business-features">
                    <ul>
                        <li><?php esc_html_e('21 years of trust & experience', 'collection-for-woo'); ?></li>
                        <li><?php esc_html_e('European Quartz suppliers', 'collection-for-woo'); ?></li>
                        <li><?php esc_html_e('#1 Fabricator & installer in GTA', 'collection-for-woo'); ?></li>
                        <li><?php esc_html_e('1000s of slabs in stock', 'collection-for-woo'); ?></li>
                        <li><?php esc_html_e('Special pricing for contractors & developers', 'collection-for-woo'); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Display CTA buttons
     */
    public function render_cta_buttons($atts) {
        $atts = shortcode_atts(array(
            'layout' => 'horizontal',
            'style' => 'default',
        ), $atts);

        $primary_text = get_option('mcd_primary_cta_text', 'Browse Collections');
        $primary_color = get_option('mcd_primary_cta_color', '#1a1a1a');
        $secondary_text = get_option('mcd_secondary_cta_text', 'Request Quote');
        $secondary_color = get_option('mcd_secondary_cta_color', '#d4af37');

        $kitchen_page_id = get_option('mcd_kitchen_page_id', 0);
        $all_collections_page_id = get_option('mcd_all_collections_page', 0);

        ob_start();
        ?>
        <div class="mcd-cta-buttons mcd-cta-<?php echo esc_attr($atts['layout']); ?>">
            <?php if ($all_collections_page_id) : ?>
                <a href="<?php echo esc_url(get_permalink($all_collections_page_id)); ?>" 
                   class="mcd-btn mcd-btn-primary"
                   style="background-color: <?php echo esc_attr($primary_color); ?>">
                    <?php echo esc_html($primary_text); ?>
                </a>
            <?php endif; ?>
            
            <a href="#contact-form" class="mcd-btn mcd-btn-secondary" style="border-color: <?php echo esc_attr($secondary_color); ?>; color: <?php echo esc_attr($secondary_color); ?>">
                <?php echo esc_html($secondary_text); ?>
            </a>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Display multi-location information
     */
    public function render_locations($atts) {
        $enable_multi = get_option('mcd_enable_multi_location', 'false');
        if ($enable_multi !== 'true') {
            return '';
        }

        $location_1_name = get_option('mcd_location_1_name', '');
        $location_1_address = get_option('mcd_location_1_address', '');
        $location_1_phone = get_option('mcd_location_1_phone', '');

        $location_2_name = get_option('mcd_location_2_name', '');
        $location_2_address = get_option('mcd_location_2_address', '');
        $location_2_phone = get_option('mcd_location_2_phone', '');

        ob_start();
        ?>
        <div class="mcd-locations-section">
            <h2><?php esc_html_e('Our Locations', 'collection-for-woo'); ?></h2>
            <div class="mcd-locations-grid">
                <?php if ($location_1_name) : ?>
                    <div class="mcd-location-card">
                        <h3><?php echo esc_html($location_1_name); ?></h3>
                        <p><?php echo nl2br(esc_html($location_1_address)); ?></p>
                        <?php if ($location_1_phone) : ?>
                            <a href="tel:<?php echo esc_attr(str_replace(array(' ', '(', ')', '-'), '', $location_1_phone)); ?>">
                                <?php echo esc_html($location_1_phone); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($location_2_name) : ?>
                    <div class="mcd-location-card">
                        <h3><?php echo esc_html($location_2_name); ?></h3>
                        <p><?php echo nl2br(esc_html($location_2_address)); ?></p>
                        <?php if ($location_2_phone) : ?>
                            <a href="tel:<?php echo esc_attr(str_replace(array(' ', '(', ')', '-'), '', $location_2_phone)); ?>">
                                <?php echo esc_html($location_2_phone); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Display quick view functionality
     */
    public function render_quick_view($atts) {
        $show_quick_view = get_option('mcd_show_quick_view', 'true');
        if ($show_quick_view !== 'true') {
            return '';
        }

        ob_start();
        ?>
        <div id="mcd-quick-view-modal" class="mcd-modal" style="display: none;">
            <div class="mcd-modal-content">
                <span class="mcd-modal-close">&times;</span>
                <div class="mcd-quick-view-body">
                    <div class="mcd-quick-view-image"></div>
                    <div class="mcd-quick-view-details">
                        <h3 class="mcd-quick-view-title"></h3>
                        <p class="mcd-quick-view-code"><strong><?php esc_html_e('Product Code:', 'collection-for-woo'); ?></strong> <span></span></p>
                        <div class="mcd-quick-view-description"></div>
                        <a href="#" class="mcd-btn mcd-btn-primary mcd-more-details-btn"><?php esc_html_e('More Details', 'collection-for-woo'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Add custom CSS to footer
     */
    public function add_custom_css() {
        $custom_css = get_option('mcd_custom_css', '');
        if ($custom_css) {
            echo '<style>';
            echo wp_kses_post($custom_css);
            echo '</style>';
        }
    }
}

// Initialize frontend display
if (!is_admin()) {
    new MCD_Frontend_Display();
}
