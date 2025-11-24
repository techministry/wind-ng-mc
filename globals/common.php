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
// Use mysqli for PHP 5+ when db version is set to 5
if((integer)$vars['db']['version'] == 5 && version_compare(PHP_VERSION, '5.0.0', '>=')) {
	include_once(ROOT_PATH."globals/classes/mysqli.php");
} else {
	include_once(ROOT_PATH."globals/classes/mysql.php");
}
include_once(ROOT_PATH."globals/classes/construct.php");
include_once(ROOT_PATH."globals/classes/form.php");
include_once(ROOT_PATH."globals/classes/table.php");

if (!file_exists($vars['smarty']['class'])) {
	die("WiND error: Cannot find Smarty lib. Please check config.php ...");
}
include_once($vars['smarty']['class']);

if ($vars['template']['version'] < $vars['info']['min_template_version']
		|| $vars['template']['version'] > $vars['info']['version']) {
	die("WiND error: Template version does not match.");
}

$smarty = new Smarty;

// Smarty 3.x/4.x compatibility
if (method_exists($smarty, 'setTemplateDir')) {
	// Smarty 3.x/4.x
	$smarty->setTemplateDir($vars['templates']['path'].$vars['templates']['default'].'/');
	$smarty->addPluginsDir($vars['templates']['path'].$vars['templates']['default'].'/plugins/');
	$smarty->setCompileDir($vars['templates']['compiled_path'].$vars['templates']['default'].'/');
	$smarty->registerPlugin('modifier', 'stripslashes', 'stripslashes');
} else {
	// Smarty 2.x (legacy)
	$smarty->template_dir = $vars['templates']['path'].$vars['templates']['default'].'/';
	$smarty->plugins_dir = array($vars['templates']['path'].$vars['templates']['default'].'/plugins/', 'plugins');
	$smarty->compile_dir = $vars['templates']['compiled_path'].$vars['templates']['default'].'/';
	$smarty->register_modifier('stripslashes', 'stripslashes');
}
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
