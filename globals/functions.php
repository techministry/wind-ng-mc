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

function array_merge_check () { 
        $array["merged"]=array (); 
        for($i=0;$i<func_num_args ();$i++) { 
                $arg = func_get_arg($i); 
                if(isset($arg) && $arg != "") { 
                        $array["tmp"]=((is_array ($arg))?($arg):(array ($arg))); 
                        $array["merged"]=array_merge ($array["merged"],$array["tmp"]); 
                } 
        } 
        return($array["merged"]); 
}

function redirect($url, $sec=0, $exit=TRUE) {
	global $main;
	$sec = (integer)($sec);
	if ($main->message->show && $main->message->forward != $url) {
		if ($main->message->forward == '') $main->message->forward = $url;
		return;
	}
	if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')) || @preg_match('/Safari/', $_SERVER['HTTP_USER_AGENT']) || $sec>0) {
		header("Refresh: $sec; URL=".html_entity_decode($url));
		$main->html->head->add_meta("$sec; url=$url", "", "refresh");
	} else {
		header("Location: ".html_entity_decode($url));		
	}
	if ($exit && !$main->message->show) {
		exit;
	}
}

function get_qs() {
	if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
		return isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
	} else {
		return isset($_POST['query_string']) ? $_POST['query_string'] : '';
	}
}

function get($key) {
	global $page_admin, $main;
	if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
		$ret = isset($_GET[$key])?$_GET[$key]:null;
	} else {
		$qs = isset($_POST['query_string']) ? $_POST['query_string'] : '';
		if (!empty($qs)) {
			parse_str($qs, $output);
			$ret = isset($output[$key])?$output[$key]:null;
		} else {
			$ret = null;
		}
	}
	switch ($key) {
		case 'page':
			$valid_array = getdirlist(ROOT_PATH."includes/pages/");
			array_unshift($valid_array, 'startup');
			break;
		case 'subpage':
			$valid_array = getdirlist(ROOT_PATH."includes/pages/".get('page').'/', FALSE, TRUE);
			for ($key=0;$key<count($valid_array);$key++) {
				$valid_array[$key] = basename($valid_array[$key], '.php');
				if (substr($valid_array[$key], 0, strlen(get('page'))+1) != get('page').'_') {
					array_splice($valid_array, $key, 1);
					$key--;
				} else {
					$valid_array[$key] = substr($valid_array[$key], strlen(get('page'))+1);
				}
			}
			array_unshift($valid_array, '');
			break;
	}
	if (isset($valid_array) && !in_array($ret, $valid_array)) $ret = $valid_array[0];
	return $ret;
}

function getdirlist($dirName, $dirs=TRUE, $files=FALSE) { 
	$d = dir($dirName);
	$a = array();
	while($entry = $d->read()) { 
		if ($entry != "." && $entry != "..") { 
			if (is_dir($dirName."/".$entry)) { 
				if ($dirs==TRUE) array_push($a, $entry); 
			} else { 
				if ($files==TRUE) array_push($a, $entry); 
			} 
		} 
	} 
	$d->close();
	return $a;
} 

function makelink($extra="", $cur_qs=FALSE, $cur_gs_vars=TRUE, $htmlspecialchars=TRUE) {
	global $qs_vars;
	$o = array();
	if(get('show_map') == "no") $o = array_merge_check($o,array("show_map" => "no"));
	if ($cur_qs == TRUE) {
		parse_str(get_qs(), $qs);
		$o = array_merge_check(isset($o)?$o:null, isset($qs)?$qs:null);
	}
	if ($cur_gs_vars == TRUE) {
		$o = array_merge_check(isset($o)?$o:null, isset($qs_vars)?$qs_vars:null);
	}
	$o = array_merge_check(isset($o)?$o:null, isset($extra)?$extra:null);
	return ($htmlspecialchars?htmlspecialchars('?'.query_str($o)):'?'.query_str($o));
}

function query_str($params) {
   $str = '';
   foreach( (array) $params as $key => $value) {
   		if ($value == '') continue;
	   $str .= (strlen($str) < 1) ? '' : '&';
	   $str .= $key . '=' . rawurlencode($value);
   }
   return ($str);
}

function cookie($name, $value) {
	global $vars;
	$expire = time() + (isset($vars['cookies']['expire']) ? $vars['cookies']['expire'] : 3600);
	return setcookie($name, $value, $expire, "/");
}

