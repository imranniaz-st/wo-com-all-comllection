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
        add_action('admin_post_mcd_create_pages', array($this, 'handle_create_pages'));
        add_action('admin_post_mcd_create_single_page', array($this, 'handle_create_single_page'));
        add_filter('pre_update_option_mcd_collection_page', array($this, 'maybe_auto_create_page'), 10, 2);
        add_filter('pre_update_option_mcd_collection_page_old', array($this, 'maybe_auto_create_page'), 10, 2);
        add_filter('pre_update_option_mcd_quartz_page', array($this, 'maybe_auto_create_page'), 10, 2);
        add_filter('pre_update_option_mcd_marble_page', array($this, 'maybe_auto_create_page'), 10, 2);
        add_filter('pre_update_option_mcd_granite_page', array($this, 'maybe_auto_create_page'), 10, 2);
        add_filter('pre_update_option_mcd_european_page', array($this, 'maybe_auto_create_page'), 10, 2);
        add_filter('pre_update_option_mcd_onyx_page', array($this, 'maybe_auto_create_page'), 10, 2);
        add_filter('pre_update_option_mcd_sink_page', array($this, 'maybe_auto_create_page'), 10, 2);
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
        register_setting('mcd_settings', 'mcd_collection_page_old', array('sanitize_callback' => $sanitize_int));
        register_setting('mcd_settings', 'mcd_auto_create_missing_pages', array('sanitize_callback' => $sanitize_true_false));
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
            'mcd_general_section',
            array(
                'option_name' => 'mcd_collection_page',
                'default_title' => 'All Collections Gallery',
                'default_slug' => 'collection-gallery',
                'create_label' => __('Create All Collections Page', 'collection-for-woo')
            )
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
            __('Main Collection Page', 'collection-for-woo'),
            array($this, 'render_page_field'),
            'mcd_settings',
            'mcd_general_section',
            array(
                'option_name' => 'mcd_collection_page_old',
                'default_title' => 'All Collections Gallery',
                'default_slug' => 'collection-gallery',
                'create_label' => __('Create Legacy Collection Page', 'collection-for-woo')
            )
        );

        add_settings_field(
            'mcd_auto_create_missing_pages',
            __('Auto-Create Missing Pages', 'collection-for-woo'),
            array($this, 'render_auto_create_missing_pages_field'),
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
        $args = func_num_args() > 0 ? func_get_arg(0) : array();
        $option_name = isset($args['option_name']) ? $args['option_name'] : 'mcd_collection_page';
        $default_title = isset($args['default_title']) ? $args['default_title'] : 'All Collections Gallery';
        $default_slug = isset($args['default_slug']) ? $args['default_slug'] : 'collection-gallery';
        $create_label = isset($args['create_label']) ? $args['create_label'] : __('Create Page', 'collection-for-woo');
        $page_id = get_option($option_name);
        $pages = get_pages();
        ?>
        <select name="<?php echo esc_attr($option_name); ?>" id="<?php echo esc_attr($option_name); ?>">
            <option value=""><?php esc_html_e('-- Select Page --', 'collection-for-woo'); ?></option>
            <?php foreach ($pages as $page): ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($page_id, $page->ID); ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p style="margin-top: 8px;">
            <?php
            $create_url = add_query_arg(
                array(
                    'action' => 'mcd_create_single_page',
                    'option' => $option_name
                ),
                admin_url('admin-post.php')
            );
            $create_url = wp_nonce_url($create_url, 'mcd_create_single_page_' . $option_name, 'mcd_create_single_page_nonce');
            ?>
            <a class="button button-secondary" href="<?php echo esc_url($create_url); ?>">
                <?php echo esc_html($create_label); ?>
            </a>
            <span class="description" style="margin-left: 8px;">
                <?php echo esc_html(sprintf(__('Default: %s', 'collection-for-woo'), $default_title)); ?>
            </span>
        </p>
        <?php
        if (isset($_GET['mcd_page_option'], $_GET['mcd_page_action']) && $_GET['mcd_page_option'] === $option_name) {
            $action = sanitize_text_field(wp_unslash($_GET['mcd_page_action']));
            if ($action === 'created') {
                echo '<p class="description" style="color:#46b450;">' . esc_html__('Page created and selected.', 'collection-for-woo') . '</p>';
            } elseif ($action === 'exists') {
                echo '<p class="description" style="color:#0073aa;">' . esc_html__('Page already exists and was selected.', 'collection-for-woo') . '</p>';
            } elseif ($action === 'failed') {
                echo '<p class="description" style="color:#dc3232;">' . esc_html__('Page could not be created.', 'collection-for-woo') . '</p>';
            }
        }
        ?>
        <p class="description">
            <?php esc_html_e('Select the page where you want to display all collections. The plugin will automatically add the collection display to this page.', 'collection-for-woo'); ?>
        </p>
        <?php
    }

    /**
     * Render auto-create missing pages field
     */
    public function render_auto_create_missing_pages_field() {
        $enabled = get_option('mcd_auto_create_missing_pages', 'false');
        ?>
        <label>
            <input type="checkbox" name="mcd_auto_create_missing_pages" value="true" <?php checked($enabled, 'true'); ?> />
            <?php esc_html_e('If selected page is missing, create it automatically when saving settings.', 'collection-for-woo'); ?>
        </label>
        <p class="description">
            <?php esc_html_e('Applies to General and Gallery page settings in this screen.', 'collection-for-woo'); ?>
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
        $this->render_page_dropdown(
            'mcd_quartz_page',
            __('Quartz Gallery', 'collection-for-woo'),
            array(
                'create_label' => __('Create Quartz Gallery Page', 'collection-for-woo'),
                'description' => __('Select page for Quartz gallery (shows only Quartz category products)', 'collection-for-woo')
            )
        );
    }
    
    /**
     * Render Marble gallery page field
     */
    public function render_marble_page_field() {
        $this->render_page_dropdown(
            'mcd_marble_page',
            __('Marble Gallery', 'collection-for-woo'),
            array(
                'create_label' => __('Create Marble Gallery Page', 'collection-for-woo'),
                'description' => __('Select page for Marble gallery (shows only Marble category products)', 'collection-for-woo')
            )
        );
    }
    
    /**
     * Render Granite gallery page field
     */
    public function render_granite_page_field() {
        $this->render_page_dropdown(
            'mcd_granite_page',
            __('Granite Gallery', 'collection-for-woo'),
            array(
                'create_label' => __('Create Granite Gallery Page', 'collection-for-woo'),
                'description' => __('Select page for Granite gallery (shows only Granite category products)', 'collection-for-woo')
            )
        );
    }
    
    /**
     * Render European gallery page field
     */
    public function render_european_page_field() {
        $this->render_page_dropdown(
            'mcd_european_page',
            __('European Gallery', 'collection-for-woo'),
            array(
                'create_label' => __('Create European Gallery Page', 'collection-for-woo'),
                'description' => __('Select page for European gallery (shows only European category products)', 'collection-for-woo')
            )
        );
    }
    
    /**
     * Render Onyx gallery page field
     */
    public function render_onyx_page_field() {
        $this->render_page_dropdown(
            'mcd_onyx_page',
            __('Onyx Gallery', 'collection-for-woo'),
            array(
                'create_label' => __('Create Onyx Gallery Page', 'collection-for-woo'),
                'description' => __('Select page for Onyx gallery (shows only Onyx category products)', 'collection-for-woo')
            )
        );
    }
    
    /**
     * Render Sink gallery page field
     */
    public function render_sink_page_field() {
        $this->render_page_dropdown(
            'mcd_sink_page',
            __('Sink Gallery', 'collection-for-woo'),
            array(
                'create_label' => __('Create Sink Gallery Page', 'collection-for-woo'),
                'description' => __('Select page for Sink gallery (shows only Sink category products)', 'collection-for-woo')
            )
        );
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
        if (!$collection_page_id) {
            $collection_page_id = get_option('mcd_collection_page_old');
        }
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
    public function sanitize_absint($value) {
        return absint($value);
    }

    /**
     * Sanitize text options
     */
    public function sanitize_text($value) {
        return sanitize_text_field($value);
    }

    /**
     * Sanitize true/false string options
     */
    public function sanitize_true_false($value) {
        return ($value === 'true' || $value === true || $value === '1' || $value === 1) ? 'true' : 'false';
    }

    /**
     * Sanitize yes/no string options
     */
    public function sanitize_yes_no($value) {
        return ($value === 'yes' || $value === true || $value === '1' || $value === 1) ? 'yes' : 'no';
    }

    /**
     * Sanitize color values
     */
    public function sanitize_color($value) {
        $color = sanitize_hex_color($value);
        return $color ? $color : '';
    }

    /**
     * Sanitize orderby option
     */
    public function sanitize_orderby($value) {
        $allowed = array('menu_order', 'popularity', 'date', 'title', 'price', 'price-desc', 'rating');
        return in_array($value, $allowed, true) ? $value : 'menu_order';
    }

    /**
     * Add additional settings for GTA Marble and advanced features
     */
    public function add_advanced_settings() {
        // Stock status settings
        register_setting('mcd_settings', 'mcd_show_stock_status', array('sanitize_callback' => array($this, 'sanitize_true_false')));
        register_setting('mcd_settings', 'mcd_show_quick_view', array('sanitize_callback' => array($this, 'sanitize_true_false')));
        register_setting('mcd_settings', 'mcd_lazy_load_images', array('sanitize_callback' => array($this, 'sanitize_true_false')));
        
        // GTA Marble specific settings
        register_setting('mcd_settings', 'mcd_business_name', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_phone_1', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_phone_2', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_email', array('sanitize_callback' => 'sanitize_email'));
        register_setting('mcd_settings', 'mcd_address', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_hours', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_service_area', array('sanitize_callback' => array($this, 'sanitize_text')));
        
        // Hero section settings
        register_setting('mcd_settings', 'mcd_show_hero', array('sanitize_callback' => array($this, 'sanitize_true_false')));
        register_setting('mcd_settings', 'mcd_hero_title', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_hero_subtitle', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_hero_cta_text', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_hero_image', array('sanitize_callback' => array($this, 'sanitize_int')));
        
        // Kitchen countertops priority
        register_setting('mcd_settings', 'mcd_kitchen_priority', array('sanitize_callback' => array($this, 'sanitize_true_false')));
        register_setting('mcd_settings', 'mcd_kitchen_page_id', array('sanitize_callback' => array($this, 'sanitize_int')));
        
        // Collection settings for GTA Marble
        register_setting('mcd_settings', 'mcd_superstone_page', array('sanitize_callback' => array($this, 'sanitize_int')));
        register_setting('mcd_settings', 'mcd_goodstone_page', array('sanitize_callback' => array($this, 'sanitize_int')));
        register_setting('mcd_settings', 'mcd_kstone_page', array('sanitize_callback' => array($this, 'sanitize_int')));
        register_setting('mcd_settings', 'mcd_lucent_page', array('sanitize_callback' => array($this, 'sanitize_int')));
        register_setting('mcd_settings', 'mcd_fortezza_page', array('sanitize_callback' => array($this, 'sanitize_int')));
        register_setting('mcd_settings', 'mcd_natural_stone_page', array('sanitize_callback' => array($this, 'sanitize_int')));
        register_setting('mcd_settings', 'mcd_all_collections_page', array('sanitize_callback' => array($this, 'sanitize_int')));
        
        // Multi-location support
        register_setting('mcd_settings', 'mcd_enable_multi_location', array('sanitize_callback' => array($this, 'sanitize_true_false')));
        register_setting('mcd_settings', 'mcd_location_1_name', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_location_1_address', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_location_1_phone', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_location_2_name', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_location_2_address', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_location_2_phone', array('sanitize_callback' => array($this, 'sanitize_text')));
        
        // Performance settings
        register_setting('mcd_settings', 'mcd_minify_css', array('sanitize_callback' => array($this, 'sanitize_true_false')));
        register_setting('mcd_settings', 'mcd_minify_js', array('sanitize_callback' => array($this, 'sanitize_true_false')));
        register_setting('mcd_settings', 'mcd_enable_caching', array('sanitize_callback' => array($this, 'sanitize_true_false')));
        register_setting('mcd_settings', 'mcd_cache_duration', array('sanitize_callback' => array($this, 'sanitize_int')));
        
        // SEO settings
        register_setting('mcd_settings', 'mcd_seo_focus_keywords', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_seo_location', array('sanitize_callback' => array($this, 'sanitize_text')));
        
        // CTA button settings
        register_setting('mcd_settings', 'mcd_primary_cta_text', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_primary_cta_color', array('sanitize_callback' => array($this, 'sanitize_color')));
        register_setting('mcd_settings', 'mcd_secondary_cta_text', array('sanitize_callback' => array($this, 'sanitize_text')));
        register_setting('mcd_settings', 'mcd_secondary_cta_color', array('sanitize_callback' => array($this, 'sanitize_color')));
        
        // Custom CSS
        register_setting('mcd_settings', 'mcd_custom_css', array('sanitize_callback' => array($this, 'sanitize_css')));
        
        // Add settings sections and fields for GTA Marble
        $this->add_gta_marble_sections();
    }

    /**
     * Add GTA Marble specific settings sections
     */
    private function add_gta_marble_sections() {
        // Auto Page Creator Section
        add_settings_section(
            'mcd_auto_pages',
            __('🚀 Quick Setup - Auto Create Pages', 'collection-for-woo'),
            array($this, 'render_auto_pages_section'),
            'mcd_settings'
        );
        
        // Business Information Section
        add_settings_section(
            'mcd_business_info',
            __('Business Information', 'collection-for-woo'),
            array($this, 'render_business_info_section'),
            'mcd_settings'
        );

        add_settings_field(
            'mcd_business_name',
            __('Business Name', 'collection-for-woo'),
            array($this, 'render_business_name_field'),
            'mcd_settings',
            'mcd_business_info'
        );

        add_settings_field(
            'mcd_phone_1',
            __('Primary Phone Number', 'collection-for-woo'),
            array($this, 'render_phone_1_field'),
            'mcd_settings',
            'mcd_business_info'
        );

        add_settings_field(
            'mcd_phone_2',
            __('Secondary Phone Number', 'collection-for-woo'),
            array($this, 'render_phone_2_field'),
            'mcd_settings',
            'mcd_business_info'
        );

        add_settings_field(
            'mcd_email',
            __('Contact Email', 'collection-for-woo'),
            array($this, 'render_email_field'),
            'mcd_settings',
            'mcd_business_info'
        );

        add_settings_field(
            'mcd_address',
            __('Business Address', 'collection-for-woo'),
            array($this, 'render_address_field'),
            'mcd_settings',
            'mcd_business_info'
        );

        add_settings_field(
            'mcd_hours',
            __('Business Hours', 'collection-for-woo'),
            array($this, 'render_hours_field'),
            'mcd_settings',
            'mcd_business_info'
        );

        add_settings_field(
            'mcd_service_area',
            __('Service Area', 'collection-for-woo'),
            array($this, 'render_service_area_field'),
            'mcd_settings',
            'mcd_business_info'
        );

        // Collections Section
        add_settings_section(
            'mcd_collections',
            __('GTA Marble Collections', 'collection-for-woo'),
            array($this, 'render_collections_section'),
            'mcd_settings'
        );

        add_settings_field(
            'mcd_kitchen_priority',
            __('Enable Kitchen Countertops Priority', 'collection-for-woo'),
            array($this, 'render_kitchen_priority_field'),
            'mcd_settings',
            'mcd_collections'
        );

        add_settings_field(
            'mcd_kitchen_page_id',
            __('Kitchen Countertops Page', 'collection-for-woo'),
            array($this, 'render_kitchen_page_field'),
            'mcd_settings',
            'mcd_collections'
        );

        add_settings_field(
            'mcd_superstone_page',
            __('Superstone Quartz Collection Page', 'collection-for-woo'),
            array($this, 'render_superstone_page_field'),
            'mcd_settings',
            'mcd_collections'
        );

        add_settings_field(
            'mcd_goodstone_page',
            __('Goodstone Quartz Collection Page', 'collection-for-woo'),
            array($this, 'render_goodstone_page_field'),
            'mcd_settings',
            'mcd_collections'
        );

        add_settings_field(
            'mcd_kstone_page',
            __('Kstone Quartz Collection Page', 'collection-for-woo'),
            array($this, 'render_kstone_page_field'),
            'mcd_settings',
            'mcd_collections'
        );

        add_settings_field(
            'mcd_lucent_page',
            __('Lucent Quartz Collection Page', 'collection-for-woo'),
            array($this, 'render_lucent_page_field'),
            'mcd_settings',
            'mcd_collections'
        );

        add_settings_field(
            'mcd_fortezza_page',
            __('Fortezza Quartz (Custom) Collection Page', 'collection-for-woo'),
            array($this, 'render_fortezza_page_field'),
            'mcd_settings',
            'mcd_collections'
        );

        add_settings_field(
            'mcd_natural_stone_page',
            __('Natural Stone Collection Page', 'collection-for-woo'),
            array($this, 'render_natural_stone_page_field'),
            'mcd_settings',
            'mcd_collections'
        );

        add_settings_field(
            'mcd_all_collections_page',
            __('All Collections Master Page', 'collection-for-woo'),
            array($this, 'render_all_collections_page_field'),
            'mcd_settings',
            'mcd_collections'
        );
    }

    /**
     * Render auto pages section
     */
    public function render_auto_pages_section() {
        echo '<p><strong>' . esc_html__('Automatically create selected pages with content and shortcodes!', 'collection-for-woo') . '</strong></p>';
        echo '<p>' . esc_html__('Choose which page groups you want to create. Created pages are auto-linked to the dropdowns below.', 'collection-for-woo') . '</p>';
        
        // Check if pages were just created and show detailed results
        if (isset($_GET['pages_created']) && $_GET['pages_created'] == 'yes') {
            $created_count = isset($_GET['created']) ? intval($_GET['created']) : 0;
            $existing_count = isset($_GET['existing']) ? intval($_GET['existing']) : 0;
            $failed_count = isset($_GET['failed']) ? intval($_GET['failed']) : 0;
            
            echo '<div class="notice notice-success" style="border-left-color:#46b450; padding:15px;">';
            echo '<h3 style="margin-top:0;">✅ ' . esc_html__('Pages Created & Saved Successfully!', 'collection-for-woo') . '</h3>';
            
            if ($created_count > 0) {
                echo '<p><strong>' . sprintf(esc_html__('✓ Created: %d new pages saved to database', 'collection-for-woo'), $created_count) . '</strong></p>';
            }
            
            if ($existing_count > 0) {
                echo '<p><strong>' . sprintf(esc_html__('ℹ Existing: %d pages already existed (not overwritten)', 'collection-for-woo'), $existing_count) . '</strong></p>';
            }
            
            if ($failed_count > 0) {
                echo '<p style="color:#dc3232;"><strong>' . sprintf(esc_html__('✗ Failed: %d pages could not be created', 'collection-for-woo'), $failed_count) . '</strong></p>';
            }
            
            echo '<p><a href="' . esc_url(admin_url('edit.php?post_type=page')) . '" class="button button-primary">' . esc_html__('View All Pages', 'collection-for-woo') . '</a></p>';
            echo '</div>';
        }

        if (isset($_GET['pages_created']) && $_GET['pages_created'] === 'no_selection') {
            echo '<div class="notice notice-error" style="border-left-color:#dc3232; padding:15px;">';
            echo '<p><strong>' . esc_html__('Please select at least one page group to create.', 'collection-for-woo') . '</strong></p>';
            echo '</div>';
        }
        
        ?>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="mcd_create_pages">
            <?php wp_nonce_field('mcd_create_pages', 'mcd_create_pages_nonce'); ?>
            <fieldset style="margin: 10px 0 15px;">
                <legend class="screen-reader-text"><?php esc_html_e('Select page groups to create', 'collection-for-woo'); ?></legend>
                <label style="display:block; margin-bottom:6px;">
                    <input type="checkbox" name="mcd_create_groups[]" value="gta_pages" checked>
                    <?php esc_html_e('GTA Marble pages (Home, Kitchen, Collections, All Collections, About, Contact)', 'collection-for-woo'); ?>
                </label>
                <label style="display:block;">
                    <input type="checkbox" name="mcd_create_groups[]" value="gallery_pages" checked>
                    <?php esc_html_e('Gallery pages (All, Quartz, Marble, Granite, European, Onyx, Sink)', 'collection-for-woo'); ?>
                </label>
            </fieldset>
            <p>
                <button type="submit" class="button button-primary button-hero" style="background:#d4af37; border-color:#c49f2e; text-shadow:none; font-size:16px; height:auto; padding:15px 30px;">
                    🚀 <?php esc_html_e('Create Selected Pages', 'collection-for-woo'); ?>
                </button>
            </p>
            <p class="description">
                <?php esc_html_e('⚠️ Note: All pages are saved permanently to the database. If pages already exist with the same slugs, they will not be overwritten.', 'collection-for-woo'); ?>
            </p>
            <p class="description">
                <?php esc_html_e('💾 All created pages are saved with: Content, Shortcodes, SEO metadata, and can be viewed in Pages → All Pages', 'collection-for-woo'); ?>
            </p>
        </form>
        <?php
    }

    /**
     * Render business info section
     */
    public function render_business_info_section() {
        echo '<p>' . esc_html__('Configure GTA Marble business information displayed on the website', 'collection-for-woo') . '</p>';
    }

    /**
     * Render business name field
     */
    public function render_business_name_field() {
        $value = get_option('mcd_business_name', 'GTA Marble');
        ?>
        <input type="text" name="mcd_business_name" value="<?php echo esc_attr($value); ?>" placeholder="GTA Marble" style="width: 300px;" />
        <p class="description"><?php esc_html_e('Your business name (default: GTA Marble)', 'collection-for-woo'); ?></p>
        <?php
    }

    /**
     * Render phone 1 field
     */
    public function render_phone_1_field() {
        $value = get_option('mcd_phone_1', '');
        ?>
        <input type="tel" name="mcd_phone_1" value="<?php echo esc_attr($value); ?>" placeholder="+1 (647) 291-2686" style="width: 300px;" />
        <p class="description"><?php esc_html_e('Primary contact phone number', 'collection-for-woo'); ?></p>
        <?php
    }

    /**
     * Render phone 2 field
     */
    public function render_phone_2_field() {
        $value = get_option('mcd_phone_2', '');
        ?>
        <input type="tel" name="mcd_phone_2" value="<?php echo esc_attr($value); ?>" placeholder="+1 (647) 619-9753" style="width: 300px;" />
        <p class="description"><?php esc_html_e('Secondary contact phone number (optional)', 'collection-for-woo'); ?></p>
        <?php
    }

    /**
     * Render email field
     */
    public function render_email_field() {
        $value = get_option('mcd_email', '');
        ?>
        <input type="email" name="mcd_email" value="<?php echo esc_attr($value); ?>" placeholder="info@gtamarble.com" style="width: 300px;" />
        <p class="description"><?php esc_html_e('Business contact email address', 'collection-for-woo'); ?></p>
        <?php
    }

    /**
     * Render address field
     */
    public function render_address_field() {
        $value = get_option('mcd_address', '');
        ?>
        <textarea name="mcd_address" style="width: 100%; max-width: 500px; height: 80px;"><?php echo esc_textarea($value); ?></textarea>
        <p class="description"><?php esc_html_e('Business address: 44 Goodmark Place, Unit 16, Etobicoke, ON M9W 6N8', 'collection-for-woo'); ?></p>
        <?php
    }

    /**
     * Render hours field
     */
    public function render_hours_field() {
        $value = get_option('mcd_hours', '');
        ?>
        <textarea name="mcd_hours" style="width: 100%; max-width: 500px; height: 80px;"><?php echo esc_textarea($value); ?></textarea>
        <p class="description"><?php esc_html_e('Business hours (e.g., Mon-Fri 9am-6pm, Sat 10am-4pm)', 'collection-for-woo'); ?></p>
        <?php
    }

    /**
     * Render service area field
     */
    public function render_service_area_field() {
        $value = get_option('mcd_service_area', '');
        ?>
        <textarea name="mcd_service_area" style="width: 100%; max-width: 500px; height: 60px;"><?php echo esc_textarea($value); ?></textarea>
        <p class="description"><?php esc_html_e('Service area coverage (e.g., GTA + 500km Ontario coverage)', 'collection-for-woo'); ?></p>
        <?php
    }

    /**
     * Render collections section
     */
    public function render_collections_section() {
        echo '<p>' . esc_html__('Configure gallery pages for each collection. Select the pages you created for each collection type.', 'collection-for-woo') . '</p>';
    }

    /**
     * Render kitchen priority field
     */
    public function render_kitchen_priority_field() {
        $value = get_option('mcd_kitchen_priority', 'true');
        ?>
        <label>
            <input type="checkbox" name="mcd_kitchen_priority" value="true" <?php checked($value, 'true'); ?> />
            <?php esc_html_e('Enable Kitchen Countertops as homepage priority', 'collection-for-woo'); ?>
        </label>
        <p class="description"><?php esc_html_e('When enabled, Kitchen Countertops featured prominently on homepage for SEO', 'collection-for-woo'); ?></p>
        <?php
    }

    /**
     * Render kitchen page field
     */
    public function render_kitchen_page_field() {
        $this->render_page_dropdown('mcd_kitchen_page_id', __('Kitchen Countertops Gallery', 'collection-for-woo'));
    }

    /**
     * Render page dropdown helper
     */
    private function render_page_dropdown($option_name, $label, $args = array()) {
        $selected = get_option($option_name, 0);
        $create_label = isset($args['create_label']) ? $args['create_label'] : '';
        $description = isset($args['description']) ? $args['description'] : '';
        ?>
        <select name="<?php echo esc_attr($option_name); ?>" style="max-width: 300px;">
            <option value="0"><?php esc_html_e('-- Select a Page --', 'collection-for-woo'); ?></option>
            <?php
            $pages = get_pages();
            foreach ($pages as $page) {
                echo '<option value="' . esc_attr($page->ID) . '"' . selected($selected, $page->ID) . '>' . esc_html($page->post_title) . '</option>';
            }
            ?>
        </select>
        <?php
        if (!empty($create_label)) {
            $create_url = add_query_arg(
                array(
                    'action' => 'mcd_create_single_page',
                    'option' => $option_name
                ),
                admin_url('admin-post.php')
            );
            $create_url = wp_nonce_url($create_url, 'mcd_create_single_page_' . $option_name, 'mcd_create_single_page_nonce');
            echo '<p style="margin-top: 8px;">';
            echo '<a class="button button-secondary" href="' . esc_url($create_url) . '">' . esc_html($create_label) . '</a>';
            echo '</p>';

            if (isset($_GET['mcd_page_option'], $_GET['mcd_page_action']) && $_GET['mcd_page_option'] === $option_name) {
                $action = sanitize_text_field(wp_unslash($_GET['mcd_page_action']));
                if ($action === 'created') {
                    echo '<p class="description" style="color:#46b450;">' . esc_html__('Page created and selected.', 'collection-for-woo') . '</p>';
                } elseif ($action === 'exists') {
                    echo '<p class="description" style="color:#0073aa;">' . esc_html__('Page already exists and was selected.', 'collection-for-woo') . '</p>';
                } elseif ($action === 'failed') {
                    echo '<p class="description" style="color:#dc3232;">' . esc_html__('Page could not be created.', 'collection-for-woo') . '</p>';
                }
            }
        }

        if (!empty($description)) {
            echo '<p class="description">' . esc_html($description) . '</p>';
        }
         
    }

    /**
     * Render superstone page field
     */
    public function render_superstone_page_field() {
        $this->render_page_dropdown('mcd_superstone_page', __('Superstone Quartz Collection', 'collection-for-woo'));
    }

    /**
     * Render goodstone page field
     */
    public function render_goodstone_page_field() {
        $this->render_page_dropdown('mcd_goodstone_page', __('Goodstone Quartz Collection', 'collection-for-woo'));
    }

    /**
     * Render kstone page field
     */
    public function render_kstone_page_field() {
        $this->render_page_dropdown('mcd_kstone_page', __('Kstone Quartz Collection', 'collection-for-woo'));
    }

    /**
     * Render lucent page field
     */
    public function render_lucent_page_field() {
        $this->render_page_dropdown('mcd_lucent_page', __('Lucent Quartz Collection', 'collection-for-woo'));
    }

    /**
     * Render fortezza page field
     */
    public function render_fortezza_page_field() {
        $this->render_page_dropdown('mcd_fortezza_page', __('Fortezza Quartz (Custom) Collection', 'collection-for-woo'));
    }

    /**
     * Render natural stone page field
     */
    public function render_natural_stone_page_field() {
        $this->render_page_dropdown('mcd_natural_stone_page', __('Natural Stone Collection', 'collection-for-woo'));
    }

    /**
     * Render all collections page field
     */
    public function render_all_collections_page_field() {
        $this->render_page_dropdown('mcd_all_collections_page', __('All Collections Master Page', 'collection-for-woo'));
    }

    /**
     * Sanitize CSS
     */
    public function sanitize_css($value) {
        // Allow basic CSS but strip dangerous content
        return wp_kses_post($value);
    }

    /**
     * Sanitize integer
     */
    public function sanitize_int($value) {
        return absint($value);
    }

    /**
     * Auto-create missing pages on save
     */
    public function maybe_auto_create_page($new_value, $old_value) {
        if (!is_admin() || !current_user_can('manage_options')) {
            return $new_value;
        }

        $filter = current_filter();
        $option_map = array(
            'pre_update_option_mcd_collection_page' => 'mcd_collection_page',
            'pre_update_option_mcd_collection_page_old' => 'mcd_collection_page_old',
            'pre_update_option_mcd_quartz_page' => 'mcd_quartz_page',
            'pre_update_option_mcd_marble_page' => 'mcd_marble_page',
            'pre_update_option_mcd_granite_page' => 'mcd_granite_page',
            'pre_update_option_mcd_european_page' => 'mcd_european_page',
            'pre_update_option_mcd_onyx_page' => 'mcd_onyx_page',
            'pre_update_option_mcd_sink_page' => 'mcd_sink_page'
        );

        if (!isset($option_map[$filter])) {
            return $new_value;
        }

        $option_name = $option_map[$filter];

        $auto_create = false;
        if (isset($_POST['mcd_auto_create_missing_pages'])) {
            $auto_create = sanitize_text_field(wp_unslash($_POST['mcd_auto_create_missing_pages'])) === 'true';
        } else {
            $auto_create = get_option('mcd_auto_create_missing_pages', 'false') === 'true';
        }

        if (!$auto_create) {
            return $new_value;
        }

        $page_id = absint($new_value);
        if ($page_id > 0 && get_post_status($page_id)) {
            return $page_id;
        }

        $result = $this->create_or_select_page($option_name);
        if (!empty($result['id'])) {
            return $result['id'];
        }

        return $new_value;
    }

    /**
     * Handle single page creation from General Settings
     */
    public function handle_create_single_page() {
        if (!isset($_GET['mcd_create_single_page_nonce'], $_GET['option'])) {
            wp_die(__('Security check failed', 'collection-for-woo'));
        }

        $option_name = sanitize_text_field(wp_unslash($_GET['option']));
        $nonce = sanitize_text_field(wp_unslash($_GET['mcd_create_single_page_nonce']));

        if (!wp_verify_nonce($nonce, 'mcd_create_single_page_' . $option_name)) {
            wp_die(__('Security check failed', 'collection-for-woo'));
        }

        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have permission to perform this action', 'collection-for-woo'));
        }

        $result = $this->create_or_select_page($option_name, true);
        $status = $result['status'];

        $redirect_url = add_query_arg(
            array(
                'page' => 'marble-collection-settings',
                'mcd_page_action' => $status,
                'mcd_page_option' => $option_name
            ),
            admin_url('admin.php')
        );

        wp_redirect($redirect_url);
        exit;
    }

    /**
     * Get default pages map
     */
    private function get_page_defaults() {
        return array(
            'mcd_collection_page' => array(
                'title' => 'All Collections Gallery',
                'slug' => 'collection-gallery',
                'content' => '[marble_collection]'
            ),
            'mcd_collection_page_old' => array(
                'title' => 'All Collections Gallery',
                'slug' => 'collection-gallery',
                'content' => '[marble_collection]'
            ),
            'mcd_quartz_page' => array(
                'title' => 'Quartz Gallery',
                'slug' => 'quartz-gallery',
                'content' => '[marble_collection category="quartz"]'
            ),
            'mcd_marble_page' => array(
                'title' => 'Marble Gallery',
                'slug' => 'marble-gallery',
                'content' => '[marble_collection category="marble"]'
            ),
            'mcd_granite_page' => array(
                'title' => 'Granite Gallery',
                'slug' => 'granite-gallery',
                'content' => '[marble_collection category="granite"]'
            ),
            'mcd_european_page' => array(
                'title' => 'European Gallery',
                'slug' => 'european-gallery',
                'content' => '[marble_collection category="european"]'
            ),
            'mcd_onyx_page' => array(
                'title' => 'Onyx Gallery',
                'slug' => 'onyx-gallery',
                'content' => '[marble_collection category="onyx"]'
            ),
            'mcd_sink_page' => array(
                'title' => 'Sink Gallery',
                'slug' => 'sink-gallery',
                'content' => '[marble_collection category="sink"]'
            )
        );
    }

    /**
     * Create or select a default page for a given option
     */
    private function create_or_select_page($option_name, $save_option = false) {
        $page_defaults = $this->get_page_defaults();

        if (!isset($page_defaults[$option_name])) {
            return array('status' => 'failed', 'id' => 0);
        }

        $defaults = $page_defaults[$option_name];
        $slug = sanitize_title($defaults['slug']);
        $existing = get_page_by_path($slug);

        if ($existing) {
            if ($save_option) {
                update_option($option_name, $existing->ID);
            }
            return array('status' => 'exists', 'id' => $existing->ID);
        }

        $page_id = wp_insert_post(
            array(
                'post_title' => $defaults['title'],
                'post_name' => $slug,
                'post_content' => $defaults['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => get_current_user_id(),
                'comment_status' => 'closed',
                'ping_status' => 'closed'
            ),
            true
        );

        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_mcd_auto_created', true);
            update_post_meta($page_id, '_mcd_created_date', current_time('mysql'));
            clean_post_cache($page_id);
            if ($save_option) {
                update_option($option_name, $page_id);
            }
            return array('status' => 'created', 'id' => $page_id);
        }

        return array('status' => 'failed', 'id' => 0);
    }
    
    /**
     * Handle page creation
     */
    public function handle_create_pages() {
        // Verify nonce
        if (!isset($_POST['mcd_create_pages_nonce']) || !wp_verify_nonce($_POST['mcd_create_pages_nonce'], 'mcd_create_pages')) {
            wp_die(__('Security check failed', 'collection-for-woo'));
        }
        
        // Check user permissions
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have permission to perform this action', 'collection-for-woo'));
        }
        
        // Load auto page creator
        require_once MCD_PLUGIN_DIR . 'includes/auto-page-creator.php';

        $allowed_groups = array('gta_pages', 'gallery_pages');
        $groups = isset($_POST['mcd_create_groups']) ? (array) $_POST['mcd_create_groups'] : array();
        $groups = array_values(array_intersect($allowed_groups, array_map('sanitize_text_field', $groups)));

        if (empty($groups)) {
            $redirect_url = add_query_arg(
                array(
                    'page' => 'marble-collection-settings',
                    'pages_created' => 'no_selection'
                ),
                admin_url('admin.php')
            );

            wp_redirect($redirect_url);
            exit;
        }
        
        // Create selected pages (they are saved to database automatically)
        $pages = MCD_Auto_Page_Creator::create_pages($groups);
        
        // Auto-link pages to settings
        MCD_Auto_Page_Creator::auto_link_pages($pages);
        
        // Count results
        $created_count = 0;
        $existing_count = 0;
        $failed_count = 0;
        
        foreach ($pages as $page) {
            if (isset($page['status'])) {
                if ($page['status'] === 'created') {
                    $created_count++;
                } elseif ($page['status'] === 'exists') {
                    $existing_count++;
                } elseif ($page['status'] === 'failed') {
                    $failed_count++;
                }
            }
        }
        
        // Redirect back with success message and statistics
        $redirect_url = add_query_arg(
            array(
                'page' => 'marble-collection-settings',
                'pages_created' => 'yes',
                'created' => $created_count,
                'existing' => $existing_count,
                'failed' => $failed_count
            ),
            admin_url('admin.php')
        );
        
        wp_redirect($redirect_url);
        exit;
    }
}

// Initialize admin settings
if (is_admin()) {
    $settings = new MCD_Admin_Settings();
    add_action('admin_init', array($settings, 'add_advanced_settings'));
}
