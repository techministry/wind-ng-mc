# WiND Application - Real Smarty 3.1.48 Integration Status

## Completed Tasks

✅ **Installed Real Smarty 3.1.48 Library**
- Downloaded Smarty 3.1.48 from GitHub archive (398KB)
- Extracted to `vendor/smarty/smarty/libs/` with all sysplugins and plugins
- Verified Smarty.class.php (1425 lines) and supporting infrastructure files are in place

✅ **Fixed PHP 8.1 Compatibility in Smarty**
- Modified `SmartyCompilerException` to use magic `__get`/`__set` methods for legacy `$line` property access
- Removed conflicting `$line` property declaration that violated Exception contract
- Exception now properly inherits from SmartyException without type conflicts

✅ **Fixed PHP 8.1 Type Issues in Construct.php**
- Updated form() and table() methods to handle `template_dir` as array (Smarty 3.x returns array, not string)
- Changed from: `file_exists($smarty->template_dir . $file)`
- Changed to: `file_exists(is_array($smarty->template_dir) ? $smarty->template_dir[0] : $smarty->template_dir . $file)`
- Prevents "Array to string conversion" errors

✅ **Verified Smarty Configuration**
- config.php correctly points to `vendor/smarty/smarty/libs/Smarty.class.php`
- Template directories properly configured in globals/common.php
- Smarty instance properly initialized with setTemplateDir(), setCompileDir()

✅ **Fixed form.tpl for Smarty 3.x Compatibility** (Partially)
- Converted {section} loops to {foreach} loops
- Changed `$data[d].Type_Enums[e].value` syntax to `$enumVal.value` (foreach compatible)
- Removed bracket-dot notation which Smarty 3.x doesn't support
- Form template now compiles successfully

## Current Status

🔄 **Real Smarty Library Running**
- Server: http://localhost:3000 (PHP 8.1.33)
- Smarty 3.1.48: Actively processing templates
- Template compilation: Working
- Issue: Templates still using Smarty 2.x syntax cause parse errors

⚠️ **Template Syntax Compatibility Issue**
**Root Cause**: Original templates written for Smarty 2.x, using syntax not compatible with Smarty 3.x

**Affected Syntax Patterns**:
1. **Unquoted file paths**: `{include file=generic/help.tpl}` (100+ instances)
   - Smarty 3.x requires: `{include file="generic/help.tpl"}`
   - Error: "Unexpected '.', expected one of: '}'"

2. **Bracket-dot notation**: `$data[d].Type_Enums[e].value` (50+ instances)
   - Smarty 3.x requires: `$data['d'].Type_Enums['e'].value` or using {foreach}
   - Fixed in form.tpl, other templates still need conversion

3. **{section} loops**: `{section name=e loop=$array}` with `$smarty.section.*.index`
   - Can use {foreach} as drop-in replacement for simple cases
   - Requires mapping of index variable: `$smarty.section.e.index` → loop counter

4. **Backtick evaluation in attributes**: `prefix="CONDATETIME_`$data[d].fullField`_"`
   - Smarty 3.x: Use `|cat` modifier or plain string concatenation

## Attempted Solutions

❌ **Automatic Template Preprocessor**
- Created SmartyCompat class to fix unquoted file paths via regex
- Issue: Regex patterns too complex for reliable matching of mixed quoted/unquoted params
- Note: Would require sophisticated parsing to handle all edge cases
- Decision: Manual template conversion more reliable

## Recommended Path Forward

### Option 1: Convert Templates to Smarty 3.x (Recommended for Production)
1. Batch-convert all 100+ template files:
   - Convert `{section}` to `{foreach}`
   - Quote all unquoted file paths in `{include}`
   - Fix bracket-dot notation
   - Update backtick expressions

2. Timeline: 2-3 hours with careful testing

3. Validate: Run test suite against all pages

### Option 2: Downgrade to Smarty 2.x Library
1. Locate Smarty 2.x distribution (end-of-life around 2011)
2. Install to `vendor/smarty/smarty/libs/`
3. Advantage: All templates work without modification
4. Disadvantage: Old library, potential security issues, no PHP 8+ support (likely)

### Option 3: Use Compatibility Layer (Current Attempt)
1. Enhance SmartyCompat preprocessor with better regex patterns
2. Handle all syntax variations
3. Test on each template type
4. Challenges: Edge cases, maintenance burden

## Technical Notes

**Smarty Version Differences**:
- Smarty 2.x: Loose parsing, unquoted values, bracket-dot notation
- Smarty 3.x: Stricter parsing, requires quotes, uses array notation

**Compiler Exception Fix**:
- PHP Exception class has read-only `$line` property (protected, set in constructor)
- Smarty 3.1.48 tries to assign to it post-construction
- Solution: Override with magic methods that redirect to `$smarty_line` property

**Template Directory Array Issue**:
- Smarty 2.x: `$smarty->template_dir = 'path'` (string)
- Smarty 3.x: `$smarty->getTemplateDir()` returns array
- Location: Affects form.php and table.php constructor methods

## Files Modified

### Smarty Library
- `vendor/smarty/smarty/libs/Smarty.class.php` - Real 3.1.48 installed (was custom mock)
- `vendor/smarty/smarty/libs/sysplugins/smartycompilerexception.php` - PHP 8 compatibility
- `vendor/smarty/smarty/libs/SmartyCompat.php` - New compatibility helper class

### Application Code
- `globals/common.php` - Added SmartyCompat include
- `globals/classes/construct.php` - Fixed template_dir array handling
- `templates/basic/constructors/form.tpl` - Converted to Smarty 3.x syntax
- `globals/functions.php` - Added template preprocessing (currently disabled)

### Configuration
- `config/config.php` - Already pointing to correct Smarty location

## Testing Results

**Status**: Smarty 3.1.48 successfully compiles templates, but encounters syntax errors on templates using Smarty 2.x features

**Test URL**: `http://localhost:3000/index.php?page=nodes`

**Result**: 
- Server responds with 200
- Template compilation starts
- Parsing error on line 21 of nodes_search.tpl: `{include file=generic/help.tpl help=nodes_search}`
- Error message: "Unexpected '.', expected one of: '}'"

**Next Test After Template Conversion**:
- Manually convert a few key templates (form.tpl✓, table.tpl, page-title.tpl)
- Retry test to verify page rendering works with corrected syntax
- Expand conversion to all 50+ template files

## Conclusion

Real Smarty 3.1.48 is now active and PHP 8.1 compatible. The application is ready for template syntax modernization. Current blocker is not the Smarty library itself (which is working), but the legacy Smarty 2.x template syntax throughout the application.

Recommendation: Proceed with manual template conversion (Option 1) using form.tpl as a pattern reference.

