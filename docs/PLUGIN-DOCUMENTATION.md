# Marble Collection Display - Plugin Documentation

**Plugin Name:** Marble Collection Display  
**Version:** 2.0.1  
**Author:** Bicodev Ltd  
**License:** GPL-2.0+  
**WordPress Requirement:** 5.8+  
**WooCommerce Requirement:** 5.0+  
**PHP Requirement:** 7.4+  

---

## 📌 Plugin Overview

Marble Collection Display is a professional WordPress/WooCommerce plugin for displaying marble, stone, and quartz product collections with advanced filtering, responsive design, and Elementor integration.

**This plugin documentation is isolated and independent from GTA Marble business requirements.**

---

## 🎯 Core Features

### 1. Collection Management
- Create unlimited product collections
- Group products by category
- Display via shortcode or Elementor widget
- AJAX-powered filtering
- Real-time search functionality

### 2. Product Filtering
- Filter by category
- Filter by product attributes
- Color swatch filtering
- Multiple filter types supported
- AJAX filters without page reload

### 3. Layout & Display
- Responsive grid (2-5 columns configurable)
- Desktop, tablet, mobile breakpoints
- Separate settings per device
- Smooth animations
- Professional styling

### 4. Elementor Integration
- Custom "Marble Collection" widget
- Widget controls for settings
- Typography customization
- Layout configuration
- Category filtering in builder

### 5. Customization
- Font family selection (11 options)
- Font size & weight control
- Color customization (titles, descriptions, filters)
- Show/hide elements
- Custom CSS support

### 6. Performance
- Optimized AJAX queries
- Lazy loading support
- CSS/JS minification ready
- Efficient database queries
- Caching compatible

---

## 🔧 Installation

### Method 1: WordPress Admin Dashboard
1. Go to **Plugins → Add New**
2. Click **Upload Plugin**
3. Select marble-collection-display.zip
4. Click **Install Now** → **Activate**

### Method 2: Manual Upload
1. Extract plugin files
2. Upload to `/wp-content/plugins/marble-collection-display/`
3. Go to **Plugins** and activate

### Method 3: Git Clone
```bash
cd wp-content/plugins/
git clone https://github.com/imranniaz-st/wo-com-all-comllection.git marble-collection-display
```

---

## ⚙️ Configuration

### Admin Settings Panel
Access via: **Settings → Marble Collections**

#### General Settings
- **Collection Page:** Select main collection page
- **Columns (Desktop):** 2-5 columns (default: 3)
- **Columns (Tablet):** 1-4 columns (default: 2)
- **Columns (Mobile):** 1-2 columns (default: 1)
- **Products Per Page:** 1-100 (default: 12)
- **Default Sort:** menu_order, popularity, date, title

#### Display Settings
- **Show Filters:** Enable/disable filtering
- **Show Search:** Enable/disable search box
- **Show Sorting:** Enable/disable sort dropdown
- **Show Product Titles:** Show/hide product names
- **Show Descriptions:** Show/hide product descriptions
- **Show Quick View:** Enable/disable quick view button
- **Show Color Swatches:** Enable/disable color display

#### Font Customization
- **Title Font:** Font family, size, weight, color
- **Description Font:** Font family, size, weight, color
- **Filter Font:** Font family, size, weight, color

#### Color Swatch Settings
- **Desktop Size:** Swatch width/height (pixels)
- **Mobile Size:** Mobile swatch dimensions

#### Gallery Pages (6 Categories)
- Quartz Gallery page
- Marble Gallery page
- Granite Gallery page
- European Gallery page
- Onyx Gallery page
- Sink Gallery page

---

## 🎨 Shortcode Usage

### Basic Shortcode
```
[marble_collection]
```

### With Parameters
```
[marble_collection 
  category="quartz" 
  columns="4" 
  per_page="32" 
  orderby="popularity"
  show_filters="true"
  show_search="true"
  show_sorting="true"
  show_title="true"
  show_description="true"
  show_quick_view="true"
]
```

