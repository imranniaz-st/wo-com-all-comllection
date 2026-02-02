# 🚀 AUTO PAGE CREATOR - USER GUIDE

## What's New?

Your WordPress plugin now includes an **Automatic Page Creator** that:

✅ Creates 11 pages automatically with one click  
✅ Adds all necessary shortcodes to each page  
✅ Shows shortcode labels so you know what's being used  
✅ Links pages to plugin settings automatically  
✅ Works with Elementor (widgets appear automatically)  
✅ Includes professional content and SEO metadata  

---

## 🎯 Quick Start (60 Seconds)

### Step 1: Create All Pages
1. Login to WordPress admin
2. Go to **Marble Collections → Settings**
3. Find the **"🚀 Quick Setup - Auto Create Pages"** section at the top
4. Click **"Create All Pages Automatically"** button
5. Wait 5-10 seconds for pages to be created
6. You'll see a success message ✅

### Step 2: View Your New Pages
Go to **Pages → All Pages** and you'll see:

| Page Name | What It Shows | Shortcodes Used |
|-----------|---------------|-----------------|
| **GTA Marble - Home** | Full homepage layout | Hero, Kitchen, Collection Bar, Gallery, Business Info, Contact |
| **Kitchen Countertops** | Kitchen specialty page | Kitchen Priority, Gallery (kitchen category), CTA Buttons, Contact |
| **Superstone Quartz Collection** | Superstone gallery | Collection Bar, Gallery (superstone-quartz), CTA Buttons |
| **Goodstone Quartz Collection** | Goodstone gallery | Collection Bar, Gallery (goodstone-quartz), CTA Buttons |
| **Kstone Quartz Collection** | Kstone gallery | Collection Bar, Gallery (kstone-quartz), CTA Buttons |
| **Lucent Quartz Collection** | Lucent gallery | Collection Bar, Gallery (lucent-quartz), CTA Buttons |
| **Fortezza Quartz** | Fortezza gallery | Collection Bar, Gallery (fortezza-quartz), CTA Buttons |
| **Natural Stone Collection** | Natural stone gallery | Collection Bar, Gallery (natural-stone), Contact |
| **All Collections** | Complete catalog | Collection Bar, Gallery (all products), Business Info |
| **About GTA Marble** | Company information | Business Info, Locations, Contact |
| **Contact Us** | Contact page | Contact Info, Locations, CTA Buttons |

---

## 📱 What You'll See on Each Page

### Example: Kitchen Countertops Page

When you view the page, you'll see:

```
# Professional Kitchen Countertops
Premium European Quartz | Professional Installation | In Stock

Shortcode Used: [mcd_kitchen_priority]

[Kitchen Priority Section Displays Here]

## Browse Kitchen Countertop Samples

Shortcode Used: [marble_collection_display category="kitchen"]

[Product Gallery Displays Here]

## Request a Quote

Shortcode Used: [mcd_cta_buttons layout="horizontal"]

[CTA Buttons Display Here]

## Contact Us

Shortcode Used: [mcd_contact_info]

[Contact Information Displays Here]
```

**The shortcode labels help you:**
- ✅ Know exactly what's being used
- ✅ Copy shortcodes to other pages easily
- ✅ Understand the page structure
- ✅ Customize content confidently

---

## 🎨 Using Elementor (If Installed)

If you have Elementor installed, you get **8 custom GTA Marble widgets** automatically!

### Finding Widgets in Elementor:

1. Edit any page with Elementor
2. Look in the left sidebar
3. Find the **"GTA Marble"** category
4. Drag widgets onto your page

### Available Widgets:

| Widget Name | What It Does | Shortcode Equivalent |
|-------------|--------------|---------------------|
| **Hero Section** | Full-width hero banner | `[mcd_hero_section]` |
| **Kitchen Priority Section** | Kitchen countertops feature | `[mcd_kitchen_priority]` |
| **Sticky Collection Navigation** | Always-visible collection menu | `[mcd_sticky_collection_bar]` |
| **Contact Information** | Phone, email, address | `[mcd_contact_info]` |
| **Business Information** | About section with features | `[mcd_business_info]` |
| **Call-to-Action Buttons** | Primary/secondary buttons | `[mcd_cta_buttons]` |
| **Business Locations** | Multi-location display | `[mcd_locations]` |
| **Product Collection Gallery** | Product grid with filters | `[marble_collection_display]` |

