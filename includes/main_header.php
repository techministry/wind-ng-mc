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