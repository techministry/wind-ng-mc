<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:23
  from 'file:includes/main_menu.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189d38d8142_05967726',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f850cd93a6f84959effd5999a871a07d3713143f' => 
    array (
      0 => 'includes/main_menu.tpl',
      1 => 1765893819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/qs.tpl' => 1,
    'file:generic/link.tpl' => 6,
  ),
))) {
function content_694189d38d8142_05967726 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes';
?><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-middle-left">
	<tr>
		<td class="small-menu">
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF">
					<td class="table-small-menu-text"><a href="<?php echo $_smarty_tpl->getValue('link_home');?>
" class="menu-link"><?php echo $_smarty_tpl->getValue('lang')['home'];?>
</a></td>
				</tr>
			  
		              <tr bgcolor="#FFFFFF">
					<td class="table-small-menu-text"><a href="../forum" class="menu-link">WNA forum</a></td>
				</tr>
			  
		<?php if ($_smarty_tpl->getValue('logged') == TRUE) {?>

				<!--<tr bgcolor="#FFFFFF">
					<td class="table-small-menu-text"><a href="<?php echo $_smarty_tpl->getValue('link_edit_profile');?>
" class="menu-link"><?php echo $_smarty_tpl->getValue('lang')['edit_profile'];?>
</a></td>
				  </tr>-->
				<tr bgcolor="#FFFFFF">
					<td class="table-small-menu-text"><a href="<?php echo $_smarty_tpl->getValue('link_logout');?>
" class="menu-link"><?php echo $_smarty_tpl->getValue('lang')['log_out'];?>
</a></td>
				</tr>
		
		<?php } else { ?>
	
								<tr bgcolor="#FFFFFF">
					<td class="table-small-menu-text"><a href="http://www.wna.gr/forum/member.php?action=register" class="menu-link"><?php echo $_smarty_tpl->getValue('lang')['register'];?>
</a></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td class="table-small-menu-text"><a href="http://www.wna.gr/forum/member.php?action=lostpw" class="menu-link"><?php echo $_smarty_tpl->getValue('lang')['password_recover'];?>
</a></td>
				</tr>

		 <?php }?>            

		 		<tr>
					<td class="table-middle-left-pad"></td>
			  	</tr>
			</table>
	  	</td>
	</tr>
	<tr>
		<td class="search-menu">
			<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-search-menu">
				<tr>
					<td class="table-search-menu-text"><img src="templates/basic/images/search_nodes.gif" width="16" height="16" alt="<?php echo $_smarty_tpl->getValue('lang')['all_nodes'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_allnodes');?>
"><?php echo $_smarty_tpl->getValue('lang')['all_nodes'];?>
</a></td>
			  	</tr>
			  					<tr>
					<td class="table-search-menu-text"><img src="templates/basic/images/dns-small.png" width="16" height="16" alt="<?php echo $_smarty_tpl->getValue('lang')['communities'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_communities');?>
"><?php echo $_smarty_tpl->getValue('lang')['communities'];?>
</a></td>
			  	</tr>
			  	<tr>
					<td class="table-search-menu-text"><img src="templates/basic/images/search_ip.gif" width="16" height="16" alt="<?php echo $_smarty_tpl->getValue('lang')['all_ranges'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_allranges');?>
"><?php echo $_smarty_tpl->getValue('lang')['all_ranges'];?>
</a></td>
				</tr>
				<tr>
					<td class="table-search-menu-text"><img src="templates/basic/images/services.gif" width="16" height="16" alt="<?php echo $_smarty_tpl->getValue('lang')['all_services'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_allservices');?>
"><?php echo $_smarty_tpl->getValue('lang')['all_services'];?>
</a></td>
		  		</tr>
			  	<tr>
					<td class="table-search-menu-text">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-search-menu">
							<tr>
								<td><img src="templates/basic/images/search.gif" width="32" height="32" alt="<?php echo $_smarty_tpl->getValue('lang')['quick_search'];?>
" /></td>
								<td style="font-size: 12px;">
									<form name="search" method="get" action="?">
									<?php $_smarty_tpl->renderSubTemplate("file:generic/qs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('qs'=>$_smarty_tpl->getValue('query_string')), (int) 0, $_smarty_current_dir);
?>
									<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-main">
										<tr>
											<td style="font-size: 12px;" width="100%">&nbsp;<?php echo $_smarty_tpl->getValue('lang')['quick_search'];?>
 <a href="javascript:document.search.submit()"><img src="templates/basic/images/submit1.png" alt="<?php echo $_smarty_tpl->getValue('lang')['submit'];?>
" /></a></td>
										</tr>
										<tr>
											<td>
												<div>
												<input type="text" id="q" name="q" autocomplete="off" onkeydown="" onfocus="hover('',this.value);" onkeyup="hover(event.keyCode,this.value);"  onblur="setTimeout('hideSearch()',500); hov=0;" />
												</div>
												<div align="left" id="searchResult" name="searchResult" style="font-family:Arial; font-size:12px; background-color: white; border:#000000 dashed 1px; padding:0px; display: none; position: absolute; width: 150px;"></div>
											</td>
										</tr>
									</table>
									</form>
								</td>
							</tr>
						</table>
					</td>
			  	</tr>
			  	<tr>
					<td class="table-middle-left-pad"></td>
			  	</tr>
			</table>
		</td>
	</tr>

	<tr>
    	<td class="search-menu">
			<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-search-menu">
				<tr>
					<td colspan="2" class="quick-login-title"><?php echo $_smarty_tpl->getValue('lang')['statistics'];?>
</td>
			  	</tr>
			  	<tr>
					<td rowspan="6" class="quick-login-text"><img src="templates/basic/images/stats.png" width="48" height="48" alt="<?php echo $_smarty_tpl->getValue('lang')['statistics'];?>
" /></td>
					<td class="quick-login-text"><?php echo $_smarty_tpl->getValue('stats_communities');?>
 <span style="color: black;">Wireless Communities</span>
<br><?php echo $_smarty_tpl->getValue('stats_nodes_active');?>
/<?php echo $_smarty_tpl->getValue('stats_nodes_total');?>
 <span style="color: black;"><?php echo mb_strtolower((string) $_smarty_tpl->getValue('lang')['active_nodes'], 'UTF-8');?>
</span></td>
					
			  	</tr>
							  	
			  	<tr>
					<td class="quick-login-text"><?php echo $_smarty_tpl->getValue('stats_backbone');?>
 <span style="color: black;"><?php echo mb_strtolower((string) $_smarty_tpl->getValue('lang')['backbone_nodes'], 'UTF-8');?>
</span></td>
			  	</tr>
			  	<tr>
					<td class="quick-login-text"><?php echo $_smarty_tpl->getValue('stats_links');?>
 <span style="color: black;"><?php echo mb_strtolower((string) $_smarty_tpl->getValue('lang')['links'], 'UTF-8');?>
</span></td>
			  	</tr>
				
			  	<tr>
					<td class="quick-login-text"><?php echo $_smarty_tpl->getValue('stats_aps');?>
 <span style="color: black;"><?php echo mb_strtolower((string) $_smarty_tpl->getValue('lang')['aps'], 'UTF-8');?>
</span>
					<br><?php echo $_smarty_tpl->getValue('stats_hotspots');?>
 <span style="color: black;">Hotspots</span></td>
			  	</tr>
				
			  	<tr>
					<td class="quick-login-text"><?php echo $_smarty_tpl->getValue('stats_services_active');?>
/<?php echo $_smarty_tpl->getValue('stats_services_total');?>
 <span style="color: black;"><?php echo mb_strtolower((string) $_smarty_tpl->getValue('lang')['active_services'], 'UTF-8');?>
</span></td>
			  </tr>
			  	<tr>
					<td colspan="2" class="table-middle-left-pad"></td>
			  	</tr>
			</table>
        </td>
	</tr>

   <?php if ($_smarty_tpl->getValue('logged') == TRUE) {?>

   <tr>
		<td class="search-menu">
			<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-mynodes">
				<tr>
					<td rowspan="2" class="table-mynodes-image" ><img src="templates/basic/images/node.gif" alt="<?php echo $_smarty_tpl->getValue('lang')['mynodes'];?>
" /></td>
					<td class="table-mynodes-title"><?php echo $_smarty_tpl->getValue('lang')['mynodes'];?>
</td>
				</tr>
				<tr>
					<td class="table-mynodes-link">|<a href="<?php echo $_smarty_tpl->getValue('link_addnode');?>
"><?php echo $_smarty_tpl->getValue('lang')['node_add'];?>
</a>|</td>
				</tr>
			</table>
			<table width="100%"  border="0" cellpadding="0" cellspacing="0"><tr class="table-form-row2">
			<td class="table-form-title"><img src="templates/basic/images/node-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['mynodes'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('mynodes')[($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)]['url_view'];?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('home_node')[($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)]['name'], ENT_QUOTES, 'UTF-8', true);?>
 (#<?php echo $_smarty_tpl->getValue('home_node')[($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)]['id'];?>
)</a>&nbsp;
					<br />
					<span style="font-weight:bold; font-size: 7px; color: orange;">|<a href="<?php echo $_smarty_tpl->getValue('mynodes')[($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)]['url'];?>
"><?php echo $_smarty_tpl->getValue('lang')['edit_node'];?>

					<img src="templates/basic/images/submit1.png" alt="<?php echo $_smarty_tpl->getValue('lang')['node'];?>
" /></a>|</span>	
										
					</td>
			</tr>
			<?php
$__section_row_0_loop = (is_array(@$_loop=$_smarty_tpl->getValue('mynodes')) ? count($_loop) : max(0, (int) $_loop));
$__section_row_0_total = $__section_row_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_row'] = new \Smarty\Variable(array());
if ($__section_row_0_total !== 0) {
for ($__section_row_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_row']->value['index'] = 0; $__section_row_0_iteration <= $__section_row_0_total; $__section_row_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_row']->value['index']++){
?>
					
			<?php if ((1 & ($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null))) {?>
				<tr class="table-form-row2">
			<?php } else { ?>
				<tr class="table-form-row1">
			<?php }?>
					<td class="table-form-title"><img src="templates/basic/images/node-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['mynodes'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('mynodes')[($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)]['url_view'];?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('mynodes')[($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)]['name'], ENT_QUOTES, 'UTF-8', true);?>
 (#<?php echo $_smarty_tpl->getValue('mynodes')[($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)]['id'];?>
)</a>&nbsp;
					<br />
					<span style="font-weight:bold; font-size: 7px; color: orange;">|<a href="<?php echo $_smarty_tpl->getValue('mynodes')[($_smarty_tpl->getValue('__smarty_section_row')['index'] ?? null)]['url'];?>
"><?php echo $_smarty_tpl->getValue('lang')['edit_node'];?>

					<img src="templates/basic/images/submit1.png" alt="<?php echo $_smarty_tpl->getValue('lang')['node'];?>
" /></a>|</span>
					<span style="font-weight:bold; font-size: 7px; color: orange;">|<a href="javascript:alert('Λυπούμαστε, αλλα αυτή η επιλογή δεν είναι έτοιμη ακόμα');">Αποστολή ενημέρωσης χρηστών</a></a>|</span>
					
					
					</td>
				</tr>
			<?php
}
}
?>
				<tr>
					<td class="table-middle-left-pad"></td>
				</tr>
			</table>
		</td>
	</tr>
					
	<?php if ($_smarty_tpl->getValue('is_admin') === TRUE) {?>
					
	<tr>
		<td class="search-menu">
			<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-mynodes">
				<tr>
					<td class="table-mynodes-image" ><img src="templates/basic/images/admin.gif" alt="<?php echo $_smarty_tpl->getValue('lang')['admin_panel'];?>
" /></td><td class="table-mynodes-title" ><?php echo $_smarty_tpl->getValue('lang')['admin_panel'];?>
</td>
				</tr>
				<?php if ($_smarty_tpl->getValue('link_admin_nodes') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/node-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['nodes'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_admin_nodes');?>
"><?php echo $_smarty_tpl->getValue('lang')['nodes'];?>
</a></td>
				</tr>
				<?php }?>
				<?php if ($_smarty_tpl->getValue('link_admin_users') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/user-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['users'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_admin_users');?>
"><?php echo $_smarty_tpl->getValue('lang')['users'];?>
</a></td>
				</tr>
				<?php }?>
				<?php if ($_smarty_tpl->getValue('link_admin_nodes_services') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/services-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['services'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_admin_nodes_services');?>
"><?php echo $_smarty_tpl->getValue('lang')['services'];?>
</a></td>
				</tr>
				<?php }?>
				<?php if ($_smarty_tpl->getValue('link_admin_services') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/services-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['services_categories'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_admin_services');?>
"><?php echo $_smarty_tpl->getValue('lang')['services_categories'];?>
</a></td>
				</tr>
				<?php }?>
				<?php if ($_smarty_tpl->getValue('link_admin_regions') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/regions-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['regions'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_admin_regions');?>
"><?php echo $_smarty_tpl->getValue('lang')['regions'];?>
</a></td>
				</tr>
				<?php }?>
				<?php if ($_smarty_tpl->getValue('link_admin_areas') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/areas-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['areas'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_admin_areas');?>
"><?php echo $_smarty_tpl->getValue('lang')['areas'];?>
</a></td>
				</tr>
				<?php }?>
				<?php if ($_smarty_tpl->getValue('link_admin_communities') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/areas-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['areas'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_admin_communities');?>
">wireless communities</a></td>
				</tr>
				<?php }?>
				<?php if ($_smarty_tpl->getValue('link_admin_actionlog') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/areas-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['areas'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_admin_actionlog');?>
">action log</a></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="2" class="table-middle-left-pad"></td>
				</tr>
			</table>
		</td>
	</tr>
	<?php }?>
					
	<?php if ($_smarty_tpl->getValue('is_admin') === TRUE || $_smarty_tpl->getValue('is_hostmaster') === TRUE) {?>
					
	<tr>
		<td class="search-menu">
			<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-mynodes">
				<tr>
					<td class="table-mynodes-image" ><img src="templates/basic/images/admin.gif" alt="<?php echo $_smarty_tpl->getValue('lang')['hostmaster_panel'];?>
" /></td><td class="table-mynodes-title" ><?php echo $_smarty_tpl->getValue('lang')['hostmaster_panel'];?>
</td>
				</tr>
				<?php if ($_smarty_tpl->getValue('link_ranges') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/node-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['ip_ranges'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_ranges');?>
"><?php echo $_smarty_tpl->getValue('lang')['ip_ranges'];?>
</a></td>
				</tr>
				<tr>
					<td colspan="2" class="menu-small-links"><?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_ranges_waiting'),'content'=>((string)$_smarty_tpl->getValue('ranges_waiting'))." ".((string)$_smarty_tpl->getValue('lang')['waiting'])), (int) 0, $_smarty_current_dir);
?> <?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_ranges_req_del'),'content'=>((string)$_smarty_tpl->getValue('ranges_req_del'))." ".((string)$_smarty_tpl->getValue('lang')['for_deletion'])), (int) 0, $_smarty_current_dir);
?></td>
				</tr>
				<?php }?>
				<?php if ($_smarty_tpl->getValue('link_dnszones') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/dns-small.png" alt="<?php echo $_smarty_tpl->getValue('lang')['dns_zones'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_dnszones');?>
"><?php echo $_smarty_tpl->getValue('lang')['dns_zones'];?>
</a></td>
				</tr>
				<tr>
					<td colspan="2" class="menu-small-links"><?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_dnszones_waiting'),'content'=>((string)$_smarty_tpl->getValue('dnszones_waiting'))." ".((string)$_smarty_tpl->getValue('lang')['waiting'])), (int) 0, $_smarty_current_dir);
?> <?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_dnszones_req_del'),'content'=>((string)$_smarty_tpl->getValue('dnszones_req_del'))." ".((string)$_smarty_tpl->getValue('lang')['for_deletion'])), (int) 0, $_smarty_current_dir);
?></td>
				</tr>
				<?php }?>
				<?php if ($_smarty_tpl->getValue('link_dnsnameservers') != '') {?>
				<tr class="table-form-row1">
					<td colspan="2" class="table-form-title"><img src="templates/basic/images/nameserver.gif" alt="<?php echo $_smarty_tpl->getValue('lang')['dns_nameservers'];?>
" />&nbsp;<a href="<?php echo $_smarty_tpl->getValue('link_dnsnameservers');?>
"><?php echo $_smarty_tpl->getValue('lang')['dns_nameservers'];?>
</a></td>
				</tr>
				<tr>
					<td colspan="2" class="menu-small-links"><?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_dnsnameservers_waiting'),'content'=>((string)$_smarty_tpl->getValue('dnsnameservers_waiting'))." ".((string)$_smarty_tpl->getValue('lang')['waiting'])), (int) 0, $_smarty_current_dir);
?> <?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_dnsnameservers_req_del'),'content'=>((string)$_smarty_tpl->getValue('dnsnameservers_req_del'))." ".((string)$_smarty_tpl->getValue('lang')['for_deletion'])), (int) 0, $_smarty_current_dir);
?></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="2" class="table-middle-left-pad"></td>
				</tr>
			</table>
		</td>
	</tr>
	<?php }?>
					
  	<?php }?>
</table>
<?php }
}
