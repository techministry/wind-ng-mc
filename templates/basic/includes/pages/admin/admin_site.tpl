{*
 * WiND - Wireless Nodes Database
 * Admin Site Settings Template
 *
 * Copyright (C) 2025 WNA Team
 *}
{include file="generic/page-title.tpl" title=$lang.admin_site_settings}

<form method="post" action="{$form_action}">
<input type="hidden" name="action" value="save" />

<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table-page">
<tr>
    <td class="table-page-pad">
        <div class="title2">{$lang.admin_startup_page_content}</div>
        <p>{$lang.admin_startup_page_help}</p>
        
        <textarea id="startup_html" name="startup_html" style="width:100%; height:400px;">{$startup_html|escape:'html'}</textarea>
        
        <br /><br />
        <input type="submit" value="{$lang.save}" class="form-submit" />
    </td>
</tr>
</table>
</form>

<!-- TinyMCE WYSIWYG Editor -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#startup_html',
    height: 500,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | bold italic forecolor backcolor | ' +
        'alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | link image | code | removeformat | help',
    content_style: 'body { font-family: Verdana, Arial, sans-serif; font-size: 12px; }',
    language: '{if $lang.code == "el"}el{else}en{/if}'
});
</script>
