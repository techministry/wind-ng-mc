<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:22
  from 'file:generic/title1.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189d2f002f6_92075740',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '412b6b4172dd7e831c6d3ec9206e17bdb83aba40' => 
    array (
      0 => 'generic/title1.tpl',
      1 => 1765893818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_694189d2f002f6_92075740 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\generic';
?><table width="100%"  border="0" cellspacing="0" cellpadding="0" class="table-d1">
	<tr>
		<td width="6" class="table-d1-side">&nbsp;</td>
		<td nowrap="nowrap" class="table-d1-title-text" >
			<?php echo $_smarty_tpl->getValue('title');?>

		</td>
		<?php if ($_smarty_tpl->getValue('right') != '') {?><td nowrap="nowrap"><?php echo $_smarty_tpl->getValue('right');?>
</td><?php }?>
		<td width="10" class="table-d1-title-space"></td>
		<td width="299" class="table-d1-title-border">&nbsp;</td>
		<td width="6" class="table-d1-side2">&nbsp;</td>
	</tr>
	<tr>
		<td rowspan="2" class="table-d1-side">&nbsp;</td>
		<td colspan="<?php if ($_smarty_tpl->getValue('right') != '') {?>4<?php } else { ?>3<?php }?>" class="table-d1-title-down"></td>
		<td rowspan="2" class="table-d1-side2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="<?php if ($_smarty_tpl->getValue('right') != '') {?>4<?php } else { ?>3<?php }?>" class="table-d1-text1">
			<?php echo $_smarty_tpl->getValue('content');?>

		</td>
	</tr>
</table><?php }
}
