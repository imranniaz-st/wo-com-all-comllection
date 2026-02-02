# Plugin Pages Status Report

## About This Report

This guide helps you check which pages are currently assigned to the Marble Collection plugin and verify your setup.

## Quick Status Check

### For WordPress Admins:

**Location:** Settings → Marble Collections

You'll see:

```
GENERAL SETTINGS
├── All Collections Page: [Dropdown showing page name or blank]

GALLERY PAGES
├── Quartz Gallery Page: [Dropdown showing page name or blank]
├── Marble Gallery Page: [Dropdown showing page name or blank]
├── Granite Gallery Page: [Dropdown showing page name or blank]
├── European Gallery Page: [Dropdown showing page name or blank]
├── Onyx Gallery Page: [Dropdown showing page name or blank]
└── Sink Gallery Page: [Dropdown showing page name or blank]
```

## What Each Setting Means

| Setting | Purpose | Required? |
|---------|---------|-----------|
| All Collections Page | Displays ALL products from all categories | No, but recommended |
| Quartz Gallery Page | Displays ONLY Quartz category products | No, only if you want dedicated gallery |
| Marble Gallery Page | Displays ONLY Marble category products | No, only if you want dedicated gallery |
| Granite Gallery Page | Displays ONLY Granite category products | No, only if you want dedicated gallery |
| European Gallery Page | Displays ONLY European category products | No, only if you want dedicated gallery |
| Onyx Gallery Page | Displays ONLY Onyx category products | No, only if you want dedicated gallery |
| Sink Gallery Page | Displays ONLY Sink category products | No, only if you want dedicated gallery |

## Configuration Scenarios

### Scenario 1: Only Master Collection
```
All Collections Page: ✅ Set (e.g., "Products")
Gallery Pages: ⭕ Empty
```
**Result:** Shows all products on one page

### Scenario 2: Master + Individual Galleries
```
All Collections Page: ✅ Set (e.g., "Products")
Quartz Gallery Page: ✅ Set (e.g., "Quartz Collection")
Marble Gallery Page: ✅ Set (e.g., "Marble Collection")
Granite Gallery Page: ✅ Set (e.g., "Granite Collection")
...more galleries as needed
```
**Result:** Multiple pages, each showing different product categories

### Scenario 3: Gallery Pages Only (No Master)
```
All Collections Page: ⭕ Empty
Quartz Gallery Page: ✅ Set (e.g., "Quartz Collection")
Marble Gallery Page: ✅ Set (e.g., "Marble Collection")
...
```
**Result:** Only category-specific galleries, no master page

## How to Find Your Page IDs

If you see a number instead of a page name (e.g., "42"), that's the **Page ID**.

To match it to a page:
1. Go to **Pages → All Pages**
2. Hover over page titles - URL shows `?post=XXX`
3. Or use browser Inspector (F12) to see page elements

## Pages Currently Using the Plugin

After configuration, check which pages display the collection:

### Step 1: Find Your Page URLs
- **Pages → All Pages**
- Look for pages that match your settings
- Click "View" to see the collection

### Step 2: Check the Content
The page should display:
- ✅ Product grid
- ✅ Filters (if enabled)
- ✅ Search box (if enabled)
- ✅ Sorting options (if enabled)
- ✅ Product titles, descriptions, colors

### Step 3: Test Functionality
- Filter by category or color
- Search for a product
- Change sort order
- View on mobile to test responsive design

## Database View

If you prefer to check directly via database:

### WordPress Database Structure:
```
Table: wp_options
Rows containing plugin settings:

option_name: mcd_collection_page
  option_value: [Page ID or empty]

option_name: mcd_quartz_page
  option_value: [Page ID or empty]

option_name: mcd_marble_page
  option_value: [Page ID or empty]

... and so on for each gallery type
```

### Find Page Names by ID:
```
Table: wp_posts
WHERE ID = [Page ID from above]
  post_type = 'page'
  post_title = [Your page name]
```

## Complete Setup Checklist

After configuration, verify everything:

```
PAGES CREATED:
☐ Created at least 1 page in Pages → Add New
☐ Page published
☐ Page title is descriptive (e.g., "Quartz Gallery")

PLUGIN CONFIGURED:
☐ Opened Settings → Marble Collections
☐ Selected page(s) in dropdowns
☐ Clicked "Save Changes"

CATEGORIES CREATED:
☐ Created product categories: quartz, marble, granite, european, onyx, sink
☐ Category slugs are lowercase

PRODUCTS ASSIGNED:
☐ At least some products assigned to categories
☐ Products have images

VERIFICATION:
☐ Visit configured page URL
☐ See product grid displayed
☐ Filters work
☐ Responsive on mobile
```

## Viewing Your Pages

### If All Collections Page is set to ID 42:
- Direct URL: `yoursite.com/?page_id=42`
- Pretty URL: `yoursite.com/all-products/` (depends on page slug)

### If Quartz Gallery is set to ID 43:
- Direct URL: `yoursite.com/?page_id=43`
- Pretty URL: `yoursite.com/quartz-gallery/`

### Finding the Exact URL:
1. **Pages → All Pages**
2. Find your page
3. Click "View" - this shows the actual URL
4. Bookmark or share that URL

## What If Nothing Shows?

### Check 1: Is the page assigned?
- Settings → Marble Collections
- Verify page is selected in dropdown
- Save Changes

### Check 2: Does the page exist?
- Pages → All Pages
- Search for the page name
- Should show in list

### Check 3: Are there products?
- Products → All Products
- Verify at least 1 product exists
- Verify product has a category

### Check 4: Are categories set?
- Products → Categories
- Verify categories exist
- Check category slugs (must be lowercase)

### Check 5: Are products in categories?
- Edit a product
- Check "Product Categories" box
- Verify category is checked
- Update product

## Advanced: Multiple Sites on Same Installation

If you have multiple product collections:

```
Collection A:
├── All Products: Set to page "Shop"
├── Quartz: Set to page "Quartz"
└── Marble: Set to page "Marble"

Collection B (Same plugin, different settings):
├── All Products: Set to page "All Stone"
├── Granite: Set to page "Granite"
└── Sink: Set to page "Sinks"
```

The plugin uses WordPress options, so each site gets its own settings.

## Support Information

### Plugin Files Involved:
- `/marble-collection-display.php` - Main plugin
- `/includes/admin-settings.php` - Settings page
- `/templates/page-collection.php` - Page template

### Settings Stored In:
- WordPress database table: `wp_options`
- Option names: `mcd_*` (all plugin settings start with this prefix)

### Related Taxonomies:
- Product Categories: `product_cat` taxonomy
- Product Color: `pa_color` attribute

## Final Verification

To confirm everything is working:

1. **Admin Check:** Settings → Marble Collections shows assigned pages ✅
2. **Page Check:** Pages → All Pages shows your pages exist ✅
3. **Category Check:** Products → Categories shows required categories ✅
4. **Product Check:** Products → All Products shows products with categories ✅
5. **Frontend Check:** Visit page URL and see collection displayed ✅
6. **Functionality Check:** Filters, search, and sorting work ✅

If all checks pass, your setup is complete! 🎉
