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

class head {

	var $tpl;
	
	function add_extra($extra) {
		$this->tpl['extra'] .= $extra;
	}
	
	function add_title($title) {
		$this->tpl['title'] = $title;
	}
	
	function add_base($href, $target="") {
		if (!isset($this->tpl['base'])) $this->tpl['base'] = array();
		array_push($this->tpl['base'], array('href' => $href, 'target' => $target));
	}
	
	function add_link($rel, $type="", $href="", $integrity="", $crossorigin="") {
		if (!isset($this->tpl['link'])) $this->tpl['link'] = array();
		// Support both old style (3 params) and new style (array)
		if (is_array($rel)) {
			array_push($this->tpl['link'], $rel);
		} else {
			$link = array('rel' => $rel, 'type' => $type, 'href' => $href);
			if ($integrity != '') $link['integrity'] = $integrity;
			if ($crossorigin != '') $link['crossorigin'] = $crossorigin;
			array_push($this->tpl['link'], $link);
		}
	}
	
	function add_meta($content, $name="", $http_equiv="", $scheme="") {
		if (!isset($this->tpl['meta'])) $this->tpl['meta'] = array();
		array_push($this->tpl['meta'], array('http-equiv' => $http_equiv, 'content' => $content, 'name' => $name, 'scheme' => $scheme));
	}
	
	function add_script($type,$src="", $integrity="", $crossorigin="") {
		if (!isset($this->tpl['script'])) $this->tpl['script'] = array();
		$script = array('type' => $type, 'src' => $src);
		if ($integrity != '') $script['integrity'] = $integrity;
		if ($crossorigin != '') $script['crossorigin'] = $crossorigin;
		array_push($this->tpl['script'], $script);
	}
	
	function output() {
		return template($this->tpl, __FILE__);
	}

}

?>