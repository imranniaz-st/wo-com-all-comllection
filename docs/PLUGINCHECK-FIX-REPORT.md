# PluginCheck Fix Report (February 2, 2026)

This report summarizes the issues identified by Plugin Check and the fixes applied.

## Fixed Issues

### 1) Text Domain Mismatch
**Issue:** Text domain mismatches across PHP templates and settings.
**Fix:** Standardized text domain to `collection-for-woo` across all plugin files, including:
- `marble-collection-display.php`
- `includes/admin-settings.php`
- `includes/elementor-support.php`
- `includes/elementor-widget.php`
- `templates/collection-display.php`
- `templates/product-item.php`

### 2) Missing Sanitization in register_setting()
**Issue:** Missing `sanitize_callback` for settings registration.
**Fix:** Added sanitize callbacks for all options in `includes/admin-settings.php`.
Added helpers:
- `sanitize_absint()`
- `sanitize_text()`
- `sanitize_true_false()`
- `sanitize_yes_no()`
- `sanitize_color()`
- `sanitize_orderby()`

### 3) Unescaped Output (_e / __ / raw output)
**Issue:** Unescaped output in admin UI and templates.
**Fixes:**
- Replaced `_e()` with `esc_html_e()` where appropriate.
- Replaced `__()` output with `esc_html__()`.
- Escaped `MCD_VERSION` with `esc_html()`.
- Escaped `admin_url()` with `esc_url()`.
- Escaped `paginate_links()` output with `wp_kses_post()`.
- Escaped inline CSS output with `wp_kses_post()`.
- Escaped product image output with `wp_kses_post()`.
- Escaped product class output using `wc_get_product_class()` + `esc_attr()`.

### 4) Hidden Files in Plugin Root
**Issue:** `.gitignore` and `.gitattributes` are not allowed in plugin root.
**Fix:** Removed from plugin root.

### 5) Unexpected Markdown Files in Root
**Issue:** Multiple markdown files flagged in plugin root.
**Fix:** Moved documentation into `docs/` folder (only `README.md` remains in root).

## Known Remaining Requirement

### Restricted Slug
**Issue:** Plugin folder starts with restricted term `wo`.
**Required Action:** Rename folder to a compliant slug, e.g. `collection-for-woo`.

**Status:** Rename attempt blocked by file lock (in use by another process). Please close any open editors/servers and rename.

## Verification Targets

Re-run Plugin Check on the compliant folder after rename:
```
wp-content/plugins/collection-for-woo/
```

Expected results:
- No TextDomainMismatch
- No missing sanitize callbacks
- No unsafe output warnings
- No hidden files in root
- No unexpected markdown files in root