function date_now() {
      return date("Y-m-d H:i:s");
 }
 
function message($arg) {
	global $lang;
	$mes = $lang['message'][func_get_arg(0)][func_get_arg(1)][func_get_arg(2)];
	for ($i=3;$i<func_num_args();$i++) {
		$par = func_get_arg($i);
		$mes = str_replace('%'.($i-2).'%', $par, $mes);
	}
	return $mes;
}

function lang($arg) {
	global $lang;
	$mes = $lang[func_get_arg(0)];
	for ($i=1;$i<func_num_args();$i++) {
		$par = func_get_arg($i);
		$mes = str_replace('%'.($i).'%', $par, $mes);
	}
	return $mes;
}

function template($assign_array, $file) {
       global $smarty, $vars;
       $path_parts = pathinfo($file);
       $extension = isset($path_parts['extension']) ? $path_parts['extension'] : '';
       // Always resolve template path relative to the current theme directory
       if (strtolower($extension) !== "tpl") {
	       // e.g. includes/pages/admin/admin_services.php -> includes/pages/admin/admin_services.tpl
	       $base_name = basename($path_parts['basename'], $extension ? '.'.$extension : '');
	       if (!isset($path_parts['dirname']) || $path_parts['dirname'] === '.' || $path_parts['dirname'] === '') {
		       // Plain template name like "html" -> look under includes/html.tpl
		       $tpl_file = 'includes/' . $base_name . '.tpl';
	       } else {
		       $tpl_file = $path_parts['dirname'] . '/' . $base_name . '.tpl';
		       // Normalize to start from the includes/ directory for theme resolution
		       $tpl_file = preg_replace('#^.*includes[/\\\\]#', 'includes/', $tpl_file);
	       }
	       $tpl_file = str_replace('\\', '/', $tpl_file);
       } else {
	       $tpl_file = $file;
       }
       reset_smarty();
       $smarty->assign($assign_array);
       try {
	       $result = $smarty->fetch($tpl_file);
	       return $result;
       } catch (Exception $e) {
	       return '<div style="color:red;border:2px solid red;padding:10px;">Template error: ' . htmlspecialchars($e->getMessage()) . '<br>File: ' . htmlspecialchars($tpl_file) . '</div>';
       } catch (Error $e) {
	       return '<div style="color:red;border:2px solid red;padding:10px;">PHP Error in template: ' . htmlspecialchars($e->getMessage()) . '<br>File: ' . htmlspecialchars($tpl_file) . '</div>';
       }
}

function reset_smarty() {
	global $smarty, $lang, $vars;
	$smarty->clearAllAssign();
	
	// Smarty 3.x/4.x uses assign() instead of assign_by_ref()
	$smarty->assign('lang', $lang);
	
	// Use web-relative paths for templates (needed for JavaScript/browser resources)
	// These paths are relative to the web root, not filesystem paths
	// Only keep themes that actually exist on disk
	$available_themes = array_values(array_filter((array)$vars['templates']['available'], function($tpl) use ($vars) {
		return is_dir($vars['templates']['path'].$tpl.'/');
	}));

	// Handle explicit theme switch via query param
	if (isset($_GET['theme'])) {
		$requested = trim($_GET['theme']);
		if ($requested !== '' && in_array($requested, $available_themes)) {
			$_SESSION['theme_override'] = $requested;
			setcookie('theme_override', $requested, time() + 60*60*24*30, "/");
		} else {
			unset($_SESSION['theme_override']);
			setcookie('theme_override', '', time() - 3600, "/");
		}
	}

	// Resolve theme: override > user preference > cookie > default
	$tpl_name = null;
	if (isset($_SESSION['theme_override']) && in_array($_SESSION['theme_override'], $available_themes)) {
		$tpl_name = $_SESSION['theme_override'];
	} elseif (isset($_SESSION['user_template']) && in_array($_SESSION['user_template'], $available_themes)) {
		$tpl_name = $_SESSION['user_template'];
	} elseif (isset($_COOKIE['theme_override']) && in_array($_COOKIE['theme_override'], $available_themes)) {
		$tpl_name = $_COOKIE['theme_override'];
	} else {
		$tpl_name = isset($vars['templates']['default']) ? $vars['templates']['default'] : 'basic';
	}
	// Final fallback to first available if chosen theme is missing
	if (!in_array($tpl_name, $available_themes) && count($available_themes) > 0) {
		$tpl_name = $available_themes[0];
	}

	$tpl_web_dir = "templates/".$tpl_name."/";
	// Point Smarty to the selected theme (with basic fallback)
	$smarty->setTemplateDir(array(
		$vars['templates']['path'].$tpl_name.'/',
		$vars['templates']['path'].'basic/'
	));
	// Use per-theme compile dir
	if (!empty($vars['templates']['compiled_path'])) {
		$smarty->setCompileDir($vars['templates']['compiled_path'].$tpl_name.'/');
	}
	
	$smarty->assign('tpl_dir', $tpl_web_dir);
	$smarty->assign('img_dir', $tpl_web_dir."images/");
	$smarty->assign('css_dir', $tpl_web_dir."css/");
	$smarty->assign('js_dir', $tpl_web_dir."scripts/javascripts/");
	$smarty->assign('available_themes', $available_themes);
	$smarty->assign('current_theme', $tpl_name);
	
	// Load site theme setting
	$site_theme = 'light';
	$settings_file = ROOT_PATH . "config/site_settings.json";
	if (file_exists($settings_file)) {
		$json = file_get_contents($settings_file);
		$settings = json_decode($json, true);
		if (isset($settings['theme'])) {
			$site_theme = $settings['theme'];
		}
	}
	$smarty->assign('site_theme', $site_theme);
}

