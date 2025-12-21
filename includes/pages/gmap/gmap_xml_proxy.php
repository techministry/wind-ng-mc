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

class gmap_xml_proxy {

	private function normalize_wind_url($wind_url) {
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

	private function parse_community_id($value) {
		if ($value === null) return 0;
		$value = trim($value);
		if ($value === '') return 0;
		if (preg_match('/^community-(\\d+)$/', $value, $matches)) {
			return intval($matches[1]);
		}
		if (ctype_digit($value)) {
			return intval($value);
		}
		return 0;
	}

	private function build_param_query() {
		$allowed = array(
			'show_p2p',
			'show_aps',
			'show_clients',
			'show_unlinked',
			'show_links_p2p',
			'show_links_client',
			'show_links_vpn'
		);
		$params = array();
		foreach ($allowed as $key) {
			$value = get($key);
			if ($value !== null && $value !== '') {
				$params[$key] = $value;
			}
		}
		return query_str($params);
	}

	private function fetch_url($url) {
		if (function_exists('curl_init')) {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
			curl_setopt($ch, CURLOPT_TIMEOUT, 12);
			curl_setopt($ch, CURLOPT_USERAGENT, 'WiND gmap proxy');
			$body = curl_exec($ch);
			$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			if ($body === false || $code < 200 || $code >= 300) return false;
			return $body;
		}

		global $http_response_header;
		$context = stream_context_create(array(
			'http' => array(
				'timeout' => 12,
				'user_agent' => 'WiND gmap proxy',
				'follow_location' => 1
			)
		));
		$body = @file_get_contents($url, false, $context);
		if ($body === false) return false;
		if (isset($http_response_header) && is_array($http_response_header)) {
			foreach ($http_response_header as $header) {
				if (stripos($header, 'HTTP/') === 0 && !preg_match('#\\s2\\d\\d\\s#', $header)) {
					return false;
				}
			}
		}
		return $body;
	}

	private function looks_like_wind_xml($body) {
		if (!is_string($body)) return false;
		$body = trim($body);
		if ($body === '') return false;
		if (stripos($body, '<wind') === false) return false;
		if (stripos($body, '<nodes') === false) return false;
		return true;
	}

	private function build_endpoint_url($base, $page, $subpage, $params) {
		if ($base === '') return '';
		$base = rtrim($base, '/');
		$query = 'page='.rawurlencode($page).'&subpage='.rawurlencode($subpage);
		if ($params !== '') $query .= '&'.$params;
		if (preg_match('#\\.php$#i', $base)) {
			$separator = (strpos($base, '?') === false ? '?' : '&');
			return $base.$separator.$query;
		}
		return $base.'/?'.$query;
	}

	private function fetch_wind_xml($base, $params) {
		$endpoints = array(
			array('page' => 'gmap', 'subpage' => 'xml'),
			array('page' => 'map', 'subpage' => 'xml')
		);
		foreach ($endpoints as $endpoint) {
			$url = $this->build_endpoint_url($base, $endpoint['page'], $endpoint['subpage'], $params);
			if ($url === '') continue;
			$body = $this->fetch_url($url);
			if ($this->looks_like_wind_xml($body)) return $body;
		}
		return false;
	}

	private function output_empty_xml($charset) {
		return "<?xml version='1.0' encoding='".$charset."' standalone='yes'?>\n<wind></wind>";
	}

	function output() {
		global $db, $lang;

		while (ob_get_level()) {
			ob_end_clean();
		}
		error_reporting(0);
		$charset = isset($lang['charset']) ? $lang['charset'] : 'utf-8';
		if (!headers_sent()) {
			header("Expires: 0");
			header("Content-type: text/xml; charset=" . $charset);
			header("Cache-Control: no-cache, must-revalidate");
		}

		$community_id = $this->parse_community_id(get('community'));
		if ($community_id <= 0) {
			echo $this->output_empty_xml($charset);
			exit;
		}

		$rows = $db->get('windURL', 'communities', "id = ".intval($community_id));
		$wind_url = isset($rows[0]['windURL']) ? trim($rows[0]['windURL']) : '';
		if ($wind_url === '') {
			echo $this->output_empty_xml($charset);
			exit;
		}

		$wind_url = $this->normalize_wind_url($wind_url);
		$clean_base = rtrim($wind_url, '/');
		$params = $this->build_param_query();

		$body = $this->fetch_wind_xml($clean_base, $params);

		if ($body === false) {
			$fallback_base = preg_replace('#^https://#i', 'http://', $clean_base);
			if ($fallback_base !== $clean_base) {
				$body = $this->fetch_wind_xml($fallback_base, $params);
			}
		}

		if ($body === false || $body === '') {
			echo $this->output_empty_xml($charset);
			exit;
		}

		echo $body;
		exit;
	}

}

?>
