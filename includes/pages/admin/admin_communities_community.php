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
		global $main, $db, $vars, $lang;
		$form_community = new form(array('FORM_NAME' => 'form_community'));
		// Note: Don't use SQL aliases (AS) or hyphens in column names with db_data() - they aren't parsed correctly
		$form_community->db_data('communities.id, communities.name, communities.windURL, communities.TOS, communities.fullname, communities.dnstld, communities.ns1, communities.ns2');
		$form_community->db_data_values("communities", "id", get('community'));
		
		if (get('community') != 'add') {
			// Convert IP addresses from long to dotted format
			$form_community->data[6]['value'] = long2ip($form_community->data[6]['value']);
			$form_community->data[7]['value'] = long2ip($form_community->data[7]['value']);
		}
		
		// Manually add the cadmins_ids pickup field with full structure
		$cadmins_index = count($form_community->data);
		$form_community->data[$cadmins_index] = array(
			'Field' => 'cadmins_ids',
			'fullField' => 'cadmins_ids',
			'Type' => 'text',
			'Null' => 'YES',
			'Key' => '',
			'Default' => '',
			'Extra' => '',
			'value' => ''
		);
		
		// Get current community admin(s) if editing, or current user if adding
		if (get('community') != 'add') {
			$community_data = $db->get("admins", "communities", "id = '".get('community')."'");
			if (!empty($community_data[0]['admins'])) {
				$admin_id = $community_data[0]['admins'];
				$temp = $db->get("users.id AS value, users.username AS output", "users", "users.id = '".$admin_id."'");
			} else {
				$temp = $db->get("users.id AS value, users.username AS output", "users", "users.id = '".$main->userdata->user."'");
			}
		} else {
			$temp = $db->get("users.id AS value, users.username AS output", "users", "users.id = '".$main->userdata->user."'");
		}
		$form_community->db_data_pickup("cadmins_ids", "users", $temp);
		
		// DEBUG: Log the cadmins field after pickup setup
		error_log("DEBUG form_community: cadmins field after pickup: " . print_r($form_community->data[$cadmins_index], true));
		
		// Remove the id field from being displayed (we don't want to show community_id)
		$form_community->db_data_remove('communities__id');
		return $form_community;
	}
	
	function output() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && method_exists($this, 'output_onpost_'.$_POST['form_name'])) return call_user_func(array($this, 'output_onpost_'.$_POST['form_name']));
		global $construct;
		$this->tpl['communities_method'] = (get('community') == 'add' ? 'add' : 'edit' );
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