### Widget Benefits:

✅ **Visual editing** - See changes in real-time  
✅ **Customizable options** - Each widget has settings  
✅ **Shows shortcode** - Reference displayed below widget  
✅ **Drag & drop** - Easy layout building  
✅ **Responsive preview** - Test mobile/tablet views  

---

## ⚙️ Customizing Auto-Created Pages

### Option 1: Edit Content Directly
1. Go to **Pages → All Pages**
2. Click **Edit** on any page
3. Modify text, headings, or add content
4. Keep shortcodes in place (they display features)
5. Click **Update**

### Option 2: Use Elementor
1. Go to **Pages → All Pages**
2. Click **Edit with Elementor**
3. Replace blocks with GTA Marble widgets
4. Customize colors, spacing, fonts
5. Click **Publish**

### Option 3: Change Shortcodes
Each page shows the shortcode being used. You can:

**Copy the shortcode:**
```
[mcd_kitchen_priority]
```

**Paste it anywhere:**
- Other pages
- Blog posts
- Sidebars
- Footer

**Modify attributes:**
```
[marble_collection_display category="superstone-quartz" columns="4" limit="12"]
[mcd_cta_buttons layout="vertical"]
```

---

## 🔗 Page Links Auto-Configuration

After creating pages, they're **automatically linked** in your plugin settings:

| Setting Name | Linked Page |
|--------------|-------------|
| Kitchen Priority Page | Kitchen Countertops |
| Superstone Collection Page | Superstone Quartz Collection |
| Goodstone Collection Page | Goodstone Quartz Collection |
| Kstone Collection Page | Kstone Quartz Collection |
| Lucent Collection Page | Lucent Quartz Collection |
| Fortezza Collection Page | Fortezza Quartz |
| Natural Stone Collection Page | Natural Stone Collection |
| All Collections Page | All Collections |

**This means:**
- Sticky collection bar navigation works immediately
- "See All Collections" links to the right page
- Kitchen priority links to kitchen page
- No manual configuration needed!

---

## 🎓 What Happens Behind the Scenes

### Page Creation Process:

1. **Checks for existing pages** - Won't overwrite existing content
2. **Creates 11 pages** with professional content
3. **Adds shortcodes** to display features
4. **Shows shortcode labels** for reference
5. **Sets page templates** (Elementor-compatible)
6. **Adds SEO metadata** (Yoast-compatible)
7. **Links pages to settings** automatically
8. **Enables Elementor** support if installed

### Security Features:

✅ **Nonce verification** - Prevents unauthorized access  
✅ **Permission checks** - Only admins can create pages  
✅ **Proper escaping** - All content sanitized  
✅ **No overwriting** - Existing pages are safe  

---

## 📋 All Available Shortcodes (Reference)

Copy and paste these anywhere on your site:

### Display Features:
```
[mcd_hero_section]
[mcd_kitchen_priority]
[mcd_sticky_collection_bar]
[mcd_contact_info]
[mcd_business_info]
[mcd_locations]
```

### Call-to-Action:
```
[mcd_cta_buttons]
[mcd_cta_buttons layout="horizontal"]
[mcd_cta_buttons layout="vertical"]
```

### Product Gallery:
```
[marble_collection_display]
[marble_collection_display category="kitchen"]
[marble_collection_display category="superstone-quartz"]
[marble_collection_display category="goodstone-quartz"]
[marble_collection_display category="kstone-quartz"]
[marble_collection_display category="lucent-quartz"]
[marble_collection_display category="fortezza-quartz"]
[marble_collection_display category="natural-stone"]
[marble_collection_display columns="4" limit="12"]
```

---

## 🔧 Troubleshooting

### Problem: Button doesn't appear

