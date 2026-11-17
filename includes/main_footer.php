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
		// Theme selector data
		$this->tpl['available_themes'] = isset($vars['templates']['available']) ? $vars['templates']['available'] : array();
		$this->tpl['current_theme'] = isset($vars['templates']['default']) ? $vars['templates']['default'] : 'basic';
		if (isset($GLOBALS['smarty'])) {
			// pick from smarty assigns if present
			$this->tpl['current_theme'] = $GLOBALS['smarty']->getTemplateVars('current_theme') ?: $this->tpl['current_theme'];
		}
		
		// Add debug link if admin and debug enabled
		if (isset($main->userdata->privileges['admin']) && $main->userdata->privileges['admin'] === TRUE && isset($vars['debug']['enabled']) && $vars['debug']['enabled'] == TRUE) {
			$this->tpl['debug_mysql'] = ROOT_PATH . 'debug/mysql.php?' . get_qs();
		}
		
		// Use template() to render the footer template
		try {
			return template($this->tpl, __FILE__).$this->session_debug();
		} catch (Throwable $e) {
			// Fallback to simple footer if template fails
			error_log("Footer template error: " . $e->getMessage());
			$ret = '<div class="footer">' . "\n";
			$ret .= '<p>PHP time: ' . number_format($this->tpl['php_time'], 3) . 's | MySQL time: ' . number_format($this->tpl['mysql_time'], 3) . 's</p>' . "\n";
			$ret .= '<p><b>WiND - Wireless Nodes Database</b></p>' . "\n";
			$ret .= '</div>' . "\n";
			return $ret.$this->session_debug();
		}
	}

	// Shown only while $config['nerdid']['debug'] is on
	function session_debug() {
		global $main, $db, $vars;
		if (empty($vars['nerdid']['debug'])) return '';
		$ud = $main->userdata;
		$sid = session_id();
		$uid = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : '';
		$row = ($uid !== '') ? $db->get('username, email, status', 'users', "id = '".intval($uid)."'", '', '', '1') : array();
		$info = array(
			'session id' => $sid === '' ? '(no session)' : substr($sid, 0, 8).'… (len '.strlen($sid).')',
			'session cookie received' => isset($_COOKIE[session_name()]) ? 'yes' : 'NO',
			'session save path' => session_save_path().(is_writable(session_save_path() ?: sys_get_temp_dir()) ? ' (writable)' : ' (NOT writable)'),
			'session cookie params' => json_encode(session_get_cookie_params()),
			'$_SESSION userdata id' => $uid === '' ? '(none)' : $uid,
			'userdata->logged' => $ud->logged ? 'TRUE' : 'FALSE',
			'userdata->user' => $ud->user,
			'userdata->info username' => isset($ud->info['username']) ? $ud->info['username'] : '(none)',
			'db username' => isset($row[0]['username']) ? $row[0]['username'] : '(no row)',
			'db email' => isset($row[0]['email']) ? $row[0]['email'] : '(no row)',
			'db status' => isset($row[0]['status']) ? $row[0]['status'] : '(no row)',
			'host / https' => (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').' / '.(!empty($_SERVER['HTTPS']) ? 'on' : 'off'),
			'db error' => method_exists($db, 'get_error') ? $db->get_error() : ''
		);
		$out = '<pre style="margin:12px;padding:8px;background:#fff8dc;border:1px solid #cc0;font-size:12px;text-align:left;color:#000">NerdID/session debug'."\n";
		foreach ($info as $k => $v) $out .= htmlspecialchars($k.': '.$v)."\n";
		return $out.'</pre>';
	}
	
}

?>
