{* WiND - Modern Theme - Admin Site Settings *}
{include file="generic/page-title.tpl" title=$lang.admin_site_settings}

<form method="post" action="{$form_action}" id="site_settings_form" onsubmit="return saveForm();">
  <input type="hidden" name="action" value="save" />

  <div class="modern-form-section">
    <h2>{$lang.theme_selection}</h2>
    <p>{$lang.theme_selection_help}</p>
    <div class="modern-form-row">
      <label for="theme_selector">{$lang.theme}:</label>
      <select name="theme" id="theme_selector" onchange="previewTheme(this.value)">
        {foreach from=$themes key=theme_key item=theme_name}
        <option value="{$theme_key}" {if $current_theme == $theme_key}selected="selected"{/if}>{$theme_name}</option>
        {/foreach}
      </select>
      <span id="theme_preview_indicator" class="theme-preview-indicator"></span>
    </div>
  </div>

  <hr class="modern-divider" />

  <div class="modern-form-section">
    <h2>{$lang.admin_startup_page_content}</h2>
    <p>{$lang.admin_startup_page_help}</p>
    <textarea id="startup_html" name="startup_html" class="modern-textarea">{$startup_html|escape:'html'}</textarea>
  </div>

  <div class="modern-form-actions">
    <input type="submit" value="{$lang.save}" class="modern-form-submit" />
  </div>
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
      darkCssLink.href = 'templates/modern/css/dark.css';
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

<!-- TinyMCE 5 WYSIWYG Editor -->
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
function saveForm() {
  if (typeof tinymce !== 'undefined') {
    tinymce.triggerSave();
  }
  return true;
}
</script>
