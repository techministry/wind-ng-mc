<?php
/*
 * WiND - Wireless Nodes Database
 *
 * Copyright (C) 2025 WNA Team
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

class admin_site {

	var $tpl;
	
	function __construct() {
		// Privilege check moved to output() since $main->message isn't ready yet
	}
	
	function save_startup_html() {
		global $main;
		
		if (!isset($main->userdata->privileges['admin'])) {
			return false;
		}
		
		if (isset($_POST['startup_html'])) {
			$html = $_POST['startup_html'];
			$file_path = ROOT_PATH . "config/startup.html";
			
			if (file_put_contents($file_path, $html) !== false) {
				$main->message->set_fromlang('info', 'site_settings_saved', 
					makelink(array("page" => "admin", "subpage" => "site")));
				return true;
			} else {
				$main->message->set_fromlang('error', 'site_settings_save_failed');
				return false;
			}
		}
		return false;
	}
	
	function output() {
		global $main, $lang;
		
		if (!isset($main->userdata->privileges['admin'])) {
			return template($this->tpl, __FILE__);
		}
		
		// Handle form submission
		if (isset($_POST['action']) && $_POST['action'] == 'save') {
			$this->save_startup_html();
		}
		
		// Load current startup.html content
		$startup_file = ROOT_PATH . "config/startup.html";
		$this->tpl['startup_html'] = '';
		if (file_exists($startup_file)) {
			$this->tpl['startup_html'] = file_get_contents($startup_file);
		}
		
		$this->tpl['form_action'] = makelink(array("page" => "admin", "subpage" => "site"));
		
		return template($this->tpl, __FILE__);
	}

}

?>