### Parameter Reference
| Parameter | Type | Default | Options |
|-----------|------|---------|---------|
| `category` | string | all | category slug |
| `columns` | int | 3 | 2-5 |
| `per_page` | int | 12 | 1-100 |
| `orderby` | string | menu_order | menu_order, popularity, date, title |
| `show_filters` | bool | true | true, false |
| `show_search` | bool | true | true, false |
| `show_sorting` | bool | true | true, false |
| `show_title` | bool | true | true, false |
| `show_description` | bool | true | true, false |
| `show_quick_view` | bool | true | true, false |

---

## 🧩 Elementor Widget

### Adding to Page
1. Edit page with Elementor
2. Search for "Marble Collection"
3. Click to add widget
4. Configure widget settings
5. Publish page

### Widget Controls

#### Layout Tab
- Columns (desktop/tablet/mobile)
- Products per page
- Sorting order

#### Content Tab
- Category filter
- Show/hide elements
- Title/description toggle

#### Style Tab
- Font settings
- Color customization
- Spacing options

#### Advanced Tab
- Custom CSS
- Responsive settings
- Animation options

---

## 🎣 Hooks & Filters

### Action Hooks
```php
// Before collection renders
do_action('mcd_before_collection');

// After collection renders
do_action('mcd_after_collection');

// Before products loop
do_action('mcd_before_products');

// After products loop
do_action('mcd_after_products');
```

### Filter Hooks
```php
// Modify product query arguments
apply_filters('mcd_product_query_args', $args);

// Modify product HTML output
apply_filters('mcd_product_html', $html, $product);

// Modify filter output
apply_filters('mcd_filter_html', $html, $filter_name);

// Modify search results
apply_filters('mcd_search_results', $products, $search_term);
```

### Usage Example
```php
// Add custom content before collection
add_action('mcd_before_collection', function() {
    echo '<p>Welcome to our collection!</p>';
});

// Modify query arguments
add_filter('mcd_product_query_args', function($args) {
    $args['orderby'] = 'popularity';
    return $args;
});
```

---

## 📁 File Structure

```
marble-collection-display/
├── marble-collection-display.php      (Main plugin file)
├── includes/
│   ├── admin-settings.php             (Settings page)
│   ├── elementor-support.php          (Elementor integration)
│   ├── elementor-widget.php           (Widget class)
│   └── github-updater.php             (Update handler)
├── templates/
│   ├── page-collection.php            (Full page template)
│   ├── collection-display.php         (Grid layout)
│   └── product-item.php               (Product card)
├── assets/
│   ├── css/
│   │   ├── marble-collection.css      (Styles)
│   │   └── elementor-editor.css       (Builder styles)
│   └── js/
│       ├── marble-collection.js       (AJAX/interactions)
│       └── color-picker-init.js       (Color picker)
├── docs/
│   └── [documentation files]
└── languages/
    └── collection-for-woo.pot         (Translation file)
```

---

## 🔐 Security Features

### Input Sanitization
- All form inputs sanitized with `sanitize_text_field()`
- Settings validated before saving
- Options escaping on output

### Output Escaping
- HTML output with `wp_kses_post()`
- Attributes with `esc_attr()`
- URLs with `esc_url()`
- Localized text with `esc_html_e()`

### Nonce Verification
- AJAX requests secured with nonces
- Form submissions validated
- User capabilities checked

### Database Queries
- Prepared statements used
- WP Query class for safe queries
- Meta queries properly escaped

---

## 🐛 Troubleshooting

### Collection Not Displaying
**Solution:**
1. Verify page assigned in settings
2. Check products exist in category
3. Clear browser cache
4. Check JavaScript console for errors

### Filters Not Working
**Solution:**
1. Verify AJAX is enabled
2. Check category exists
3. Ensure products have attributes
4. Check server error logs

