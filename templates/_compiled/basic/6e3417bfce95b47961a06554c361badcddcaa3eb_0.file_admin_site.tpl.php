<?php
/* Smarty version 5.7.0, created on 2025-12-16 22:10:31
  from 'file:includes\pages\admin/admin_site.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941d8d739e313_25820114',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e3417bfce95b47961a06554c361badcddcaa3eb' => 
    array (
      0 => 'includes\\pages\\admin/admin_site.tpl',
      1 => 1765922830,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/page-title.tpl' => 1,
  ),
))) {
function content_6941d8d739e313_25820114 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\admin';
$_smarty_tpl->renderSubTemplate("file:generic/page-title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>$_smarty_tpl->getValue('lang')['admin_site_settings']), (int) 0, $_smarty_current_dir);
?>

<form method="post" action="<?php echo $_smarty_tpl->getValue('form_action');?>
">
<input type="hidden" name="action" value="save" />

<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table-page">
<tr>
    <td class="table-page-pad">
        <div class="title2"><?php echo $_smarty_tpl->getValue('lang')['admin_startup_page_content'];?>
</div>
        <p><?php echo $_smarty_tpl->getValue('lang')['admin_startup_page_help'];?>
</p>
        
        <textarea id="startup_html" name="startup_html" style="width:100%; height:400px;"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('startup_html'), ENT_QUOTES, 'UTF-8', true);?>
</textarea>
        
        <br /><br />
        <input type="submit" value="<?php echo $_smarty_tpl->getValue('lang')['save'];?>
" class="form-submit" />
    </td>
</tr>
</table>
</form>

<!-- TinyMCE WYSIWYG Editor -->
<?php echo '<script'; ?>
 src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
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
    language: '<?php if ($_smarty_tpl->getValue('lang')['code'] == "el") {?>el<?php } else { ?>en<?php }?>'
});
<?php echo '</script'; ?>
>
<?php }
}
