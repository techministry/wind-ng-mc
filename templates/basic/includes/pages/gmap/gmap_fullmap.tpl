{*
 * WiND - Wireless Nodes Database
 * Basic HTML Template
 *
 * Copyright (C) 2005 Konstantinos Papadimitriou <vinilios@cube.gr>
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
<style>
#map { min-height: calc(100vh - 150px); }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<table class="table-main" cellpadding="0" cellspacing="0"><tr><td style="font-size:12px; text-align:center; width: 100%;">
{if $gmap_key_ok}
<div id="map" style="width: 100%; height: calc(100vh - 150px);"></div>
<script type="text/javascript">
{literal}
window.onload = function() {
	var map = L.map('map').setView([38, 23], 8);
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; OpenStreetMap contributors'
	}).addTo(map);
};
{/literal}
</script>
{else}
{$lang.message.error.gmap_key_failed.body|wordwrap:40|nl2br}
{/if}
</td></tr><tr><td style="font-size:12px;" align="center">
<input type="checkbox" name="p2p" checked="checked" onclick="gmap_refresh();" />{html_image file="`$img_dir`/gmap/mm_20_orange.png" alt=$lang.backbone}{$lang.backbone}
<input type="checkbox" name="aps" checked="checked" onclick="gmap_refresh();" />{html_image file="`$img_dir`/gmap/mm_20_green.png" alt=$lang.aps}{$lang.aps}
<input type="checkbox" name="hs" checked="checked" onclick="gmap_refresh();" />{html_image file="`$img_dir`/gmap/mm_20_green.png" alt=$lang.hs}{$lang.hs}
<input type="checkbox" name="clients" checked="checked" onclick="gmap_refresh();" />{html_image file="`$img_dir`/gmap/mm_20_blue.png" alt=$lang.clients}{$lang.clients}
<input type="checkbox" name="unlinked" onclick="gmap_refresh();" />{html_image file="`$img_dir`/gmap/mm_20_red.png" alt=$lang.unlinked}{$lang.unlinked}
</td></tr>
</table>