**Solution:**  
Make sure you're on the **Marble Collections → Settings** page. The button is at the very top under "🚀 Quick Setup - Auto Create Pages".

---

### Problem: Pages already exist message

**Solution:**  
The plugin detected pages with matching slugs. Options:
1. Delete old pages first, then create again
2. Keep existing pages and ignore message
3. Edit existing pages manually to add shortcodes

---

### Problem: Shortcodes show as text

**Solutions:**
1. Make sure plugin is activated
2. Check **Marble Collections → Settings** and save settings
3. Clear browser cache
4. Check if WooCommerce is active

---

### Problem: Elementor widgets not showing

**Solutions:**
1. Make sure Elementor is installed and activated
2. Update Elementor to latest version
3. Go to Elementor → Tools → Regenerate CSS
4. Check if "GTA Marble" category appears in widget panel

---

### Problem: Pages created but empty

**Solution:**  
1. Go to **Marble Collections → Settings**
2. Fill in Business Information (name, phones, email, address)
3. Visit pages again - content will appear

---

## 🎯 Next Steps After Page Creation

### 1. Configure Settings (5 minutes)
Go to **Marble Collections → Settings** and fill in:
- Business Name: **GTA Marble**
- Primary Phone: **+1 (647) 291-2686**
- Secondary Phone: **+1 (647) 619-9753**
- Email: **info@gtamarble.com**
- Address: **44 Goodmark Place, Etobicoke**
- Business Hours: **Mon-Fri: 9:00 AM - 6:00 PM**
- Service Area: **GTA + 500km Ontario**

### 2. Upload Products (30 minutes)
1. Go to **Products → Add New**
2. Create products for each collection
3. Assign categories: `superstone-quartz`, `goodstone-quartz`, `kstone-quartz`, `lucent-quartz`, `fortezza-quartz`, `natural-stone`, `kitchen`
4. Add high-quality images
5. Write descriptions

### 3. Set Homepage (1 minute)
1. Go to **Settings → Reading**
2. Select **"A static page"**
3. Choose **"GTA Marble - Home"**
4. Click **Save Changes**

### 4. Customize Design (Optional)
1. Edit pages with Elementor
2. Change colors in plugin settings
3. Add custom CSS if needed
4. Adjust fonts in theme settings

### 5. Test Everything (10 minutes)
- Click all navigation links
- Test contact buttons
- View pages on mobile
- Check product gallery filters
- Test "Call Now" buttons

### 6. Launch! 🚀
Your website is ready with:
- 11 professional pages
- All features functional
- Contact information displayed
- Product galleries working
- SEO optimized
- Mobile responsive

---

## 💡 Pro Tips

### Tip 1: Shortcode Reference
Keep this shortcode reference handy - all pages show which shortcode they use, making it easy to replicate layouts.

### Tip 2: Backup Before Editing
If using Elementor, consider backing up auto-created content before major changes. You can always recreate pages with one click.

### Tip 3: Test with Real Products
Upload 3-5 real products in each category to see how galleries look with actual content.

### Tip 4: SEO Optimization
Auto-created pages include SEO metadata. Install **Yoast SEO** plugin to enhance with focus keywords, meta descriptions, and sitemap.

### Tip 5: Mobile First
Test all pages on mobile devices first - most customers browse on phones. The sticky collection bar works great on mobile!

---

## 📞 Support

If you need help:

1. Check **QUICK-START-GUIDE.md** for basic usage
2. Check **PLUGIN-IMPLEMENTATION-GUIDE.md** for detailed reference
3. Review **IMPLEMENTATION-COMPLETE.md** for feature list
4. Contact your developer for custom modifications

---

## ✅ Summary

**With one click, you now have:**

✅ 11 professional pages with content  
✅ All shortcodes pre-configured  
✅ Shortcode labels for easy reference  
✅ Elementor widgets (if installed)  
✅ Automatic page linking  
✅ SEO metadata included  
✅ Mobile-responsive layouts  
✅ Professional GTA Marble branding  

**No coding needed. Just click and go!** 🚀