### Elementor Widget Missing
**Solution:**
1. Install/activate Elementor
2. Refresh page
3. Clear Elementor cache
4. Check plugin compatibility

### Styling Issues
**Solution:**
1. Check CSS file is loaded
2. Verify theme CSS conflicts
3. Use custom CSS in settings
4. Check mobile breakpoints

---

## 🚀 Performance Optimization

### Best Practices
1. **Limit Products Per Page:** 12-24 items optimal
2. **Use Categories:** Organize products efficiently
3. **Optimize Images:** Use WebP format when possible
4. **Enable Caching:** Use W3 Total Cache or similar
5. **Monitor Queries:** Check Site Health for slow queries

### Recommended Settings
- Products Per Page: 16
- Columns (Desktop): 4
- Columns (Tablet): 2
- Columns (Mobile): 1
- Show Filters: Yes
- Show Sorting: Yes

---

## 🔄 AJAX Endpoints

### Filter Products
```
POST /wp-admin/admin-ajax.php
Action: mcd_filter_products
Parameters:
  - category: string
  - color: string
  - orderby: string
  - paged: int
  - per_page: int
  - search: string
```

### Response
```json
{
  "success": true,
  "html": "<product items>",
  "pagination": "<pagination html>",
  "count": 16
}
```

---

## 📊 Database Tables Used

The plugin uses standard WordPress tables:
- `wp_posts` - Products and pages
- `wp_postmeta` - Product metadata
- `wp_terms` - Categories and tags
- `wp_termmeta` - Term metadata
- `wp_woocommerce_attribute_taxonomies` - WooCommerce attributes

No custom tables created.

---

## 🔄 Updater Functionality

The plugin includes GitHub-based auto-updater:
- Checks for new releases on GitHub
- Compares versions
- Enables one-click updates
- Preserves settings during update
- Logs update history

### Manual Update
1. Download latest from GitHub
2. Deactivate plugin
3. Delete old files
4. Upload new version
5. Activate plugin

---

## �️ Category Management Guide

### Creating Product Categories

**Step 1: Create Categories**
1. Go to **Products → Categories**
2. Click **Add New Category**
3. Enter category name (e.g., "Superstone Quartz")
4. Set category slug (lowercase, no spaces)
5. Add description (optional)
6. Upload category image (optional)
7. Click **Add New Category**

**Step 2: Assign Products to Categories**
1. Go to **Products → All Products**
2. Edit a product
3. In **Product Data** tab, scroll to **Product Categories**
4. Check the appropriate category
5. Click **Update**

**Category Slug Rules:**
- Must be lowercase
- No spaces (use hyphens instead)
- Should be descriptive and SEO-friendly
- Examples: `superstone-quartz`, `goodstone-quartz`, `kitchen-countertops`

### Gallery Pages Setup

**For Each Collection Category:**

1. Create a dedicated page:
   - **Page Name:** "[Collection Name] Gallery"
   - **Slug:** "[collection]-gallery"
   - **Content:** Introductory text (optional)

2. Configure in plugin settings:
   - Go to **Settings → Marble Collections**
   - Scroll to **Gallery Pages**
   - Select the page for each category
   - Click **Save Changes**

3. The gallery page will automatically:
   - Display only products from that category
   - Apply all plugin filters and settings
   - Show responsive grid layout
   - Enable AJAX search/filter

---

## ⚠️ Troubleshooting Guide

### Issue: Gallery page shows no products

**Causes & Solutions:**

1. **No products assigned to category**
   - Check: Go to **Products → Categories**
   - Verify category exists
   - Go to **Products → All Products**
   - Edit a product, assign to the category

2. **Category slug mismatch**
   - Verify category slug is lowercase
   - Check plugin settings match the slug
   - Clear browser cache
   - Clear any caching plugins

3. **Wrong page selected in settings**
   - Go to **Settings → Marble Collections → Gallery Pages**
   - Confirm correct page is selected
   - Click **Save Changes**
   - Verify page is published

