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
            __('Marble Collections', 'collection-for-woo'),
            __('Marble Collections', 'collection-for-woo'),
            'manage_options',
            'marble-collection-settings',
            array($this, 'render_settings_page'),
            'dashicons-grid-view',
            56
        );
        
        add_submenu_page(
            'marble-collection-settings',
            __('Settings', 'collection-for-woo'),
            __('Settings', 'collection-for-woo'),
            'manage_options',
            'marble-collection-settings',
            array($this, 'render_settings_page')
        );
    }
    
    /**
     * Register settings
     */
    public function register_settings() {
        $sanitize_int = array($this, 'sanitize_absint');
        $sanitize_text = array($this, 'sanitize_text');
        $sanitize_true_false = array($this, 'sanitize_true_false');
        $sanitize_yes_no = array($this, 'sanitize_yes_no');
        $sanitize_color = array($this, 'sanitize_color');
        $sanitize_orderby = array($this, 'sanitize_orderby');

        register_setting('mcd_settings', 'mcd_collection_page', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_columns', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_columns_tablet', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_columns_mobile', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_per_page', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_default_orderby', array('sanitize_callback' => $sanitize_orderby));
        register_setting('mcd_settings', 'mcd_show_filters', array('sanitize_callback' => $sanitize_true_false));
        register_setting('mcd_settings', 'mcd_show_search', array('sanitize_callback' => $sanitize_true_false));
        register_setting('mcd_settings', 'mcd_show_sorting', array('sanitize_callback' => $sanitize_true_false));
        register_setting('mcd_settings', 'mcd_show_color_swatches', array('sanitize_callback' => $sanitize_yes_no));
        register_setting('mcd_settings', 'mcd_swatch_size_desktop', array('sanitize_callback' => $sanitize_text));
        register_setting('mcd_settings', 'mcd_swatch_size_mobile', array('sanitize_callback' => $sanitize_text));
        
        // Font settings
        register_setting('mcd_settings', 'mcd_title_font', array('sanitize_callback' => $sanitize_text));
        register_setting('mcd_settings', 'mcd_title_size', array('sanitize_callback' => $sanitize_text));
        register_setting('mcd_settings', 'mcd_title_weight', array('sanitize_callback' => $sanitize_text));
        register_setting('mcd_settings', 'mcd_title_color', array('sanitize_callback' => $sanitize_color));
        register_setting('mcd_settings', 'mcd_excerpt_font', array('sanitize_callback' => $sanitize_text));
        register_setting('mcd_settings', 'mcd_excerpt_size', array('sanitize_callback' => $sanitize_text));
        register_setting('mcd_settings', 'mcd_excerpt_weight', array('sanitize_callback' => $sanitize_text));
        register_setting('mcd_settings', 'mcd_excerpt_color', array('sanitize_callback' => $sanitize_color));
        register_setting('mcd_settings', 'mcd_filter_font', array('sanitize_callback' => $sanitize_text));
        register_setting('mcd_settings', 'mcd_filter_size', array('sanitize_callback' => $sanitize_text));
        register_setting('mcd_settings', 'mcd_filter_color', array('sanitize_callback' => $sanitize_color));
        
        // Gallery pages
        register_setting('mcd_settings', 'mcd_quartz_page', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_marble_page', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_granite_page', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_european_page', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_onyx_page', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_sink_page', array('sanitize_callback' => $sanitize_int));
        
        add_settings_section(
            'mcd_general_section',
            __('General Settings', 'collection-for-woo'),
            array($this, 'render_general_section'),
            'mcd_settings'
        );
        
        add_settings_field(
            'mcd_collection_page',
            __('All Collections Page', 'collection-for-woo'),
            array($this, 'render_page_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        // Gallery Pages Section
        add_settings_section(
            'mcd_gallery_section',
            __('Gallery Pages', 'collection-for-woo'),
            array($this, 'render_gallery_section'),
            'mcd_settings'
        );
        
        add_settings_field(
            'mcd_quartz_page',
            __('Quartz Gallery Page', 'collection-for-woo'),
            array($this, 'render_quartz_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_marble_page',
            __('Marble Gallery Page', 'collection-for-woo'),
            array($this, 'render_marble_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_granite_page',
            __('Granite Gallery Page', 'collection-for-woo'),
            array($this, 'render_granite_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_european_page',
            __('European Gallery Page', 'collection-for-woo'),
            array($this, 'render_european_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_onyx_page',
            __('Onyx Gallery Page', 'collection-for-woo'),
            array($this, 'render_onyx_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_sink_page',
            __('Sink Gallery Page', 'collection-for-woo'),
            array($this, 'render_sink_page_field'),
            'mcd_settings',
            'mcd_gallery_section'
        );
        
        add_settings_field(
            'mcd_collection_page_old',
            __('Main Collection Page (Legacy)', 'collection-for-woo'),
            array($this, 'render_page_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_columns',
            __('Columns (Desktop)', 'collection-for-woo'),
            array($this, 'render_columns_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_columns_tablet',
            __('Columns (Tablet)', 'collection-for-woo'),
            array($this, 'render_columns_tablet_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_columns_mobile',
            __('Columns (Mobile)', 'collection-for-woo'),
            array($this, 'render_columns_mobile_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_per_page',
            __('Products Per Page', 'collection-for-woo'),
            array($this, 'render_per_page_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_default_orderby',
            __('Default Sorting', 'collection-for-woo'),
            array($this, 'render_orderby_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_show_filters',
            __('Show Filters', 'collection-for-woo'),
            array($this, 'render_filters_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_show_search',
            __('Show Search', 'collection-for-woo'),
            array($this, 'render_search_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_show_sorting',
            __('Show Sorting Dropdown', 'collection-for-woo'),
            array($this, 'render_sorting_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_show_color_swatches',
            __('Show Color Swatches', 'collection-for-woo'),
            array($this, 'render_color_swatches_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_swatch_size_desktop',
            __('Color Swatch Size (Desktop)', 'collection-for-woo'),
            array($this, 'render_swatch_size_desktop_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        add_settings_field(
            'mcd_swatch_size_mobile',
            __('Color Swatch Size (Mobile)', 'collection-for-woo'),
            array($this, 'render_swatch_size_mobile_field'),
            'mcd_settings',
            'mcd_general_section'
        );
        
        // Font Settings Section
        add_settings_section(
            'mcd_font_section',
            __('Font Customization', 'collection-for-woo'),
            array($this, 'render_font_section'),
            'mcd_settings'
        );
        
        // Product Title Fonts
        add_settings_field(
            'mcd_title_font',
            __('Product Title Font', 'collection-for-woo'),
            array($this, 'render_title_font_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_title_size',
            __('Product Title Size', 'collection-for-woo'),
            array($this, 'render_title_size_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_title_weight',
            __('Product Title Weight', 'collection-for-woo'),
            array($this, 'render_title_weight_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_title_color',
            __('Product Title Color', 'collection-for-woo'),
            array($this, 'render_title_color_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        // Product Description Fonts
        add_settings_field(
            'mcd_excerpt_font',
            __('Product Description Font', 'collection-for-woo'),
            array($this, 'render_excerpt_font_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_excerpt_size',
            __('Product Description Size', 'collection-for-woo'),
            array($this, 'render_excerpt_size_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_excerpt_weight',
            __('Product Description Weight', 'collection-for-woo'),
            array($this, 'render_excerpt_weight_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_excerpt_color',
            __('Product Description Color', 'collection-for-woo'),
            array($this, 'render_excerpt_color_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        // Filter Fonts
        add_settings_field(
            'mcd_filter_font',
            __('Filter & Search Font', 'collection-for-woo'),
            array($this, 'render_filter_font_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_filter_size',
            __('Filter & Search Size', 'collection-for-woo'),
            array($this, 'render_filter_size_field'),
            'mcd_settings',
            'mcd_font_section'
        );
        
        add_settings_field(
            'mcd_filter_color',
            __('Filter & Search Color', 'collection-for-woo'),
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
                        <h3><?php esc_html_e('Quick Setup', 'collection-for-woo'); ?></h3>
                        <p><?php esc_html_e('To display your marble collection:', 'collection-for-woo'); ?></p>
                        <ol>
                            <li><?php esc_html_e('Select a page below or create a new one', 'collection-for-woo'); ?></li>
                            <li><?php esc_html_e('Configure display settings', 'collection-for-woo'); ?></li>
                            <li><?php esc_html_e('Save changes', 'collection-for-woo'); ?></li>
                        </ol>
                        <p><strong><?php esc_html_e('Or use shortcode:', 'collection-for-woo'); ?></strong></p>
                        <code>[marble_collection]</code>
                    </div>
                    
                    <div class="mcd-admin-box">
                        <h3><?php esc_html_e('Documentation', 'collection-for-woo'); ?></h3>
                        <p><?php esc_html_e('Shortcode examples:', 'collection-for-woo'); ?></p>
                        <code>[marble_collection columns="4"]</code><br><br>
                        <code>[marble_collection category="quartz"]</code><br><br>
                        <code>[marble_collection per_page="32"]</code>
                    </div>
                    
                    <div class="mcd-admin-box">
                        <h3><?php esc_html_e('Plugin Updates', 'collection-for-woo'); ?></h3>
                        <p><?php esc_html_e('Current Version:', 'collection-for-woo'); ?> <strong><?php echo esc_html(MCD_VERSION); ?></strong></p>
                        <p><?php esc_html_e('Updates are checked automatically from GitHub.', 'collection-for-woo'); ?></p>
                        <p>
                            <a href="<?php echo esc_url(admin_url('plugins.php')); ?>" class="button button-secondary">
                                <?php esc_html_e('Check for Updates', 'collection-for-woo'); ?>
                            </a>
                        </p>
                        <p>
                            <a href="https://github.com/imranniaz-st/wo-com-all-comllection/releases" target="_blank" class="button button-secondary">
                                <?php esc_html_e('View Releases', 'collection-for-woo'); ?>
                            </a>
                        </p>
                        <p class="description">
                            <?php esc_html_e('This plugin updates from GitHub, not WordPress.org repository.', 'collection-for-woo'); ?>
                        </p>
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
        echo '<p>' . esc_html__('Configure how your marble collection is displayed.', 'collection-for-woo') . '</p>';
    }
    
    /**
     * Render gallery section
     */
    public function render_gallery_section() {
        echo '<p>' . esc_html__('Select pages for each gallery type. Each gallery will display only products from its assigned category.', 'collection-for-woo') . '</p>';
    }
    
    /**
     * Render page field
     */
    public function render_page_field() {
        $page_id = get_option('mcd_collection_page');
        $pages = get_pages();
        ?>
        <select name="mcd_collection_page" id="mcd_collection_page">
            <option value=""><?php esc_html_e('-- Select Page --', 'collection-for-woo'); ?></option>
            <?php foreach ($pages as $page): ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($page_id, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description">
            <?php esc_html_e('Select the page where you want to display all collections. The plugin will automatically add the collection display to this page.', 'collection-for-woo'); ?>
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
        <p class="description"><?php esc_html_e('Number of product columns on desktop (above 980px)', 'collection-for-woo'); ?></p>
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
        <p class="description"><?php esc_html_e('Number of product columns on tablets (768px - 980px)', 'collection-for-woo'); ?></p>
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
        <p class="description"><?php esc_html_e('Number of product columns on mobile phones (below 768px)', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**     * Render Quartz gallery page field
     */
    public function render_quartz_page_field() {
        $selected_page = get_option('mcd_quartz_page');
        $pages = get_pages();
        ?>
        <select name="mcd_quartz_page">
            <option value=""><?php esc_html_e('Select a page', 'collection-for-woo'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php esc_html_e('Select page for Quartz gallery (shows only Quartz category products)', 'collection-for-woo'); ?></p>
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
            <option value=""><?php esc_html_e('Select a page', 'collection-for-woo'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php esc_html_e('Select page for Marble gallery (shows only Marble category products)', 'collection-for-woo'); ?></p>
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
            <option value=""><?php esc_html_e('Select a page', 'collection-for-woo'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php esc_html_e('Select page for Granite gallery (shows only Granite category products)', 'collection-for-woo'); ?></p>
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
            <option value=""><?php esc_html_e('Select a page', 'collection-for-woo'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php esc_html_e('Select page for European gallery (shows only European category products)', 'collection-for-woo'); ?></p>
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
            <option value=""><?php esc_html_e('Select a page', 'collection-for-woo'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php esc_html_e('Select page for Onyx gallery (shows only Onyx category products)', 'collection-for-woo'); ?></p>
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
            <option value=""><?php esc_html_e('Select a page', 'collection-for-woo'); ?></option>
            <?php foreach ($pages as $page) : ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description"><?php esc_html_e('Select page for Sink gallery (shows only Sink category products)', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**     * Render per page field
     */
    public function render_per_page_field() {
        $per_page = get_option('mcd_per_page', 24);
        ?>
        <input type="number" name="mcd_per_page" value="<?php echo esc_attr($per_page); ?>" min="1" max="100" />
        <p class="description"><?php esc_html_e('Number of products to show per page', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**
     * Render orderby field
     */
    public function render_orderby_field() {
        $orderby = get_option('mcd_default_orderby', 'menu_order');
        ?>
        <select name="mcd_default_orderby">
            <option value="menu_order" <?php selected($orderby, 'menu_order'); ?>><?php esc_html_e('Default sorting', 'collection-for-woo'); ?></option>
            <option value="popularity" <?php selected($orderby, 'popularity'); ?>><?php esc_html_e('Popularity', 'collection-for-woo'); ?></option>
            <option value="date" <?php selected($orderby, 'date'); ?>><?php esc_html_e('Latest', 'collection-for-woo'); ?></option>
            <option value="title" <?php selected($orderby, 'title'); ?>><?php esc_html_e('Name', 'collection-for-woo'); ?></option>
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
            <?php esc_html_e('Enable category and color filters', 'collection-for-woo'); ?>
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
            <?php esc_html_e('Enable product search', 'collection-for-woo'); ?>
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
            <?php esc_html_e('Enable sorting dropdown', 'collection-for-woo'); ?>
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
        echo '<p>' . esc_html__('Customize fonts for product titles, descriptions, and filters. These settings are also available in Elementor if installed.', 'collection-for-woo') . '</p>';
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
        <p class="description"><?php esc_html_e('Font family for product titles', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**
     * Render title size field
     */
    public function render_title_size_field() {
        $size = get_option('mcd_title_size', '18px');
        ?>
        <input type="text" name="mcd_title_size" value="<?php echo esc_attr($size); ?>" placeholder="18px" style="width: 80px;" />
        <p class="description"><?php esc_html_e('E.g. 16px, 18px, 1.5rem', 'collection-for-woo'); ?></p>
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
        <p class="description"><?php esc_html_e('Font weight for product titles', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**
     * Render title color field
     */
    public function render_title_color_field() {
        $color = get_option('mcd_title_color', '#333');
        ?>
        <input type="text" name="mcd_title_color" value="<?php echo esc_attr($color); ?>" class="mcd-color-picker" data-default-color="#333" />
        <p class="description"><?php esc_html_e('Color for product titles', 'collection-for-woo'); ?></p>
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
        <p class="description"><?php esc_html_e('Font family for product descriptions', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**
     * Render excerpt size field
     */
    public function render_excerpt_size_field() {
        $size = get_option('mcd_excerpt_size', '14px');
        ?>
        <input type="text" name="mcd_excerpt_size" value="<?php echo esc_attr($size); ?>" placeholder="14px" style="width: 80px;" />
        <p class="description"><?php esc_html_e('E.g. 13px, 14px, 1rem', 'collection-for-woo'); ?></p>
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
        <p class="description"><?php esc_html_e('Font weight for product descriptions', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**
     * Render excerpt color field
     */
    public function render_excerpt_color_field() {
        $color = get_option('mcd_excerpt_color', '#666');
        ?>
        <input type="text" name="mcd_excerpt_color" value="<?php echo esc_attr($color); ?>" class="mcd-color-picker" data-default-color="#666" />
        <p class="description"><?php esc_html_e('Color for product descriptions', 'collection-for-woo'); ?></p>
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
        <p class="description"><?php esc_html_e('Font family for filters and search', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**
     * Render filter size field
     */
    public function render_filter_size_field() {
        $size = get_option('mcd_filter_size', '14px');
        ?>
        <input type="text" name="mcd_filter_size" value="<?php echo esc_attr($size); ?>" placeholder="14px" style="width: 80px;" />
        <p class="description"><?php esc_html_e('E.g. 13px, 14px, 1rem', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**
     * Render filter color field
     */
    public function render_filter_color_field() {
        $color = get_option('mcd_filter_color', '#333');
        ?>
        <input type="text" name="mcd_filter_color" value="<?php echo esc_attr($color); ?>" class="mcd-color-picker" data-default-color="#333" />
        <p class="description"><?php esc_html_e('Color for filters and search text', 'collection-for-woo'); ?></p>
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
            <?php esc_html_e('Display available color swatches on product cards', 'collection-for-woo'); ?>
        </label>
        <p class="description"><?php esc_html_e('Shows small color circles for each product color variant (uses WooCommerce color attribute)', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**
     * Render swatch size desktop field
     */
    public function render_swatch_size_desktop_field() {
        $size = get_option('mcd_swatch_size_desktop', '20px');
        ?>
        <input type="text" name="mcd_swatch_size_desktop" value="<?php echo esc_attr($size); ?>" placeholder="20px" style="width: 80px;" />
        <p class="description"><?php esc_html_e('Size of color circles on desktop (e.g., 20px, 25px, 1.5rem)', 'collection-for-woo'); ?></p>
        <?php
    }
    
    /**
     * Render swatch size mobile field
     */
    public function render_swatch_size_mobile_field() {
        $size = get_option('mcd_swatch_size_mobile', '16px');
        ?>
        <input type="text" name="mcd_swatch_size_mobile" value="<?php echo esc_attr($size); ?>" placeholder="16px" style="width: 80px;" />
        <p class="description"><?php esc_html_e('Size of color circles on mobile devices (e.g., 14px, 16px, 1rem)', 'collection-for-woo'); ?></p>
        <?php
    }

    /**
     * Sanitize integer options
     */
    private function sanitize_absint($value) {
        return absint($value);
    }

    /**
     * Sanitize text options
     */
    private function sanitize_text($value) {
        return sanitize_text_field($value);
    }

    /**
     * Sanitize true/false string options
     */
    private function sanitize_true_false($value) {
        return ($value === 'true' || $value === true || $value === '1' || $value === 1) ? 'true' : 'false';
    }

    /**
     * Sanitize yes/no string options
     */
    private function sanitize_yes_no($value) {
        return ($value === 'yes' || $value === true || $value === '1' || $value === 1) ? 'yes' : 'no';
    }

    /**
     * Sanitize color values
     */
    private function sanitize_color($value) {
        $color = sanitize_hex_color($value);
        return $color ? $color : '';
    }

    /**
     * Sanitize orderby option
     */
    private function sanitize_orderby($value) {
        $allowed = array('menu_order', 'popularity', 'date', 'title');
        return in_array($value, $allowed, true) ? $value : 'menu_order';
    }
}

// Initialize admin settings
if (is_admin()) {
    new MCD_Admin_Settings();
}
