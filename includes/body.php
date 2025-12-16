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

class body {
	
	var $tags;
	var $tpl;
	
	function __construct() {
		$this->tags = array();
		$this->tpl = array();
	}
	
	function output() {
		global $smarty;
		
		// Build body tag attributes
		$body_attrs = '';
		if (is_array($this->tags) && count($this->tags) > 0) {
			foreach ($this->tags as $key => $value) {
				$body_attrs .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
			}
		} elseif (is_string($this->tags) && !empty($this->tags)) {
			$body_attrs = ' ' . $this->tags;
		}
		
		// Use Smarty template for body with table-based layout
		$smarty->assign('header', isset($this->tpl['header']) ? $this->tpl['header'] : '');
		$smarty->assign('menu', isset($this->tpl['menu']) ? $this->tpl['menu'] : '');
		$smarty->assign('message', isset($this->tpl['message']) ? $this->tpl['message'] : '');
		$smarty->assign('center', isset($this->tpl['center']) ? $this->tpl['center'] : '');
		$smarty->assign('footer', isset($this->tpl['footer']) ? $this->tpl['footer'] : '');
		
		// Login-related variables needed by body.tpl
		$smarty->assign('logged', isset($this->tpl['logged']) ? $this->tpl['logged'] : false);
		$smarty->assign('form_login', isset($this->tpl['form_login']) ? $this->tpl['form_login'] : '');
		$smarty->assign('languages', isset($this->tpl['languages']) ? $this->tpl['languages'] : array());
		$smarty->assign('logged_username', isset($this->tpl['logged_username']) ? $this->tpl['logged_username'] : '');
		$smarty->assign('link_logged_profile', isset($this->tpl['link_logged_profile']) ? $this->tpl['link_logged_profile'] : '');
		
		$ret = '<body' . $body_attrs . ">\n";
		$ret .= $smarty->fetch('includes/body.tpl');
		$ret .= '</body>' . "\n";
		return $ret;
	}
	
}

?>