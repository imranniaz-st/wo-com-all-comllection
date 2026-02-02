# Gallery Setup Guide - GTA Marble

**Purpose:** Complete guide to setting up product collection galleries for GTA Marble website  
**Business Context:** Quartz supplier & stone fabricator (21+ years, GTA)  
**Based on:** Requirements from Adnan (Business Owner)

This guide explains how to set up separate gallery pages for different product categories specific to GTA Marble's product offerings.

## GTA Marble Product Collections (PRIMARY)

**⭐ PRIMARY FOCUS: QUARTZ COLLECTIONS**

### Main Collections (IN STOCK)
1. **Superstone Quartz Gallery** ← PRIORITY #1
2. **Goodstone Quartz Gallery** ← PRIORITY #2
3. **Kstone Quartz Gallery** ← PRIORITY #3
4. **Lucent Quartz Gallery** ← PRIORITY #4

### Secondary Collections
5. **Fortezza Quartz Gallery** (Custom Orders)
6. **Natural Stone Gallery** (Marble, Granite, Porcelain)

### Service-Based Pages (NOT galleries, but important)
- Kitchen Countertops Showcase
- Bathroom Vanities
- Backsplash & Features
- Commercial Projects

## Setup Steps for GTA Marble

### PHASE 1: Create Product Categories in WooCommerce

**Step 1: Create Quartz Collection Categories**

Go to **Products → Categories** and create these categories:

#### Quartz Collections (Primary)
```
Category Name: Superstone Quartz
Slug: superstone-quartz
Description: Premium European Quartz - 50+ Colors In Stock

Category Name: Goodstone Quartz
Slug: goodstone-quartz
Description: Quality European Quartz - 40+ Colors In Stock

Category Name: Kstone Quartz
Slug: kstone-quartz
Description: Reliable European Quartz - 35+ Colors In Stock

Category Name: Lucent Quartz
Slug: lucent-quartz
Description: Luminous European Quartz - 45+ Colors In Stock
```

#### Special Collections
```
Category Name: Fortezza Quartz
Slug: fortezza-quartz
Description: Premium Custom Quartz - 100+ Colors (Custom Orders)

Category Name: Natural Stone
Slug: natural-stone
Description: Marble, Granite, Porcelain & All Natural Stone
```

#### Service Categories (Optional - for content organization)
```
Category Name: Kitchen Countertops
Slug: kitchen-countertops

Category Name: Bathroom Vanities
Slug: bathroom-vanities

Category Name: Commercial Projects
Slug: commercial-projects
```

**Important Notes:**
- Slug must be lowercase and match exactly
- Use hyphens for multiple words (not underscores)
- Description should match marketing copy

### PHASE 2: Create Gallery Pages

**Step 1: Create Main Pages for Each Quartz Collection**

Go to **Pages → Add New** and create these pages:

1. **Page Title:** "Superstone Quartz Collection"
   - **Slug:** superstone-quartz-collection
   - **Content:** Add introductory text or leave empty
   - **Status:** Publish

2. **Page Title:** "Goodstone Quartz Collection"
   - **Slug:** goodstone-quartz-collection
   - **Content:** Add introductory text or leave empty
   - **Status:** Publish

3. **Page Title:** "Kstone Quartz Collection"
   - **Slug:** kstone-quartz-collection
   - **Content:** Add introductory text or leave empty
   - **Status:** Publish

4. **Page Title:** "Lucent Quartz Collection"
   - **Slug:** lucent-quartz-collection
   - **Content:** Add introductory text or leave empty
   - **Status:** Publish

5. **Page Title:** "All Quartz Collections" (Master Page)
   - **Slug:** all-quartz-collections
   - **Content:** "Browse all our premium European Quartz collections in stock"
   - **Status:** Publish

**Optional Service Pages:**
- Kitchen Countertops Gallery
- Bathroom Vanities Gallery
- Commercial Projects Gallery
- Natural Stone Selection

### PHASE 3: Assign Products to Categories

**Step 1: Upload Product Images & Colors**

