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

class center {

	var $page;
	
	function __construct() {
		$p = get('page');
		if ($p && file_exists(ROOT_PATH."includes/pages/".$p."/".$p.".php")) {
			include_once(ROOT_PATH."includes/pages/".$p."/".$p.".php");
			if (class_exists($p)) {
				$this->page = new $p;
			} else {
				error_log("Page class not found: " . $p);
				$this->page = null;
			}
		} else {
			error_log("Page file not found: " . $p);
			$this->page = null;
		}
	}
	
	function security_check() {
		global $main, $db;
		// Debug: Log privileges check
		error_log("security_check: logged=" . var_export($main->userdata->logged, true) . 
			", user=" . var_export($main->userdata->user, true) . 
			", privileges=" . print_r($main->userdata->privileges, true));
		if (isset($main->userdata->privileges['admin']) && $main->userdata->privileges['admin'] === TRUE) {
			return TRUE;
		}
		switch (get('page')) {
			case 'admin':		
  				if ($main->userdata->privileges['cadmin'] === TRUE) {
					if (get('subpage') == 'areas'){return TRUE;}
					if (get('subpage') == 'services'){return TRUE;}
					if (get('subpage') == 'nodes'){return TRUE;}
				}
				return ($main->userdata->privileges['admin'] === TRUE);
				break;
			case 'hostmaster':
				if ($main->userdata->privileges['cadmin'] === TRUE) {
					if (get('subpage') == 'ranges'){return TRUE;}
					if (get('subpage') == 'range'){return TRUE;}
				}
				return ($main->userdata->privileges['hostmaster'] === TRUE);
				break;
			case 'mynodes':
				if ($main->userdata->logged === TRUE) {
					if (get('node') == 'add') return TRUE;
					if (get('node') != 'add' && get('action') == 'delete') {
						if ($db->cnt('', "users_nodes", "node_id = ".intval(get('node'))." AND user_id = '".$main->userdata->user."' AND owner = 'Y'") > 0) {
							return TRUE;
						} else {
							return FALSE;
						}
					}
					if ($db->cnt('', "users_nodes", "node_id = ".get('node')." AND user_id = '".$main->userdata->user."'") > 0) return TRUE;
					#@#community admins
					if ($main->userdata->privileges['cadmin']===TRUE) {
					$q="SELECT
					communities.admins
					FROM
					communities
					LEFT JOIN nodes ON nodes.community_id = communities.id
					WHERE
					nodes.id =  '".intval(get('node'))."'";
					$query = $db->query($q);
					$data = mysql_fetch_assoc($query);
					$this_node_com_admins = explode(",",$data[admins]);
						if (in_array($main->userdata->user,$this_node_com_admins))
						{
						   return TRUE;
						}
					
					}
					#@# 
					if (get('subpage') == 'dnszone' && 
						$db->cnt('', "users_nodes, dns_zones", "dns_zones.node_id = users_nodes.node_id AND dns_zones.id = '".get('zone')."' AND users_nodes.user_id = '".$main->userdata->user."'") > 0) return TRUE;
					if (get('subpage') == 'dnsnameserver' && 
						$db->cnt('', "users_nodes, dns_nameservers", "dns_nameservers.node_id = users_nodes.node_id AND dns_nameservers.id = '".get('nameserver')."' AND users_nodes.user_id = '".$main->userdata->user."'") > 0) return TRUE;
				}				
				break;
			case 'nodes':
				return TRUE;
				break;
			case 'startup':
				return TRUE;
				break;
			case 'ranges':
			case 'dnszones':
			case 'pickup':
			case 'gmap':
			case 'gearth':
			case 'communities':
				return TRUE;
				break;
			case 'services':
				return ($main->userdata->logged === TRUE)=== TRUE;
				break;
								
			case 'search':
				return TRUE;
				break;
			case 'users':
				if (get('user') == 'add') return TRUE;
				if ($main->userdata->logged === TRUE) {
					if (get('action') == 'logout') return TRUE;
					if (get('user') === $main->userdata->user) return TRUE;
				}
				if (get('action') == 'activate') return TRUE;
				if (get('action') == 'restore') return TRUE;
				break;
		}
		return FALSE;
	}
	
	function output() {
		global $main;
		if (!$this->page) {
			error_log("Center output: page is null");
			$main->message->set_fromlang('info', 'page_not_found');
			return '';
		}
		if (!$this->security_check()) {
			error_log("Center output: security check failed");
			$main->message->set_fromlang('info', 'no_privilege');
			return '';
		}
		// Don't catch errors - let them propagate for debugging
		return $this->page->output();
	}
	
}

?>
