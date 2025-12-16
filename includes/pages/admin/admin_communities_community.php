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

class admin_communities_community {

	var $tpl;
	
	function __construct() {
		
	}
	
	function form_community() {
		#global $db, $vars;
		global $main, $db, $vars, $lang;
		$form_community = new form(array('FORM_NAME' => 'form_community'));
		$form_community->db_data('communities.id as community_id, communities.name, communities.windURL, communities.TOS, communities.fullname, communities.dnstld, communities.ns1,communities.ns2, communities.central-node as cnode, communities.admins AS cadmins_ids');
		$form_community->db_data_values("communities", "id", get('community'));
		if (get('community') != 'add') {
		#$table_communities->data[$i]['ns1'] = long2ip($table_communities->data[$i]['ns1']);
		#$table_communities->data[$i]['ns2'] = long2ip($table_communities->data[$i]['ns2']);
			$form_community->data[5]['value'] = long2ip($form_community->data[5]['value']);
			$form_community->data[6]['value'] = long2ip($form_community->data[6]['value']);
		}
			$form_community->data[7]['Field'] = 'cnode';
			$form_community->data[8]['Field'] = 'cadmins_ids';
			$form_community->data[8]['fullField'] = 'cadmins_ids';

			#if (get('node') == 'add') {
				$temp = $db->get("users.id AS value, users.username AS output", "users", "users.id = '".$main->userdata->user."'");
			#} else {
			#	$temp = $db->get("users.id AS value, users.username AS output", "users_nodes, users", "users.id = users_nodes.user_id AND users_nodes.node_id = ".intval(get('node'))." AND users_nodes.owner = 'Y'");
			#}
			$form_community->db_data_pickup("cadmins_ids", "users", $temp);
			#$form_community->db_data_pickup("users_nodes.user_id", "users", $db->get("users.id AS value, users.username AS output", "users_nodes, users", "users.id = users_nodes.user_id AND users_nodes.node_id = ".intval(get('node'))." AND users_nodes.owner != 'Y'"), TRUE);
		#if (get('node') != 'add') {
			######$form_community->db_data_pickup("users_nodes.user_id", "users", $db->get("users.id AS value, users.username AS output", "users_nodes, users", "users.id = users_nodes.user_id AND users_nodes.node_id = ".intval(get('node'))." AND users_nodes.owner != 'Y'"), TRUE);
		#	} else {
				#$form_community->db_data_pickup("users_nodes.user_id", "users", null, TRUE);
		#	}
		$form_community->db_data_remove('community_id');
		return $form_community;
	}
	
	function output() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && method_exists($this, 'output_onpost_'.$_POST['form_name'])) return call_user_func(array($this, 'output_onpost_'.$_POST['form_name']));
		global $construct;
		$this->tpl['community_method'] = (get('communities') == 'add' ? 'add' : 'edit' );
		$this->tpl['form_community'] = $construct->form($this->form_community(), __FILE__);
		return template($this->tpl, __FILE__);
	}

	function output_onpost_form_community() {
		global $construct, $main, $db;
		$form_community = $this->form_community();
		$community = get('community');
		$ret = TRUE;
		$_POST['communities__ns1'] = ip2long($_POST['communities__ns1']);
        $_POST['communities__ns2'] = ip2long($_POST['communities__ns2']);
		$ret = $form_community->db_set(array(),
								"communities", "id", get('community'));
		
		if ($ret) {
			$main->message->set_fromlang('info', 'insert_success', makelink(array("page" => "admin", "subpage" => "communities")));
		} else {
			$main->message->set_fromlang('error', 'generic');		
		}
	}

}

?>

