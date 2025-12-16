<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:31:31
  from 'file:includes/main_menu_form_login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941c1a36902b4_33513824',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb8f648b3cb2267dfcf3f5dd8de1d6384d129fa9' => 
    array (
      0 => 'includes/main_menu_form_login.tpl',
      1 => 1765893819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6941c1a36902b4_33513824 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes';
?><form name="<?php echo $_smarty_tpl->getValue('extra_data')['FORM_NAME'];?>
" method="post" action="?">
<input type="hidden" name="query_string" value="<?php echo $_smarty_tpl->getValue('hidden_qs');?>
" />
<input type="hidden" name="form_name" value="<?php echo $_smarty_tpl->getValue('extra_data')['FORM_NAME'];?>
" />
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-quick-login">
<tr>
<td nowrap="nowrap" class="quick-login-title"><?php echo $_smarty_tpl->getValue('lang')['login'];?>
 |</td>
<?php $_smarty_tpl->assign('fullField', $_smarty_tpl->getValue('data')[0]['fullField'], false, NULL);?>
<td nowrap="nowrap" class="quick-login-field"><?php echo $_smarty_tpl->getValue('lang')['db'][$_smarty_tpl->getValue('fullField')];?>
:
<input name="<?php echo $_smarty_tpl->getValue('fullField');?>
" type="text" class="fld-quick-login" /></td>
<?php $_smarty_tpl->assign('fullField', $_smarty_tpl->getValue('data')[1]['fullField'], false, NULL);?>
<td nowrap="nowrap" class="quick-login-field"><?php echo $_smarty_tpl->getValue('lang')['db'][$_smarty_tpl->getValue('fullField')];?>
:
<input name="<?php echo $_smarty_tpl->getValue('fullField');?>
" type="password" class="fld-quick-login" />
</td>
<td nowrap="nowrap" class="quick-login-field"><input type="checkbox" name="save_login" value="Y" /></td>
<td width="373" class="quick-login-submit">
<input type="image" src="templates/basic/images/submit1.png" /></td>
</tr>
</table>
</form><?php }
}
