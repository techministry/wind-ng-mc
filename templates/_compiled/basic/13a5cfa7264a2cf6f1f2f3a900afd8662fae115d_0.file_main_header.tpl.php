<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:21:03
  from 'file:includes/main_header.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941bf2f0d4c47_53901211',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13a5cfa7264a2cf6f1f2f3a900afd8662fae115d' => 
    array (
      0 => 'includes/main_header.tpl',
      1 => 1765916457,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6941bf2f0d4c47_53901211 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes';
?><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-header">
      <tr>
        <td class="table-header-td-left"><img src="<?php echo $_smarty_tpl->getValue('img_dir');?>
main_logo.png" alt="WiND Logo" /></td>
<?php if ($_smarty_tpl->getValue('mylogo')) {?>        <td class="table-header-td-right"><img src="<?php echo $_smarty_tpl->getValue('mylogo_dir');?>
mylogo.png" alt="<?php echo $_smarty_tpl->getValue('lang')['site_title'];?>
" /></td><?php }?>
      </tr>
</table>
<?php }
}
