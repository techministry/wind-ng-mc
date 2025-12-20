<?php
/*
 * WiND - Wireless Nodes Database
 *
 * Copyright (C) 2005 Nikolaos Nikalexis <winner@cube.gr>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 dated June, 1991.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

class menu {
	
	var $tpl;
	var $hide=FALSE;
	
	function __construct() {
		$this->tpl = array();
	}
	
	function form_login() {
		$form_login = new form(array('FORM_NAME' => 'form_login'));
		$form_login->db_data('users.username, users.password');
		return $form_login;
	}

	function output() {
		if ($this->hide) return;
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && method_exists($this, 'output_onpost_'.$_POST['form_name'])) call_user_func(array($this, 'output_onpost_'.$_POST['form_name']));
		global $construct, $main, $db, $vars, $lang;
		$this->tpl['logged'] = $main->userdata->logged;
		$this->tpl['form_login'] = $construct->form($this->form_login(), __FILE__);
			
		$main->html->body->tpl['form_login'] = $this->tpl['form_login'];
		$main->html->body->tpl['logged_username'] = isset($main->userdata->info['username'])?$main->userdata->info['username']:null;
		#@#
				if (isset($main->userdata->privileges['cadmin']) && $main->userdata->privileges['cadmin'] === TRUE) { 
				$main->html->body->tpl['logged_username'] =$main->html->body->tpl['logged_username']." "."{ Community Admin }";
				}
				if (isset($main->userdata->privileges['admin']) && $main->userdata->privileges['admin'] === TRUE) { 
				$main->html->body->tpl['logged_username'] =$main->html->body->tpl['logged_username']." "."{ Administrator }";
				}
		#@#
		$main->html->body->tpl['link_logged_profile'] = makelink(array("page" => "users", "user" => $main->userdata->user));
		$main->html->body->tpl['link_logout'] = makelink(array("page" => "users", "action" => "logout", "ts" => time()));
		$main->html->body->tpl['logged'] = $main->userdata->logged;
		//dump($main->html->body->tpl);
		foreach($vars['language']['enabled'] as $key => $value) {
			if ($value) {
				$main->html->body->tpl['languages'][$key]['name'] = ($lang['languages'][$key]==''?$key:$lang['languages'][$key]);
				$main->html->body->tpl['languages'][$key]['link'] = makelink(array("session_lang" => $key), TRUE);
			}
		}
		
		if ($main->userdata->logged) {
			$this->tpl = array_merge_check($this->tpl, $main->userdata->info);
			$this->tpl['mynodes'] = $db->get('nodes.id, nodes.name', 'nodes INNER JOIN users_nodes ON nodes.id = users_nodes.node_id', "users_nodes.user_id = '".$main->userdata->user."'");
			#@#
			$home_node_id = isset($main->userdata->home_node) ? $main->userdata->home_node : '';
			if ($home_node_id) {
				$this->tpl['home_node'] = $db->get('nodes.id, nodes.name', 'nodes INNER JOIN users_nodes ON nodes.id = users_nodes.node_id', "nodes.id = '".$home_node_id."'");
				if (!empty($this->tpl['home_node'][0]['id'])) {
					$this->tpl['home_node'][0]['url'] = makelink(array("page" => "mynodes", "node" => $this->tpl['home_node'][0]['id']));
					$this->tpl['home_node'][0]['url_view'] = makelink(array("page" => "nodes", "node" => $this->tpl['home_node'][0]['id']));
				}
			} else {
				$this->tpl['home_node'] = array();
			}
			#@#
			foreach( (array) $this->tpl['mynodes'] as $key => $value) {
				$this->tpl['mynodes'][$key]['url'] = makelink(array("page" => "mynodes", "node" => $this->tpl['mynodes'][$key]['id']));
				$this->tpl['mynodes'][$key]['url_view'] = makelink(array("page" => "nodes", "node" => $this->tpl['mynodes'][$key]['id']));
			}
			$this->tpl['link_addnode'] = makelink(array("page" => "mynodes", "node" => "add"));
			$this->tpl['link_edit_profile'] = makelink(array("page" => "users", "user" => $main->userdata->user));
			if ($main->userdata->privileges['admin'] === TRUE) {
				$this->tpl['is_admin'] = TRUE;
				$this->tpl['link_admin_nodes'] = makelink(array("page" => "admin", "subpage" => "nodes"));
				$this->tpl['link_admin_users'] = makelink(array("page" => "admin", "subpage" => "users"));
				$this->tpl['link_admin_nodes_services'] = makelink(array("page" => "admin", "subpage" => "nodes_services"));
				$this->tpl['link_admin_services'] = makelink(array('page' => 'admin', 'subpage' => 'services'));
				$this->tpl['link_admin_regions'] = makelink(array('page' => 'admin', 'subpage' => 'regions'));
				$this->tpl['link_admin_areas'] = makelink(array('page' => 'admin', 'subpage' => 'areas'));
				$this->tpl['link_admin_communities'] = makelink(array('page' => 'admin', 'subpage' => 'communities'));
				$this->tpl['link_admin_actionlog'] = makelink(array('page' => 'admin', 'subpage' => 'actionlog'));
				$this->tpl['link_admin_site'] = makelink(array('page' => 'admin', 'subpage' => 'site'));
			}
			if (isset($main->userdata->privileges['cadmin']) && $main->userdata->privileges['cadmin'] === TRUE) {
				$this->tpl['is_admin'] = TRUE;
				$this->tpl['link_admin_areas'] = makelink(array('page' => 'admin', 'subpage' => 'areas'));
				$this->tpl['link_admin_nodes'] = makelink(array("page" => "admin", "subpage" => "nodes"));
				$this->tpl['link_admin_users'] = "";# makelink(array("page" => "admin", "subpage" => "users"));
				$this->tpl['link_admin_nodes_services'] ="";#  makelink(array("page" => "admin", "subpage" => "nodes_services"));
				$this->tpl['link_admin_services'] =  makelink(array('page' => 'admin', 'subpage' => 'services'));
				$this->tpl['link_admin_regions'] = "";# makelink(array('page' => 'admin', 'subpage' => 'regions'));
				$this->tpl['link_admin_communities'] ="";#  makelink(array('page' => 'admin', 'subpage' => 'communities'));
				# <a href="javascript:alert('Access Denied');"></a>
				$this->tpl['is_hostmaster'] = TRUE;
				$this->tpl['link_ranges'] = makelink(array("page" => "hostmaster", "subpage" => "ranges"));
				$this->tpl['link_ranges_waiting'] = makelink(array("page" => "hostmaster", "subpage" => "ranges", "form_search_ranges_search" => serialize(array("ip_ranges__status" => "waiting", "ip_ranges__delete_req" => "N"))));
				$this->tpl['ranges_waiting'] = $db->cnt('', "ip_ranges", "status = 'waiting' AND delete_req = 'N'");
				$this->tpl['link_ranges_req_del'] = makelink(array("page" => "hostmaster", "subpage" => "ranges", "form_search_ranges_search" => serialize(array("ip_ranges__delete_req" => "Y"))));
				$this->tpl['ranges_req_del'] = $db->cnt('', "ip_ranges", "delete_req = 'Y'");
			}
			if ($main->userdata->privileges['admin'] === TRUE || $main->userdata->privileges['hostmaster'] === TRUE) {
				$this->tpl['is_hostmaster'] = TRUE;

				$this->tpl['link_dnsnameservers'] = makelink(array("page" => "hostmaster", "subpage" => "dnsnameservers"));
				$this->tpl['link_dnsnameservers_waiting'] = makelink(array("page" => "hostmaster", "subpage" => "dnsnameservers", "form_search_nameservers_search" => serialize(array("dns_nameservers__status" => "waiting", "dns_nameservers__delete_req" => "N"))));
				$this->tpl['dnsnameservers_waiting'] = $db->cnt('', "dns_nameservers", "status = 'waiting' AND delete_req = 'N'");
				$this->tpl['link_dnsnameservers_req_del'] = makelink(array("page" => "hostmaster", "subpage" => "dnsnameservers", "form_search_nameservers_search" => serialize(array("dns_nameservers__delete_req" => "Y"))));
				$this->tpl['dnsnameservers_req_del'] = $db->cnt('', "dns_nameservers", "delete_req = 'Y'");

				$this->tpl['link_dnszones'] = makelink(array("page" => "hostmaster", "subpage" => "dnszones"));
				$this->tpl['link_dnszones_waiting'] = makelink(array("page" => "hostmaster", "subpage" => "dnszones", "form_search_dns_search" => serialize(array("dns_zones__status" => "waiting", "dns_zones__delete_req" => "N"))));
				$this->tpl['dnszones_waiting'] = $db->cnt('', "dns_zones", "status = 'waiting' AND delete_req = 'N'");
				$this->tpl['link_dnszones_req_del'] = makelink(array("page" => "hostmaster", "subpage" => "dnszones", "form_search_dns_search" => serialize(array("dns_zones__delete_req" => "Y"))));
				$this->tpl['dnszones_req_del'] = $db->cnt('', "dns_zones", "delete_req = 'Y'");

				$this->tpl['link_ranges'] = makelink(array("page" => "hostmaster", "subpage" => "ranges"));
				$this->tpl['link_ranges_waiting'] = makelink(array("page" => "hostmaster", "subpage" => "ranges", "form_search_ranges_search" => serialize(array("ip_ranges__status" => "waiting", "ip_ranges__delete_req" => "N"))));
				$this->tpl['ranges_waiting'] = $db->cnt('', "ip_ranges", "status = 'waiting' AND delete_req = 'N'");
				$this->tpl['link_ranges_req_del'] = makelink(array("page" => "hostmaster", "subpage" => "ranges", "form_search_ranges_search" => serialize(array("ip_ranges__delete_req" => "Y"))));
				$this->tpl['ranges_req_del'] = $db->cnt('', "ip_ranges", "delete_req = 'Y'");
			}
		}
		$this->tpl['link_home'] = makelink(array());
		// Avoid carrying stale query params (e.g., node=...) when listing all nodes
		$this->tpl['link_allnodes'] = makelink(array("page" => "nodes"), FALSE, FALSE);
		$this->tpl['link_allranges'] = makelink(array("page" => "ranges", "subpage" => "search"));
		$this->tpl['link_allservices'] = makelink(array("page" => "services"));
		$this->tpl['link_communities'] = makelink(array("page" => "communities"));
		$this->tpl['link_alldnszones'] = makelink(array("page" => "dnszones"));
		$this->tpl['link_restore_password'] = makelink(array("page" => "users", "action" => "restore"));
		$this->tpl['link_register'] = makelink(array("page" => "users", "user" => "add"));
		$this->tpl['link_logout'] = makelink(array("page" => "users", "action" => "logout", "ts" => time()));
		parse_str(substr(makelink(array("page" => "search"), FALSE, TRUE, FALSE), 1), $this->tpl['query_string']);
		
		// Stats: nodes with any links (connected to network)
		$this->tpl['stats_nodes_active'] = $db->cnt('DISTINCT nodes.id', 'nodes INNER JOIN links ON links.node_id = nodes.id', '');
		
		// Stats: total nodes
		$this->tpl['stats_nodes_total'] = $db->cnt('', 'nodes', '');
		
		// Stats: backbone nodes (nodes with P2P links)
		$this->tpl['stats_backbone'] = $db->cnt('DISTINCT node_id', 'links', 'type = "p2p"');
		
		// Stats: total P2P links (count link pairs once)
		$this->tpl['stats_links'] = $db->cnt('', 'links l1 INNER JOIN links l2 ON l1.peer_node_id = l2.node_id AND l2.peer_node_id = l1.node_id AND l1.id < l2.id', 'l1.type = "p2p" AND l2.type = "p2p"');
		
		// Stats: Access Points (count AP links)
		$this->tpl['stats_aps'] = $db->cnt('', 'links', 'type = "ap"');
		
		// Stats: Hotspots
		$this->tpl['stats_hotspots'] = $db->cnt('', 'links', 'type = "hs"');
		$this->tpl['stats_services_active'] =
				$db->cnt('',
						'nodes_services',
						'nodes_services.status = "active"'
						);
		$this->tpl['stats_communities'] =
				$db->cnt('',
						'communities',
						'');
		$this->tpl['stats_services_total'] =
				$db->cnt('',
						'nodes_services',
						''
						);
		$main->html->head->add_script("text/javascript", makelink(array("page" => "search", "subpage" => "suggest_js"), FALSE, TRUE, FALSE));
		// Use template() to render the menu template
		try {
			return template($this->tpl, __FILE__);
		} catch (Throwable $e) {
			error_log("Menu template error: " . $e->getMessage());
			$ret = '<nav class="menu"><div class="menu-content">' . "\n";
			$ret .= '<p>Menu temporarily unavailable</p>' . "\n";
			$ret .= '</div></nav>' . "\n";
			return $ret;
		}
	}

	function output_onpost_form_login() {
		global $main;
		if ($main->userdata->login($_POST['users__username'], $_POST['users__password'], (isset($_POST['save_login']) && ($_POST['save_login']=='Y')?TRUE:FALSE))) {
			if ($main->userdata->info['status'] == 'pending') {
				$main->message->set_fromlang('info', 'activation_required');
				$main->userdata->logout();
			} else {
				// Force an immediate refresh of the current page after login
				header("Location: ".html_entity_decode(makelink(array(), FALSE, FALSE)));
				exit;
			}
		} else {
			$main->message->set_fromlang('error', 'login_failed', makelink("", TRUE));
		}
	}
	
}

?>
