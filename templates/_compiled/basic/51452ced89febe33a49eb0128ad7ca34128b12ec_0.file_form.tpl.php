<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:40:05
  from 'file:constructors/form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941c3a567d0a2_61096198',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51452ced89febe33a49eb0128ad7ca34128b12ec' => 
    array (
      0 => 'constructors/form.tpl',
      1 => 1765917567,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:constructors/form_enum.tpl' => 2,
  ),
))) {
function content_6941c3a567d0a2_61096198 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\constructors';
?><form name="<?php echo $_smarty_tpl->getValue('extra_data')['FORM_NAME'];?>
" method="post" action="<?php echo $_smarty_tpl->getValue('action_url');?>
">
<input type="hidden" name="form_name" value="<?php echo $_smarty_tpl->getValue('extra_data')['FORM_NAME'];?>
" />
<table class="table-form">
<?php $_smarty_tpl->assign('row_num', 1, false, NULL);
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('data'), 'field');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('field')->value) {
$foreach0DoElse = false;
?>
	<?php $_smarty_tpl->assign('fullField', $_smarty_tpl->getValue('field')['fullField'], false, NULL);?>
	<tr class="table-form-row<?php if ($_smarty_tpl->getValue('row_num')%2 == 1) {?>1<?php } else { ?>2<?php }?>">
		<td class="table-form-title"><?php echo $_smarty_tpl->getValue('lang')['db'][$_smarty_tpl->getValue('fullField')];
if ($_smarty_tpl->getValue('field')['Null'] != 'YES') {?>*<?php }?>:</td>
		<td class="table-form-field">
	<?php if ($_smarty_tpl->getValue('field')['Type'] == 'caption') {?>
		<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('field')['Value'], ENT_QUOTES, 'UTF-8', true);?>

	<?php } elseif ($_smarty_tpl->getValue('field')['Type'] == 'datetime') {?>
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_select_date')->handle(array('time'=>$_smarty_tpl->getValue('field')['value'],'prefix'=>"CONDATETIME_".((string)$_smarty_tpl->getValue('field')['fullField'])."_"), $_smarty_tpl);?>
 - <?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_select_time')->handle(array('time'=>$_smarty_tpl->getValue('field')['value'],'prefix'=>"CONDATETIME_".((string)$_smarty_tpl->getValue('field')['fullField'])."_"), $_smarty_tpl);?>

	<?php } elseif ($_smarty_tpl->getValue('field')['Type'] == 'text') {?>
		<textarea class="fld-form-input" name="<?php echo $_smarty_tpl->getValue('field')['fullField'];?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('field')['value'], ENT_QUOTES, 'UTF-8', true);?>
</textarea>
	<?php } elseif ($_smarty_tpl->getValue('field')['Type'] == 'enum') {?>
		<select class="fld-form-input" name="<?php echo $_smarty_tpl->getValue('field')['fullField'];?>
">
			<?php if ($_smarty_tpl->getValue('field')['Null'] == 'YES') {?><option value="">---</option><?php }?>
			<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('field')['Type_Enums'], 'enum');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('enum')->value) {
$foreach1DoElse = false;
?>
			<option value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('enum')['value'], ENT_QUOTES, 'UTF-8', true);?>
"<?php if ($_smarty_tpl->getValue('enum')['value'] == $_smarty_tpl->getValue('field')['value']) {?> selected="selected"<?php }?>><?php $_smarty_tpl->renderSubTemplate("file:constructors/form_enum.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('fullField'=>$_smarty_tpl->getValue('fullField'),'value'=>$_smarty_tpl->getValue('enum')['output']), (int) 0, $_smarty_current_dir);
?></option>
			<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
		</select>
	<?php } elseif ($_smarty_tpl->getValue('field')['Type'] == 'enum_radio') {?>
		<?php if ($_smarty_tpl->getValue('field')['Null'] == 'YES') {?><input type="radio" name="<?php echo $_smarty_tpl->getValue('field')['fullField'];?>
" value="" /><br /><?php }?>
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('field')['Type_Enums'], 'enum');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('enum')->value) {
$foreach2DoElse = false;
?>
			<input type="radio" name="<?php echo $_smarty_tpl->getValue('field')['fullField'];?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('enum')['value'], ENT_QUOTES, 'UTF-8', true);?>
"<?php if ($_smarty_tpl->getValue('enum')['value'] == $_smarty_tpl->getValue('field')['value']) {?> checked="checked"<?php }?> /><?php $_smarty_tpl->renderSubTemplate("file:constructors/form_enum.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('fullField'=>$_smarty_tpl->getValue('fullField'),'value'=>$_smarty_tpl->getValue('enum')['output']), (int) 0, $_smarty_current_dir);
?><br />
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
	<?php } elseif ($_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('field')['Field'],8,'',true) == 'password') {?>
		<input class="fld-form-input" name="<?php echo $_smarty_tpl->getValue('field')['fullField'];?>
" type="password" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('field')['value'], ENT_QUOTES, 'UTF-8', true);?>
" />
	<?php } else { ?>
		<input class="fld-form-input" name="<?php echo $_smarty_tpl->getValue('field')['fullField'];?>
" type="text" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('field')['value'], ENT_QUOTES, 'UTF-8', true);?>
" />
	<?php }?>
		</td>
	</tr>
	<?php $_smarty_tpl->assign('row_num', $_smarty_tpl->getValue('row_num')+1, false, NULL);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
	<tr>
		<td class="table-form-submit" colspan="2"><input class="fld-form-submit" type="submit" value="<?php echo $_smarty_tpl->getValue('lang')['submit'];?>
" /></td>
	</tr>
</table>
</form>
<?php }
}
