# Gallery Setup Guide

This guide explains how to set up separate gallery pages for different product categories.

## Available Gallery Types

The plugin supports 6 separate gallery types:
1. **Quartz Gallery**
2. **Marble Gallery**
3. **Granite Gallery**
4. **European Gallery**
5. **Onyx Gallery**
6. **Sink Gallery**

## Setup Steps

### 1. Create WooCommerce Product Categories

First, make sure you have the following product categories created in WooCommerce:

- Go to **Products → Categories**
- Create these categories:
  - `quartz` (case-insensitive, can be "Quartz")
  - `marble` (case-insensitive, can be "Marble")
  - `granite` (case-insensitive, can be "Granite")
  - `european` (case-insensitive, can be "European")
  - `onyx` (case-insensitive, can be "Onyx")
  - `sink` (case-insensitive, can be "Sink")

**Important:** The category slug must match exactly (lowercase). For example, if you create a category called "Quartz", WordPress will automatically create the slug "quartz".

### 2. Create Gallery Pages

Create a separate page for each gallery you want:

1. Go to **Pages → Add New**
2. Create pages with names like:
   - "Quartz Gallery"
   - "Marble Gallery"
   - "Granite Gallery"
   - etc.
3. Leave the page content empty or add some introductory text
4. Publish each page

### 3. Configure Gallery Pages in Plugin Settings

1. Go to **Settings → Marble Collection**
2. Scroll to the **Gallery Pages** section
3. For each gallery type, select the page you created:
   - **Quartz Gallery Page** → Select "Quartz Gallery"
   - **Marble Gallery Page** → Select "Marble Gallery"
   - **Granite Gallery Page** → Select "Granite Gallery"
   - **European Gallery Page** → Select "European Gallery"
   - **Onyx Gallery Page** → Select "Onyx Gallery"
   - **Sink Gallery Page** → Select "Sink Gallery"
4. Click **Save Changes**

### 4. Assign Products to Categories

1. Go to **Products → All Products**
2. Edit each product
3. In the **Product Categories** box, assign the product to the appropriate category (Quartz, Marble, etc.)
4. Update the product

## How It Works

- Each gallery page will automatically display only products from its assigned category
- For example, the Quartz Gallery page will only show products assigned to the "Quartz" category
- The filters on each gallery page will work independently
- All the settings (columns, fonts, colors, etc.) apply to all gallery pages

## All Collections Page

You can still use the "All Collections Page" setting to create a page that shows products from ALL categories together. This is useful for having both:
- Individual category galleries (Quartz only, Marble only, etc.)
- One master page showing everything

## Category Slug Reference

The plugin uses these category slugs to filter products:

| Gallery Type | Category Slug Required |
|-------------|------------------------|
| Quartz      | `quartz`               |
| Marble      | `marble`               |
| Granite     | `granite`              |
| European    | `european`             |
| Onyx        | `onyx`                 |
| Sink        | `sink`                 |

## Troubleshooting

### Gallery page shows no products

1. Make sure you have products assigned to that category
2. Check that the category slug matches exactly (lowercase)
3. Verify the page is selected in plugin settings
4. Clear any caching plugins

### Gallery shows all products instead of filtered

1. Check that the page is properly selected in **Settings → Marble Collection → Gallery Pages**
2. Make sure the category exists in **Products → Categories**
3. Save the plugin settings again

## Example Menu Setup

You can create a navigation menu with links to all your galleries:

```
Shop
├── All Collections (linked to All Collections Page)
├── Quartz Gallery (linked to Quartz Gallery Page)
├── Marble Gallery (linked to Marble Gallery Page)
├── Granite Gallery (linked to Granite Gallery Page)
├── European Gallery (linked to European Gallery Page)
├── Onyx Gallery (linked to Onyx Gallery Page)
└── Sink Gallery (linked to Sink Gallery Page)
```

## Using with Elementor

If you're using Elementor:
1. You can still use the Marble Collection widget
2. Add the widget to any page
3. Use the `category` attribute in the shortcode to filter by category
4. Example: `[marble_collection category="quartz"]`

However, the dedicated gallery pages use the automatic category detection, so you don't need to add any shortcode or widget - just assign the page in plugin settings.