1. Go to **Products → Add New**
2. Create product for each color/slab:
   - **Product Name:** "Superstone Glacier White"
   - **Description:** Color details, features
   - **Product Image:** High-quality slab photo
   - **Gallery Images:** Color swatches, installation examples
   - **Attributes:** Color, pattern, finish

**Step 2: Assign to Category**

1. In Product Editor, find **Product Categories** box
2. Check the quartz collection (e.g., "Superstone Quartz")
3. Also check any additional categories as needed
4. Save/Update Product

**Example Product Setup:**
```
Product: Superstone Glacier White
Categories: 
  ✓ Superstone Quartz
  ✓ Premium Quality
  
Attributes:
  - Color: White
  - Pattern: Speckled
  - Primary Tone: Whites/Creams
  
Images:
  - Full slab photo (1920x1440px)
  - Color swatch (300x300px)
  - Installation example (1600x1200px)
```

### PHASE 4: Configure Gallery Pages in Plugin Settings

**Go to: Settings → Marble Collections → Gallery Pages**

Configure as follows:

```
Quartz Gallery Page Selection:
- Quartz Gallery Page: [SELECT] "All Quartz Collections"

Additional Gallery Pages (Use Elementor Widget Instead):
- For Superstone: Use Elementor with [marble_collection category="superstone-quartz"]
- For Goodstone: Use Elementor with [marble_collection category="goodstone-quartz"]
- For Kstone: Use Elementor with [marble_collection category="kstone-quartz"]
- For Lucent: Use Elementor with [marble_collection category="lucent-quartz"]
```

**Alternative: Use Shortcode on Each Page**

If not using Elementor, add shortcode to page content:

Page: "Superstone Quartz Collection"
```
[marble_collection category="superstone-quartz" columns="4" per_page="20"]
```

Page: "Goodstone Quartz Collection"
```
[marble_collection category="goodstone-quartz" columns="4" per_page="20"]
```

Page: "Kstone Quartz Collection"
```
[marble_collection category="kstone-quartz" columns="4" per_page="20"]
```

Page: "Lucent Quartz Collection"
```
[marble_collection category="lucent-quartz" columns="4" per_page="20"]
```

Page: "All Quartz Collections" (Master)
```
[marble_collection columns="4" per_page="32"]
```

Click **Save Changes** in plugin settings after configuration

## How It Works - GTA Marble Context

### Collection Display Flow

```
Homepage
  ↓
Quartz Collections Bar (Sticky)
  ├─→ Superstone Quartz Collection Page
  │   └─ Shows: Superstone products (50+ colors)
  ├─→ Goodstone Quartz Collection Page
  │   └─ Shows: Goodstone products (40+ colors)
  ├─→ Kstone Quartz Collection Page
  │   └─ Shows: Kstone products (35+ colors)
  ├─→ Lucent Quartz Collection Page
  │   └─ Shows: Lucent products (45+ colors)
  └─→ All Collections Master Page
      └─ Shows: All quartz + natural stone
```

### Key Features for GTA Marble

✅ **Kitchen Countertops First**
- Featured prominently on homepage
- Quick access to collection browser
- Professional showcase of in-stock samples

✅ **Multiple Collections**
- Each brand gets dedicated page
- Customers can browse by preference
- Easy to compare quality levels

✅ **Real-Time Filtering**
- Filter by color
- Filter by finish/pattern
- Sort by popularity or newest
- AJAX search without page reload

✅ **Professional Presentation**
- High-quality images
- Color swatches visible
- Installation examples
- Easy contact/quote buttons

### Gallery Settings for Adnan's Needs

**Recommended Configuration:**

| Setting | Value | Reason |
|---------|-------|--------|
| Columns (Desktop) | 4-5 | Show more samples at once |
| Columns (Tablet) | 2-3 | Optimize tablet viewing |
| Columns (Mobile) | 1-2 | Mobile-first design |
| Products Per Page | 20-32 | Show variety without overwhelming |
| Show Filters | Yes | Let customers filter by color |
| Show Search | Yes | Help find specific colors/names |
| Show Sorting | Yes | Popular items first |
| Show Titles | Yes | Color names important |
| Show Descriptions | Yes | Pattern/feature details |
| Show Quick View | Yes | Fast preview |
| Show Color Swatches | Yes | Essential for stone products |

