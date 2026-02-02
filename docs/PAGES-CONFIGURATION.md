# Pages Configuration Checker

This file helps you identify which pages have been assigned to the Marble Collection plugin.

## How to Check Configured Pages

### Method 1: WordPress Admin Dashboard

1. Go to **Settings → Marble Collections**
2. Check the following sections:

#### General Settings
- **All Collections Page** - Page ID shown here is your main collection page

#### Gallery Pages
- **Quartz Gallery Page** - Page ID for Quartz products
- **Marble Gallery Page** - Page ID for Marble products
- **Granite Gallery Page** - Page ID for Granite products
- **European Gallery Page** - Page ID for European products
- **Onyx Gallery Page** - Page ID for Onyx products
- **Sink Gallery Page** - Page ID for Sink products

### Method 2: Database Query

Run this in your WordPress database:

```sql
SELECT option_name, option_value FROM wp_options 
WHERE option_name IN (
    'mcd_collection_page',
    'mcd_quartz_page',
    'mcd_marble_page',
    'mcd_granite_page',
    'mcd_european_page',
    'mcd_onyx_page',
    'mcd_sink_page'
)
ORDER BY option_name;
```

Results:
- Values are **Page IDs** (numbers)
- Empty values mean no page is assigned
- Match IDs to page titles in **Pages → All Pages**

### Method 3: WordPress WP-CLI Command

If you have WP-CLI installed, run:

```bash
wp option get mcd_collection_page
wp option get mcd_quartz_page
wp option get mcd_marble_page
wp option get mcd_granite_page
wp option get mcd_european_page
wp option get mcd_onyx_page
wp option get mcd_sink_page
```

## Understanding Page IDs

When you see a number in the plugin settings (e.g., "42"), it's a **Page ID**.

To find which page has that ID:
1. Go to **Pages → All Pages**
2. Hover over a page title
3. Check the bottom URL bar - it shows `post=42`
4. Or use: **Inspect Element** on page titles in the admin

## Pages the Plugin Uses

The plugin doesn't CREATE pages - you must create them manually. It only LINKS to existing pages.

### Pages You Need to Create:

| Purpose | How to Create | Settings Name |
|---------|---------------|---------------|
| Show all products | Pages → Add New | mcd_collection_page |
| Quartz products only | Pages → Add New | mcd_quartz_page |
| Marble products only | Pages → Add New | mcd_marble_page |
| Granite products only | Pages → Add New | mcd_granite_page |
| European products only | Pages → Add New | mcd_european_page |
| Onyx products only | Pages → Add New | mcd_onyx_page |
| Sink products only | Pages → Add New | mcd_sink_page |

## Current Plugin Configuration

To check what's currently configured:

### Step 1: Access Plugin Settings
- WordPress Dashboard → Settings → Marble Collections

### Step 2: Look for Assigned Pages
- **All Collections Page**: [Select a page or number shown]
- **Quartz Gallery Page**: [Select a page or number shown]
- **Marble Gallery Page**: [Select a page or number shown]
- **Granite Gallery Page**: [Select a page or number shown]
- **European Gallery Page**: [Select a page or number shown]
- **Onyx Gallery Page**: [Select a page or number shown]
- **Sink Gallery Page**: [Select a page or number shown]

### Step 3: View Those Pages
- If a page is assigned, go to **Pages → All Pages**
- Find the page with matching content
- Click "View" to see the collection display in action

## Quick Setup Verification

Use this checklist to verify your setup:

```
☐ At least 1 page assigned to "All Collections Page"
☐ Page created in WordPress Pages
☐ Product categories exist (quartz, marble, granite, european, onyx, sink)
☐ Products assigned to categories
☐ Page displays collection when viewed
☐ Filters work on the page
☐ (Optional) Gallery pages assigned for each category
```

## Troubleshooting

### No pages show in the dropdown
- Create pages first: Pages → Add New → Publish
- Then the dropdown will show them

### Page assigned but doesn't show collection
- Check if page template is set correctly
- Verify plugin is activated
- Clear any cache plugins
- Check browser console for JavaScript errors

### Wrong products showing on gallery page
- Verify product categories are correct
- Check category slug matches plugin settings (must be lowercase)
- Assign products to correct category
- Clear cache and reload

## Finding Your Page URLs

Once pages are assigned, their URLs will be:

Example (if page ID is 42):
- `yoursite.com/?page_id=42`
- Or `yoursite.com/your-page-name/` (if using pretty permalinks)

To find the actual URLs:
1. Go to **Pages → All Pages**
2. Click "View" on the assigned page
3. Check the URL in the address bar
