# PHP 8.2 Compatibility Fixes

## Overview
This document outlines the changes made to ensure WiND (Wireless Nodes Database) is compatible with PHP 8.2.

## Date
2025-11-24

## PHP Version Requirements
- **Minimum**: PHP 7.2
- **Recommended**: PHP 8.2+
- **Tested**: PHP 8.2

## Issues Fixed

### 1. Deprecated `each()` Function
**Issue**: The `each()` function was deprecated in PHP 7.2 and removed in PHP 8.0.

**Fixed in:**
- `globals/classes/mysql.php` (3 occurrences)
  - Line 80: `result_to_data()` method
  - Line 112: `add()` method
  - Line 148: `set()` method
  
- `globals/classes/mysqli.php` (3 occurrences)
  - Line 76: `result_to_data()` method
  - Line 108: `add()` method
  - Line 144: `set()` method

**Change:**
```php
// Before (deprecated)
while (list ($key, $value) = each ($data)) {
    // ...
}

// After (PHP 8.2 compatible)
foreach ($data as $key => $value) {
    // ...
}
```

### 2. Deprecated Curly Brace String Syntax
**Issue**: String offset access using curly braces `$string{$i}` was deprecated in PHP 7.4 and removed in PHP 8.0. Must use square brackets `$string[$i]` instead.

**Fixed in:**
- `globals/functions.php`
  - Line 219: `is8bit()` function

- `templates/basic/plugins/modifier.escape.php`
  - Line 72: `smarty_modifier_escape()` function
  - Line 78: `smarty_modifier_escape()` function

**Change:**
```php
// Before (deprecated)
$char = $string{$i};
$_ord = ord($string{$_i});

// After (PHP 8.2 compatible)
$char = $string[$i];
$_ord = ord($string[$_i]);
```

## Testing

To verify PHP 8.2 compatibility, test the following:

### Database Operations
- ✅ Create records (uses `add()` method)
- ✅ Update records (uses `set()` method)
- ✅ Query data (uses `result_to_data()` method)
- ✅ Verify no errors in logs

### String Operations
- ✅ Email sending (uses `is8bit()`)
- ✅ Smarty template rendering with special characters
- ✅ Character encoding detection

### General Functionality
- ✅ User login/authentication
- ✅ Node management (add/edit/delete)
- ✅ Map display (already updated to Leaflet)
- ✅ DNS zone management
- ✅ Admin functions

## Additional PHP 8.2 Considerations

### Dynamic Properties (PHP 8.2 Deprecation)
PHP 8.2 deprecates dynamic property creation on classes. The current codebase uses dynamic properties in several places. While this will generate deprecation warnings in PHP 8.2, the code will still work. To fully resolve this:

1. **Option A**: Add `#[AllowDynamicProperties]` attribute to affected classes
2. **Option B**: Declare all properties explicitly in class definitions
3. **Option C**: Suppress deprecation warnings temporarily

This is not critical for functionality but should be addressed in future updates.

### Database Drivers
- ✅ **mysql** extension: Removed in PHP 7.0 (code exists but not used if mysqli available)
- ✅ **mysqli** extension: Fully compatible with PHP 8.2
- Ensure your config uses `$vars['db']['version'] = 5` to use mysqli

### Smarty Template Engine
- The included Smarty version (appears to be 2.x) may have compatibility issues with PHP 8.2
- Consider upgrading to Smarty 4.x for full PHP 8.2 support
- Current fixes ensure the modifier plugin works with PHP 8.2

## Configuration Recommendations

### php.ini Settings
```ini
; Recommended for PHP 8.2
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT
display_errors = Off
log_errors = On
error_log = /path/to/wind/error.log

; Database
mysqli.allow_local_infile = On
mysqli.default_socket = /var/run/mysqld/mysqld.sock
```

### Database Configuration
Ensure your `config/config.php` uses:
```php
$config['db']['version'] = 5; // Use mysqli instead of deprecated mysql
```

## Migration Path

### From PHP 5.x/7.x to PHP 8.2:
1. ✅ Apply these compatibility fixes
2. ✅ Test thoroughly in development environment
3. ✅ Check error logs for deprecation warnings
4. ⚠️ Consider Smarty upgrade (optional)
5. ⚠️ Address dynamic properties (optional, future)
6. ✅ Deploy to production

## Known Limitations

### Not Fixed (Non-Critical)
- **Dynamic property deprecation warnings**: Will appear in PHP 8.2 but don't break functionality
- **Old MySQL extension code**: Still exists in `globals/classes/mysql.php` but not used when mysqli is configured
- **Smarty 2.x compatibility**: May have other PHP 8.2 issues; recommend upgrading to Smarty 4.x

## Performance Notes
- Replacing `each()` with `foreach()` may provide slight performance improvements
- PHP 8.2's JIT compilation can improve performance by 20-30% for some operations
- No negative performance impact from these changes

## Error Handling
All changes maintain the same error handling behavior as the original code:
- Database errors are still caught and logged
- String operations maintain the same error conditions
- No new exceptions are introduced

## Backward Compatibility
These changes maintain compatibility with:
- ✅ PHP 7.2+
- ✅ PHP 7.4
- ✅ PHP 8.0
- ✅ PHP 8.1
- ✅ PHP 8.2

## Support
For issues related to PHP 8.2 compatibility:
1. Check PHP error logs
2. Verify php.ini configuration
3. Ensure mysqli extension is enabled
4. Review this document for known limitations

## References
- [PHP 8.2 Release Notes](https://www.php.net/releases/8.2/en.php)
- [PHP 8.0 Migration Guide](https://www.php.net/manual/en/migration80.php)
- [Deprecated Features in PHP 7.4](https://www.php.net/manual/en/migration74.deprecated.php)
