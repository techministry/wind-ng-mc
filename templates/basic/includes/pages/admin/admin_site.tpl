{*
 * WiND - Wireless Nodes Database
 * Admin Site Settings Template
 *
 * Copyright (C) 2025 WNA Team
 *}
{include file="generic/page-title.tpl" title=$lang.admin_site_settings}

<form method="post" action="{$form_action}" id="site_settings_form" onsubmit="return saveForm();">
<input type="hidden" name="action" value="save" />

<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table-page">
<tr>
    <td class="table-page-pad">
        <!-- Theme Selection -->
        <div class="title2">{$lang.theme_selection}</div>
        <p>{$lang.theme_selection_help}</p>
        
        <table class="table-form" width="100%" cellpadding="4" cellspacing="0">
        <tr class="table-form-row1">
            <td class="table-form-text" width="150">{$lang.theme}:</td>
            <td class="table-form-field">
                <select name="theme" id="theme_selector" onchange="previewTheme(this.value)">
                    {foreach from=$themes key=theme_key item=theme_name}
                    <option value="{$theme_key}" {if $current_theme == $theme_key}selected="selected"{/if}>{$theme_name}</option>
                    {/foreach}
                </select>
                <span style="margin-left: 15px; font-size: 11px; color: #666;">
                    <span id="theme_preview_indicator"></span>
                </span>
            </td>
        </tr>
        </table>
        
        <br /><hr /><br />
        
        <!-- Homepage Content -->
        <div class="title2">{$lang.admin_startup_page_content}</div>
        <p>{$lang.admin_startup_page_help}</p>
        
        <textarea id="startup_html" name="startup_html" style="width:100%; height:400px;">{$startup_html|escape:'html'}</textarea>
        
        <br /><br />
        <input type="submit" value="{$lang.save}" class="form-submit" />
    </td>
</tr>
</table>
</form>

<!-- Theme Preview Script -->
<script>
var originalTheme = '{$current_theme}';

function previewTheme(theme) {
    var indicator = document.getElementById('theme_preview_indicator');
    var existingDarkCss = document.getElementById('dark-theme-css');
    
    if (theme === 'dark') {
        if (existingDarkCss) {
            existingDarkCss.disabled = false;
        } else {
            var darkCssLink = document.createElement('link');
            darkCssLink.rel = 'stylesheet';
            darkCssLink.type = 'text/css';
            darkCssLink.href = 'templates/basic/css/dark.css';
            darkCssLink.id = 'dark-theme-css';
            document.head.appendChild(darkCssLink);
        }
    } else {
        if (existingDarkCss) {
            existingDarkCss.disabled = true;
        }
    }
    
    if (theme !== originalTheme) {
        indicator.innerHTML = '({$lang.theme_preview_mode})';
        indicator.style.color = '#e94560';
    } else {
        indicator.innerHTML = '';
    }
}
</script>

<!-- TinyMCE 5 WYSIWYG Editor (LGPL License - Free) -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@5.10.9/tinymce.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    tinymce.init({
        selector: '#startup_html',
        height: 400,
        menubar: true,
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste help wordcount',
        toolbar: 'undo redo | formatselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code | removeformat | help',
        content_style: 'body { font-family: Verdana, Arial, sans-serif; font-size: 12px; }'
    });
});

// Save form handler - sync TinyMCE content before submit
function saveForm() {
    if (typeof tinymce !== 'undefined') {
        tinymce.triggerSave();
    }
    return true;
}
</script>
