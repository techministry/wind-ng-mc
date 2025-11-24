# Smarty Compatibility Fix - UPDATE INSTRUCTIONS

## The Problem
Your server uses **Smarty 3.x/4.x** (newer version) but the code was written for **Smarty 2.x** (older version). This caused a blank page.

## The Fix
I've updated the code to automatically detect and work with both versions.

## How to Update Your Server

### Option 1: Git Pull (Recommended if you use git on server)
```bash
cd /home/wnagr/public_html/wind
git pull origin master
```

### Option 2: Upload via FTP/SFTP
Upload these 2 updated files from your local machine to the server:
1. `globals/common.php`
2. `globals/functions.php`

### Option 3: Copy/Paste via File Manager
If you use cPanel/Plesk file manager, edit these files on the server and replace their content with the new versions from your local repository.

## What Was Changed

### File: `globals/common.php`
- ✅ Added Smarty version detection
- ✅ Uses new methods for Smarty 3.x/4.x (setTemplateDir, registerPlugin)
- ✅ Falls back to old methods for Smarty 2.x
- ✅ Fixed PHP version detection

### File: `globals/functions.php`
- ✅ Updated `reset_smarty()` function
- ✅ Uses `clearAllAssign()` instead of `clear_all_assign()`
- ✅ Uses `assign()` instead of deprecated `assign_by_ref()`
- ✅ Gets template directory correctly for both versions

## Testing After Update

1. **Clear browser cache** (Ctrl+F5)
2. Visit: `https://wna.gr/wind/`
3. You should see the WiND homepage, not a blank page
4. **Delete debug.php** from the server (it's not needed anymore)

## Verify It Works

After uploading, check:
- ✅ Homepage loads
- ✅ Login works
- ✅ Map displays (using Leaflet now)
- ✅ No errors in PHP error log

## If You Still See Issues

1. Check PHP error log: `/var/log/php-fpm/error.log` or `/var/log/apache2/error.log`
2. Make sure file permissions are correct:
   ```bash
   chmod -R 755 templates/_compiled/
   chmod 644 globals/common.php globals/functions.php
   ```
3. Clear Smarty compiled templates:
   ```bash
   rm -rf templates/_compiled/basic/*
   ```

## Additional Notes

### Your Server Configuration
- **PHP Version**: 5.6.40 (old but will work)
- **Smarty Path**: `/home/wnagr/php/smarty/libs/`
- **Smarty Version**: 3.x or 4.x (detected automatically)
- **Database**: Should use mysqli (recommended for PHP 5.6)

### Recommendations
1. **PHP Upgrade**: Consider upgrading to PHP 7.4 or 8.2 for better performance and security
   - All our fixes work with PHP 5.6 through PHP 8.2
2. **Check Database Config**: Make sure `config/config.php` has:
   ```php
   $config['db']['version'] = 5; // Use mysqli
   ```

## Compatibility

These fixes maintain compatibility with:
- ✅ Smarty 2.x (legacy)
- ✅ Smarty 3.x (current)
- ✅ Smarty 4.x (latest)
- ✅ PHP 5.6 - 8.2

## Support

If you encounter any issues:
1. Check the PHP error log
2. Verify the files were uploaded correctly
3. Clear Smarty cache: `rm -rf templates/_compiled/basic/*`
4. Test with `debug.php` to see detailed errors

---

**Files to Upload:**
- `globals/common.php`
- `globals/functions.php`

**After fixing, delete from server:**
- `debug.php` (debugging file, not needed)
