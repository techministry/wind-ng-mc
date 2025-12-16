<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:22
  from 'file:constructors/table.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189d2ea28d1_12730918',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '283cc1cca862b8926dd3de2feb0fb5f0a7d7ca97' => 
    array (
      0 => 'constructors/table.tpl',
      1 => 1765893818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_694189d2ea28d1_12730918 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\constructors';
if ($_smarty_tpl->getValue('extra_data')['MULTICHOICE'][1] != '') {?>
<form name="<?php echo $_smarty_tpl->getValue('extra_data')['FORM_NAME'];?>
" method="post">
<input type="hidden" name="query_string" value="<?php echo $_smarty_tpl->getValue('hidden_qs');?>
" />
<input type="hidden" name="form_name" value="<?php echo $_smarty_tpl->getValue('extra_data')['FORM_NAME'];?>
" />
<?php }?>
<table width="100%"  border="0" cellspacing="0" cellpadding="2">
<?php
$__section_row_0_loop = (is_array(@$_loop=$_smarty_tpl->getValue('data')) ? count($_loop) : max(0, (int) $_loop));
$__section_row_0_total = $__section_row_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_row'] = new \Smarty\Variable(array());
if ($__section_row_0_total !== 0) {
for ($__section_row_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_row']->value['index'] = 0; $__section_row_0_iteration <= $__section_row_0_total; $__section_row_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_row']->value['index']++){
?>

	<?php if (($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null) == 0) {?>
	<tr>
	<?php } else { ?>
	<?php if ((1 & ($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null))) {?>
	<tr class="table-list-list1">
	<?php } else { ?>
	<tr class="table-list-list2">
	<?php }?>
	<?php }?>
		
	<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('data')[($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)], 'itm', false, 'key');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('key')->value => $_smarty_tpl->getVariable('itm')->value) {
$foreach3DoElse = false;
?>
	<?php $_smarty_tpl->assign('fullkey', $_smarty_tpl->getValue('data')[0][$_smarty_tpl->getValue('key')], false, NULL);?>
	<?php if ($_smarty_tpl->getValue('extra_data')['HIDE'][$_smarty_tpl->getValue('fullkey')] != 'YES') {?>
	<?php if (($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null) == 0 && $_smarty_tpl->getValue('lang')['db'][$_smarty_tpl->getValue('itm')] != '') {?>
		<?php $_smarty_tpl->assign('cell', $_smarty_tpl->getValue('lang')['db'][$_smarty_tpl->getValue('itm')], false, NULL);?>
		<?php $_smarty_tpl->assign('cellclass', "table-list-top-cell", false, NULL);?>
	<?php } elseif (($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null) != 0 && $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('key'),5,'',true) == 'date_') {?>
		<?php $_smarty_tpl->assign('cell', $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('itm'),"%x"), false, NULL);?>
		<?php $_smarty_tpl->assign('cellclass', "table-list-cell", false, NULL);?>
	<?php } elseif ($_smarty_tpl->getValue('extra_data')['TRANSLATE'][$_smarty_tpl->getValue('fullkey')] == 'YES') {?>
		<?php $_smarty_tpl->assign('cellclass', "table-list-cell", false, NULL);?>
		<?php $_smarty_tpl->assign('lang_cell', (($_smarty_tpl->getValue('fullkey')).("-")).($_smarty_tpl->getValue('itm')), false, NULL);?>
		<?php $_smarty_tpl->assign('cell', $_smarty_tpl->getValue('lang')['db'][$_smarty_tpl->getValue('lang_cell')], false, NULL);?>
		<?php $_smarty_tpl->assign('cellclass', "table-list-cell", false, NULL);?>
	<?php } else { ?>
		<?php $_smarty_tpl->assign('cellclass', "table-list-cell", false, NULL);?>
		<?php $_smarty_tpl->assign('cell', $_smarty_tpl->getValue('itm'), false, NULL);?>
	<?php }?>
	
	<?php if ($_smarty_tpl->getValue('rowclass') != '') {?>

	<?php }?>
	<?php $_smarty_tpl->assign('edit_column', '', false, NULL);?>
	<?php $_smarty_tpl->assign('edit', '', false, NULL);?>
	<?php $_smarty_tpl->assign('onclick', '', false, NULL);?>
	<?php if ($_smarty_tpl->getValue('extra_data')['EDIT_COLUMN'] != '') {?>
		<?php $_smarty_tpl->assign('edit_column', ((string)$_smarty_tpl->getValue('extra_data')['EDIT_COLUMN']), false, NULL);?>
		<?php $_smarty_tpl->assign('edit', ((string)$_smarty_tpl->getValue('extra_data')['EDIT'][($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)]), false, NULL);?>
	<?php }?>
	<?php if ($_smarty_tpl->getValue('extra_data')['PICKUP_COLUMN'] != '') {?>
		<?php $_smarty_tpl->assign('edit_column', ((string)$_smarty_tpl->getValue('extra_data')['PICKUP_COLUMN']), false, NULL);?>
		<?php $_smarty_tpl->assign('edit', '', false, NULL);?>
		<?php $_smarty_tpl->assign('onclick', $_smarty_tpl->getSmarty()->getModifierCallback('stripslashes')("javascript: window.opener.pickup(window.opener.document.".((string)$_smarty_tpl->getValue('extra_data')['PICKUP_OBJECT']).",'".((string)$_smarty_tpl->getValue('extra_data')['PICKUP_OUTPUT'][($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)])."','".((string)$_smarty_tpl->getValue('extra_data')['PICKUP_VALUE'][($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)])."', window); return false;"), false, NULL);?>
	<?php }?>
	<td class="<?php echo $_smarty_tpl->getValue('cellclass');?>
