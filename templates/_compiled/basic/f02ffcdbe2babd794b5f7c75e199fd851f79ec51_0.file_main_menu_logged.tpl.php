<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:55:11
  from 'file:includes/main_menu_logged.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941c72fb8e822_03796085',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f02ffcdbe2babd794b5f7c75e199fd851f79ec51' => 
    array (
      0 => 'includes/main_menu_logged.tpl',
      1 => 1765893819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6941c72fb8e822_03796085 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes';
?><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-quick-login">
<tr>
<td nowrap="nowrap" class="quick-login-title"><?php echo $_smarty_tpl->getValue('lang')['logged'];?>
 |</td>
<td nowrap="nowrap" class="quick-login-field" width="100%"><a href="<?php echo $_smarty_tpl->getValue('link_logged_profile');?>
" class="menu-link"><?php echo $_smarty_tpl->getValue('logged_username');?>
</a></td>
</tr>
</table>
</form><?php }
}
