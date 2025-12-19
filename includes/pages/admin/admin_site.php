<?php
/*
 * WiND - Wireless Nodes Database
 *
 * Copyright (C) 2025 WNA Team
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

class admin_site {

	var $tpl;
	var $settings_file;
	
	function __construct() {
		$this->settings_file = ROOT_PATH . "config/site_settings.json";
	}
	
	function get_site_settings() {
		$defaults = array(
			'theme' => 'light',
			'site_title' => 'WiND - Wireless Nodes Database'
		);
		
		if (file_exists($this->settings_file)) {
			$json = file_get_contents($this->settings_file);
			$settings = json_decode($json, true);
			if (is_array($settings)) {
				return array_merge($defaults, $settings);
			}
		}
		return $defaults;
	}
	
	function save_site_settings($settings) {
		global $main;
		
		if (!isset($main->userdata->privileges['admin'])) {
			error_log("save_site_settings: No admin privileges");
			return false;
		}
		
		$current = $this->get_site_settings();
		$new_settings = array_merge($current, $settings);
		
		$result = file_put_contents($this->settings_file, json_encode($new_settings, JSON_PRETTY_PRINT));
		error_log("save_site_settings: Writing to " . $this->settings_file . " - result: " . var_export($result, true));
		
		if ($result !== false) {
			return true;
		}
		return false;
	}
	
	function save_startup_html() {
		global $main;
		
		if (!isset($main->userdata->privileges['admin'])) {
			return false;
		}
		
		if (isset($_POST['startup_html'])) {
			$html = $_POST['startup_html'];
			$file_path = ROOT_PATH . "config/startup.html";
			
			if (file_put_contents($file_path, $html) !== false) {
				return true;
			}
			return false; // Only fail if write actually failed
		}
		return true; // No startup_html in POST is OK (field might be empty)
	}
	
	function output() {
		global $main, $lang;
		
		if (!isset($main->userdata->privileges['admin'])) {
			return template($this->tpl, __FILE__);
		}
		
		// Handle form submission
		if (isset($_POST['action']) && $_POST['action'] == 'save') {
			$theme_saved = true;
			$html_saved = true;
			
			error_log("admin_site: Form submitted, POST = " . print_r($_POST, true));
			
			// Save theme setting
			if (isset($_POST['theme'])) {
				$theme = $_POST['theme'];
				error_log("admin_site: Theme from POST = " . $theme);
				   if (in_array($theme, array('light', 'dark', 'modern'))) {
					   $theme_saved = $this->save_site_settings(array('theme' => $theme));
					   // Also update config/config.php for persistent theme selection
					   $config_file = ROOT_PATH . 'config/config.php';
					   if (is_writable($config_file)) {
						   $config_contents = file_get_contents($config_file);
						   // Replace the default theme line
						   $config_contents = preg_replace(
							   "/('default'\s*=>\s*getenv\('WIND_THEME'\) ?: ')[^']*(',)/",
							   "${1}{$theme}${2}",
							   $config_contents
						   );
						   file_put_contents($config_file, $config_contents);
					   }
					   error_log("admin_site: theme_saved = " . var_export($theme_saved, true));
				   }
			}
			
			// Save startup HTML
			$html_saved = $this->save_startup_html();
			
			if ($theme_saved && $html_saved) {
				$main->message->set_fromlang('info', 'site_settings_saved', 
					makelink(array("page" => "admin", "subpage" => "site")));
			} else {
				$main->message->set_fromlang('error', 'site_settings_save_failed');
			}
		}
		
		// Load current settings
		$settings = $this->get_site_settings();
		$this->tpl['current_theme'] = $settings['theme'];
		   $this->tpl['themes'] = array(
			   'light' => isset($lang['theme_light']) ? $lang['theme_light'] : 'Light',
			   'dark' => isset($lang['theme_dark']) ? $lang['theme_dark'] : 'Dark',
			   'modern' => isset($lang['theme_modern']) ? $lang['theme_modern'] : 'Modern Material'
		   );
		
		// Load current startup.html content
		$startup_file = ROOT_PATH . "config/startup.html";
		$this->tpl['startup_html'] = '';
		if (file_exists($startup_file)) {
			$this->tpl['startup_html'] = file_get_contents($startup_file);
		}
		
		$this->tpl['form_action'] = makelink(array("page" => "admin", "subpage" => "site"));
		
		return template($this->tpl, __FILE__);
	}

}

// Helper function to get current theme (can be called from anywhere)
function get_current_theme() {
	$settings_file = ROOT_PATH . "config/site_settings.json";
	if (file_exists($settings_file)) {
		$json = file_get_contents($settings_file);
		$settings = json_decode($json, true);
		if (isset($settings['theme'])) {
			return $settings['theme'];
		}
	}
	return 'light';
}

?>
