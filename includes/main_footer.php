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

class footer {
	
	var $hide=FALSE;
	var $tpl;

	function __construct() {
		$this->tpl = array();
	}
	
	
	function output() {
		global $db, $php_start, $main, $vars;
		if ($this->hide) return '';
		
		// Calculate execution times
		$this->tpl['php_time'] = getmicrotime() - $php_start;
		$this->tpl['mysql_time'] = isset($db->total_time) ? $db->total_time : 0;
		
		// Add debug link if admin and debug enabled
		if (isset($main->userdata->privileges['admin']) && $main->userdata->privileges['admin'] === TRUE && isset($vars['debug']['enabled']) && $vars['debug']['enabled'] == TRUE) {
			$this->tpl['debug_mysql'] = ROOT_PATH . 'debug/mysql.php?' . get_qs();
		}
		
		// Use template() to render the footer template
		try {
			return template($this->tpl, __FILE__);
		} catch (Throwable $e) {
			// Fallback to simple footer if template fails
			error_log("Footer template error: " . $e->getMessage());
			$ret = '<div class="footer">' . "\n";
			$ret .= '<p>PHP time: ' . number_format($this->tpl['php_time'], 3) . 's | MySQL time: ' . number_format($this->tpl['mysql_time'], 3) . 's</p>' . "\n";
			$ret .= '<p><b>WiND - Wireless Nodes Database</b></p>' . "\n";
			$ret .= '</div>' . "\n";
			return $ret;
		}
	}
	
}

?>