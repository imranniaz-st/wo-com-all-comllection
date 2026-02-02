<?php
/**
 * Admin Settings for Marble Collection Display
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_Admin_Settings {
    
    /**
     * Initialize admin settings
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_filter('page_template', array($this, 'load_collection_template'));
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            __('Marble Collections', 'marble-collection'),
            __('Marble Collections', 'marble-collection'),
            'manage_options',
            'marble-collection-settings',
            array($this, 'render_settings_page'),
            'dashicons-grid-view',
            56
        );
        
        add_submenu_page(
            'marble-collection-settings',
            __('Settings', 'marble-collection'),
            __('Settings', 'marble-collection'),
            'manage_options',
            'marble-collection-settings',
            array($this, 'render_settings_page')
        );
    }
    
    /**
     * Register settings
     */
    public function register_settings() {
        register_setting('mcd_settings', 'mcd_collection_page');
        register_setting('mcd_settings', 'mcd_columns');
        register_setting('mcd_settings', 'mcd_columns_tablet');
        register_setting('mcd_settings', 'mcd_columns_mobile');
        register_setting('mcd_settings', 'mcd_per_page');
        register_setting('mcd_settings', 'mcd_default_orderby');
        register_setting('mcd_settings', 'mcd_show_filters');
        register_setting('mcd_settings', 'mcd_show_search');
        register_setting('mcd_settings', 'mcd_show_sorting');
        register_setting('mcd_settings', 'mcd_show_color_swatches');
        register_setting('mcd_settings', 'mcd_swatch_size_desktop');
        register_setting('mcd_settings', 'mcd_swatch_size_mobile');
        
        // Font settings
        register_setting('mcd_settings', 'mcd_title_font');
        register_setting('mcd_settings', 'mcd_title_size');
        register_setting('mcd_settings', 'mcd_title_weight');
        register_setting('mcd_settings', 'mcd_title_color');
        register_setting('mcd_settings', 'mcd_excerpt_font');
        register_setting('mcd_settings', 'mcd_excerpt_size');
        register_setting('mcd_settings', 'mcd_excerpt_weight');
        register_setting('mcd_settings', 'mcd_excerpt_color');
        register_setting('mcd_settings', 'mcd_filter_font');
        register_setting('mcd_settings', 'mcd_filter_size');
        register_setting('mcd_settings', 'mcd_filter_color');
        
        // Gallery pages
        register_setting('mcd_settings', 'mcd_quartz_page');
        register_setting('mcd_settings', 'mcd_marble_page');
        register_setting('mcd_settings', 'mcd_granite_page');
        register_setting('mcd_settings', 'mcd_european_page');
        register_setting('mcd_settings', 'mcd_onyx_page');
        register_setting('mcd_settings', 'mcd_sink_page');
        
        add_settings_section(
            'mcd_general_section',
            __('General Settings', 'marble-collection'),
            array($this, 'render_general_section'),
            'mcd_settings'
        );
        
        add_settings_field(
            'mcd_collection_page',
            __('All Collections Page', 'marble-collection'),
            array($this, 'render_page_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        // Gallery Pages Section
        add_settings_section(
            'mcd_gallery_section',
            __('Gallery Pages', 'marble-collection'),
            array($this, 'render_gallery_section'),
            'mcd_settings'
        );
        
        add_settings_field(
            'mcd_quartz_page',
            __('Quartz Gallery Page', 'marble-collection'),
            array($this, 'render_quartz_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_marble_page',
            __('Marble Gallery Page', 'marble-collection'),
            array($this, 'render_marble_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_granite_page',
            __('Granite Gallery Page', 'marble-collection'),
            array($this, 'render_granite_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_european_page',
            __('European Gallery Page', 'marble-collection'),
            array($this, 'render_european_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_onyx_page',
            __('Onyx Gallery Page', 'marble-collection'),
            array($this, 'render_onyx_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_sink_page',
            __('Sink Gallery Page', 'marble-collection'),
            array($this, 'render_sink_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_collection_page_old',
            __('Main Collection Page (Legacy)', 'marble-collection'),
            array($this, 'render_page_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_columns',
            __('Columns (Desktop)', 'marble-collection'),
            array($this, 'render_columns_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_columns_tablet',
            __('Columns (Tablet)', 'marble-collection'),
            array($this, 'render_columns_tablet_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_columns_mobile',
            __('Columns (Mobile)', 'marble-collection'),
            array($this, 'render_columns_mobile_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_per_page',
            __('Products Per Page', 'marble-collection'),
            array($this, 'render_per_page_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_default_orderby',
            __('Default Sorting', 'marble-collection'),
            array($this, 'render_orderby_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_show_filters',
            __('Show Filters', 'marble-collection'),
            array($this, 'render_filters_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_show_search',
            __('Show Search', 'marble-collection'),
            array($this, 'render_search_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_show_sorting',
            __('Show Sorting Dropdown', 'marble-collection'),
            array($this, 'render_sorting_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_show_color_swatches',
            __('Show Color Swatches', 'marble-collection'),
            array($this, 'render_color_swatches_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_swatch_size_desktop',
            __('Color Swatch Size (Desktop)', 'marble-collection'),
            array($this, 'render_swatch_size_desktop_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_swatch_size_mobile',
            __('Color Swatch Size (Mobile)', 'marble-collection'),
            array($this, 'render_swatch_size_mobile_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        // Font Settings Section
        add_settings_section(
            'mcd_font_section',
            __('Font Customization', 'marble-collection'),
            array($this, 'render_font_section'),
            'mcd_settings'
        );
        
        // Product Title Fonts
        add_settings_field(
            'mcd_title_font',
            __('Product Title Font', 'marble-collection'),
            array($this, 'render_title_font_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_title_size',
            __('Product Title Size', 'marble-collection'),
            array($this, 'render_title_size_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_title_weight',
            __('Product Title Weight', 'marble-collection'),
            array($this, 'render_title_weight_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_title_color',
            __('Product Title Color', 'marble-collection'),
            array($this, 'render_title_color_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        // Product Description Fonts
        add_settings_field(
            'mcd_excerpt_font',
            __('Product Description Font', 'marble-collection'),
            array($this, 'render_excerpt_font_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_excerpt_size',
            __('Product Description Size', 'marble-collection'),
            array($this, 'render_excerpt_size_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_excerpt_weight',
            __('Product Description Weight', 'marble-collection'),
            array($this, 'render_excerpt_weight_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_excerpt_color',
            __('Product Description Color', 'marble-collection'),
            array($this, 'render_excerpt_color_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        // Filter Fonts
        add_settings_field(
            'mcd_filter_font',
            __('Filter & Search Font', 'marble-collection'),
            array($this, 'render_filter_font_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_filter_size',
            __('Filter & Search Size', 'marble-collection'),
            array($this, 'render_filter_size_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_filter_color',
            __('Filter & Search Color', 'marble-collection'),
            array($this, 'render_filter_color_field'),
            'mcd_settings',
            'mcd_font_section'
        );
    }
    
    /**
     * Render settings page
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <div class="mcd-admin-wrapper">
                <div class="mcd-admin-main">
                    <form method="post" action="options.php">
                        <?php
                        settings_fields('mcd_settings');
                        do_settings_sections('mcd_settings');
                        submit_button();
                        ?>
                    </form>
                </div>
                
                <div class="mcd-admin-sidebar">
                    <div class="mcd-admin-box">
                        <h3><?php _e('Quick Setup', 'marble-collection'); ?></h3>
                        <p><?php _e('To display your marble collection:', 'marble-collection'); ?></p>
                        <ol>
                            <li><?php _e('Select a page below or create a new one', 'marble-collection'); ?></li>
                            <li><?php _e('Configure display settings', 'marble-collection'); ?></li>
                            <li><?php _e('Save changes', 'marble-collection'); ?></li>
                        </ol>
                        <p><strong><?php _e('Or use shortcode:', 'marble-collection'); ?></strong></p>
                        <code>[marble_collection]</code>
                    </div>
                    
                    <div class="mcd-admin-box">
                        <h3><?php _e('Documentation', 'marble-collection'); ?></h3>
                        <p><?php _e('Shortcode examples:', 'marble-collection'); ?></p>
                        <code>[marble_collection columns="4"]</code><br><br>
                        <code>[marble_collection category="quartz"]</code><br><br>
                        <code>[marble_collection per_page="32"]</code>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * Render general section
     */
    public function render_general_section() {
        echo '<p>' . __('Configure how your marble collection is displayed.', 'marble-collection') . '</p>';
    }
    
    /**
     * Render gallery section
     */
    public function render_gallery_section() {
        echo '<p>' . __('Select pages for each gallery type. Each gallery will display only products from its assigned category.', 'marble-collection') . '</p>';
    }
    
    /**
     * Render page field
     */
    public function render_page_field() {
        $page_id = get_option('mcd_collection_page');
        $pages = get_pages();
        ?>
        <select name="mcd_collection_page" id="mcd_collection_page">
            <option value=""><?php _e('-- Select Page --', 'marble-collection'); ?></option>
            <?php foreach ($pages as $page): ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($page_id, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description">
            <?php _e('Select the page where you want to display all collections. The plugin will automatically add the collection display to this page.', 'marble-collection'); ?>
        </p>
        <?php
    }
    
    /**
     * Render desktop columns field
     */
    public function render_columns_field() {
        $columns = get_option('mcd_columns', 3);
        ?>
        <select name="mcd_columns">
            <option value="2" <?php selected($columns, 2); ?>>2</option>
            <option value="3" <?php selected($columns, 3); ?>>3</option>
            <option value="4" <?php selected($columns, 4); ?>>4</option>
            <option value="5" <?php selected($columns, 5); ?>>5</option>
        </select>
        <p class="description"><?php _e('Number of product columns on desktop (above 980px)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render tablet columns field
     */
    public function render_columns_tablet_field() {
        $columns = get_option('mcd_columns_tablet', 2);
        ?>
        <select name="mcd_columns_tablet">
            <option value="1" <?php selected($columns, 1); ?>>1</option>
            <option value="2" <?php selected($columns, 2); ?>>2</option>
            <option value="3" <?php selected($columns, 3); ?>>3</option>
            <option value="4" <?php selected($columns, 4); ?>>4</option>
        </select>
        <p class="description"><?php _e('Number of product columns on tablets (768px - 980px)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render mobile columns field
     */
    public function render_columns_mobile_field() {
        $columns = get_option('mcd_columns_mobile', 2);
        ?>
        <select name="mcd_columns_mobile">
            <option value="1" <?php selected($columns, 1); ?>>1</option>
            <option value="2" <?php selected($columns, 2); ?>>2</option>
        </select>
        <p class="description"><?php _e('Number of product columns on mobile phones (below 768px)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**     * Render Quartz gallery page field
     */
    public function render_quartz_page_field() {
        $selected_page = get_option('mcd_quartz_page');
        $pages = get_pages();
        ?>
        <select name="mcd_quartz_page">
            <option value=""><?php _e('Select a page', 'marble-collection'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Select page for Quartz gallery (shows only Quartz category products)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render Marble gallery page field
     */
    public function render_marble_page_field() {
        $selected_page = get_option('mcd_marble_page');
        $pages = get_pages();
        ?>
        <select name="mcd_marble_page">
            <option value=""><?php _e('Select a page', 'marble-collection'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Select page for Marble gallery (shows only Marble category products)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render Granite gallery page field
     */
    public function render_granite_page_field() {
        $selected_page = get_option('mcd_granite_page');
        $pages = get_pages();
        ?>
        <select name="mcd_granite_page">
            <option value=""><?php _e('Select a page', 'marble-collection'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Select page for Granite gallery (shows only Granite category products)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render European gallery page field
     */
    public function render_european_page_field() {
        $selected_page = get_option('mcd_european_page');
        $pages = get_pages();
        ?>
        <select name="mcd_european_page">
            <option value=""><?php _e('Select a page', 'marble-collection'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Select page for European gallery (shows only European category products)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render Onyx gallery page field
     */
    public function render_onyx_page_field() {
        $selected_page = get_option('mcd_onyx_page');
        $pages = get_pages();
        ?>
        <select name="mcd_onyx_page">
            <option value=""><?php _e('Select a page', 'marble-collection'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Select page for Onyx gallery (shows only Onyx category products)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render Sink gallery page field
     */
    public function render_sink_page_field() {
        $selected_page = get_option('mcd_sink_page');
        $pages = get_pages();
        ?>
        <select name="mcd_sink_page">
            <option value=""><?php _e('Select a page', 'marble-collection'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Select page for Sink gallery (shows only Sink category products)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**     * Render per page field
     */
    public function render_per_page_field() {
        $per_page = get_option('mcd_per_page', 24);
        ?>
        <input type="number" name="mcd_per_page" value="<?php echo esc_attr($per_page); ?>" min="1" max="100" />
        <p class="description"><?php _e('Number of products to show per page', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render orderby field
     */
    public function render_orderby_field() {
        $orderby = get_option('mcd_default_orderby', 'menu_order');
        ?>
        <select name="mcd_default_orderby">
            <option value="menu_order" <?php selected($orderby, 'menu_order'); ?>><?php _e('Default sorting', 'marble-collection'); ?></option>
            <option value="popularity" <?php selected($orderby, 'popularity'); ?>><?php _e('Popularity', 'marble-collection'); ?></option>
            <option value="date" <?php selected($orderby, 'date'); ?>><?php _e('Latest', 'marble-collection'); ?></option>
            <option value="title" <?php selected($orderby, 'title'); ?>><?php _e('Name', 'marble-collection'); ?></option>
        </select>
        <?php
    }
    
    /**
     * Render filters field
     */
    public function render_filters_field() {
        $show_filters = get_option('mcd_show_filters', 'true');
        ?>
        <label>
            <input type="checkbox" name="mcd_show_filters" value="true" <?php checked($show_filters, 'true'); ?> />
            <?php _e('Enable category and color filters', 'marble-collection'); ?>
        </label>
        <?php
    }
    
    /**
     * Render search field
     */
    public function render_search_field() {
        $show_search = get_option('mcd_show_search', 'true');
        ?>
        <label>
            <input type="checkbox" name="mcd_show_search" value="true" <?php checked($show_search, 'true'); ?> />
            <?php _e('Enable product search', 'marble-collection'); ?>
        </label>
        <?php
    }
    
    /**
     * Render sorting field
     */
    public function render_sorting_field() {
        $show_sorting = get_option('mcd_show_sorting', 'true');
        ?>
        <label>
            <input type="checkbox" name="mcd_show_sorting" value="true" <?php checked($show_sorting, 'true'); ?> />
            <?php _e('Enable sorting dropdown', 'marble-collection'); ?>
        </label>
        <?php
    }
    
    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts($hook) {
        if ($hook !== 'toplevel_page_marble-collection-settings') {
            return;
        }
        
        // Enqueue color picker
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        
        // Enqueue admin CSS
        wp_enqueue_style('mcd-admin-style', MCD_PLUGIN_URL . 'assets/css/admin-style.css', array(), MCD_VERSION);
        
        // Enqueue color picker init script
        wp_enqueue_script(
            'mcd-color-picker-init',
            MCD_PLUGIN_URL . 'assets/js/color-picker-init.js',
            array('wp-color-picker'),
            MCD_VERSION,
            true
        );
    }
    
    /**
     * Load collection template for selected page
     */
    public function load_collection_template($template) {
        $collection_page_id = get_option('mcd_collection_page');
        $quartz_page_id = get_option('mcd_quartz_page');
        $marble_page_id = get_option('mcd_marble_page');
        $granite_page_id = get_option('mcd_granite_page');
        $european_page_id = get_option('mcd_european_page');
        $onyx_page_id = get_option('mcd_onyx_page');
        $sink_page_id = get_option('mcd_sink_page');
        
        $current_page_id = get_the_ID();
        
        // Check if current page is any gallery page
        $gallery_pages = array(
            $collection_page_id,
            $quartz_page_id,
            $marble_page_id,
            $granite_page_id,
            $european_page_id,
            $onyx_page_id,
            $sink_page_id
        );
        
        if (!in_array($current_page_id, $gallery_pages) || !is_page()) {
            return $template;
        }
        
        // Set gallery category based on page
        if ($current_page_id == $quartz_page_id) {
            $GLOBALS['mcd_gallery_category'] = 'quartz';
        } elseif ($current_page_id == $marble_page_id) {
            $GLOBALS['mcd_gallery_category'] = 'marble';
        } elseif ($current_page_id == $granite_page_id) {
            $GLOBALS['mcd_gallery_category'] = 'granite';
        } elseif ($current_page_id == $european_page_id) {
            $GLOBALS['mcd_gallery_category'] = 'european';
        } elseif ($current_page_id == $onyx_page_id) {
            $GLOBALS['mcd_gallery_category'] = 'onyx';
        } elseif ($current_page_id == $sink_page_id) {
            $GLOBALS['mcd_gallery_category'] = 'sink';
        }
        
        $custom_template = MCD_PLUGIN_DIR . 'templates/page-collection.php';
        
        if (file_exists($custom_template)) {
            return $custom_template;
        }
        
        return $template;
    }
    
    /**
     * Render font settings section description
     */
    public function render_font_section() {
        echo '<p>' . esc_html__('Customize fonts for product titles, descriptions, and filters. These settings are also available in Elementor if installed.', 'marble-collection') . '</p>';
    }
    
    /**
     * Render title font field
     */
    public function render_title_font_field() {
        $font = get_option('mcd_title_font', 'Poppins');
        $fonts = array('Poppins', 'Roboto', 'Open Sans', 'Lato', 'Ubuntu', 'Playfair Display');
        ?>
        <select name="mcd_title_font">
            <?php foreach ($fonts as $f): ?>
                <option value="<?php echo esc_attr($f); ?>" <?php selected($font, $f); ?>><?php echo esc_html($f); ?></option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Font family for product titles', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render title size field
     */
    public function render_title_size_field() {
        $size = get_option('mcd_title_size', '18px');
        ?>
        <input type="text" name="mcd_title_size" value="<?php echo esc_attr($size); ?>" placeholder="18px" style="width: 80px;" />
        <p class="description"><?php _e('E.g. 16px, 18px, 1.5rem', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render title weight field
     */
    public function render_title_weight_field() {
        $weight = get_option('mcd_title_weight', '600');
        $weights = array('300' => '300 (Light)', '400' => '400 (Normal)', '500' => '500 (Medium)', '600' => '600 (Semi-Bold)', '700' => '700 (Bold)', '800' => '800 (Extra Bold)');
        ?>
        <select name="mcd_title_weight">
            <?php foreach ($weights as $w => $label): ?>
                <option value="<?php echo esc_attr($w); ?>" <?php selected($weight, $w); ?>><?php echo esc_html($label); ?></option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Font weight for product titles', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render title color field
     */
    public function render_title_color_field() {
        $color = get_option('mcd_title_color', '#333');
        ?>
        <input type="text" name="mcd_title_color" value="<?php echo esc_attr($color); ?>" class="mcd-color-picker" data-default-color="#333" />
        <p class="description"><?php _e('Color for product titles', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render excerpt font field
     */
    public function render_excerpt_font_field() {
        $font = get_option('mcd_excerpt_font', 'Open Sans');
        $fonts = array('Poppins', 'Roboto', 'Open Sans', 'Lato', 'Ubuntu', 'Playfair Display');
        ?>
        <select name="mcd_excerpt_font">
            <?php foreach ($fonts as $f): ?>
                <option value="<?php echo esc_attr($f); ?>" <?php selected($font, $f); ?>><?php echo esc_html($f); ?></option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Font family for product descriptions', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render excerpt size field
     */
    public function render_excerpt_size_field() {
        $size = get_option('mcd_excerpt_size', '14px');
        ?>
        <input type="text" name="mcd_excerpt_size" value="<?php echo esc_attr($size); ?>" placeholder="14px" style="width: 80px;" />
        <p class="description"><?php _e('E.g. 13px, 14px, 1rem', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render excerpt weight field
     */
    public function render_excerpt_weight_field() {
        $weight = get_option('mcd_excerpt_weight', '400');
        $weights = array('300' => '300 (Light)', '400' => '400 (Normal)', '500' => '500 (Medium)', '600' => '600 (Semi-Bold)', '700' => '700 (Bold)');
        ?>
        <select name="mcd_excerpt_weight">
            <?php foreach ($weights as $w => $label): ?>
                <option value="<?php echo esc_attr($w); ?>" <?php selected($weight, $w); ?>><?php echo esc_html($label); ?></option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Font weight for product descriptions', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render excerpt color field
     */
    public function render_excerpt_color_field() {
        $color = get_option('mcd_excerpt_color', '#666');
        ?>
        <input type="text" name="mcd_excerpt_color" value="<?php echo esc_attr($color); ?>" class="mcd-color-picker" data-default-color="#666" />
        <p class="description"><?php _e('Color for product descriptions', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render filter font field
     */
    public function render_filter_font_field() {
        $font = get_option('mcd_filter_font', 'Open Sans');
        $fonts = array('Poppins', 'Roboto', 'Open Sans', 'Lato', 'Ubuntu', 'Playfair Display');
        ?>
        <select name="mcd_filter_font">
            <?php foreach ($fonts as $f): ?>
                <option value="<?php echo esc_attr($f); ?>" <?php selected($font, $f); ?>><?php echo esc_html($f); ?></option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php _e('Font family for filters and search', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render filter size field
     */
    public function render_filter_size_field() {
        $size = get_option('mcd_filter_size', '14px');
        ?>
        <input type="text" name="mcd_filter_size" value="<?php echo esc_attr($size); ?>" placeholder="14px" style="width: 80px;" />
        <p class="description"><?php _e('E.g. 13px, 14px, 1rem', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render filter color field
     */
    public function render_filter_color_field() {
        $color = get_option('mcd_filter_color', '#333');
        ?>
        <input type="text" name="mcd_filter_color" value="<?php echo esc_attr($color); ?>" class="mcd-color-picker" data-default-color="#333" />
        <p class="description"><?php _e('Color for filters and search text', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render color swatches field
     */
    public function render_color_swatches_field() {
        $show_swatches = get_option('mcd_show_color_swatches', 'yes');
        ?>
        <label>
            <input type="checkbox" name="mcd_show_color_swatches" value="yes" <?php checked($show_swatches, 'yes'); ?> />
            <?php _e('Display available color swatches on product cards', 'marble-collection'); ?>
        </label>
        <p class="description"><?php _e('Shows small color circles for each product color variant (uses WooCommerce color attribute)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render swatch size desktop field
     */
    public function render_swatch_size_desktop_field() {
        $size = get_option('mcd_swatch_size_desktop', '20px');
        ?>
        <input type="text" name="mcd_swatch_size_desktop" value="<?php echo esc_attr($size); ?>" placeholder="20px" style="width: 80px;" />
        <p class="description"><?php _e('Size of color circles on desktop (e.g., 20px, 25px, 1.5rem)', 'marble-collection'); ?></p>
        <?php
    }
    
    /**
     * Render swatch size mobile field
     */
    public function render_swatch_size_mobile_field() {
        $size = get_option('mcd_swatch_size_mobile', '16px');
        ?>
        <input type="text" name="mcd_swatch_size_mobile" value="<?php echo esc_attr($size); ?>" placeholder="16px" style="width: 80px;" />
        <p class="description"><?php _e('Size of color circles on mobile devices (e.g., 14px, 16px, 1rem)', 'marble-collection'); ?></p>
        <?php
    }
}

// Initialize admin settings
if (is_admin()) {
    new MCD_Admin_Settings();
}