function delfile($str) 
{ 
   foreach( (array) glob($str) as $fn) { 
	   unlink($fn); 
   } 
} 

function resizeJPG($filename, $width, $height) {

	list($width_orig, $height_orig) = getimagesize($filename);
	
	if ($width && ($width_orig < $height_orig)) {
	   $width = ($height / $height_orig) * $width_orig;
	} else {
	   $height = ($width / $width_orig) * $height_orig;
	}

   // Resample
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	return $image_p;
}

function reverse_zone_from_ip($ip) {
	global $vars;
	$ret = explode(".", $ip);
	$ret = $ret[2].".".$ret[1].".".$ret[0].".".$vars['dns']['reverse_zone'];
	return $ret;
}

function is8bit($str) {
	for($i=0; $i <= strlen($str); $i++)
		if(ord($str[$i]) >> 7)   
			return TRUE;
	return FALSE;
}

function sendmail($to, $subject, $body, $from_name='', $from_email='', $cc_to_sender=FALSE) {
	global $vars, $lang;
	$subject = mb_encode_mimeheader($subject, $lang['charset'], 'B', "\n");
	if (empty($from_email)) {
		$from_name = $vars['mail']['from_name'];
		$from_email = $vars['mail']['from'];
	}
	$from_name = mb_encode_mimeheader($from_name, $lang['charset'], 'B', "\n");
	if ($from_name == $from_email) {
		$from = $from_email;
	} else {
		$from = $from_name.' <'.$from_email.'>';
	}
	$headers = "From: $from\n";
	if ($cc_to_sender) $headers .= "Cc: $from\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= 'Content-Type: text/plain; charset='.$lang['charset']."\n";
	$headers .= 'Content-Transfer-Encoding: '.(is8bit($body) ? '8bit' : '7bit');
	return @mail($to, $subject, $body, $headers);
}

function correct_ip($ip, $ret_null=TRUE) {
	if ($ip == '' && $ret_null === TRUE) return '';
	$t = explode(".", $ip, 4);
	for ($i=0;$i<4;$i++) {
		$t[$i] = (integer)(isset($t[$i])?$t[$i]:null);
	}
	return implode(".", $t);
}

function correct_ip_min($ip, $ret_null=TRUE, $pad=3) {
	if ($ip == '' && $ret_null === TRUE) return '';
	$t = explode(".", $ip, 4);
	for ($i=0;$i<4;$i++) {
		if(!isset($t[$i+1]) && (isset($t[$i]) && $t[$i] != null)) {
			switch (substr($t[$i], 0, 1)) {
			case '0':
				break;
			case '1':
			case '2':
				$t[$i] = intval(str_pad($t[$i], (substr($t[$i], 1, 1) >= 6?2:$pad), "0"));
				break;
			default:
				$t[$i] = intval(str_pad($t[$i], ($pad==3?2:$pad), "0"));
			}
		}elseif(!isset($t[$i]) || $t[$i] == null) {
			$t[$i] = 0;
		}else{
			$t[$i] = (integer)($t[$i]);
		}
	}
	return implode(".", $t);
}

