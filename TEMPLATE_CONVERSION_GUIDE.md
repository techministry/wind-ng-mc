# Smarty 2.x to 3.x Template Conversion Quick Guide

## Problem
WiND templates were written for Smarty 2.x but we've installed Smarty 3.1.48 which has stricter syntax requirements.

## Common Issues and Fixes

### 1. Unquoted File Paths in Include Statements

**Smarty 2.x (Old - DOESN'T WORK IN 3.x):**
```smarty
{include file=generic/help.tpl help=nodes_search}
{include assign=help file=generic/help.tpl help=nodes_search}
```

**Smarty 3.x (NEW - REQUIRED):**
```smarty
{include file="generic/help.tpl" help="nodes_search"}
{include assign=help file="generic/help.tpl" help="nodes_search"}
```

**Pattern to Replace:**
- Search: `{include ([^}]*?)file=([a-z_][a-z0-9_/\-\.]*)`
- Replace: `{include $1file="$2`

---

### 2. Bracket-Dot Notation (Numeric Array Indices)

**Smarty 2.x (Old):**
```smarty
{section loop=$data name=d}
  {$data[d].fullField}
  {$data[d].Type}
{/section}
```

**Smarty 3.x (NEW - Use foreach):**
```smarty
{foreach from=$data item=field}
  {$field.fullField}
  {$field.Type}
{/foreach}
```

**Why**: `$array[variable_name]` syntax isn't supported in Smarty 3.x for automatic variable keys.

---

### 3. {section} Loops with Index

**Smarty 2.x (Old):**
```smarty
{section loop=$items name=e}
  {$items[e].value}
  {if $smarty.section.e.index is not even}odd{/if}
{/section}
```

**Smarty 3.x (NEW):**
```smarty
{foreach from=$items item=item key=e}
  {$item.value}
  {if $e is not even}odd{/if}
{/foreach}
```

**Alternative for Index Counter:**
```smarty
{foreach from=$items item=item name=loop}
  Item #{$smarty.foreach.loop.iteration}
{/foreach}
```

---

### 4. Complex Array Access with Dots

**Smarty 2.x (Old):**
```smarty
{$extra_data.EDIT[c]}
{$data[d].Type_Enums[e].output}
```

**Smarty 3.x (NEW):**
```smarty
{$extra_data['EDIT'][$c]}
{$data[$d]['Type_Enums'][$e]['output']}
```

OR if using foreach (PREFERRED):
```smarty
{foreach from=$data item=field key=d}
  {foreach from=$field.Type_Enums item=enum key=e}
    {$enum.output}
  {/foreach}
{/foreach}
```

---

### 5. Backtick Evaluation in Parameters

**Smarty 2.x (Old):**
```smarty
{include file="constructors/form_enum.tpl" value=`$data[d].Type_Enums[e].output`}
```

**Smarty 3.x (NEW):**
```smarty
{include file="constructors/form_enum.tpl" value=$enum.output}
```

Or if backticks needed:
```smarty
{assign var=value value=$data[$d]['Type_Enums'][$e]['output']}
{include file="constructors/form_enum.tpl" value=$value}
```

---

## Conversion Checklist for Each Template

- [ ] Add quotes around all `file=` paths in `{include}` tags
- [ ] Add quotes around all parameter values
- [ ] Replace `{section}` loops with `{foreach}` (where applicable)
- [ ] Fix bracket-dot notation: `$arr[key].subkey` → `$arr['key']['subkey']` or use foreach
- [ ] Replace backtick variables with assignments
- [ ] Test template renders without Smarty compile errors
- [ ] Verify output matches expected layout

## Files to Convert (Priority Order)

1. ✅ `templates/basic/constructors/form.tpl` - DONE
2. `templates/basic/constructors/table.tpl` - IN PROGRESS
3. `templates/basic/generic/page-title.tpl` - HIGH PRIORITY
4. `templates/basic/generic/link.tpl` - HIGH PRIORITY  
5. `templates/basic/generic/help.tpl` - HIGH PRIORITY
6. All other `templates/basic/generic/*.tpl` files
7. `templates/basic/includes/*.tpl` files
8. Page-specific templates in `templates/basic/includes/pages/*/`

## Automated Conversion Script (PowerShell)

```powershell
$templateDir = "d:\users\admin\GitHub\wind-ng-mc\templates\basic"
$pattern = '\{include\s+([^}]*?)(\s+file=)([a-z_][a-z0-9_\/\-\.]*?)(\s|$|[^a-z0-9_\/\-\.])'
$replacement = '{include $1$2"$3"$4'

Get-ChildItem -Path $templateDir -Recurse -Filter "*.tpl" | ForEach-Object {
    $content = Get-Content $_.FullName -Raw
    $newContent = $content -replace $pattern, $replacement
    Set-Content -Path $_.FullName -Value $newContent
    if ($content -ne $newContent) { Write-Host "Updated: $($_.Name)" }
}
```

## Testing After Conversion

1. Start server: `php -S localhost:3000`
2. Test each major page:
   - http://localhost:3000/index.php?page=nodes
   - http://localhost:3000/index.php?page=services
   - http://localhost:3000/index.php?page=search
   - http://localhost:3000/index.php?page=admin
3. Check browser console for JavaScript errors
4. Verify forms render correctly
5. Verify tables display with proper styling

## Reference

- [Smarty 3.x Documentation](https://www.smarty.net/docs/en/)
- [Upgrading from Smarty 2.x to 3.x](https://www.smarty.net/docs/en/smarty.for.designers.tpl)
- Form.tpl (converted example): `templates/basic/constructors/form.tpl`
