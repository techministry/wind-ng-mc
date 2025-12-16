<?php
/* Smarty version 5.7.0, created on 2025-12-16 19:53:13
  from 'file:includes\pages\nodes/nodes_plot_link.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941b8a9ea6f61_89072046',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e62406ab33e466bdc62e69f443d0d6dd55504e1' => 
    array (
      0 => 'includes\\pages\\nodes/nodes_plot_link.tpl',
      1 => 1765902792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/page-title.tpl' => 1,
    'file:generic/link.tpl' => 3,
  ),
))) {
function content_6941b8a9ea6f61_89072046 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\nodes';
?><table cellpadding="0" cellspacing="0" class="table-main">
	<tr>
		<td>
			<?php $_smarty_tpl->renderSubTemplate("file:generic/page-title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['nodes_plot_link'])), (int) 0, $_smarty_current_dir);
?>
		</td>
	</tr>
	<tr>
		<td height="100%">
			<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->getValue('js_dir');?>
pickup.js"><?php echo '</script'; ?>
>
			<form style="height:100%;" name="form_nodes_plot_link" method="post" action="?">
			<input type="hidden" name="query_string" value="<?php echo $_smarty_tpl->getValue('hidden_qs');?>
" />
			<table cellpadding="4" cellspacing="0" class="plot-link-table">
				<tr>
					<td width="25%" align="left">
						<?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('content'=>((string)$_smarty_tpl->getValue('lang')['change']),'onclick'=>"javascript: t = window.open('?page=pickup&subpage=nodes&object=form_nodes_plot_link.a_node', 'popup_pickup', 'width=700,height=600,toolbar=0,resizable=1,scrollbars=1'); t.focus(); return false;"), (int) 0, $_smarty_current_dir);
?>
						<br />
						<input type="hidden" name="a_node" value="<?php echo $_smarty_tpl->getValue('a_node');?>
" />
						<input class="fld-form-input-pickup" type="text" disabled="disabled" name="a_node_output" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('a_node_output'), ENT_QUOTES, 'UTF-8', true);?>
" />
					</td>
					<td width="50%" align="center">
						<input class="fld-form-submit" type="submit" name="submitbutton" value="<?php echo $_smarty_tpl->getValue('lang')['submit'];?>
" />
					</td>
					<td width="25%" align="right">
						<?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('content'=>((string)$_smarty_tpl->getValue('lang')['change']),'onclick'=>"javascript: t = window.open('?page=pickup&subpage=nodes&object=form_nodes_plot_link.b_node', 'popup_pickup', 'width=700,height=600,toolbar=0,resizable=1,scrollbars=1'); t.focus(); return false;"), (int) 0, $_smarty_current_dir);
?>
						<br />
						<input type="hidden" name="b_node" value="<?php echo $_smarty_tpl->getValue('b_node');?>
" />
						<input style="text-align:right;" class="fld-form-input-pickup" type="text" disabled="disabled" name="b_node_output" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('b_node_output'), ENT_QUOTES, 'UTF-8', true);?>
" />
					</td>
				</tr>
				<?php if ($_smarty_tpl->getValue('a_node') != '' && $_smarty_tpl->getValue('b_node') != '') {?>
				<tr>
					<td align="left">
						<?php echo $_smarty_tpl->getValue('lang')['azimuth'];?>
: <?php echo round((float) $_smarty_tpl->getValue('a_node_azimuth'), (int) 2, (int) 1);?>
&#176;<br />
						<?php echo $_smarty_tpl->getValue('lang')['elevation'];?>
: <?php echo round((float) $_smarty_tpl->getValue('a_node_geo_elevation'), (int) 0, (int) 1);?>
 (+<?php echo round((float) $_smarty_tpl->getValue('a_node_elevation'), (int) 0, (int) 1);?>
) m<br />
						<?php echo $_smarty_tpl->getValue('lang')['tilt'];?>
: <?php echo round((float) $_smarty_tpl->getValue('a_node_tilt'), (int) 2, (int) 1);?>
&#176;
					</td>
					<td align="center">
						<--- <?php echo $_smarty_tpl->getValue('lang')['distance'];?>
: <?php echo round((float) $_smarty_tpl->getValue('distance'), (int) 3, (int) 1);?>
 km ---><br />
						<span style="color: brown;">
							<?php echo $_smarty_tpl->getValue('lang')['fsl'];?>
:<br />
							<?php echo round((float) $_smarty_tpl->getValue('fsl'), (int) 2, (int) 1);?>
 dBm @ 
							<select name="frequency" onchange="this.form.submit();" style="font-size: 10px;">
								<option value="2450"<?php if ($_smarty_tpl->getValue('frequency') == 2450) {?> selected="selected"<?php }?>>2450</option>
								<option value="5500"<?php if ($_smarty_tpl->getValue('frequency') == 5500) {?> selected="selected"<?php }?>>5500</option>
							</select>
	 						MHz
						</span>
					</td>
					<td align="right">
						<?php echo $_smarty_tpl->getValue('lang')['azimuth'];?>
: <?php echo round((float) $_smarty_tpl->getValue('b_node_azimuth'), (int) 2, (int) 1);?>
&#176;<br />
						<?php echo $_smarty_tpl->getValue('lang')['elevation'];?>
: <?php echo round((float) $_smarty_tpl->getValue('b_node_geo_elevation'), (int) 0, (int) 1);?>
 (+<?php echo round((float) $_smarty_tpl->getValue('b_node_elevation'), (int) 0, (int) 1);?>
) m<br />
						<?php echo $_smarty_tpl->getValue('lang')['tilt'];?>
: <?php echo round((float) $_smarty_tpl->getValue('b_node_tilt'), (int) 2, (int) 1);?>
&#176;
					</td>
				</tr>
				<tr>
					<td height="100%" colspan="3" align="center"><img src="<?php echo $_smarty_tpl->getValue('plot_image');?>
&amp;width=570&amp;height=250" width="570" height="250" /></td>
				</tr>
				<tr>
					<td colspan="3" align="right"><?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('content'=>((string)$_smarty_tpl->getValue('lang')['google_earth']),'link'=>((string)$_smarty_tpl->getValue('gearth'))), (int) 0, $_smarty_current_dir);
?></td>
				</tr>
				<?php } else { ?>
				<tr>
					<td height="100%" colspan="3" align="center"><?php echo smarty_mb_wordwrap($_smarty_tpl->getValue('lang')['nodes_plot_link_info'],40,"<br />",false);?>
</td>
				</tr>
				<?php }?>
			</table>
			</form>
		</td>
	</tr>
</table><?php }
}