## All Collections Master Page

Create a master page showing products from ALL categories:

**Page Setup:**
- **Title:** "All Collections" or "Browse All Stones"
- **Content:** Brief intro about inventory
- **Shortcode:** `[marble_collection columns="4" per_page="32"]`

This page shows:
- All quartz collections mixed
- Natural stone products
- Fortezza custom options
- Perfect for browsing everything

## Navigation Menu Structure for GTA Marble

Recommended menu hierarchy:

```
Main Menu
├── HOME
├── COLLECTIONS
│   ├── All Collections
│   ├── Superstone Quartz (50+ Colors)
│   ├── Goodstone Quartz (40+ Colors)
│   ├── Kstone Quartz (35+ Colors)
│   └── Lucent Quartz (45+ Colors)
├── SERVICES
│   ├── Kitchen Countertops
│   ├── Bathroom Vanities
│   ├── Backsplash & Features
│   └── Installation
├── IN STOCK INVENTORY
│   └── Browse Samples
└── CONTACT
    ├── Quote Request
    └── Visit Showroom
```

**Implementation:**
1. Go to **Appearance → Menus**
2. Create menu named "Main Navigation"
3. Add pages and links as shown
4. Set as "Primary Menu"
5. Display in header

## Troubleshooting - GTA Marble Specific

### Issue: Gallery page shows no products

**Solution:**
1. ✓ Verify products exist in WooCommerce (Products → All Products)
2. ✓ Check products are assigned to correct category
3. ✓ Verify category slug matches exactly
4. ✓ Clear browser cache and plugin cache
5. ✓ Check Site Health for PHP errors

**GTA Marble Check:**
- Did you upload products to "Superstone Quartz", "Goodstone Quartz", etc.?
- Are the category slugs exactly matching? (superstone-quartz not Superstone)
- Did you assign products to categories before creating gallery?

### Issue: Gallery shows all products instead of filtered

**Solution:**
1. Check plugin settings: **Settings → Marble Collections**
2. Verify correct page selected for each gallery
3. Check page has correct shortcode with category parameter
4. Clear all caching (browser + plugin cache)
5. Verify WooCommerce is active and categories created

**GTA Marble Check:**
- Is "All Collections Master Page" set, not individual collections?
- Did you save plugin settings after selecting pages?
- Are all quartz collection categories created?

### Issue: Images not showing on gallery

**Solution:**
1. Check product images uploaded (Products → Edit Product)
2. Verify images are optimized (<500KB each)
3. Check theme doesn't hide product images
4. Clear image cache
5. Test in different browser

**GTA Marble Check:**
- Are high-quality product photos uploaded (1920x1440px+)?
- Did you add swatch images and installation examples?
- Are images properly optimized for web?

### Issue: Collection bar not sticky/moving

**Solution:**
1. Check CSS is loading (inspect with browser dev tools)
2. Verify theme CSS doesn't conflict
3. Add custom CSS in plugin settings if needed
4. Check JavaScript console for errors

**GTA Marble Check:**
- Should stay at top while scrolling
- Must show: Superstone | Goodstone | Kstone | Lucent | See All

### Issue: Slow loading galleries

**Solution:**
1. Reduce "Products Per Page" (e.g., 12-16 instead of 50)
2. Optimize product images (use WebP format)
3. Enable caching plugin
4. Reduce columns on mobile to 1-2
5. Check database for slow queries (Site Health)

**GTA Marble Check:**
- Too many products per page?
- Are images optimized? (Should be <200KB for swatches)
- Is pagination enabled for large collections?

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

## Using with Elementor - GTA Marble

If you're using Elementor page builder (recommended for GTA Marble):

### Adding Collection Widget to Page

1. **Edit page with Elementor**
   - Go to page, click "Edit with Elementor"

2. **Add Marble Collection Widget**
   - Click "+" icon
   - Search for "Marble Collection"
   - Click to add widget

