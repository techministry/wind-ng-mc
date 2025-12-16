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

include_once(ROOT_PATH."includes/head.php");
include_once(ROOT_PATH."includes/body.php");

class html {
	
	var $tpl;
	var $head;
	var $body;
	
	function __construct() {
		$this->tpl = array();
		try {
			$this->head = new head;
			$this->body = new body;
		} catch (Throwable $e) {
			error_log("HTML class error: " . $e->getMessage() . " - " . $e->getFile() . ":" . $e->getLine());
			throw $e;  // Re-throw to see the actual error
		}
	}
	
	function output() {
		global $vars;
		$this->tpl['head'] = $this->head->output();
		$this->tpl['body'] = $this->body->output();
		$this->tpl['body_tags'] = $this->body->tags;
		
		// Use Smarty template for proper HTML output with all CSS/JS includes
		return template($this->tpl, 'html', TRUE);
	}
	
}

?>