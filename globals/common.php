<?php
/*
 * WiND - Wireless Nodes Database
 *
 * Copyright (C) 2005 Nikolaos Nikalexis <winner@cube.gr>
 * Copyright (C) 2007 John Kolovos <cirrus@awmn.net>
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

// Suppress PHP notices and warnings from displaying in output
// They will still be logged to error_log
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

if (!file_exists(ROOT_PATH."config/config.php")) {
	die("WiND error: Please make config/config.php file ...");
}
include_once(ROOT_PATH."globals/vars.php");
include_once(ROOT_PATH."config/config.php");
$vars = array_merge($vars, $config);
include_once($vars['templates']['path'].$vars['templates']['default'].'/config.php');
$vars = array_merge($vars, $template_config);
include_once(ROOT_PATH."globals/functions.php");

$php_start = getmicrotime();

include_once(ROOT_PATH."config/database.php");
include_once(ROOT_PATH."globals/classes/construct.php");
include_once(ROOT_PATH."globals/classes/form.php");
include_once(ROOT_PATH."globals/classes/table.php");

if ($vars['template']['version'] < $vars['info']['min_template_version']
		|| $vars['template']['version'] > $vars['info']['version']) {
	die("WiND error: Template version does not match.");
}

// Initialize Smarty 5.7.0 with proper namespace handling
// First, set up autoloader before requiring Smarty
spl_autoload_register(function($class) {
	if (strpos($class, 'Smarty\\') === 0) {
		$path = ROOT_PATH . 'vendor/smarty/smarty/src/' . str_replace('\\', '/', substr($class, 7)) . '.php';
		if (file_exists($path)) {
			require_once $path;
			return true;
		}
	}
	return false;
}, true, true);

// Ensure mbstring functions are available (polyfill if needed)
if (!function_exists('mb_strtolower')) {
	function mb_strtolower($string, $encoding = null) {
		return strtolower($string);
	}
}
if (!function_exists('mb_strtoupper')) {
	function mb_strtoupper($string, $encoding = null) {
		return strtoupper($string);
	}
}
if (!function_exists('mb_substr')) {
	function mb_substr($string, $start, $length = null, $encoding = null) {
		return substr($string, $start, $length);
	}
}
if (!function_exists('mb_strlen')) {
	function mb_strlen($string, $encoding = null) {
		return strlen($string);
	}
}
if (!function_exists('mb_strpos')) {
	function mb_strpos($haystack, $needle, $offset = 0, $encoding = null) {
		return strpos($haystack, $needle, $offset);
	}
}

// Load core Smarty functions before requiring Smarty
require_once(ROOT_PATH."vendor/smarty/smarty/src/functions.php");
require_once(ROOT_PATH."vendor/smarty/smarty/src/Smarty.php");

$smarty = new Smarty\Smarty();
$smarty->setTemplateDir($vars['templates']['path'].$vars['templates']['default'].'/');
$smarty->setCompileDir($vars['templates']['compiled_path'].$vars['templates']['default'].'/');
$smarty->registerPlugin('modifier', 'stripslashes', 'stripslashes');

reset_smarty();

$construct = new construct;

if ($vars['mail']['smtp'] != '') {
	ini_set('SMTP', $vars['mail']['smtp']);
	ini_set('smtp_port', $vars['mail']['smtp_port']);
}

$db = new database($vars['db']['server'], $vars['db']['username'], $vars['db']['password'], $vars['db']['database']);

if ($db->error) {
	die("WiND MySQL database error: $db->error_report");
}

?>
