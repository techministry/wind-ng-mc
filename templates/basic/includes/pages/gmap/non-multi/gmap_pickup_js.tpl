{*
 * WiND - Wireless Nodes Database
 * Basic HTML Template
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
 *}
{literal}
var map;
var marker;
var marker_point;

function gmap_onload() {
	// Initialize Leaflet map
	map = L.map('map', {
		zoomControl: true
	});
	
	// Add tile layers
	var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; OpenStreetMap contributors'
	});
	
	var satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
		maxZoom: 19,
		attribution: '&copy; Esri'
	});
	
	// Add default layer
	osmLayer.addTo(map);
	
	// Add layer control
	var baseMaps = {
		"OpenStreetMap": osmLayer,
		"Satellite": satelliteLayer
	};
	L.control.layers(baseMaps).addTo(map);
	
	// Check if coordinates are already set in opener window
	if (window.opener.document.{/literal}{$object_lat}{literal}.value != '' && window.opener.document.{/literal}{$object_lon}{literal}.value != '') {
		var center = [
			window.opener.document.{/literal}{$object_lat}{literal}.value,
			window.opener.document.{/literal}{$object_lon}{literal}.value
		];
		var zoom = 16;
		marker = L.marker(center).addTo(map);
		marker_point = L.latLng(center);
		map.setView(center, zoom);
	} else {
		// Use default center and fit to bounds
		var center = [{/literal}{$center_latitude}{literal}, {/literal}{$center_longitude}{literal}];
		var bound_sw = [{/literal}{$min_latitude|default:$center_latitude}{literal}, {/literal}{$min_longitude|default:$center_longitude}{literal}];
		var bound_ne = [{/literal}{$max_latitude|default:$center_latitude}{literal}, {/literal}{$max_longitude|default:$center_longitude}{literal}];
		var bounds = L.latLngBounds(bound_sw, bound_ne);
		map.fitBounds(bounds);
	}
	
	// Add click event to place marker
	map.on('click', function(e) {
		// Remove existing marker if any
		if (marker) {
			map.removeLayer(marker);
		}
		
		// Create new marker at clicked position
		marker = L.marker(e.latlng).addTo(map);
		marker_point = e.latlng;
		
		// Create popup with coordinates and selection link
		var lat = Math.round(marker_point.lat * 1000000) / 1000000;
		var lng = Math.round(marker_point.lng * 1000000) / 1000000;
		var html = '<div style="padding-right: 15px; white-space: nowrap; text-align:left; font-size:10px;">' +
			'{/literal}{$lang.db.nodes__latitude}{literal}: ' + lat + '<br />' +
			'{/literal}{$lang.db.nodes__longitude}{literal}: ' + lng + '<br /><br />' +
			'<a href="" onclick="window.opener.pickup_value(window.opener.document.{/literal}{$object_lat|escape:"quotes"}{literal}, ' + lat + '); ' +
			'window.opener.pickup_value(window.opener.document.{/literal}{$object_lon|escape:"quotes"}{literal}, ' + lng + '); ' +
			'window.close(); return false;">{/literal}{$lang.select_the_coordinates}{literal}</a></div>';
		
		marker.bindPopup(html).openPopup();
	});
}

{/literal}
