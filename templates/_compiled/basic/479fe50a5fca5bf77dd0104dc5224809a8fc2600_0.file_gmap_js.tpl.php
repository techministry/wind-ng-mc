<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:49:46
  from 'file:includes\pages\gmap/gmap_js.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941c5ea6ecbf5_95502258',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '479fe50a5fca5bf77dd0104dc5224809a8fc2600' => 
    array (
      0 => 'includes\\pages\\gmap/gmap_js.tpl',
      1 => 1765918178,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6941c5ea6ecbf5_95502258 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\gmap';
?>
var map;
var selected = Array();
var p2p_ap = Array();
var p2p = Array();
var aps = Array();
var clients = Array();
var unlinked = Array();
var links_p2p = Array();
var links_client = Array();
var markers = {};
var polylines = {};
var markerClusterGroup;
var ch_p2p;
var ch_aps;
var ch_clients;
var ch_unlinked;



var sz_icon_small = [13, 17],
    sz_icon_large = [32, 37],
    anchor_small = [6, 17],
    anchor_large = [16, 37],
    popup_anchor_small = [0, -17],
    popup_anchor_large = [0, -37],
    img_shadow = '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/shadow.png',
    img_icons =  [
        [ '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/nodes/ap_min.png', '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/nodes/ap.png' ],
        [ '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/nodes/backbone_min.png', '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/nodes/backbone.png' ],
        [ '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/nodes/user_min.png', '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/nodes/user.png' ],
        [ '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/nodes/disconnected_min.png', '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/nodes/disconnected.png' ],
        [ '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/nodes/home_min.png', '<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/nodes/home.png' ]
    ];



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
	ch_p2p = document.getElementsByName("p2p")[0];
	ch_aps = document.getElementsByName("aps")[0];
	ch_clients = document.getElementsByName("clients")[0];
	ch_unlinked = document.getElementsByName("unlinked")[0];
	
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
	
	<?php if ($_smarty_tpl->getValue('logged') == TRUE) {?>
	// Add layer control if logged in
	var baseMaps = {
		"OpenStreetMap": osmLayer,
		"Satellite": satelliteLayer
	};
	L.control.layers(baseMaps).addTo(map);
	<?php }?>
	
	// Set map center and zoom
	var center = [<?php echo $_smarty_tpl->getValue('center_latitude');?>
, <?php echo $_smarty_tpl->getValue('center_longitude');?>
];
	var zoom;
	
	if ('<?php echo $_smarty_tpl->getValue('zoom');?>
' != '') {
		zoom = <?php echo (($tmp = $_smarty_tpl->getValue('zoom') ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
;
		map.setView(center, zoom);
	} else {
		var bound_sw = [<?php echo (($tmp = $_smarty_tpl->getValue('min_latitude') ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('center_latitude') ?? null : $tmp);?>
, <?php echo (($tmp = $_smarty_tpl->getValue('min_longitude') ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('center_longitude') ?? null : $tmp);?>
];
		var bound_ne = [<?php echo (($tmp = $_smarty_tpl->getValue('max_latitude') ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('center_latitude') ?? null : $tmp);?>
, <?php echo (($tmp = $_smarty_tpl->getValue('max_longitude') ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('center_longitude') ?? null : $tmp);?>
];
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
	if (ch_unlinked.checked == true) makeMarkers(unlinked, icon_red, 100);
	if (ch_clients.checked == true) makeMarkers(clients, icon_blue, 100);
	if (ch_aps.checked == true) makeMarkers(aps, icon_green, 10);
	if (ch_p2p.checked == true) makeMarkers(p2p, icon_orange, 10);
	if (ch_p2p.checked == true || ch_aps.checked == true) makeMarkers(p2p_ap, icon_green, 10);
	makeMarkers(selected, icon_grey, 10);
}

function gmap_refresh() {
	reset_markers();
	var ch_p2p = document.getElementsByName("p2p")[0];
	var ch_aps = document.getElementsByName("aps")[0];
	var ch_clients = document.getElementsByName("clients")[0];
	var ch_unlinked = document.getElementsByName("unlinked")[0];
	if (((ch_p2p.checked == true && p2p.length > 0) || ch_p2p.checked == false) &&
		((ch_aps.checked == true && aps.length > 0) || ch_aps.checked == false) &&
		((ch_clients.checked == true && clients.length > 0) || ch_clients.checked == false) &&
		((ch_unlinked.checked == true && unlinked.length > 0) || ch_unlinked.checked == false)) {
			markerClusterGroup.clearLayers();
			markers = {};
			for (var pid in polylines) {
				if (polylines[pid]) map.removeLayer(polylines[pid]);
			}
			polylines = {};
			gmap_reload();
			return;
	}
	
	// Use modern XMLHttpRequest
	var request = new XMLHttpRequest();
	var xml_url = "<?php echo $_smarty_tpl->getValue('link_xml_page');?>
" +
		(ch_p2p.checked == true && p2p.length == 0?"&show_p2p=1":"") +
		(ch_aps.checked == true && aps.length == 0?"&show_aps=1":"") +
		(ch_clients.checked == true && clients.length == 0?"&show_clients=1":"") +
		(ch_unlinked.checked == true && unlinked.length == 0?"&show_unlinked=1":"") +
		(ch_p2p.checked == true && links_p2p.length == 0?"&show_links_p2p=1":"") +
		(ch_aps.checked == true && ch_clients.checked == true && links_client.length == 0?"&show_links_client=1":"");
	console.log("Fetching XML from:", xml_url);
	request.open("GET", xml_url, true);
	request.onreadystatechange = function() {
		if (request.readyState == 4) {
			console.log("XML response status:", request.status);
			console.log("XML response type:", request.getResponseHeader("Content-Type"));
			var xmlDoc = request.responseXML;
			
			// Fallback: manually parse XML if responseXML is null
			if (!xmlDoc || !xmlDoc.documentElement) {
				console.log("Attempting manual XML parsing...");
				try {
					var parser = new DOMParser();
					xmlDoc = parser.parseFromString(request.responseText, "text/xml");
					// Check for parse errors
					var parseError = xmlDoc.getElementsByTagName("parsererror");
					if (parseError.length > 0) {
						console.error("XML parse error:", parseError[0].textContent);
						return;
					}
				} catch (e) {
					console.error("Failed to parse XML:", e);
					return;
				}
			}
			
			if (!xmlDoc || !xmlDoc.documentElement) {
				console.error("Failed to parse XML response. Response text:", request.responseText.substring(0, 500));
				return;
			}
			console.log("XML root element:", xmlDoc.documentElement.tagName);
			selected = xmlDoc.documentElement.getElementsByTagName("selected");
			if ((ch_p2p.checked == true || ch_aps.checked == true) && p2p_ap.length == 0) p2p_ap = xmlDoc.documentElement.getElementsByTagName("p2p-ap");
			if (ch_aps.checked == true && aps.length == 0) aps = xmlDoc.documentElement.getElementsByTagName("ap");
			if (ch_p2p.checked == true && p2p.length == 0) p2p = xmlDoc.documentElement.getElementsByTagName("p2p");
			if (ch_clients.checked == true && clients.length == 0) clients = xmlDoc.documentElement.getElementsByTagName("client");
			if (ch_unlinked.checked == true && unlinked.length == 0) unlinked = xmlDoc.documentElement.getElementsByTagName("unlinked");
			if (ch_p2p.checked == true && links_p2p.length == 0) links_p2p = xmlDoc.documentElement.getElementsByTagName("link_p2p");
			if (ch_aps.checked == true && ch_clients.checked == true && links_client.length == 0) links_client = xmlDoc.documentElement.getElementsByTagName("link_client");
			console.log("Nodes loaded - p2p:", p2p.length, "aps:", aps.length, "clients:", clients.length, "unlinked:", unlinked.length);
			markerClusterGroup.clearLayers();
			markers = {};
			for (var pid in polylines) {
				if (polylines[pid]) map.removeLayer(polylines[pid]);
			}
			polylines = {};
			gmap_reload();
		}
	};
	request.send(null);
}

function makePolylines(links, color_active, color_inactive, size) {
	var bounds = map.getBounds();
	for (var i = 0; i < links.length; i++) {
		var link_id = links[i].getAttribute("id");
		if (polylines[link_id] != undefined) continue;
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
			var polyline = L.polyline([point1, point2], {
				color: color,
				weight: size
			});
			polylines[link_id] = polyline;
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
}

function getNumberedIconURL(number) {
	var num = number;
	if (num > 300) num = "more";
	return "<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/numbers/number_" + num + ".png";
}

function getNumberedIcon(number) {
	return L.icon({
		iconUrl: getNumberedIconURL(number),
		shadowUrl: "<?php echo $_smarty_tpl->getValue('img_dir');?>
gmap/modern/shadow.png",
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
		var node_lat = nodes[i].getAttribute("lat");
		var node_lon = nodes[i].getAttribute("lon");
		var node_url = nodes[i].getAttribute("url");

		if (markers[node_id] != undefined) continue;

		var point = L.latLng(node_lat, node_lon);
		var inbounds = bounds.contains(point);

		if (inbounds) {
			var node_area = nodes[i].getAttribute("area");
			var node_freeifs = nodes[i].getAttribute("freeifs");
			var node_adminowner = nodes[i].getAttribute("adminowner");
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
				"<div style=\"padding-right: 15px; white-space: nowrap; text-align:left; font-size:10px;\"><?php echo $_smarty_tpl->getValue('lang')['adminowner'];?>
: " + node_adminowner + "<br />" +
				node_area + "<br />" +
				"<?php echo $_smarty_tpl->getValue('lang')['links'];?>
: " + (parseInt(node_p2p) + parseInt(node_client_on_ap)) + " (+" + node_aps + " <?php echo $_smarty_tpl->getValue('lang')['aps'];?>
)" + "<br />" +
				"<?php echo $_smarty_tpl->getValue('lang')['clients'];?>
: " + node_clients + "<br />" + "<?php echo $_smarty_tpl->getValue('lang')['nodes__freeifs'];?>
: " + node_freeifs + "<br /><br />" + "<a href=\"" + node_url + "\"><?php echo $_smarty_tpl->getValue('lang')['node_page'];?>
</a>";
			
			if (selected[0]) {
				var this_node = selected[0].getAttribute("id");
				if (this_node != node_id) {
					html = html + "<br /><a href=\"\" onclick=\"javascript: t = window.open('?page=nodes&subpage=plot_link&a_node=" + selected[0].getAttribute("id") + "&b_node=" + node_id + "', 'popup_plot_link', 'width=600,height=450,toolbar=0,resizable=1,scrollbars=1'); t.focus(); return false;\"><?php echo $_smarty_tpl->getValue('lang')['plot'];?>
</a></div>";
				}
			} else {
				html = html + "</div>";
			}
			
			var marker = createMarker(point, html, icon);
			markers[node_id] = marker;
			markerClusterGroup.addLayer(marker);
		}
	}
}




<?php }
}
