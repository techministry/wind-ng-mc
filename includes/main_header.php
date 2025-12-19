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

class header {
	
	var $hide=FALSE;
	var $tpl;
	
	function __construct() {
		$this->tpl = array();
	}
	
	
	function output() {
		global $main, $vars, $smarty, $construct;
		if ($this->hide) return '';
		
		// Check if custom logo exists
		if (file_exists(ROOT_PATH.'config/mylogo.png')) {
			$this->tpl['mylogo'] = TRUE;
			$this->tpl['mylogo_dir'] = ROOT_PATH.'config/';
		} else {
			$this->tpl['mylogo'] = FALSE;
		}

		// Expose login info to the header template (used for profile/logout buttons)
		$this->tpl['logged'] = isset($main->userdata->logged) ? $main->userdata->logged : false;
		$this->tpl['logged_username'] = isset($main->userdata->info['username']) ? $main->userdata->info['username'] : '';
		// Build clean links (no merged query string) and force a redirect after logout
		$this->tpl['link_logged_profile'] = makelink(array("page" => "users", "user" => $main->userdata->user), FALSE, FALSE);
		$this->tpl['link_logout'] = makelink(array(
			"page" => "users",
			"action" => "logout",
			"redirect" => '?page=gmap',
			// Add a cache-busting token so proxies/browsers don't reuse an old request
			"ts" => time()
		), FALSE, FALSE);

		// Provide login form for unauthenticated users
		if (!$this->tpl['logged']) {
			$form_login = $main->menu->form_login();
			$this->tpl['form_login'] = $construct->form($form_login, 'constructors/form.tpl');
		}
		
		// Use template() to render the header template
		try {
			return template($this->tpl, __FILE__);
		} catch (Throwable $e) {
			// Fallback to simple header if template fails
			error_log("Header template error: " . $e->getMessage());
			$ret = '<div class="table-header">' . "\n";
			$ret .= '<img src="templates/basic/images/main_logo.png" alt="WiND Logo" />' . "\n";
			$ret .= '</div>' . "\n";
			return $ret;
		}
	}
	
}

?>
