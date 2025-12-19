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

class userdata {
	
	var $logged=FALSE;
	var $user='';
	var $info = array();
	var $privileges = array();
	
	#CONFIG
	var $users_table = "users";
	var $primary_key = "id";
	var $username_key = "username";
	var $password_key = "password";
	var $info_keys = "username, name, surname, date_in, last_visit, last_session, status, language, theme";
	var $last_session_key = "last_session";
	var $last_visit_key = "last_visit";
	
	function __construct() {
		session_start();
		// Short-circuit auto login if this request is explicitly logging out
		if (isset($_GET['action']) && $_GET['action'] === 'logout') {
			$this->logout();
			return;
		}
		if (isset($_SESSION['userdata'][$this->primary_key])) {
			$this->logged = TRUE;
			$this->user = $_SESSION['userdata'][$this->primary_key];
			$this->refresh_session();
		} else {
			if (isset($_COOKIE['userdata'][$this->primary_key])) {
				$uid = $_COOKIE['userdata'][$this->primary_key];
				$p_md5 = $_COOKIE['userdata'][$this->password_key];
				if ($this->check_login($uid, $p_md5, TRUE)) {
					$this->logged = TRUE;
					$this->user = $uid;
					$_SESSION['userdata'][$this->primary_key] = $uid;
					$this->reset_visit();
					$this->refresh_session();
				} else {
					$this->logged = FALSE;
				}
			} else {
				$this->logged = FALSE;			
			}
		}
		$this->load_info();
	}
	
	function load_info() {
		if ($this->logged) {
			global $db;
			$get_res = $db->get($this->info_keys, $this->users_table, $this->primary_key." = '$this->user'");
			// Fallback if custom columns are missing (e.g., theme not migrated yet)
			if (!$get_res || !isset($get_res[0])) {
				$get_res = $db->get("username, name, surname, date_in, last_visit, last_session, status, language", $this->users_table, $this->primary_key." = '$this->user'");
			}
			$this->info = isset($get_res[0]) ? $get_res[0] : array();
			
			// EDIT HERE
			$get_res = $db->get('type', 'rights', "user_id = '$this->user'");		
			foreach( (array) $get_res as $key => $value) {
				$this->privileges[$value['type']] = TRUE;
			}
			//
			// Cache per-user template preference in session for the current request
			if (isset($this->info['theme']) && $this->info['theme'] !== '') {
				$_SESSION['user_template'] = $this->info['theme'];
			} else {
				unset($_SESSION['user_template']);
			}
			
		} else {
			unset($this->info);
			unset($this->privileges);
			unset($_SESSION['user_template']);
		}
	}
	
	function login($username, $password, $save = FALSE) {
		$this->logout();
		if ($this->check_login($username, md5($password))) {
			global $db;
			$get_res = $db->get($this->primary_key, $this->users_table, $this->username_key." = '$username'");
			$uid = $get_res[0][$this->primary_key];
			$this->logged = TRUE;
			$this->user = $uid;
			$_SESSION['userdata'][$this->primary_key] = $uid;
			$this->reset_visit();
			$this->refresh_session();
			if ($save) {
				cookie('userdata['.$this->primary_key.']', $uid);
				cookie('userdata['.$this->password_key.']', md5($password));
			}
		}
		$this->load_info();
		return $this->logged;
	}
	
	function logout() {
		if ($this->logged) {
			// Clear persistent cookies immediately
			@setcookie('userdata['.$this->primary_key.']', '', time() - 3600, "/");
			@setcookie('userdata['.$this->password_key.']', '', time() - 3600, "/");
			// Reset session state
			$_SESSION = array();
			if (session_id() !== '' || isset($_COOKIE[session_name()])) {
				@setcookie(session_name(), '', time() - 3600, "/");
			}
			session_destroy();
			$this->logged = FALSE;
			$this->user = '';
		} else {
			// Also clear stray cookies even if we think we're logged out
			@setcookie('userdata['.$this->primary_key.']', '', time() - 3600, "/");
			@setcookie('userdata['.$this->password_key.']', '', time() - 3600, "/");
		}
		unset($_SESSION['user_template']);
		$this->load_info();
	}
	
	function check_login($username, $password, $user_pk = FALSE) {
		global $db;
		$get_res = $db->get($this->password_key, $this->users_table, ($user_pk?$this->primary_key:$this->username_key)." = '$username'");
		if (isset($get_res[0][$this->password_key]) && $password == $get_res[0][$this->password_key]) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function reset_visit($uid="") {
		if ($uid == "") $uid = $this->user;
		global $db;
		$ret = $db->get($this->last_session_key, $this->users_table, $this->primary_key." = '$uid'");
		$ret = $ret[0];
		$db->set($this->users_table, array($this->last_visit_key => $ret[$this->last_session_key]), $this->primary_key." = '$uid'", FALSE);
	}
	
	function refresh_session($uid="") {
		if ($uid == "") $uid = $this->user;
		global $db;
		$db->set($this->users_table, array($this->last_session_key => date_now()), $this->primary_key." = '$uid'", FALSE);
	}

}

?>