">
		<?php if ($_smarty_tpl->getValue('key') == $_smarty_tpl->getValue('edit_column') && ($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null) != 0) {?>
		<a href="<?php echo $_smarty_tpl->getValue('edit');?>
"<?php if ($_smarty_tpl->getValue('extra_data')['PICKUP_COLUMN'] != '') {?> onclick="<?php echo $_smarty_tpl->getValue('onclick');?>
"<?php }?>>
		<?php }?>
		<?php if ($_smarty_tpl->getValue('extra_data')['LINK'][$_smarty_tpl->getValue('fullkey')][($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)] != '') {?>
		<a href="<?php echo $_smarty_tpl->getValue('extra_data')['LINK'][$_smarty_tpl->getValue('fullkey')][($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)];?>
">
		<?php }?>
		<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('cell'), ENT_QUOTES, 'UTF-8', true);?>

		<?php if ($_smarty_tpl->getValue('key') == $_smarty_tpl->getValue('edit_column') && ($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null) != 0) {?></a><?php }?>
		<?php if ($_smarty_tpl->getValue('extra_data')['LINK'][$_smarty_tpl->getValue('fullkey')][($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)] != '') {?>
		</a>
		<?php }?>
	</td>
	<?php }?>
	<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
	<?php if ($_smarty_tpl->getValue('extra_data')['MULTICHOICE'][($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)] != '') {?>
	<td class="table-list-cell-extra"><input class="fld-form-check" type="checkbox" name="id[]" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('extra_data')['MULTICHOICE'][($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)], ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->getValue('extra_data')['MULTICHOICE_CHECKED'][($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)] == 'YES') {?>checked="checked" <?php }?>/></td>
	<?php } elseif ($_smarty_tpl->getValue('extra_data')['MULTICHOICE_LABEL'] != '') {?>
	<td width="1%" class="table-list-top-cell"><?php echo $_smarty_tpl->getValue('lang')[$_smarty_tpl->getValue('extra_data')['MULTICHOICE_LABEL']];?>
</td>
	<?php }?>
</tr>
<?php
}
}
if ($_smarty_tpl->getValue('extra_data')['MULTICHOICE'][1] != '' || $_smarty_tpl->getValue('extra_data')['TOTAL_PAGES'] != '') {?>
<tr class="table-list-footer">
	<?php if ($_smarty_tpl->getValue('extra_data')['TOTAL_PAGES'] == '') {?>
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('data')[0], 'cell', false, 'key');
$foreach4DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('key')->value => $_smarty_tpl->getVariable('cell')->value) {
$foreach4DoElse = false;
?>
		<td></td>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
	<?php } else { ?>
		<?php
$__section_cell_0_loop = (is_array(@$_loop=$_smarty_tpl->getValue('data')[0]) ? count($_loop) : max(0, (int) $_loop));
$_smarty_tpl->tpl_vars['__smarty_section_cell'] = new \Smarty\Variable(array('total' => $__section_cell_0_loop));
if ($_smarty_tpl->tpl_vars['__smarty_section_cell']->value['total'] !== 0) {
for ($__section_cell_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_cell']->value['index'] = 0; $__section_cell_0_iteration <= $_smarty_tpl->tpl_vars['__smarty_section_cell']->value['total']; $__section_cell_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_cell']->value['index']++){
?>
		<?php
}
}
?>
		<td class="table-list-footer" colspan="<?php echo ($_smarty_tpl->getValue('__smarty_section_cell')['total'] ?? null);?>
">Pages: 
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('extra_data')['PAGES'], 'page', false, 'key');
$foreach5DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('key')->value => $_smarty_tpl->getVariable('page')->value) {
$foreach5DoElse = false;
?>
			<?php if ($_smarty_tpl->getValue('key') == $_smarty_tpl->getValue('extra_data')['CURRENT_PAGE']) {?>
				<?php echo $_smarty_tpl->getValue('key');?>

			<?php } else { ?>
				<a href="<?php echo $_smarty_tpl->getValue('page');?>
"><?php echo $_smarty_tpl->getValue('key');?>
</a>
			<?php }?>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?></td>
	<?php }?>
	<?php if ($_smarty_tpl->getValue('extra_data')['MULTICHOICE'][1] != '') {?><td class="table-form-submit"><input class="fld-form-submit" type="submit" name="submit" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lang')[$_smarty_tpl->getValue('extra_data')['MULTICHOICE_LABEL']], ENT_QUOTES, 'UTF-8', true);?>
" /></td><?php }?>
</tr>
<?php }?>
</table>
<?php if ($_smarty_tpl->getValue('extra_data')['MULTICHOICE'][1] != '') {?></form><?php }
}
}
