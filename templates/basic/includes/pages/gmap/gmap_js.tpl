{*
 * WiND - Wireless Nodes Database
 * Basic HTML Template
 *
 * Copyright (C) 2005 Nikolaos Nikalexis <winner@cube.gr>
 * Copyright (C) 2012 Ioannis Haralampides <wavesoft@wna.gr>
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
var selected = Array();
var p2p_ap = Array();
var p2p = Array();
var aps = Array();
var clients = Array();
var unlinked = Array();
var links_p2p = Array();
var links_client = Array();
var links_vpn = Array();
var markers = {};
var polylines = {};
var markerClusterGroup;
var ch_p2p;
var ch_aps;
var ch_clients;
var ch_unlinked;
var ch_vpn;
var gmapInitialized = false;

var communitySources = {/literal}{$community_sources_json|default:'[]'|escape:'none'}{literal};
var communityDataCache = {};
var communityLoading = {};
var communityCheckboxes = {};

function getCommunitySource(id) {
	for (var i = 0; i < communitySources.length; i++) {
		if (communitySources[i].id === id) return communitySources[i];
	}
	return null;
}

function buildCommunityXmlUrl(source) {
	if (!source || !source.xml) return "";
	var joiner = (source.xml.indexOf("?") === -1 ? "?" : (source.xml.slice(-1) === "?" ? "" : "&"));
	return source.xml + joiner + "show_p2p=1&show_aps=1&show_clients=1&show_unlinked=1&show_links_p2p=1&show_links_client=1&show_links_vpn=1";
}

function normalizeNodeUrl(base, url) {
	if (!url) return url;
	if (url.indexOf("http://") === 0 || url.indexOf("https://") === 0) return url;
	if (!base) return url;
	var cleanBase = base.replace(/\/+$/, "");
	var cleanUrl = url.replace(/^\/+/, "");
	var joiner = "/";
	if (cleanUrl.charAt(0) === "?" || cleanUrl.charAt(0) === "#") {
		joiner = "";
	}
	if (/\.(php)$/i.test(cleanBase)) {
		if (/^index\.php/i.test(cleanUrl)) {
			cleanUrl = cleanUrl.replace(/^index\.php\/?/i, "");
			if (cleanUrl === "" || cleanUrl.charAt(0) === "?" || cleanUrl.charAt(0) === "#") {
				joiner = "";
			}
		}
		return cleanBase + joiner + cleanUrl;
	}
	return cleanBase + "/" + cleanUrl;
}

function tagWithCommunity(list, source) {
	var results = [];
	for (var i = 0; i < list.length; i++) {
		var node = list[i];
		node.setAttribute("community_key", source.id);
		if (source.name && !node.getAttribute("community")) node.setAttribute("community", source.name);
		if (source.base) {
			var nodeUrl = node.getAttribute("url");
			if (nodeUrl) node.setAttribute("url", normalizeNodeUrl(source.base, nodeUrl));
		}
		results.push(node);
	}
	return results;
}

function parseCommunityXml(source, xmlDoc) {
	var root = (xmlDoc && xmlDoc.documentElement ? xmlDoc.documentElement : null);
	if (!root) return null;
	return {
		nodes: {
			selected: tagWithCommunity(root.getElementsByTagName("selected"), source),
			p2p_ap: tagWithCommunity(root.getElementsByTagName("p2p-ap"), source),
			ap: tagWithCommunity(root.getElementsByTagName("ap"), source),
			p2p: tagWithCommunity(root.getElementsByTagName("p2p"), source),
			client: tagWithCommunity(root.getElementsByTagName("client"), source),
			unlinked: tagWithCommunity(root.getElementsByTagName("unlinked"), source)
		},
		links: {
			p2p: tagWithCommunity(root.getElementsByTagName("link_p2p"), source),
			client: tagWithCommunity(root.getElementsByTagName("link_client"), source),
			vpn: tagWithCommunity(root.getElementsByTagName("link_vpn"), source)
		}
	};
}

function getEnabledCommunityIds() {
	var enabled = [];
	for (var i = 0; i < communitySources.length; i++) {
		var source = communitySources[i];
		var checkbox = communityCheckboxes[source.id];
		var isChecked = (checkbox ? checkbox.checked : !!source.default_enabled);
		if (isChecked) enabled.push(source.id);
	}
	return enabled;
}

function rebuildVisibleData(enabledIds) {
	selected = [];
	p2p_ap = [];
	p2p = [];
	aps = [];
	clients = [];
	unlinked = [];
	links_p2p = [];
	links_client = [];
	links_vpn = [];

	for (var i = 0; i < enabledIds.length; i++) {
		var data = communityDataCache[enabledIds[i]];
		if (!data) continue;
		selected = selected.concat(data.nodes.selected || []);
		p2p_ap = p2p_ap.concat(data.nodes.p2p_ap || []);
		aps = aps.concat(data.nodes.ap || []);
		p2p = p2p.concat(data.nodes.p2p || []);
		clients = clients.concat(data.nodes.client || []);
		unlinked = unlinked.concat(data.nodes.unlinked || []);
		links_p2p = links_p2p.concat(data.links.p2p || []);
		links_client = links_client.concat(data.links.client || []);
		links_vpn = links_vpn.concat(data.links.vpn || []);
	}
}

function fetchCommunityXml(source, callback) {
	if (!source || !source.id) { callback(null); return; }
	if (communityDataCache[source.id]) { callback(communityDataCache[source.id]); return; }
	if (!communityLoading[source.id]) communityLoading[source.id] = [];
	communityLoading[source.id].push(callback);
	if (communityLoading[source.id].length > 1) return;

	var xml_url = buildCommunityXmlUrl(source);
	var request = new XMLHttpRequest();
	request.open("GET", xml_url, true);
	request.onreadystatechange = function() {
		if (request.readyState == 4) {
			var data = null;
			var xmlDoc = request.responseXML;
			if (!xmlDoc || !xmlDoc.documentElement) {
				try {
					var parser = new DOMParser();
					xmlDoc = parser.parseFromString(request.responseText || "", "text/xml");
				} catch (e) {}
			}
			if (xmlDoc && xmlDoc.documentElement) {
				data = parseCommunityXml(source, xmlDoc);
			}
			if (data) communityDataCache[source.id] = data;
			var callbacks = communityLoading[source.id] || [];
			communityLoading[source.id] = [];
			for (var i = 0; i < callbacks.length; i++) callbacks[i](data);
		}
	};
	request.onerror = function() {
		var callbacks = communityLoading[source.id] || [];
		communityLoading[source.id] = [];
		for (var i = 0; i < callbacks.length; i++) callbacks[i](null);
	};
	request.send(null);
}

{/literal}

var sz_icon_small = [13, 17],
    sz_icon_large = [32, 37],
    anchor_small = [6, 17],
    anchor_large = [16, 37],
    popup_anchor_small = [0, -17],
    popup_anchor_large = [0, -37],
    img_shadow = '{$img_dir}gmap/modern/shadow.png',
    img_icons =  [
        [ '{$img_dir}gmap/modern/nodes/ap_min.png', '{$img_dir}gmap/modern/nodes/ap.png' ],
        [ '{$img_dir}gmap/modern/nodes/backbone_min.png', '{$img_dir}gmap/modern/nodes/backbone.png' ],
        [ '{$img_dir}gmap/modern/nodes/user_min.png', '{$img_dir}gmap/modern/nodes/user.png' ],
        [ '{$img_dir}gmap/modern/nodes/disconnected_min.png', '{$img_dir}gmap/modern/nodes/disconnected.png' ],
        [ '{$img_dir}gmap/modern/nodes/home_min.png', '{$img_dir}gmap/modern/nodes/home.png' ]
    ];

{literal}

var iconStack=[];
for (var c=0; c<5; c++) {
    iconStack[c] = [
        L.icon({
            iconUrl: img_icons[c][0],
            shadowUrl: img_shadow,
            iconSize: sz_icon_small,
            shadowSize: [23, 17],
            iconAnchor: anchor_small,
            popupAnchor: popup_anchor_small
        }),
        L.icon({
            iconUrl: img_icons[c][1],
            shadowUrl: img_shadow,
            iconSize: sz_icon_large,
            shadowSize: [51, 37],
            iconAnchor: anchor_large,
            popupAnchor: popup_anchor_large
        })
    ];
}

var icon_green = iconStack[0],
    icon_orange = iconStack[1],
    icon_blue = iconStack[2],
    icon_red = iconStack[3],
    icon_grey = iconStack[4];

function gmap_onload() {
	if (gmapInitialized) return;
	gmapInitialized = true;
	ch_p2p = document.getElementsByName("p2p")[0];
	ch_aps = document.getElementsByName("aps")[0];
	ch_clients = document.getElementsByName("clients")[0];
	ch_unlinked = document.getElementsByName("unlinked")[0];
	ch_vpn = document.getElementsByName("vpn")[0];

	var communityToggles = document.querySelectorAll("[data-community-id]");
	for (var i = 0; i < communityToggles.length; i++) {
		var cid = communityToggles[i].getAttribute("data-community-id");
		if (cid) communityCheckboxes[cid] = communityToggles[i];
	}
	
	// Initialize Leaflet map
	map = L.map('map', {
		zoomControl: true,
		scrollWheelZoom: true
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
	
	{/literal}{if $logged==TRUE}{literal}
	// Add layer control if logged in
	var baseMaps = {
		"OpenStreetMap": osmLayer,
		"Satellite": satelliteLayer
	};
	L.control.layers(baseMaps).addTo(map);
	{/literal}{/if}{literal}
	
	// Set map center and zoom
	var center = [{/literal}{$center_latitude}{literal}, {/literal}{$center_longitude}{literal}];
	var zoom;
	
	if ('{/literal}{$zoom}{literal}' != '') {
		zoom = {/literal}{$zoom|default:0}{literal};
		map.setView(center, zoom);
	} else {
		var bound_sw = [{/literal}{$min_latitude|default:$center_latitude}{literal}, {/literal}{$min_longitude|default:$center_longitude}{literal}];
		var bound_ne = [{/literal}{$max_latitude|default:$center_latitude}{literal}, {/literal}{$max_longitude|default:$center_longitude}{literal}];
		var bounds = L.latLngBounds(bound_sw, bound_ne);
		map.fitBounds(bounds);
	}
	
	// Initialize marker cluster group
	markerClusterGroup = L.markerClusterGroup({
		maxClusterRadius: 50,
		spiderfyOnMaxZoom: true,
		showCoverageOnHover: false,
		zoomToBoundsOnClick: true
	});
	map.addLayer(markerClusterGroup);
	
	// Add event listeners
	map.on('moveend', gmap_reload);
	map.on('zoomend', function() {
		var currentZoom = map.getZoom();
		var threshold = 13; // 17-4 in original
		// Clear and reload if crossing threshold
		if ((map._lastZoom <= threshold && currentZoom > threshold) ||
			(map._lastZoom > threshold && currentZoom <= threshold)) {
			markerClusterGroup.clearLayers();
			markers = {};
			for (var pid in polylines) {
				if (polylines[pid]) map.removeLayer(polylines[pid]);
			}
			polylines = {};
		}
		map._lastZoom = currentZoom;
		gmap_reload();
	});
	
	map._lastZoom = map.getZoom();
	gmap_refresh();
}

function gmap_reload() {
	reset_markers();
	if (ch_aps.checked == true && ch_clients.checked == true) makePolylines(links_client, "#00ffff", "#ff0000", 2);
	if (ch_p2p.checked == true) makePolylines(links_p2p, "#00ff00", "#ff0000", 3);
	if (ch_vpn && ch_vpn.checked == true) makePolylines(links_vpn, "#000000", "#000000", 2, "4,6");
	if (ch_unlinked.checked == true) makeMarkers(unlinked, icon_red, 100);
	if (ch_clients.checked == true) makeMarkers(clients, icon_blue, 100);
	if (ch_aps.checked == true) makeMarkers(aps, icon_green, 10);
	if (ch_p2p.checked == true) makeMarkers(p2p, icon_orange, 10);
	if (ch_p2p.checked == true || ch_aps.checked == true) makeMarkers(p2p_ap, icon_green, 10);
	makeMarkers(selected, icon_grey, 10);
}

function gmap_refresh() {
	reset_markers();
	markerClusterGroup.clearLayers();

	var enabledCommunities = getEnabledCommunityIds();
	if (enabledCommunities.length === 0) {
		rebuildVisibleData([]);
		gmap_reload();
		return;
	}

	var pending = enabledCommunities.length;
	var onComplete = function() {
		pending--;
		if (pending <= 0) {
			rebuildVisibleData(enabledCommunities);
			gmap_reload();
		}
	};

	for (var i = 0; i < enabledCommunities.length; i++) {
		var source = getCommunitySource(enabledCommunities[i]);
		if (!source) {
			onComplete();
			continue;
		}
		fetchCommunityXml(source, onComplete);
	}
}

function makePolylines(links, color_active, color_inactive, size, dashArray) {
	var bounds = map.getBounds();
	for (var i = 0; i < links.length; i++) {
		var link_id = links[i].getAttribute("id");
		var source_key = links[i].getAttribute("community_key") || "local";
		var poly_id = source_key + ":" + link_id;
		if (polylines[poly_id] != undefined) continue;
		var link_lat1 = parseFloat(links[i].getAttribute("lat1"));
		var link_lon1 = parseFloat(links[i].getAttribute("lon1"));
		var link_lat2 = parseFloat(links[i].getAttribute("lat2"));
		var link_lon2 = parseFloat(links[i].getAttribute("lon2"));
		var l_inbound_1 = bounds.contains(L.latLng(link_lat1, link_lon1));
		var l_inbound_2 = bounds.contains(L.latLng(link_lat2, link_lon2));

	if (l_inbound_1 || l_inbound_2) {
		var color = (links[i].getAttribute("status") == 'active') ? color_active : color_inactive;
		var point1 = [link_lat1, link_lon1];
		var point2 = [link_lat2, link_lon2];
		var options = {
			color: color,
			weight: size
		};
		if (dashArray) options.dashArray = dashArray;
		var polyline = L.polyline([point1, point2], options);
		polylines[poly_id] = polyline;
		map.addLayer(polyline);
	}
	}
}

function createMarker(point, html, icon) {
	var marker = L.marker(point, {icon: icon});
	marker.bindPopup(html);
	marker.on('click', function() {
		this.openPopup();
	});
	return marker;
}

function reset_markers() {
	markerClusterGroup.clearLayers();
	for (var pid in polylines) {
		if (polylines[pid] && polylines[pid]._map) {
			map.removeLayer(polylines[pid]);
		}
	}
	markers = {};
	polylines = {};
}

function getNumberedIconURL(number) {
	var num = number;
	if (num > 300) num = "more";
	return "{/literal}{$img_dir}{literal}gmap/modern/numbers/number_" + num + ".png";
}

function getNumberedIcon(number) {
	return L.icon({
		iconUrl: getNumberedIconURL(number),
		shadowUrl: "{/literal}{$img_dir}{literal}gmap/modern/shadow.png",
		iconSize: [32, 37],
		shadowSize: [51, 37],
		iconAnchor: [16, 37],
		popupAnchor: [0, -37]
	});
}

function makeMarkers(nodes, icon_image, icon_zoom) {
	var bounds = map.getBounds();
	for (var i = 0; i < nodes.length; i++) {
		var node_name = nodes[i].getAttribute("name");
		var node_community = nodes[i].getAttribute("community") || "Not set";
		var node_id = nodes[i].getAttribute("id");
		var node_source = nodes[i].getAttribute("community_key") || "local";
		var node_lat = parseFloat(nodes[i].getAttribute("lat"));
		var node_lon = parseFloat(nodes[i].getAttribute("lon"));
		var node_url = nodes[i].getAttribute("url") || "#";

		if (markers[node_source + ":" + node_id] != undefined) continue;
		if (!isFinite(node_lat) || !isFinite(node_lon)) continue;

		var point = L.latLng(node_lat, node_lon);
		var inbounds = bounds.contains(point);

		if (inbounds) {
			var node_area = nodes[i].getAttribute("area") || "";
			var node_freeifs = nodes[i].getAttribute("freeifs") || "";
			var node_adminowner = nodes[i].getAttribute("adminowner") || "";
			var node_p2p = nodes[i].getAttribute("p2p") * 1;
			var node_aps = nodes[i].getAttribute("aps") * 1;
			var node_client_on_ap = nodes[i].getAttribute("client_on_ap") * 1;
			var node_clients = nodes[i].getAttribute("clients") * 1;

			var icon;
			var icon_s;
			if (map.getZoom() > icon_zoom) {
				var icon_scale = 1;
			} else {
				var icon_scale = 0;
			}
			icon = icon_image[icon_scale];
			icon_s = icon_image[0];
			
			var html = "<div style=\"padding-right: 15px; white-space: nowrap; text-align:left; font-size:12px;font-weight:bold;\"><img src=\"" + icon_s.options.iconUrl + "\" alt=\"\" />" + node_name + " (#" + node_id + ") <br />[" + node_community + "]</div><br />" +
				"<div style=\"padding-right: 15px; white-space: nowrap; text-align:left; font-size:10px;\">{/literal}{$lang.adminowner}{literal}: " + node_adminowner + "<br />" +
				node_area + "<br />" +
				"{/literal}{$lang.links}{literal}: " + (parseInt(node_p2p) + parseInt(node_client_on_ap)) + " (+" + node_aps + " {/literal}{$lang.aps}{literal})" + "<br />" +
				"{/literal}{$lang.clients}{literal}: " + node_clients + "<br />" + "{/literal}{$lang.nodes__freeifs}{literal}: " + node_freeifs + "<br /><br />" + "<a href=\"" + node_url + "\">{/literal}{$lang.node_page}{literal}</a>";
			
			if (selected[0]) {
				var this_node = selected[0].getAttribute("id");
				if (this_node != node_id) {
					html = html + "<br /><a href=\"\" onclick=\"javascript: t = window.open('?page=nodes&subpage=plot_link&a_node=" + selected[0].getAttribute("id") + "&b_node=" + node_id + "', 'popup_plot_link', 'width=600,height=450,toolbar=0,resizable=1,scrollbars=1'); t.focus(); return false;\">{/literal}{$lang.plot}{literal}</a></div>";
				}
			} else {
				html = html + "</div>";
			}
			
			var marker = createMarker(point, html, icon);
			markers[node_source + ":" + node_id] = marker;
			markerClusterGroup.addLayer(marker);
		}
	}
}

if (typeof window !== "undefined") {
	if (document.readyState === "complete") {
		gmap_onload();
	} else {
		window.addEventListener("load", gmap_onload);
	}
}

{/literal}