function correct_ip_max($ip, $ret_null=TRUE, $pad=3) {
	if ($ip == '' && $ret_null === TRUE) return '';
	$t = explode(".", $ip, 4);
	for ($i=0;$i<4;$i++) {
		if(!isset($t[$i+1]) && (isset($t[$i]) && $t[$i] != null)) {
			switch (substr($t[$i], 0, 1)) {
			case '0':
				break;
			case '1':
			case '2':
				$t[$i] = intval(str_pad($t[$i], (substr($t[$i], 1, 1) >= 6?2:$pad), "9"));
				break;
			default:
				$t[$i] = intval(str_pad($t[$i], ($pad==3?2:$pad), "9"));
			}
			if ($t[$i] > 255) $t[$i] = 255;
		}elseif(!isset($t[$i]) || $t[$i] == null) {
			$t[$i] = 255;
		}else{
			$t[$i] = (integer)($t[$i]);
		}
	}
	return implode(".", $t);
}

function generate_account_code() {
	for ($i=1;$i<=20;$i++) {
		$ret .= rand(0, 9);
	}
	return $ret;
}

function translate($field, $section='') {
	global $lang;
	if ($section == '') {
		$t = $lang[$field];
	} else {
		$t = $lang[$section][$field];
	}
	return ($t == '' ? $field : $t);
}

function validate_name_ns($name, $node) {
	global $db;
	$ret = null;
	$extension = null;
	$name = str_replace("_", "-", $name);
	$name = strtolower($name);
	$allowchars = 'abcdefghijklmnopqrstuvwxyz0123456789-';
	for ($i=0; $i<strlen($name); $i++) {
		$char = substr($name, $i, 1);
		if (strstr($allowchars, $char) !== FALSE) $ret .= $char;
	}
	if ($ret == '') $ret = 'noname';
	$i=2;
	do {
		$cnt = $db->cnt('', 'nodes', "name_ns = '".$ret.$extension."' AND id != '".$node."'");
		if ($cnt > 0) {
			$extension = "-".$i;
			$i++;
		}
	} while ($cnt > 0);
	return ($extension != '' ? $ret.$extension : $ret);
}

function is_ip($ip, $full_ip=TRUE) {
	$ip_ex = explode(".", $ip ?? '', 4);
	if ($ip == '') return FALSE;
	for ($i=0;$i<count($ip_ex);$i++) {
		if ($i == count($ip_ex)-1 && $ip_ex[$i] == '') continue;
		if (!is_numeric($ip_ex[$i]) || $ip_ex[$i] < 0 || $ip_ex[$i] > 255) return FALSE; 
	}
	return ($full_ip?(count($ip_ex)==4):TRUE);
}

function include_gmap($javascript) {
	global $main, $vars;
	
	// Debug: Check if $main is available
	if (!isset($main) || !is_object($main)) {
		error_log("include_gmap ERROR: \$main is not set or not an object");
		return FALSE;
	}
	if (!isset($main->html) || !is_object($main->html)) {
		error_log("include_gmap ERROR: \$main->html is not set or not an object");
		return FALSE;
	}
	if (!isset($main->html->head) || !is_object($main->html->head)) {
		error_log("include_gmap ERROR: \$main->html->head is not set or not an object");
		return FALSE;
	}
	
	// Load Leaflet CSS (without SRI to avoid CORS issues)
	$main->html->head->add_link(array(
		'rel' => 'stylesheet',
		'href' => 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css'
	));
	
	// Load Leaflet.markercluster CSS
	$main->html->head->add_link(array(
		'rel' => 'stylesheet',
		'href' => 'https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css'
	));
	$main->html->head->add_link(array(
		'rel' => 'stylesheet',
		'href' => 'https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css'
	));
	
	// Load Leaflet JS (without SRI to avoid CORS issues)
	$main->html->head->add_script("text/javascript", "https://unpkg.com/leaflet@1.9.4/dist/leaflet.js");
	
	// Load Leaflet.markercluster JS
	$main->html->head->add_script("text/javascript", "https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js");
	
	// Load custom map JavaScript
	$main->html->head->add_script("text/javascript", $javascript);
	
	$main->html->body->tags['onload'] = "gmap_onload()";	
	return TRUE;
}

