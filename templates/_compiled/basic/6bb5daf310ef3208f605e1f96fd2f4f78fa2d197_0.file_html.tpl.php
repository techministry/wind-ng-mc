<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:54:54
  from 'file:includes/html.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941c71edcebd0_40178522',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6bb5daf310ef3208f605e1f96fd2f4f78fa2d197' => 
    array (
      0 => 'includes/html.tpl',
      1 => 1765918484,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6941c71edcebd0_40178522 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes';
echo '<?'; ?>
xml version="1.0" encoding="<?php echo $_smarty_tpl->getValue('lang')['charset'];?>
"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->getValue('lang')['iso639'];?>
" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->getValue('lang')['charset'];?>
" />
<?php echo $_smarty_tpl->getValue('head');?>

<link href="<?php echo $_smarty_tpl->getValue('css_dir');?>
styles.css" rel="stylesheet" type="text/css" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getValue('js_dir');?>
overlib/overlib.js"><!-- overLIB (c) Erik Bosrup --><?php echo '</script'; ?>
>
<!-- tabs - wavesoft@wna.gr -->
<link href="<?php echo $_smarty_tpl->getValue('css_dir');?>
wavetabs.css" rel="stylesheet" type="text/css" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getValue('js_dir');?>
mootools-compact-1.3.1.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->getValue('js_dir');?>
wavetabs.js"><?php echo '</script'; ?>
>
</head>
<body<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('body_tags'), 'item', false, 'key');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('key')->value => $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?> <?php echo $_smarty_tpl->getValue('key');?>
="<?php echo $_smarty_tpl->getValue('item');?>
"<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<?php echo $_smarty_tpl->getValue('body');?>

</body>
</html><?php }
}
