<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:16:28
  from 'file:includes/body.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941be1c00d0f0_14994589',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6340787e3ef0ace085460f61fb122a6cd6c6d06c' => 
    array (
      0 => 'includes/body.tpl',
      1 => 1765893819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:includes/main_menu_logged.tpl' => 1,
  ),
))) {
function content_6941be1c00d0f0_14994589 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes';
?><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-main">
  <?php if ($_smarty_tpl->getValue('header') != '') {?>
  <tr>
    <td <?php if ($_smarty_tpl->getValue('menu') != '') {?>colspan="2" <?php }?>class="table-main-td-header"><?php echo $_smarty_tpl->getValue('header');?>
</td>
  </tr>
  <?php }?>
  
  <tr>
  <?php if ($_smarty_tpl->getValue('menu') != '') {?>
    <td class="table-main-td-middle"><?php echo $_smarty_tpl->getValue('menu');?>
</td>
  <?php }?>
    
    
    <td class="table-middle-right-td">
	<table border="0" cellpadding="0" cellspacing="0" class="table-middle-right">
  	<?php if ($_smarty_tpl->getValue('menu') != '') {?>
		<tr>
			<td class="quick-login" width="100%">
			<?php if ($_smarty_tpl->getValue('logged')) {?>
				<?php $_smarty_tpl->renderSubTemplate("file:includes/main_menu_logged.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
			<?php } else { ?>
				<?php echo $_smarty_tpl->getValue('form_login');?>

			<?php }?>
			</td>
			<td nowrap="nowrap" class="quick-login-field">
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('languages'), 'item', false, 'key');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('key')->value => $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
				<a href="<?php echo $_smarty_tpl->getValue('item')['link'];?>
"><img alt="<?php echo $_smarty_tpl->getValue('item')['name'];?>
" src="<?php echo $_smarty_tpl->getValue('img_dir');?>
flags/<?php echo $_smarty_tpl->getValue('key');?>
.gif" /></a> 
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</td>
		</tr>
	  <?php }?>
		<tr>
			<td class="main-page" colspan="2">
    			<?php if ($_smarty_tpl->getValue('message') == '') {?>
					<?php echo $_smarty_tpl->getValue('center');?>

    			<?php } else { ?>
    				<table width="100%" border="0" cellpadding="50" cellspacing="0">
    					<tr>
    						<td align="center">
    							<?php echo $_smarty_tpl->getValue('message');?>

    						</td>
    					</tr>
    				</table>
    			<?php }?>
			</td>
		</tr>
	</table>
	
	</td>
</tr>
    
  <?php if ($_smarty_tpl->getValue('footer') != '') {?>
  <tr>
    <td <?php if ($_smarty_tpl->getValue('menu') != '') {?>colspan="2" <?php }?>class="table-main-td-footer"><?php echo $_smarty_tpl->getValue('footer');?>
</td>
  </tr>
  <?php }?>
</table>
<?php }
}
