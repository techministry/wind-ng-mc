<?php
/*
 * WiND - Wireless Nodes Database
 *
 * Copyright (C) 2012 Leonidas Papadopoulos <leonidas@wna.gr>
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

class communities {

	var $tpl;
	
	function __construct() {
		
	}
	
	function form_search_communities() {
		/*global $db;
		$form_search_communities = new form(array('FORM_NAME' => 'form_search_communities'));
		$form_search_communities->db_data('communities.id, communities.name');
		$form_search_communities->db_data_enum('communities.id', $db->get("id AS value, name AS output", "communities", "", "", "id ASC"));
		$form_search_communities->db_data_search();
		return $form_search_communities;*/
		
	}

	function table_communities() {
		global $construct, $db, $lang;
		$form_search_communities = $this->form_search_communities();
		$where = "";#$form_search_communities->db_data_where();
		$table_communities = new table(array('TABLE_NAME' => 'table_communities', 'FORM_NAME' => 'table_communities'));
		$table_communities->db_data(
			'communities.id, communities.name,communities.fullname, communities.windURL, communities.TOS, communities.dnstld, communities.ns1, communities.ns2, communities.admins' ,
			'communities',
			$where,
			'',
			"communities.id ASC");
		$table_communities->db_data_search($form_search_communities);
		foreach( (array) $table_communities->data as $key => $value) {
			if ($key != 0) {
				if ($table_communities->data[$key]['ns1']) {
					$table_communities->data[$key]['ns1'] = long2ip($table_communities->data[$key]['ns1']);
					#if ($table_services->data[$key]['protocol'] && $table_communities->data[$key]['port']) {
					#	$table_services->data[$key]['ip'] .= ' ('.$lang['db']['nodes_services__protocol-'.$table_communities->data[$key]['protocol']].'/'.$table_communities->data[$key]['port'].')';
					#}
				}
				if ($table_communities->data[$key]['ns2']) {
					$table_communities->data[$key]['ns2'] = long2ip($table_communities->data[$key]['ns2']);
				}
				
				$cadmins = explode(",",$table_communities->data[$key]['admins']);
				$admin_links = array();
				foreach ($cadmins as $key_name => $key_value) {
					$uid = trim($key_value);
					if ($uid === '') continue;
					$user_row = $db->get("username", "users", "id = '".$db->escape_string($uid)."'");
					$username = isset($user_row[0]['username']) ? $user_row[0]['username'] : ('#'.$uid);
					$link = makelink(array("page" => "users", "user" => $uid));
					$admin_links[] = '<a href="'.$link.'">'.htmlspecialchars($username).'</a>';
				}
				$table_communities->data[$key]['admins'] = implode(", ", $admin_links);
				$table_communities->info['RAW']['communities__admins'] = 'YES';
					
					#		$cadmins->data[$k]['links__ip'] = $cadmins->data[$k]['links__ip'];#@#
					
									
							
				#$table_communities->data[$key]['nodes__name'] .= " (#".$table_communities->data[$key]['nodes__id'].")";
				#$table_communities->info['LINK']['nodes__name'][$key] = makelink(array("page" => "nodes", "node" => $table_communities->data[$key]['nodes__id']));
				#$table_communities->info['LINK']['services__title'][$key] = $table_communities->data[$key]['url'];
				
			}
		}
		#$table_communities->db_data_translate('communities__TOS');
		
		$table_communities->db_data_remove('TOS');
		return $table_communities;
	}

	function output() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && method_exists($this, 'output_onpost_'.$_POST['form_name'])) return call_user_func(array($this, 'output_onpost_'.$_POST['form_name']));
		global $construct;
		#$this->tpl['form_search_services'] = $construct->form($this->form_search_services(), __FILE__);
		$this->tpl['table_communities'] = $construct->table($this->table_communities(), __FILE__);
		return template($this->tpl, __FILE__);
	}

}

?>
