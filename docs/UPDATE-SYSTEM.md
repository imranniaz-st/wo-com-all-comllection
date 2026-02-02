# Plugin Update System

The Marble Collection Display plugin uses a **custom update system** that checks for updates from GitHub instead of the WordPress.org repository.

## How It Works

### Automatic Updates
The plugin automatically checks for new releases from the GitHub repository:
- **Repository:** https://github.com/imranniaz-st/wo-com-all-comllection
- **Update Check:** Every 12 hours (WordPress default)
- **Source:** GitHub Releases API
- **Method:** Compares current version with latest GitHub release tag

### Update Process

1. **Check for Updates**
   - Go to **Dashboard → Updates** or **Plugins → Installed Plugins**
   - WordPress automatically checks GitHub for new releases
   - If a new version is available, you'll see an update notification

2. **Install Update**
   - Click "Update Now" on the plugin row
   - WordPress downloads the latest release ZIP from GitHub
   - Plugin is automatically updated
   - Settings and data are preserved

3. **Manual Check**
   - Go to **Settings → Marble Collections**
   - Click "Check for Updates" button in sidebar
   - Or go to **Plugins** page and refresh

## Version Information

**Current Version:** 1.0.0  
**Update Source:** GitHub Releases  
**Branch:** wordpress-publish

## Creating New Releases

To release a new version:

### 1. Update Version Number

Update in these files:
```php
// marble-collection-display.php
define('MCD_VERSION', '1.0.1'); // Change version
```

```php
// marble-collection-display.php (header)
* Version: 1.0.1
```

### 2. Commit Changes
```bash
git add .
git commit -m "Release v1.0.1 - Brief description of changes"
```

### 3. Create Git Tag
```bash
git tag -a v1.0.1 -m "Version 1.0.1 - Release notes here"
```

### 4. Push to GitHub
```bash
git push origin wordpress-publish
git push origin v1.0.1
```

### 5. Create GitHub Release
1. Go to: https://github.com/imranniaz-st/wo-com-all-comllection/releases
2. Click "Draft a new release"
3. Select tag: `v1.0.1`
4. Title: "Marble Collection Display v1.0.1"
5. Add release notes in description
6. Click "Publish release"

### 6. Users Get Update
- WordPress checks GitHub API
- Finds new v1.0.1 release
- Shows update notification
- Users can click "Update Now"

## Update System Files

### Main Files:
- `/includes/github-updater.php` - GitHub update checker class
- `/marble-collection-display.php` - Main plugin file that loads updater

### Key Functions:

**Check for Updates:**
```php
MCD_GitHub_Updater::modify_transient()
```
Compares local version with GitHub latest release.

**Get Plugin Info:**
```php
MCD_GitHub_Updater::plugin_popup()
```
Shows plugin details and changelog when clicking "View details".

**Install Update:**
```php
MCD_GitHub_Updater::after_install()
```
Handles installation and reactivation after update.

## GitHub API Endpoints

**Latest Release:**
```
https://api.github.com/repos/imranniaz-st/wo-com-all-comllection/releases/latest
```

**Response Example:**
```json
{
  "tag_name": "v1.0.1",
  "name": "Version 1.0.1",
  "body": "Release notes...",
  "published_at": "2026-02-02T12:00:00Z",
  "zipball_url": "https://api.github.com/repos/.../zipball/v1.0.1",
  "html_url": "https://github.com/.../releases/tag/v1.0.1"
}
```

## Version Comparison

The updater uses PHP's `version_compare()`:
- Current: `1.0.0`
- GitHub: `1.0.1`
- Result: Update available ✅

- Current: `1.0.1`
- GitHub: `1.0.1`
- Result: No update ⭕

- Current: `1.1.0`
- GitHub: `1.0.1`
- Result: No update (newer installed) ⭕

## Advantages Over WordPress.org

### ✅ Benefits:
- **Independent**: Not dependent on WordPress.org approval
- **Fast Updates**: Push updates immediately
- **Custom Control**: Full control over release timing
- **Private Plugin**: Can keep plugin private if needed
- **Branch Control**: Use specific branch (wordpress-publish)

### 📝 Considerations:
- No automatic WordPress.org metrics
- Users must enable GitHub updates
- Requires GitHub account access
- Need to create releases manually

## Testing Updates Locally

### 1. Create Test Release
```bash
git tag -a v1.0.1-test -m "Test release"
git push origin v1.0.1-test
```

### 2. Create Draft Release on GitHub
- Mark as "Pre-release"
- Test update process

### 3. Check Update
- Go to WordPress Dashboard → Updates
- Should see test version available

### 4. Clean Up
```bash
git tag -d v1.0.1-test
git push origin :refs/tags/v1.0.1-test
```

## Troubleshooting

### Update Not Showing?

**Check 1: Transient Cache**
- Go to **Plugins** page
- Force refresh (Ctrl+F5)
- WordPress clears update cache

**Check 2: GitHub Release**
- Verify release exists on GitHub
- Check tag format: `v1.0.1` (with 'v')
- Ensure release is published (not draft)

**Check 3: Version Format**
```php
// Correct
define('MCD_VERSION', '1.0.1');

// Wrong
define('MCD_VERSION', 'v1.0.1'); // Don't include 'v'
```

**Check 4: GitHub API**
Visit: https://api.github.com/repos/imranniaz-st/wo-com-all-comllection/releases/latest
Should return valid JSON.

### Update Failed?

**Check 1: Permissions**
- WordPress needs write access to plugins folder
- Check folder permissions: 755

**Check 2: GitHub ZIP**
- Verify zipball_url is accessible
- Test download manually

**Check 3: Plugin Structure**
- Main file must be at root
- Folder structure must match

## Security

### API Access
- Uses GitHub public API
- No authentication needed for public repos
- Rate limit: 60 requests/hour (unauthenticated)

### Download Security
- Downloads from GitHub's CDN
- WordPress verifies ZIP integrity
- Original plugin backed up before update

### Permissions
- Only admins can update plugins
- Requires `update_plugins` capability
- WordPress verifies nonces

## Admin Interface

### Settings Page
**Settings → Marble Collections**

Shows:
- Current version number
- "Check for Updates" button
- "View Releases" link to GitHub
- Note about update source

### Plugins Page
**Plugins → Installed Plugins**

Shows:
- Update notification when available
- "Update Now" button
- "View Details" link (opens changelog)
- Version information

## Release Checklist

Before creating a new release:

```
☐ Update MCD_VERSION constant
☐ Update plugin header version
☐ Update RELEASE-NOTES.md
☐ Test all features work
☐ Commit changes
☐ Create git tag
☐ Push code and tag
☐ Create GitHub release
☐ Test update on local install
☐ Verify update works correctly
☐ Document changes in changelog
```

## Support

For update issues:
- Check GitHub repository status
- Verify internet connectivity
- Review WordPress error logs
- Check GitHub API rate limits

**Repository:** https://github.com/imranniaz-st/wo-com-all-comllection
**Issues:** https://github.com/imranniaz-st/wo-com-all-comllection/issues
