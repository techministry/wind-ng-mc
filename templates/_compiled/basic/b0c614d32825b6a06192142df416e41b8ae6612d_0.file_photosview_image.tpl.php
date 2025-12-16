<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:56:07
  from 'file:generic/photosview_image.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941c767998900_93717723',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0c614d32825b6a06192142df416e41b8ae6612d' => 
    array (
      0 => 'generic/photosview_image.tpl',
      1 => 1765893818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6941c767998900_93717723 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\generic';
?><div align="center">
<?php if ($_smarty_tpl->getValue('image')['image'] != '') {?>
<a  href="<?php echo $_smarty_tpl->getValue('image')['image'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->getValue('image')['image_s'];?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('image')['info'], ENT_QUOTES, 'UTF-8', true);?>
" /></a>
<?php } else { ?>
<img src="" alt="" width="200" height="200" />
<?php }?>
</div><?php }
}