4. **Products not published**
   - Check product status is "Publish"
   - Check product stock (if tracking enabled)
   - Verify WooCommerce is active

**Debug Steps:**
```
1. Deactivate all other plugins except WooCommerce
2. Switch to default WordPress theme (if needed)
3. Check WordPress/WooCommerce versions compatible
4. Clear all caches (browser, server, plugins)
5. Test in incognito/private window
```

### Issue: Gallery displays all products (no filtering)

**Solutions:**

1. **Page not properly linked in settings**
   - Go to **Settings → Marble Collections**
   - Re-select the gallery page
   - Click **Save Changes**
   - Wait 10 seconds for cache clear

2. **Multiple galleries on one page**
   - If using shortcodes, ensure correct category parameter
   - Example: `[marble_collection category="superstone-quartz"]`
   - Verify no typos in category slug

3. **Cache plugin interfering**
   - Disable caching temporarily
   - Clear all caches
   - Re-enable and test

### Issue: Images not displaying

**Solutions:**

1. **Product images not uploaded**
   - Go to **Products → All Products**
   - Edit product
   - Upload featured image in **Product Image**
   - Upload gallery images
   - Update product

2. **Image URLs broken**
   - Check file permissions on server
   - Verify image files exist in media library
   - Re-upload images if corrupted

3. **Lazy loading issues**
   - If images not loading with lazy load enabled:
   - Go to plugin settings
   - Disable lazy loading temporarily
   - Click **Save Changes**

### Issue: Filters not working / AJAX not responding

**Solutions:**

1. **JavaScript conflicts**
   - Disable other plugins one by one
   - Check browser console for errors (F12)
   - Verify jQuery is loaded

2. **Server AJAX misconfiguration**
   - Test AJAX: Add this to page:
     ```php
     echo 'AJAX Test: ';
     echo (function_exists('wp_remote_post')) ? 'OK' : 'FAIL';
     ```
   - Contact hosting provider if AJAX disabled

3. **Missing filter attributes**
   - Verify products have attributes assigned
   - Go to **Products → Attributes**
   - Ensure attributes are attached to products
   - Assign values to each product

### Issue: Plugin settings not saving

**Solutions:**

1. **Insufficient user permissions**
   - Ensure logged-in user has **manage_options** capability
   - User role should be **Administrator**

2. **PHP memory limit**
   - Increase in wp-config.php:
     ```php
     define('WP_MEMORY_LIMIT', '256M');
     ```

3. **POST data size limit**
   - Check server limits in php.ini:
     ```
     post_max_size = 32M
     upload_max_filesize = 32M
     ```

### Issue: Slow loading / performance issues

**Solutions:**

1. **Too many products per page**
   - Go to **Settings → Marble Collections**
   - Reduce "Products Per Page" (try 12-20)
   - Click **Save Changes**

2. **High-resolution images**
   - Use image optimization plugin (Smush, Imagify)
   - Compress images before upload
   - Use appropriate image dimensions (max 1920px width)

3. **Lazy loading disabled**
   - Go to plugin settings
   - Enable "Lazy Load Images"
   - This loads images only when visible

4. **Database optimization**
   - Use WP Rocket, W3 Total Cache for caching
   - Run database optimization tools
   - Remove unused plugins/posts

---

## 📋 Common Setup Workflows

### Workflow 1: Basic Multi-Category Gallery

**Goal:** Display 3 product categories with separate gallery pages

**Steps:**
1. Create 3 product categories: Category A, B, C
2. Create 3 pages: "Gallery A", "Gallery B", "Gallery C"
3. Assign 5-10 products to each category
4. In plugin settings, assign page to each category
5. Add menu links to each gallery page
6. Test filter/search on each page

**Result:** Three independent galleries, each showing only their category products

### Workflow 2: Master Gallery + Category Pages

