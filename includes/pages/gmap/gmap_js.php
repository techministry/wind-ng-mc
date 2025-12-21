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

class gmap_js {
	
	var $tpl;

	private function normalize_wind_base($wind_url) {
		$wind_url = trim($wind_url);
		if ($wind_url === '') return '';
		if (preg_match('#^https?://#i', $wind_url)) {
			$wind_url = preg_replace('#^http://#i', 'https://', $wind_url);
		} else {
			$wind_url = 'https://'.$wind_url;
		}

		$parts = parse_url($wind_url);
		if ($parts === false || !isset($parts['host'])) return rtrim($wind_url, '/');

		$scheme = isset($parts['scheme']) ? $parts['scheme'] : 'https';
		$host = $parts['host'];
		if (isset($parts['port'])) $host .= ':' . $parts['port'];
		$path = isset($parts['path']) ? $parts['path'] : '';
		$path = preg_replace('#/+#', '/', $path);

		if ($path !== '') {
			if (preg_match('#^(.*?/index\\.php)(?:/.*)?$#i', $path, $matches)) {
				$path = $matches[1];
			} else {
				$path = rtrim($path, '/');
				$segments = explode('/', $path);
				$last = end($segments);
				$drop = array('nodes', 'map', 'gmap');
				if ($last !== false && in_array(strtolower($last), $drop, true)) {
					array_pop($segments);
					$path = implode('/', $segments);
				}
			}
		}

		$base = $scheme.'://'.$host;
		if ($path !== '') $base .= '/'.ltrim($path, '/');
		return rtrim($base, '/');
	}

	private function community_sources($link_xml_page) {
		global $db;

		$sources = array(
			array(
				'id' => 'local',
				'name' => (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] != '' ? $_SERVER['HTTP_HOST'] : 'Local'),
				'xml' => $link_xml_page,
				'base' => '',
				'default_enabled' => TRUE
			)
		);

		$rows = $db->get('id, name, windURL', 'communities', "windURL IS NOT NULL AND windURL <> ''", '', 'name ASC');
		foreach ((array)$rows as $row) {
			$clean_base = $this->normalize_wind_base($row['windURL']);
			if ($clean_base === '') continue;
			$proxy_xml = makelink(array(
				"page" => "gmap",
				"subpage" => "xml_proxy",
				"community" => intval($row['id'])
			), FALSE, FALSE, FALSE);
			$sources[] = array(
				'id' => 'community-'.$row['id'],
				'name' => $row['name'],
				'xml' => $proxy_xml,
				'base' => $clean_base,
				'default_enabled' => FALSE
			);
		}

		return $sources;
	}

	function __construct() {
		
	}
	
	function output() {
		global $db, $lang, $vars;

		// Ensure only JS is sent back (avoid PHP warnings breaking the script)
		while (ob_get_level()) {
			ob_end_clean();
		}
		error_reporting(0);
		if (!headers_sent()) {
			header("Content-Type: application/javascript; charset=utf-8");
			header("Cache-Control: no-cache, must-revalidate");
		}
		
		if (get('node') != '') {
			$node = $db->get('latitude, longitude', 'nodes', "id = ".intval(get('node')));
			$this->tpl['center_latitude'] = $node[0]['latitude'];
			$this->tpl['center_longitude'] = $node[0]['longitude'];
			$this->tpl['zoom'] = 17 - 2;
		} else {
			$t = $db->get('MIN(latitude) AS min_lat, MIN(longitude) AS min_lon, MAX(latitude) AS max_lat, MAX(longitude) AS max_lon',
							'nodes
							INNER JOIN users_nodes ON nodes.id = users_nodes.node_id
							LEFT JOIN users ON users.id = users_nodes.user_id',
							"users.status = 'activated'".
							" AND nodes.latitude >= ".str_replace(",", ".", $vars['gmap']['bounds']['min_latitude']).
							" AND nodes.latitude <= ".str_replace(",", ".", $vars['gmap']['bounds']['max_latitude']).
							" AND nodes.longitude >= ".str_replace(",", ".", $vars['gmap']['bounds']['min_longitude']).
							" AND nodes.longitude <= ".str_replace(",", ".", $vars['gmap']['bounds']['max_longitude']).
							" AND nodes.latitude IS NOT NULL AND nodes.longitude IS NOT NULL");
							
			if ($t[0]['min_lat'] != '' && $t[0]['min_lon'] != '' &&
					$t[0]['max_lat'] != '' && $t[0]['max_lon'] != '') {
				$max_lat = $t[0]['max_lat'];
				$min_lat = $t[0]['min_lat'];
				$max_lon = $t[0]['max_lon'];
				$min_lon = $t[0]['min_lon'];
			} else {
				$max_lat = $vars['gmap']['bounds']['max_latitude'];
				$min_lat = $vars['gmap']['bounds']['min_latitude'];
				$max_lon = $vars['gmap']['bounds']['max_longitude'];
				$min_lon = $vars['gmap']['bounds']['min_longitude'];
			}
			$this->tpl['center_latitude'] = ($max_lat + $min_lat) / 2;
			$this->tpl['center_longitude'] = ($max_lon + $min_lon) / 2;
			$this->tpl['center_latitude'] = str_replace(",", ".", $this->tpl['center_latitude']);
			$this->tpl['center_longitude'] = str_replace(",", ".", $this->tpl['center_longitude']);

			$this->tpl['max_latitude'] = str_replace(",", ".", $max_lat);
			$this->tpl['max_longitude'] = str_replace(",", ".", $max_lon);
			$this->tpl['min_latitude'] = str_replace(",", ".", $min_lat);
			$this->tpl['min_longitude'] = str_replace(",", ".", $min_lon);
			
		}
		$this->tpl['link_xml_page'] = makelink(array("page" => "gmap", "subpage" => "xml", "node" => get('node')), FALSE, TRUE, FALSE);
		$this->tpl['maps_available'] = $vars['gmap']['maps_available'];
		$this->tpl['community_sources_json'] = json_encode($this->community_sources($this->tpl['link_xml_page']));
		
		echo template($this->tpl, __FILE__);
		exit;
	}

}

?>

