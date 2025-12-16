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

class construct {
	
	function form($form, $template='constructors/form.tpl') {
		global $smarty;
		if (substr(strrchr($template, "."), 1) != "tpl") {
			$path_parts = pathinfo($template);
			$form_name = isset($form->info['FORM_NAME']) ? $form->info['FORM_NAME'] : 'default';
			$tpl_file = 'includes'.substr($path_parts['dirname'], strpos($path_parts['dirname'], 'includes') + 8)."/".basename($path_parts['basename'], '.'.$path_parts['extension']).'_'.$form_name.'.tpl';
			// Get template directory using public method for Smarty 5.x compatibility
			$tpl_dirs = $smarty->getTemplateDir();
			$template_dir = (is_array($tpl_dirs)) ? $tpl_dirs[0] : $tpl_dirs;
			if (file_exists($template_dir.$tpl_file)) {
				$template = $tpl_file;
			} else {
				$template='constructors/form.tpl';
			}
		}
		return template(array("data" => $form->data, "extra_data" => $form->info, "hidden_qs" => get_qs()), $template);
	}
	
	function table($table, $template='constructors/table.tpl') {
		global $smarty;
		if (substr(strrchr($template, "."), 1) != "tpl") {
			$path_parts = pathinfo($template);
			$table_name = isset($table->info['TABLE_NAME']) ? $table->info['TABLE_NAME'] : 'default';
			$tpl_file = 'includes'.substr($path_parts['dirname'], strpos($path_parts['dirname'], 'includes') + 8)."/".basename($path_parts['basename'], '.'.$path_parts['extension']).'_'.$table_name.'.tpl';
			// Get template directory using public method for Smarty 5.x compatibility
			$tpl_dirs = $smarty->getTemplateDir();
			$template_dir = (is_array($tpl_dirs)) ? $tpl_dirs[0] : $tpl_dirs;
			if (file_exists($template_dir.$tpl_file)) {
				$template = $tpl_file;
			} else {
				$template='constructors/table.tpl';
			}
		}
		return template(array("data" => $table->data, "extra_data" => $table->info, "hidden_qs" => get_qs()), $template);
	}
		
}

?>