**Goal:** One page showing all collections + individual pages per collection

**Steps:**
1. Enable "All Collections Page" in settings
2. Select a page for "All Collections"
3. Set up individual gallery pages for each category
4. In navigation menu:
   - Add "All Collections" → All Collections Page
   - Add "Category A" → Gallery A Page
   - Add "Category B" → Gallery B Page

**Result:** Main page shows all products, category pages filter by category

### Workflow 3: Elementor Multi-Widget Page

**Goal:** Display multiple collections on single page with custom layout

**Steps:**
1. Create a new page in Elementor
2. Add heading: "Our Collections"
3. Add Marble Collection widget, set category: Category A
4. Add divider
5. Add Marble Collection widget, set category: Category B
6. Add CTA button: "View All Collections"
7. Publish page

**Result:** Single page with multiple collection widgets, all customizable

---

## 🎯 Best Practices

### Content Organization
- ✅ One category per product type/collection
- ✅ Descriptive category names and slugs
- ✅ Category images for visual browsing
- ✅ Limit categories to 10-15 for easier management

### Product Setup
- ✅ High-quality images (1920x1440px+)
- ✅ Descriptive product names and descriptions
- ✅ Assign all relevant attributes (color, size, etc.)
- ✅ Set accurate pricing and stock
- ✅ Use featured image prominently

### Gallery Configuration
- ✅ 3-4 columns desktop for stone/marble products
- ✅ 2 columns tablet, 1 column mobile
- ✅ 12-20 products per page (optimize for speed)
- ✅ Enable filters for better UX
- ✅ Enable search for product discovery

### Performance
- ✅ Optimize images before upload
- ✅ Enable lazy loading
- ✅ Use caching plugin (WP Rocket, W3 Total Cache)
- ✅ Monitor site speed regularly
- ✅ Update plugin and dependencies

### SEO
- ✅ Use descriptive category slugs
- ✅ Add meta descriptions to gallery pages
- ✅ Use proper heading hierarchy (H1, H2, H3)
- ✅ Add alt text to all images
- ✅ Create sitemap with category pages

### Accessibility
- ✅ Ensure color contrast meets WCAG standards
- ✅ Use descriptive alt text for images
- ✅ Test keyboard navigation
- ✅ Test with screen readers
- ✅ Ensure mobile usability

---

## �📝 Changelog

### v2.0.1 (February 3, 2026)
- ✅ Fixed sanitization method visibility (private → public)
- ✅ PluginCheck compliance updates
- ✅ Text domain standardized to `collection-for-woo`
- ✅ Removed hidden files from root
- ✅ Documentation reorganized

### v2.0.0 (January 17, 2026)
- 🎉 Major release
- ✅ Elementor widget support
- ✅ Font customization
- ✅ GitHub updater
- ✅ Advanced filtering
- ✅ Responsive design

### v1.0.0 (November 14, 2025)
- 🎉 Initial release
- ✅ Core collection functionality
- ✅ AJAX filtering
- ✅ Shortcode support
- ✅ Admin settings panel

---

## 📞 Support & Contribution

### Report Issues
- GitHub Issues: https://github.com/imranniaz-st/wo-com-all-comllection/issues
- Include version and error details
- Provide reproduction steps

### Contributing
- Fork repository
- Create feature branch
- Submit pull request
- Follow code standards

### License
GPL-2.0+ - See LICENSE.txt

---

## 📚 Additional Resources

- [WordPress Plugin Handbook](https://developer.wordpress.org/plugins/)
- [WooCommerce Docs](https://woocommerce.com/documentation/)
- [Elementor Developer Docs](https://developers.elementor.com/)
- [GitHub Repository](https://github.com/imranniaz-st/wo-com-all-comllection)

---

**Plugin Status:** Active & Maintained  
**Last Updated:** February 3, 2026  
**Stable Version:** 2.0.1  

This documentation is isolated and independent from any client project requirements.