3. **Configure Widget Settings**
   - **Title:** "Superstone Quartz Collection" (optional)
   - **Category:** superstone-quartz
   - **Columns:** 4-5 (desktop)
   - **Products Per Page:** 20
   - **Show Filters:** Yes
   - **Show Search:** Yes

4. **Style Tab**
   - Font sizes (make titles prominent)
   - Colors (match GTA Marble branding)
   - Spacing/padding

5. **Publish Page**

### Example: Multiple Collections on One Page

You can add multiple Marble Collection widgets on a single page:

```
Page: "Quartz Collections Showroom"

[Header Section]
"Premium European Quartz In Stock"

[Widget 1: Superstone]
[marble_collection category="superstone-quartz"]

[Divider]

[Widget 2: Goodstone]
[marble_collection category="goodstone-quartz"]

[Divider]

[Widget 3: Kstone]
[marble_collection category="kstone-quartz"]

[Divider]

[Widget 4: Lucent]
[marble_collection category="lucent-quartz"]

[Footer: Contact/Quote CTA]
```

### Recommended Widget Settings for GTA Marble

| Setting | Value | Notes |
|---------|-------|-------|
| Show Filters | ✓ Yes | Customers filter by color |
| Show Search | ✓ Yes | Quick color lookup |
| Show Sorting | ✓ Yes | Popular items first |
| Show Titles | ✓ Yes | Color names important |
| Show Quick View | ✓ Yes | Hover to preview |
| Show Swatches | ✓ Yes | Essential for products |
| Columns Desktop | 4-5 | Show multiple samples |
| Columns Tablet | 2-3 | Readable layout |
| Columns Mobile | 1 | Touch-friendly |
| Per Page | 20-32 | Browse variety |

## Kitchen Countertops - Adnan's Priority

Since Adnan requested Kitchen Countertops on top for SEO:

### Setup Homepage Showcase

1. **Create Page:** "Kitchen Countertops Gallery"
   - Featured on homepage
   - Dedicated menu item
   - Top navigation priority

2. **Add Widget with Shortcode:**
   ```
   [marble_collection 
     category="superstone-quartz" 
     columns="5" 
     per_page="20"
     show_filters="true"
     show_search="true"
   ]
   ```

3. **Add Heading:** "Professional Kitchen Countertops"

4. **Add CTA Buttons:**
   - "View More Colors"
   - "Request Quote"
   - "Schedule Consultation"

### Homepage Hero Section Setup

```
[Hero Banner]
"PREMIUM KITCHEN COUNTERTOPS"
"European Quartz | 21+ Years Experience"
"1000s of Slabs In Stock"

[CTA Button] "Browse Collections" → Links to Kitchen Countertops page

[Sticky Collection Bar]
Superstone | Goodstone | Kstone | Lucent | See All

[Product Grid Preview]
Shows top 12-16 kitchen countertop samples
From all collections
```

## Adnan's Requirements Checklist

Based on project requirements from WhatsApp conversations:

✅ **Kitchen Countertops Priority**
- [ ] Create dedicated Kitchen Countertops gallery page
- [ ] Feature on homepage with prominent position
- [ ] Add to main navigation menu
- [ ] Include professional kitchen images
- [ ] Add quote/contact buttons

✅ **Quartz Collections Visible**
- [ ] Create sticky collection bar at top
- [ ] Links to: Superstone, Goodstone, Kstone, Lucent, See All
- [ ] Show moving with page scroll
- [ ] Professional styling

✅ **Professional Presentation**
- [ ] High-quality product images (1920x1440px+)
- [ ] Color swatches for each product
- [ ] Installation examples
- [ ] No placeholder/dummy content
- [ ] Professional typography

✅ **SEO Optimized**
- [ ] "Kitchen Countertops" prominent keywords
- [ ] Proper page titles and meta descriptions
- [ ] URL structure: /collections/quartz/ etc.
- [ ] Schema markup for products
- [ ] Mobile optimized

✅ **Easy Navigation**
- [ ] Collection browser on every page
- [ ] Quick access to galleries
- [ ] Filter and search working
- [ ] Mobile menu simplified
- [ ] Contact accessible
