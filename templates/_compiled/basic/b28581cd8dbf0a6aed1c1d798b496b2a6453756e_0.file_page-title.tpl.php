<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:22
  from 'file:generic/page-title.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189d2ee3a57_52438834',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b28581cd8dbf0a6aed1c1d798b496b2a6453756e' => 
    array (
      0 => 'generic/page-title.tpl',
      1 => 1765893818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_694189d2ee3a57_52438834 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\generic';
?><table width="100%" style="height:73px;"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="table-main-title-left">&nbsp;</td>
<td class="table-main-title-bullet">&nbsp;</td>
<td class="table-main-title-text"><?php echo $_smarty_tpl->getValue('title');?>
</td>
<?php if ($_smarty_tpl->getValue('right') != '') {?><td class="table-main-title-right"><?php echo $_smarty_tpl->getValue('right');?>
</td><?php }?>
</tr>
</table><?php }
}
