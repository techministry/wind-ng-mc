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

if (get('community') != '') include_once(ROOT_PATH."includes/pages/admin/admin_communities_community.php");

class admin_communities {

	var $tpl;
	var $page;
	
	function __construct() {
		if (get('community') != '') {
			$p = "admin_communities_community";
			$this->page = new $p;
		}		
	}
	
	function table_communities() {
		global $construct, $db, $main;
		$table_communities = new table(array('FORM_NAME' => 'table_communities', 'TABLE_NAME' => 'table_communities'));
		$table_communities->db_data(
			'communities.id, communities.name, communities.windURL, communities.TOS, communities.fullname, communities.dnstld, communities.ns1, communities.ns2',
			'communities',
			"",
			"",
			"name ASC");
		for($i=1;$i<count($table_communities->data);$i++) {
			if (isset($table_communities->data[$i])) {
				$table_communities->data[$i]['ns1'] = long2ip($table_communities->data[$i]['ns1']);
				$table_communities->data[$i]['ns2'] = long2ip($table_communities->data[$i]['ns2']);
				$table_communities->info['EDIT'][$i] = makelink(array("page" => "admin", "subpage" => "communities", "community" => $table_communities->data[$i]['id']));
			}
		}
		$table_communities->info['EDIT_COLUMN'] = 'dnstld';
		$table_communities->info['EDIT_COLUMN'] = 'name';
		$table_communities->db_data_multichoice('community', 'id');
		$table_communities->info['MULTICHOICE_LABEL'] = 'delete';
		$table_communities->db_data_remove('id','communities.id');
		return $table_communities;
	}
	
	function output() {
		if (get('community') != '') {
			return $this->page->output();
		} else {
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && method_exists($this, 'output_onpost_'.$_POST['form_name'])) return call_user_func(array($this, 'output_onpost_'.$_POST['form_name']));
			global $construct;
			$this->tpl['link_communities_add'] = makelink(array('page' => 'admin', 'subpage' => 'communities', 'community' => 'add'));
			$this->tpl['table_communities'] = $construct->table($this->table_communities(), __FILE__);
			return template($this->tpl, __FILE__);
		}
	}

	function output_onpost_table_communities() {
		global $db, $main;
		$ret = TRUE;
		foreach( (array) $_POST['id'] as $key => $value) {
			$ret = $ret && $db->del("communities", "id = '".$value."'");
		}
		if ($ret) {
			$main->message->set_fromlang('info', 'delete_success', makelink("",TRUE));
		} else {
			$main->message->set_fromlang('error', 'generic');		
		}
	}

}

?>
