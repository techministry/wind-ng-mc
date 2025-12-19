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

if (get('subpage') != '') include_once(ROOT_PATH."includes/pages/admin/admin_".get('subpage').".php");

class admin {

	var $tpl;
	var $page;
	
	function __construct() {
		if (get('subpage') != '') {
			$p = "admin_".get('subpage');
			$this->page = new $p;
		}
	}
	
	       function output() {
		       if (isset($this->page) && is_object($this->page) && method_exists($this->page, 'output')) {
			       return $this->page->output();
		       } else {
			       // Default admin dashboard or error message
			       return '<div class="mdc-card mdc-card--outlined" style="margin: 24px auto; max-width: 600px; padding: 32px; text-align: center;">'
				       .'<span class="material-icons mdc-theme--primary" style="font-size:48px;">admin_panel_settings</span><br>'
				       .'<div class="mdc-typography--headline6" style="margin-top: 16px;">Admin Panel</div>'
				       .'<div class="mdc-typography--body2" style="margin-top: 8px;">Select an admin section from the menu.</div>'
				       .'</div>';
		       }
	       }

}

?>

