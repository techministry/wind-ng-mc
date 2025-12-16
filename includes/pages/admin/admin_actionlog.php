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

#if (get('log') != '') include_once(ROOT_PATH."includes/pages/admin/admin_actionlog_log.php");

class admin_actionlog {

	var $tpl;
	var $page;
	
	function __construct() {
		if (get('log') != '') {
			$p = "admin_actionlog_log";
			$this->page = new $p;
		}		
	}
	
	function table_actionlog() {
		global $construct, $db, $main;
		$table_actionlog = new table(array('FORM_NAME' => 'table_actionlog', 'TABLE_NAME' => 'table_actionlog'));
		$table_actionlog->db_data(
			'actionlog.id, users.username,actionlog.ipaddress, actionlog.uid, actionlog.dateline AS actionlog__date, actionlog.page, actionlog.action, actionlog.data',
			'actionlog ' .
			'Left Join `users` ON `actionlog`.`uid` = `users`.`id`',
			"",
			"",
			"actionlog.id DESC");
		for($i=1;$i<count($table_actionlog->data);$i++) {
			if (isset($table_actionlog->data[$i])) {
				#$table_actionlog->data[$i]['ip_start'] = long2ip($table_actionlog->data[$i]['ip_start']);
				#$table_actionlog->data[$i]['ip_end'] = long2ip($table_actionlog->data[$i]['ip_end']);
				#$table_actionlog->info['EDIT'][$i] = makelink(array("page" => "admin", "subpage" => "actionlog", "area" => $table_actionlog->data[$i]['id']));
			}
		}
		#$table_actionlog->info['EDIT_COLUMN'] = 'actionlog__name';
		$table_actionlog->db_data_multichoice('dateline', 'id');
		$table_actionlog->info['MULTICHOICE_LABEL'] = 'delete';
		$table_actionlog->db_data_remove('id', 'uid');
		return $table_actionlog;
	}
	
	function output() {
		if (get('log') != '') {
			return $this->page->output();
		} else {
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && method_exists($this, 'output_onpost_'.$_POST['form_name'])) return call_user_func(array($this, 'output_onpost_'.$_POST['form_name']));
			global $construct;
			#$this->tpl['link_area_add'] = makelink(array('page' => 'admin', 'subpage' => 'actionlog', 'area' => 'add'));
			$this->tpl['table_actionlog'] = $construct->table($this->table_actionlog(), __FILE__);
			return template($this->tpl, __FILE__);
		}
	}

	function output_onpost_table_actionlog() {
		global $db, $main;
		$ret = TRUE;
		foreach( (array) $_POST['id'] as $key => $value) {
			$ret = $ret && $db->del("actionlog", "id = '".$value."'");
		}
		if ($ret) {
			$main->message->set_fromlang('info', 'delete_success', makelink("",TRUE));
		} else {
			$main->message->set_fromlang('error', 'generic');		
		}
	}

}

?>
