# Elementor & Font Customization Guide

## New Features

### 1. Font Customization in Admin Panel

You can now customize all fonts directly from the WordPress admin without any code:

**Marble Collections → Settings → Font Customization**

#### Available Font Customizations:

**Product Titles:**
- Font Family (Poppins, Roboto, Open Sans, Lato, Ubuntu, Playfair Display)
- Font Size (e.g., 16px, 18px, 1.5rem)
- Font Weight (300, 400, 500, 600, 700, 800)
- Font Color (with color picker)

**Product Descriptions:**
- Font Family
- Font Size
- Font Weight
- Font Color

**Filters & Search:**
- Font Family
- Font Size
- Font Color

### 2. Elementor Support

If Elementor is installed and active, you can use the **Marble Collection** widget directly in the Elementor editor.

#### Features:

✅ **Drag & drop** collection display in Elementor
✅ **Real-time preview** of your changes
✅ **Responsive controls** for different devices
✅ **Typography controls** for all text elements
✅ **Color pickers** for customization
✅ **No errors** if Elementor is not installed

#### Adding the Widget:

1. Open any page/post in Elementor
2. Search for "Marble Collection" in the elements panel
3. Add the widget to your page
4. Configure settings:
   - **Layout**: Grid with filters or Simple grid
   - **Columns**: 2, 3, or 4
   - **Show Filters**: Toggle on/off
   - **Show Search**: Toggle on/off

#### Styling in Elementor:

Under the **Styles** tab, you can customize:
- **Title Typography**: Font, size, weight, color
- **Description Typography**: Font, size, weight, color
- **Card Background**: Change product card colors
- **Items Gap**: Spacing between products

### 3. Font Settings via CSS Variables

All font settings are automatically applied as CSS variables:

```css
--mcd-title-font
--mcd-title-size
--mcd-title-weight
--mcd-title-color

--mcd-excerpt-font
--mcd-excerpt-size
--mcd-excerpt-weight
--mcd-excerpt-color

--mcd-filter-font
--mcd-filter-size
--mcd-filter-color
```

These can also be overridden in custom CSS if needed.

### 4. No Errors If Elementor Not Installed

The plugin gracefully handles missing Elementor:
- No errors are displayed
- No broken shortcodes
- All functionality works with or without Elementor
- Font customization is always available in admin

## Usage Examples

### Using Admin Settings Only:

1. Go to **Marble Collections → Settings**
2. Scroll to **Font Customization**
3. Set your preferred fonts, sizes, and colors
4. Click **Save Changes**
5. Changes apply instantly to all collections

### Using with Elementor:

1. Install and activate Elementor
2. Create/edit a page with Elementor
3. Add "Marble Collection" widget
4. Customize in the Elementor panel
5. Both admin settings and Elementor controls work together

### Shortcode Usage:

```
[marble_collection_display columns="3" filters="true" search="true"]
```

Font settings from admin panel automatically apply to shortcodes.

## Troubleshooting

### Fonts Not Changing

- Clear browser cache
- Clear any page caching plugins
- Verify you saved the admin settings
- Check browser DevTools to see if CSS variables are applied

### Elementor Widget Not Showing

- Verify Elementor is installed and activated
- Refresh the Elementor editor
- Check browser console for JavaScript errors
- Ensure WooCommerce is active

### Color Picker Not Working

- You're using the WordPress color picker
- Click on the color input field to open the picker
- You can also paste hex color codes directly

## Advanced: Custom Font Integration

To add more fonts, you can filter the font list:

```php
add_filter('mcd_available_fonts', function($fonts) {
    $fonts[] = 'Your Custom Font';
    return $fonts;
});
```

Or add Google Fonts support by adding to your theme's `functions.php`:

```php
@import url('https://fonts.googleapis.com/css2?family=Your+Font:wght@300;400;600&display=swap');
```

Then add the font name to the admin settings options.

## Version History

**v1.0.0** - Initial release with Elementor and font customization support
