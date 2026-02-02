# Troubleshooting Guide

## Common Issues and Solutions

### "Error loading products. Please try again."

**Possible Causes:**
1. WooCommerce is not active
2. JavaScript not loading properly
3. AJAX endpoint not responding
4. Plugin permissions issue

**Solutions:**

1. **Check WooCommerce Status:**
   - Go to WordPress Admin → Plugins
   - Ensure WooCommerce is active
   - Activate if it's not

2. **Clear Cache:**
   - If using a caching plugin, clear all caches
   - Clear browser cache (Ctrl+Shift+Delete)
   - Try in incognito/private browsing mode

3. **Check JavaScript Console:**
   - Press F12 to open browser developer tools
   - Click on "Console" tab
   - Look for any error messages
   - If you see "mcdAjax is not defined", the plugin scripts aren't loading

4. **Regenerate Permalinks:**
   - Go to WordPress Admin → Settings → Permalinks
   - Click "Save Changes" (no need to change anything)
   - This refreshes WordPress rewrite rules

5. **Check Theme Compatibility:**
   - Temporarily switch to a default WordPress theme (Twenty Twenty-Four)
   - If it works, there may be a theme conflict
   - Contact your theme developer for support

### No Products Displaying

**Solutions:**

1. **Check Products Exist:**
   - Go to WooCommerce → Products
   - Ensure you have published products
   - Products must have "Publish" status

2. **Check Product Categories:**
   - Verify products are assigned to categories
   - Go to Products → Categories to check

3. **Check Shortcode:**
   - Ensure shortcode is correct: `[marble_collection]`
   - No extra spaces or characters

### Filters Not Working

**Solutions:**

1. **Check Product Attributes:**
   - Go to Products → Attributes
   - Ensure "Color" attribute exists (slug: `pa_color`)
   - Assign colors to your products

2. **Clear Filter Cache:**
   - Go to Marble Collections → Settings
   - Save settings again to refresh

### Styling Issues

**Solutions:**

1. **Check CSS Loading:**
   - View page source (Ctrl+U)
   - Search for "marble-collection.css"
   - If not found, plugin CSS isn't loading

2. **Clear Cache:**
   - Clear all caches
   - Hard refresh browser (Ctrl+Shift+R)

### Mobile Display Issues

**Solutions:**

1. **Check Mobile Settings:**
   - Go to Marble Collections → Settings
   - Verify mobile column settings
   - Default: 2 columns on mobile

2. **Test Responsive:**
   - Press F12, click "Toggle Device Toolbar"
   - Test different screen sizes
   - Verify layout adapts properly

## Debug Mode

To enable debugging:

1. Add this to your `wp-config.php`:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

2. Check debug log:
   - Location: `/wp-content/debug.log`
   - Look for marble-collection related errors

## Still Having Issues?

1. **Deactivate Other Plugins:**
   - Temporarily deactivate all other plugins
   - Activate them one by one to find conflicts

2. **Check Server Requirements:**
   - PHP 7.4 or higher
   - WordPress 5.8 or higher
   - WooCommerce 5.0 or higher

3. **Contact Support:**
   - Include WordPress version
   - Include WooCommerce version
   - Include error messages from console
   - Include steps to reproduce issue
