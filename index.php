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

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();

define("ROOT_PATH","./");

// Handle XML requests early to avoid header pollution from warnings
if (isset($_GET['page']) && $_GET['page'] === 'gmap' && isset($_GET['subpage']) && $_GET['subpage'] === 'xml') {
	// Suppress errors for clean XML
	error_reporting(0);
	ini_set('display_errors', 0);
	
	// Start fresh output buffer to capture any accidental output
	while (ob_get_level()) {
		ob_end_clean();
	}
	ob_start();
	
	include_once(ROOT_PATH."globals/vars.php");
	include_once(ROOT_PATH."config/config.php");
	$vars = array_merge($vars, $config);
	include_once(ROOT_PATH."config/database.php");
	include_once(ROOT_PATH."globals/functions.php");
	include_once(ROOT_PATH."globals/language/".$config['language']['default'].".php");
	
	$db = new database($vars['db']['server'], $vars['db']['username'], $vars['db']['password'], $vars['db']['database']);
	include_once(ROOT_PATH."includes/pages/gmap/gmap_xml.php");
	
	// Discard any accidental output from includes
	ob_end_clean();
	
	// Set XML headers
	header("Content-type: text/xml; charset=utf-8");
	header("Expires: 0");
	
	$xml_handler = new gmap_xml();
	$xml_handler->output();
	exit;
}

include_once(ROOT_PATH."globals/common.php");

include_once(ROOT_PATH."includes/main.php");

try {
	$main = new main;
	$output = $main->output();
	if (!$output || trim($output) === '') {
		echo "ERROR: No output from main->output()<br>";
	} else {
		echo $output;
	}
} catch (Throwable $e) {
	echo "ERROR: " . $e->getMessage() . "<br>";
	echo "File: " . $e->getFile() . "<br>";
	echo "Line: " . $e->getLine() . "<br>";
	echo "<pre>";
	echo $e->getTraceAsString();
	echo "</pre>";
}

ob_end_flush();

?>