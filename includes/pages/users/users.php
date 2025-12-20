<?php
/*
 * WiND - Wireless Nodes Database
 *
 * Copyright (C) 2005 Nikolaos Nikalexis <winner@cube.gr>
 * Copyright (C) 2009 Vasilis Tsiligiannis <b_tsiligiannis@silverton.gr>
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

if (get('action') == 'restore') include_once(ROOT_PATH."includes/pages/users/users_restore.php");

class users {

	var $tpl;
	var $restore;
	
	function __construct() {
		if (get('action') == 'restore') {
			$this->restore = new users_restore;
		}
	}
	
	function form_user() {
		global $main, $db, $vars, $lang;
		// Helper: check if a column exists to stay compatible when DB isn't migrated yet
		$has_field = function($table, $col) use ($db) {
			$fields = $db->get_fields($table);
			foreach ((array)$fields as $f) {
				if (isset($f['Field']) && $f['Field'] === $col) return TRUE;
			}
			return FALSE;
		};
		$has_theme = $has_field('users', 'theme');
		$form_user = new form(array('FORM_NAME' => 'form_user'));
		$form_user->db_data('users.username, users.password, users.surname, users.name, users.email, users.phone, users.info, users.language' . ($has_theme ? ', users.theme' : ''));
		// Hide password...
		$form_user->data[1]['value'] = '';
		// ...and show it as required
		if (get('user') == 'add') $form_user->data[1]['Null'] = '';
		array_splice($form_user->data, 2, 0, array($form_user->data[1]));
		$form_user->data[2]['Field'] .= '_c';
		$form_user->data[2]['fullField'] .= '_c';
		$form_user->data[8]['Type'] = 'enum';
		$form_user->data[8]['Null'] = '';
		$form_user->data[8]['Type_Enums'][0] = array("value" => "", "output" => $lang['default']);
		foreach($vars['language']['enabled'] as $key => $value) {
			if ($value) array_push($form_user->data[8]['Type_Enums'], array("value" => $key, "output" => ($lang['languages'][$key]==''?$key:$lang['languages'][$key])));
		}
		// Theme preference (per-user), leave empty for default, only if DB supports it
		if ($has_theme) {
			$form_user->data[9]['Type'] = 'enum';
			$form_user->data[9]['Null'] = '';
			$form_user->data[9]['Type_Enums'][0] = array("value" => "", "output" => $lang['default']);
			foreach ((array)$vars['templates']['available'] as $tpl) {
				array_push($form_user->data[9]['Type_Enums'], array("value" => $tpl, "output" => $tpl));
			}
		}
		
		if (isset($main->userdata->privileges['admin']) && $main->userdata->privileges['admin'] === TRUE) {
			$form_user->db_data('rights.type, users.status');
			// Locate field indexes dynamically to avoid breakage when columns change
			$find_idx = function($field) use (&$form_user) {
				$matches = array();
				foreach ($form_user->data as $idx => $def) {
					if ($def['Field'] === $field || $def['fullField'] === $field) {
						$matches[] = $idx;
					}
				}
				return $matches;
			};
			$rights_idx = $find_idx('rights.type');
			if (isset($rights_idx[0])) {
				$form_user->data[$rights_idx[0]]['Type'] = 'enum_multi';
			}
			$form_user->db_data_values_multi("rights", "user_id", get('user'), 'type');	
			
			$form_user->db_data('users_nodes.node_id, users_nodes.node_id');
			$node_idxs = $find_idx('users_nodes.node_id');
			$all_nodes = $db->get("nodes.id AS value, CONCAT(nodes.name, ' (#', nodes.id, ')') AS output", "nodes", "", "", "nodes.name ASC");
			// First picker: owner
			if (isset($node_idxs[0])) {
				$form_user->data[$node_idxs[0]]['Field'] = 'node_id_owner';
				$form_user->data[$node_idxs[0]]['fullField'] = 'node_id_owner';
				$form_user->data[$node_idxs[0]]['Field_Text'] = $lang['node'].' (owner, admin only)';
				$form_user->data[$node_idxs[0]]['Type'] = 'pickup';
				$form_user->db_data_pickup("node_id_owner", "nodes", $all_nodes, TRUE);
			}
			// Second picker: co-admin
			if (isset($node_idxs[1])) {
				$form_user->data[$node_idxs[1]]['Type'] = 'pickup';
				$form_user->data[$node_idxs[1]]['Field_Text'] = $lang['node'].' (co-admin, admin only)';
				$form_user->db_data_pickup("users_nodes.node_id", "nodes", $all_nodes, TRUE);
			}
			// Pre-select existing owner/co-admin nodes
			if (isset($node_idxs[0])) {
				$owners = $db->get("node_id", "users_nodes", "user_id = '".get('user')."' AND owner = 'Y'");
				foreach ((array)$owners as $row) {
					$form_user->data[$node_idxs[0]]['value'][$row['node_id']] = "YES";
				}
			}
			if (isset($node_idxs[1])) {
				$coadmins = $db->get("node_id", "users_nodes", "user_id = '".get('user')."' AND owner != 'Y'");
				foreach ((array)$coadmins as $row) {
					$form_user->data[$node_idxs[1]]['value'][$row['node_id']] = "YES";
				}
			}
		}
		
		$form_user->db_data_values("users", "id", get('user'));
		$form_user->data[1]['value'] = '';
		return $form_user;
	}

	function output() {
		global $main, $construct, $db;
		// Admin-only impersonation hook
		if (get('action') === 'impersonate' && $main->userdata->privileges['admin'] === TRUE && get('user') !== '' && get('user') !== 'add') {
			// Remember who impersonated, so they can log back if needed
			$_SESSION['impersonator'] = $main->userdata->user;
			$_SESSION['userdata'][$main->userdata->primary_key] = get('user');
			$main->userdata->logged = TRUE;
			$main->userdata->user = get('user');
			$main->userdata->load_info();
			$main->message->set('Info', 'Now impersonating user #'.get('user'));
			header("Location: ".html_entity_decode(makelink(array(), FALSE, FALSE)));
			exit;
		}
		if(get('action') === "delete" && $main->userdata->privileges['admin'] === TRUE)
		{
			$ret = $db->del("users", '', "id = '".get('user')."'");
			if ($ret) {
				$main->message->set_fromlang('info', 'delete_success', makelink(array("page" => "admin", "subpage" => "users")));
			} else {
				$main->message->set_fromlang('error', 'generic');		
			}
			return ;
		}
		if (get('action') == 'activate') {
			$t = $db->get('account_code', 'users', "id = '".get('user')."'");
			if ($t[0]['account_code'] != '' && $t[0]['account_code'] == get('account_code')) {
				$db->set('users', array('status' => 'activated'), "id = '".get('user')."'");
				$main->message->set_fromlang('info', 'activation_success');
			} else {
				$main->message->set_fromlang('info', 'activation_failed');
			}
			return;
		}
		if (get('action') == 'logout') {
			$main->userdata->logout();
			// Always force immediate redirect after logout to avoid stale state
			$redirect = get('redirect');
			$redirect = ($redirect == "" ? makelink(array(), FALSE, FALSE) : $redirect);
			header("Location: ".html_entity_decode($redirect));
			exit;
		}
		if (get('action') == 'restore') {
			return $this->restore->output();
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && method_exists($this, 'output_onpost_'.$_POST['form_name'])) return call_user_func(array($this, 'output_onpost_'.$_POST['form_name']));
		if (get('user') != '') {
			$this->tpl['user_method'] = (get('user') == 'add' ? 'add' : 'edit');
			if(get('user') != 'add' && $main->userdata->privileges['admin'] === TRUE)
				$this->tpl['link_user_delete'] = makelink(array("action" => "delete"),TRUE);
			if (get('user') != 'add' && $main->userdata->privileges['admin'] === TRUE) {
				$this->tpl['link_impersonate'] = makelink(array("action" => "impersonate"), TRUE);
			}
			$this->tpl['form_user'] = $construct->form($this->form_user(), __FILE__);
			// Show nodes where this user is owner/admin or co-admin
			if (get('user') != 'add') {
				$this->tpl['nodes_owner'] = $db->get(
					"nodes.id, nodes.name",
					"nodes INNER JOIN users_nodes ON users_nodes.node_id = nodes.id",
					"users_nodes.user_id = '".get('user')."' AND users_nodes.owner = 'Y'",
					"",
					"nodes.name ASC"
				);
				$this->tpl['nodes_coadmin'] = $db->get(
					"nodes.id, nodes.name",
					"nodes INNER JOIN users_nodes ON users_nodes.node_id = nodes.id",
					"users_nodes.user_id = '".get('user')."' AND users_nodes.owner != 'Y'",
					"",
					"nodes.name ASC"
				);
				// Build links for convenience
				foreach ((array)$this->tpl['nodes_owner'] as $idx => $row) {
					$this->tpl['nodes_owner'][$idx]['url_view'] = makelink(array('page' => 'nodes', 'node' => $row['id']));
				}
				foreach ((array)$this->tpl['nodes_coadmin'] as $idx => $row) {
					$this->tpl['nodes_coadmin'][$idx]['url_view'] = makelink(array('page' => 'nodes', 'node' => $row['id']));
				}
			}
		}
		return template($this->tpl, __FILE__);
	}
	
	function output_onpost_form_user() {
		global $main, $db, $vars, $lang;
		
		if ($_POST['users__password'] != $_POST['users__password_c']) {
			$main->message->set_fromlang('error', 'password_not_match');
			return;
		}					
		if ($_POST['users__password'] == '' && get('user') != 'add') {
			unset($_POST['users__password']);
		} else {
			if ($_POST['users__password'] == '') {
				$main->message->set_fromlang('error', 'password_not_valid');
				return;
			}
			$_POST['users__password'] = md5($_POST['users__password']);
		}
		if (get('user') != 'add') $v_old = $db->get('email', 'users', "id = '".get('user')."'");
		$ret = TRUE;
		$form_user = $this->form_user();
		array_splice($form_user->data, 2, 1);
		if (!isset($_POST['users__password'])) array_splice($form_user->data, 1, 1);
		if (get('user') == 'add') {
			$a['status'] = 'pending';	
			$a['account_code'] = generate_account_code();
		}
		$ret = $form_user->db_set((isset($a)?$a:""), "users", "id", get('user'));
		if (get('user') == 'add') {
			$ins_id = $db->insert_id;
		} else {
			$ins_id = get('user');
			$a['account_code'] = generate_account_code();
		}
		// If the current user updated their own theme, refresh session preference
		// If the current user updated their own theme and the column exists, refresh session preference
		if ($ret && $has_theme && isset($main->userdata->user) && $ins_id == $main->userdata->user && isset($_POST['users__theme'])) {
			if ($_POST['users__theme'] !== '') {
				$_SESSION['user_template'] = $_POST['users__theme'];
			} else {
				unset($_SESSION['user_template']);
			}
		}
		if ($ret && $main->userdata->privileges['admin'] === TRUE) {
			$ret = $form_user->db_set_multi(array(), "rights", "user_id", get('user'));
			$ret = $ret && $form_user->db_set_multi(array(), "users_nodes", "user_id", $ins_id);
			$ret = $ret && $db->del('users_nodes', '', "user_id = '".$ins_id."' AND owner = 'Y'");
			if (isset($_POST['node_id_owner'])) {
				foreach((array)$_POST['node_id_owner'] as $value) {
					$ret = $ret && $db->del('users_nodes', '', "node_id = '".$value."' AND owner = 'Y'");
					$ret = $ret && $db->add('users_nodes', array("user_id" => $ins_id, "node_id" => $value, 'owner' => 'Y'));
				}
			}
		}
		if ($ret && (get('user') == 'add' || $v_old[0]['email'] != $_POST['users__email'])) {
			if (get('user') == 'add') {
				$t = 'user_activation';
			} else {
				$t = 'user_change_email';
			}
			$subject = $lang['email'][$t]['subject'];
			$subject = str_replace('##username##', $_POST['users__username'], $subject);
			$body = $lang['email'][$t]['body'];
			$body = str_replace('##username##', $_POST['users__username'], $body);
			$body = str_replace('##act_link##', $vars['site']['url']."?page=users&user=".$ins_id."&action=activate&account_code=".$a['account_code'], $body);
			$ret = sendmail($_POST['users__email'], $subject, $body);
			if ($ret && (get('user') != 'add' && $v_old[0]['email'] != $_POST['users__email'])) {
				$ret = $db->set('users', array('status' => 'pending', 'account_code' => $a['account_code']), "id = '".get('user')."'");
			}
		}
		if ($ret) {
			$main->message->set_fromlang('info', (get('user') == 'add'?'signup':'edit').'_success', makelink());
		} else {
			$main->message->set_fromlang('error', 'generic');		
		}
	}

}

?>

