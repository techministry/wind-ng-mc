# WiND (Wireless Nodes Database) - AI Assistant Instructions

## Project Overview
WiND is a PHP-based wireless network management system for mapping and managing network nodes, communities, and services. It manages network infrastructure with web UI, database backend, and geospatial features using Leaflet.js mapping.

## Architecture

### Core Request Flow
```
index.php → globals/common.php (init) → includes/main.php → HTML output
    ↓
    ├→ globals/classes/userdata.php (auth/session)
    ├→ includes/pages/{page}/{page}.php (page handler)
    ├→ globals/classes/form.php / table.php (UI components)
    ├→ globals/classes/mysql.php OR mysqli.php (DB layer)
    └→ templates/basic/ (Smarty template rendering)
```

### Key Components

**Database Layer**: Abstraction classes for MySQL legacy (`mysql.php`) or modern MySQLi (`mysqli.php`)
- Configured in `config/config.php` - set `$config['db']['version'] = 5` for MySQLi
- Methods: `get()`, `add()`, `set()`, `del()`, `cnt()`, `query()`
- Auto-detects PHP version and uses appropriate driver

**Template System**: Smarty with auto-detection for v2.x/3.x/4.x compatibility
- Template detection in `globals/common.php` uses `method_exists()` to choose API
- All `.tpl` files must use compatibility-safe Smarty calls (no deprecated syntax)
- Compiled templates cache at `templates/_compiled/basic/`
- Custom plugins at `templates/basic/plugins/`

**Page Architecture**: Dynamic page loading based on `?page=` URL parameter
- Pages auto-loaded from `includes/pages/{page}/{page}.php`
- Security checks in `main_center.php::security_check()` - ALWAYS check privileges before operations
- Uses role-based access control via `userdata->privileges` array (admin, cadmin, hostmaster, etc.)

**UI Construction**: Smarty-based forms and tables
- `globals/classes/form.php` - builds form objects with field definitions
- `globals/classes/table.php` - builds data tables with sorting/pagination
- `globals/classes/construct.php` - renders via Smarty templates
- Template lookup: tries `includes/{page}/{page}_{FORM_NAME}.tpl` before fallback to generic

## Critical Development Practices

### PHP Version & Compatibility
- **Target versions**: PHP 5.6 through PHP 8.2+
- **PHP 8.2 compliance**: Already fixed
  - Replaced deprecated `each()` with `foreach` loops (see [globals/classes/mysql.php](globals/classes/mysql.php#L80))
  - Changed string indexing from `$str{i}` to `$str[$i]` (see [globals/functions.php](globals/functions.php#L219))
- **When modifying**: Always test with both old and new APIs where version-dependent

### Database Operations
- Use `$db->get($fields, $table, $where_clause)` - returns array of rows
- Use parameterized queries where possible (currently uses string concatenation - needs SQL injection hardening)
- MySQLi class in [globals/classes/mysqli.php](globals/classes/mysqli.php) mirrors MySQL API for compatibility
- Database abstraction set in [globals/common.php](globals/common.php#L35) - don't hardcode driver

### Authentication & Authorization
- Session-based auth via `userdata` class (see [globals/classes/userdata.php](globals/classes/userdata.php))
- Always check `$main->userdata->logged` before showing restricted content
- Privileges stored in `users_nodes`, `rights` tables - check with `isset($userdata->privileges['privilege_name'])`
- Admin hierarchy: `admin` > `cadmin` (community admin) > `hostmaster` > regular users

### Template & Frontend
- Leaflet.js migration completed (2025-11-24) - uses OpenStreetMap tiles by default
- See [LEAFLET_MIGRATION.md](LEAFLET_MIGRATION.md) for mapping API changes (GMap2→L.map, GMarker→L.marker, etc.)
- Smarty variables passed via `assign()` not `assign_by_ref()` (v3+ compatible)
- Use `template()` helper to render with query string context preserved
- CSS/JS: `add_link()` and `add_script()` in [includes/head.php](includes/head.php) support CDN integrity/crossorigin

### Common Patterns
- **Getting URL parameters**: `get('param_name')` from [globals/functions.php](globals/functions.php)
- **Redirects**: `redirect($url, $sec=0, $exit=true)` - respects Safari quirk
- **Error messaging**: `$main->message->show()` object in `globals/classes/message.php`
- **Page routing**: Match pattern in `includes/pages/` folder structure

## Recent Major Changes (Track for Impact)
1. **Leaflet.js migration** (11/24/2025) - Map API completely different from Google Maps v2
2. **Smarty 2→3/4 compatibility** (11/24/2025) - `setTemplateDir()`, `clearAllAssign()` in common.php
3. **PHP 8.2 fixes** (11/24/2025) - `each()` removal, bracket string indexing

## Quick Reference: Important Files

| Purpose | File | Key Note |
|---------|------|----------|
| **Entry point** | [index.php](index.php) | Calls `new main` to build page |
| **Global init** | [globals/common.php](globals/common.php) | DB init, Smarty setup, config load |
| **DB abstraction** | [globals/classes/mysql.php](globals/classes/mysql.php) / [mysqli.php](globals/classes/mysqli.php) | Auto-selected based on config |
| **Auth system** | [globals/classes/userdata.php](globals/classes/userdata.php) | Session/cookie, privilege loading |
| **Page router** | [includes/main_center.php](includes/main_center.php) | Security checks + page instantiation |
| **Helpers** | [globals/functions.php](globals/functions.php) | `get()`, `template()`, `redirect()`, etc. |
| **Template config** | [templates/basic/config.php](templates/basic/config.php) | Version info |

## When Coding
- Assume class-based page handlers at `includes/pages/{page}/{page}.php`
- All page classes should implement a `output()` method
- Preserve backward compat: test deprecated patterns still work (mysql_* functions still in codebase)
- DB queries: escape user input even though not current standard (SQL injection risk exists)
- Before refactoring: check SMARTY_FIX.md, PHP82_COMPATIBILITY.md, LEAFLET_MIGRATION.md for context