function getmicrotime(){ 
	$mt = explode(" ", microtime()); 
	return ((float)$mt[0] + (float)$mt[1]); 
} 

function array_multimerge($array1, $array2) {
	if (is_array($array2) && count($array2)) {
		foreach ($array2 as $k => $v) {
			if (is_array($v) && count($v)) {
				$array1[$k] = array_multimerge($array1[$k], $v);
			} else {
				$array1[$k] = $v;
			}
		}
	} else {
		$array1 = $array2;
	}
	
	return $array1;
}

function language_set($language='', $force=FALSE) {
	global $vars, $db, $lang;
	if ($force) {
		$tl = $language;
	} elseif (get('lang') != '') {
		$tl = get('lang');
	} elseif (isset($_SESSION['lang']) && $_SESSION['lang'] != '') {
		$tl = $_SESSION['lang'];
	} elseif ($language != '') {
		$tl = $language;
	} else {
		$tl = $vars['language']['default'];
	}
	
	if ($vars['language']['enabled'][$tl] === TRUE && 
			file_exists(ROOT_PATH."globals/language/".$tl.".php")) {

		include_once(ROOT_PATH."globals/language/".$tl.".php");
		if (file_exists(ROOT_PATH."config/language/".$tl."_overwrite.php")) {
			include_once(ROOT_PATH."config/language/".$tl."_overwrite.php");
			$lang = array_multimerge($lang, $lang_overwrite);
		}
		// Set-up mbstring's internal encoding (mainly for supporting UTF-8)
		if (function_exists('mb_internal_encoding')) {
			mb_internal_encoding($lang['charset']);
		}
		
		// Set-up NAMES on database system
		if($vars['db']['version']>=4.1)
			$db->query("SET NAMES '".$lang['mysql_charset']."'");

	} else {

		if ($tl == $_SESSION['lang']) unset($_SESSION['lang']);
		die("WiND error: Selected language not found.");

	}
}

function url_fix ($url, $default_prefix="http://") {
	if($url == "") {
		return;
	}
	// Windows shares (samba) check
	if (substr(stripslashes($url), 0, 2) == '\\\\') {
		return 'file://'.str_replace('\\', '/', substr(stripslashes($url), 2));
	}
	// Insert default prefix
	if (strpos($url, '://') === FALSE) {
		return $default_prefix.$url;
	}
	return $url;
	
}

function replace_sql_wildcards($str) {
	$str = str_replace("*", "%", $str);
	$str = str_replace("?", "_", $str);
	return $str;
}
//#$#
/**
 * Logs an administrator action taking any arguments as log data.
 */
function log_admin_action()
{
	global $main, $db, $vars;

	$data = func_get_args();

	if(count($data) == 1 && is_array($data[0]))
	{
		$data = $data[0];
	}

	if(!is_array($data))
	{
		$data = array($data);
	}
   	$uid=$main->userdata->user;
	$log_entry = array(
		"uid" => $uid,
		"ipaddress" => get_ip(),
		"dateline" => date("Y-m-d H:i:s"),
		"page" => get('page'),
		"action" => get('subpage'),
		"data" => serialize($data)
	);
	$fields = "`".implode("`,`", array_keys($log_entry))."`";
	$values = implode("','", $log_entry);
	
	#$db->add("adminlog", $log_entry);
	#$log_query = "INSERT INTO actionlogs ($fields) VALUES ($values)";
	$log_query= $db->query("INSERT INTO actionlog ($fields) VALUES ('$values')");
}
/**
 * Fetch the IP address of the current user.
 *
 * @return string The IP address.
 */
function get_ip()
{
	if(isset($_SERVER['REMOTE_ADDR']))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		if(preg_match_all("#[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}#s", $_SERVER['HTTP_X_FORWARDED_FOR'], $addresses))
		{
			foreach($addresses[0] as $key => $val)
			{
				if(!preg_match("#^(10|172\.16|192\.168)\.#", $val))
				{
					$ip = $val;
					break;
				}
			}
		}
	}

	if(!isset($ip))
	{
		if(isset($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		else
		{
			$ip = '';
		}
	}

	$ip = preg_replace("#([^.0-9 ]*)#", "", $ip);
	return $ip;
}

#$#

?>
