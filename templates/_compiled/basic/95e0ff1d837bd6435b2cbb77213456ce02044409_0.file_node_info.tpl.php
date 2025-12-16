<?php
/* Smarty version 5.7.0, created on 2025-12-16 19:52:46
  from 'file:includes/pages/nodes/node_info.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941b88e5a8fb6_17916410',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95e0ff1d837bd6435b2cbb77213456ce02044409' => 
    array (
      0 => 'includes/pages/nodes/node_info.tpl',
      1 => 1765893819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/link.tpl' => 1,
  ),
))) {
function content_6941b88e5a8fb6_17916410 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\nodes';
?><!-- start node_info_tpl -->
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="table-node">
<tr>
<td class="table-node-key"> <?php echo $_smarty_tpl->getValue('lang')['db']['nodes__id'];?>
</td>
<td class="table-node-value"><?php echo $_smarty_tpl->getValue('node')['id'];?>
</td>
</tr>
<tr>
<td class="table-node-key"> <?php echo $_smarty_tpl->getValue('lang')['db']['nodes__name'];?>
</td>
<td class="table-node-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('node')['name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
</tr>
<tr>
<td class="table-node-key"> <?php echo $_smarty_tpl->getValue('lang')['db']['areas__name'];?>
</td>
<td class="table-node-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('node')['area_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
</tr>
<tr>
<td class="table-node-key"> <?php echo $_smarty_tpl->getValue('lang')['db']['regions__name'];?>
</td>
<td class="table-node-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('node')['region_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
</tr>
<tr>
<td class="table-node-key"> <?php echo $_smarty_tpl->getValue('lang')['community'];?>
</td>
<td class="table-node-value">
<a style="border-bottom: 1px dotted rgb(51, 102, 187); text-decoration: none; cursor: help;" title="Πατήστε εδώ για να μάθετε περισσότερα για την κοινότητα αυτή " href="../wiki/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('node')['community_name'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('node')['community_name'], ENT_QUOTES, 'UTF-8', true);?>
</a></td>
</tr>

<?php if ($_smarty_tpl->getValue('node')['community_name'] != 'WNA') {?> 
<td class="table-node-key"> Local Community node page</td>
<td class="table-node-value">
<a style="border-bottom: 1px dotted rgb(51, 102, 187); text-decoration: none; cursor: help;" title="Πατήστε εδώ για να μεταβείτε στην σελίδα του κόμβου αυτού στην τοπική κοινότητα " target="_new" href="<?php echo $_smarty_tpl->getValue('node')['community_windURL'];?>
/?page=nodes&node=<?php echo $_smarty_tpl->getValue('node')['com_wind_id'];?>
"><?php echo $_smarty_tpl->getValue('node')['com_wind_id'];?>
</a></td>
</tr>
<?php }?> 

<!--<td class="table-node-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('node')['com_wind_id'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td class="table-node-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('node')['TOS'], ENT_QUOTES, 'UTF-8', true);?>
</td>-->

<tr>
<td class="table-node-key"> <?php echo $_smarty_tpl->getValue('lang')['db']['nodes__date_in'];?>
</td>
<td class="table-node-value"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('node')['date_in'],"%x");?>
</td>
</tr>
<tr>-</tr>
<tr>
<?php if ($_smarty_tpl->getValue('is_admin')) {?> 
<td class="table-node-key"> Παροχή Internet<?php echo $_smarty_tpl->getValue('lang')['db']['nodes__internetaccess'];?>
</td>
<td class="table-node-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('node')['internetaccess'], ENT_QUOTES, 'UTF-8', true);?>
</td>
</tr>
<tr>
<td class="table-node-key"> Πάροχος Internet <?php echo $_smarty_tpl->getValue('lang')['db']['nodes__internetprovider'];?>
</td>
<td class="table-node-value"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('node')['internetprovider'], ENT_QUOTES, 'UTF-8', true);?>
</td>
</tr>
<?php }?>

<tr>
<td class="table-node-key"><?php echo $_smarty_tpl->getValue('lang')['db']['user_id_owner'];?>
</td>
<td class="table-node-value"><a href="/forum/userinfo.php?username=<?php echo $_smarty_tpl->getValue('node')['owner_username'];?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('node')['owner_username'], ENT_QUOTES, 'UTF-8', true);?>
 (contact)</a> 
 | <a href="/forum/searchnodes.php?username=<?php echo $_smarty_tpl->getValue('node')['owner_username'];?>
">Other nodes</a>
<!--  <?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('onclick'=>"javascript: t = window.open('".((string)$_smarty_tpl->getValue('link_contact'))."', 'contact', 'width=700,height=600,toolbar=0,resizable=1,scrollbars=1'); t.focus(); return false;",'content'=>$_smarty_tpl->getValue('lang')['contact']), (int) 0, $_smarty_current_dir);
?>--></td>
</tr>
</table>

<!-- end node_info_tpl --><?php }
}
