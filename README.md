# Marble Collection Display

A professional WordPress/WooCommerce plugin for displaying beautiful marble and stone product collections with advanced filtering, responsive design, and Elementor support.

![Version](https://img.shields.io/badge/version-1.0.0-blue)
![License](https://img.shields.io/badge/license-GPL--2.0+-green)
![WordPress](https://img.shields.io/badge/WordPress-5.8+-blue)
![WooCommerce](https://img.shields.io/badge/WooCommerce-5.0+-green)
![PHP](https://img.shields.io/badge/PHP-7.4+-purple)

## 🎯 Features

### Core Functionality
- ✨ **Responsive Grid Layout** - Desktop (3-5 cols), Tablet (1-4 cols), Mobile (1-2 cols)
- 🎨 **Advanced Filtering** - Filter by category and color with real-time AJAX updates
- 🔍 **Product Search** - Built-in search functionality with AJAX
- 📊 **Smart Sorting** - Default, Popularity, Latest, Name sorting
- 🖼️ **Color Swatches** - Display product color variations with WooCommerce integration
- ⚡ **Quick View** - Quick view button for fast product preview

### Gallery Pages
- 📄 **Master Collection Page** - Display all products from all categories
- 🏔️ **Quartz Gallery** - Dedicated page for Quartz products
- 🪨 **Marble Gallery** - Dedicated page for Marble products
- 🗻 **Granite Gallery** - Dedicated page for Granite products
- 🌍 **European Gallery** - Dedicated page for European products
- ⚫ **Onyx Gallery** - Dedicated page for Onyx products
- 🚰 **Sink Gallery** - Dedicated page for Sink products

### Customization
- 🎨 **Font Customization** - 11 font settings (title, description, filters)
- 🎯 **Typography Controls** - Font family, size, weight, and color
- 📱 **Mobile-Specific Settings** - Different column layouts for mobile/tablet
- 🧪 **Elementor Integration** - Full Elementor support with custom widget
- 🎛️ **Admin Settings Panel** - Intuitive settings interface

## 📋 Requirements

- WordPress 5.8 or higher
- WooCommerce 5.0 or higher
- PHP 7.4 or higher
- Modern browser with JavaScript enabled

**Optional:**
- Elementor 3.0+ for page builder integration

## 🚀 Installation

### Method 1: WordPress Admin Dashboard
1. Go to **Plugins → Add New**
2. Click **Upload Plugin**
3. Choose plugin ZIP file
4. Click **Install Now** → **Activate**

### Method 2: Manual Installation
1. Extract plugin files
2. Upload to `/wp-content/plugins/`
3. Go to **Plugins** and activate plugin

### Method 3: Via Git
```bash
cd wp-content/plugins/
git clone https://github.com/ADC212006/wo-com-all-comllection.git
```

## ⚙️ Quick Setup

### 1. Create Product Categories
- Go to **Products → Categories**
- Create: Quartz, Marble, Granite, European, Onyx, Sink
- **Note:** Slugs must be lowercase

### 2. Create Pages
- Go to **Pages → Add New**
- Create pages for galleries you want
- Publish pages

### 3. Configure Plugin
- Go to **Settings → Marble Collections**
- Select pages for each gallery type
- Click **Save Changes**

### 4. Assign Products
- Edit WooCommerce products
- Assign to categories
- Update products

### 5. Done! ✅
- Visit pages to see collections

## 📖 Documentation

- [QUICK_START.md](./QUICK_START.md) - 5-minute setup
- [INSTALLATION.md](./INSTALLATION.md) - Detailed installation
- [ADMIN_GUIDE.md](./ADMIN_GUIDE.md) - Admin panel walkthrough
- [GALLERY-SETUP-GUIDE.md](./GALLERY-SETUP-GUIDE.md) - Multi-gallery setup
- [ELEMENTOR_FONTS_GUIDE.md](./ELEMENTOR_FONTS_GUIDE.md) - Elementor integration
- [PAGES-STATUS.md](./PAGES-STATUS.md) - Check configured pages
- [TROUBLESHOOTING.md](./TROUBLESHOOTING.md) - Common issues & solutions

## 🎯 Usage

### Shortcode
```
[marble_collection]
[marble_collection columns="4" category="quartz" per_page="32"]
[marble_collection show_title="true" show_description="true" show_quick_view="true"]
```

### Elementor Widget
1. Edit page with Elementor
2. Search for "Marble Collection"
3. Add widget
4. Configure settings
5. Publish

### Admin Settings
**Settings → Marble Collections**

Sections:
- General Settings
- Gallery Pages (6 categories)
- Layout Settings
- Display Settings
- Font Customization
- Color Swatch Settings

## 🎨 Customization

### Font Customization
Customize via admin panel (no coding):
- Product Title (font, size, weight, color)
- Product Description (font, size, weight, color)
- Filter Labels (font, size, color)

### CSS Override
```css
.marble-collection-wrapper { }
.mcd-products-grid { }
.mcd-product-card { }
.mcd-color-swatches { }
```

## 📱 Responsive Design

| Device | Width | Columns |
|--------|-------|---------|
| Desktop | ≥981px | 2-5 (configurable) |
| Tablet | 768-980px | 1-4 (configurable) |
| Mobile | <768px | 1-2 (configurable) |

## 🔧 Developer Info

### Hooks & Filters
```php
do_action('mcd_before_collection');
do_action('mcd_after_collection');
apply_filters('mcd_product_query_args', $args);
apply_filters('mcd_product_html', $html, $product);
```

### File Structure
```
plugin/
├── marble-collection-display.php
├── includes/
│   ├── admin-settings.php
│   └── elementor-support.php
├── templates/
│   ├── page-collection.php
│   ├── collection-display.php
│   └── product-item.php
├── assets/
│   ├── css/marble-collection.css
│   ├── js/marble-collection.js
│   └── js/color-picker-init.js
└── docs/
```

## 🐛 Troubleshooting

**Collection not showing?**
- Verify page assigned in settings
- Check products exist
- Verify categories assigned
- Clear cache

**Filters not working?**
- Check AJAX enabled
- Verify categories exist
- Clear cache

**Elementor widget missing?**
- Install Elementor
- Refresh page
- Clear cache

See [TROUBLESHOOTING.md](./TROUBLESHOOTING.md) for more.

## 📄 License

GPL v2 or later. See LICENSE file.

## 🤝 Contributing

1. Fork repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Open Pull Request

## 📞 Support

- Check [TROUBLESHOOTING.md](./TROUBLESHOOTING.md)
- Review documentation
- Open GitHub issue

## ⭐ Credits

Created for SuperStone - Professional Marble & Stone Collections

---

**Made with ❤️ for marble and stone product showcase**

If helpful, please ⭐ star this repository!
