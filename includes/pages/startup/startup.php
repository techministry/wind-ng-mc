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

class startup {

	var $tpl;
	
	function __construct() {
		
	}
	
	function output() {
		if (file_exists(ROOT_PATH."config/startup.html")) $this->tpl['startup_html'] = file_get_contents(ROOT_PATH."config/startup.html");
		// Attach map scripts for the homepage
		$this->tpl['gmap_key_ok'] = include_gmap("?page=gmap&subpage=js");
		$this->tpl['link_fullmap'] = makelink(array("page" => "gmap"));
		return template($this->tpl, __FILE__);
	}

}

?>
