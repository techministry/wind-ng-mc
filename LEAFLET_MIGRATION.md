# Google Maps to Leaflet Migration Summary

## Overview
Successfully migrated the WiND (Wireless Nodes Database) project from Google Maps API v2 to Leaflet.js, an open-source mapping library.

## Date
2025-11-24

## Changes Made

### 1. Core Function Update
**File:** `globals/functions.php`
- Replaced `include_gmap()` function to load Leaflet libraries instead of Google Maps API
- Added Leaflet CSS from CDN (v1.9.4)
- Added Leaflet.markercluster plugin for clustering functionality
- Removed dependency on Google Maps API keys
- Removed VML styles (no longer needed)

### 2. Helper Function Updates
**File:** `includes/head.php`
- Updated `add_link()` function to support integrity and crossorigin attributes for CDN resources
- Updated `add_script()` function to support integrity and crossorigin attributes
- Maintains backward compatibility with existing code

### 3. Main Map Template
**File:** `templates/basic/includes/pages/gmap/gmap_js.tpl`
- Completely rewritten using Leaflet API
- Replaced Google Maps v2 API calls with Leaflet equivalents:
  - `GMap2` → `L.map()`
  - `GLatLng` → `L.latLng()`
  - `GMarker` → `L.marker()`
  - `GPolyline` → `L.polyline()`
  - `GIcon` → `L.icon()`
  - `GLatLngBounds` → `L.latLngBounds()`
  - `GEvent.addListener` → `map.on()`
- Replaced `GXmlHttp.create()` with modern `XMLHttpRequest`
- Implemented Leaflet.markercluster for automatic marker clustering
- Added OpenStreetMap and Esri Satellite tile layers
- All marker types preserved (P2P, APs, clients, unlinked)
- Polyline drawing for network links maintained
- Info popups on marker click maintained
- Zoom-based icon scaling preserved

**Backup:** Original file saved as `gmap_js.tpl.bak`

### 4. Coordinate Picker Template
**File:** `templates/basic/includes/pages/gmap/gmap_pickup_js.tpl`
- Rewritten using Leaflet API
- Click-to-place marker functionality preserved
- Coordinate selection and window communication maintained
- Layer switcher added (OSM and Satellite)

**Backup:** Original file saved as `gmap_pickup_js.tpl.bak`

## Features Maintained

✅ Map initialization with custom center and zoom
✅ Multiple map types (OpenStreetMap, Satellite)
✅ Marker creation with custom icons (5 types)
✅ Automatic marker clustering
✅ Polylines for node links (colored by status)
✅ Info popups on marker click
✅ Zoom-based icon scaling
✅ Bounds-based node filtering
✅ Map event listeners (moveend, zoomend)
✅ Coordinate picking functionality
✅ All existing node type displays (P2P, APs, clients, unlinked)

## New Features

🆕 Modern, actively maintained mapping library
🆕 No API key required for basic usage
🆕 Better performance with Leaflet.markercluster
🆕 Cleaner, more maintainable code
🆕 Free satellite imagery from Esri
🆕 Easier to customize and extend

## Tile Providers

The migration uses the following tile providers:

1. **OpenStreetMap** (Default)
   - URL: `https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png`
   - Free, no API key required
   - Community-maintained

2. **Esri World Imagery** (Satellite)
   - URL: `https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}`
   - Free for non-commercial use
   - No API key required

## Configuration

No configuration changes needed! The system will work immediately without Google Maps API keys.

If you want to add more tile providers or customize the map, edit:
- `templates/basic/includes/pages/gmap/gmap_js.tpl`
- `templates/basic/includes/pages/gmap/gmap_pickup_js.tpl`

## Testing Checklist

To verify the migration worked correctly:

1. ✅ Navigate to the map page in your application
2. ✅ Verify the map loads and displays correctly
3. ✅ Check that all node types display with correct icons
4. ✅ Test marker clustering by zooming in/out
5. ✅ Verify polylines show connections between nodes
6. ✅ Click on markers to verify info popups open correctly
7. ✅ Test zoom controls
8. ✅ Test layer switcher (OpenStreetMap ↔ Satellite)
9. ✅ Verify map reloads on pan/zoom
10. ✅ Test coordinate picker for node location selection
11. ✅ Verify icons scale correctly at different zoom levels

## Rollback Instructions

If you need to rollback to Google Maps:

1. Restore the backed-up files:
   ```powershell
   mv C:\Users\admin\wind-ng-mc\templates\basic\includes\pages\gmap\gmap_js.tpl.bak C:\Users\admin\wind-ng-mc\templates\basic\includes\pages\gmap\gmap_js.tpl
   mv C:\Users\admin\wind-ng-mc\templates\basic\includes\pages\gmap\gmap_pickup_js.tpl.bak C:\Users\admin\wind-ng-mc\templates\basic\includes\pages\gmap\gmap_pickup_js.tpl
   ```

2. Revert changes in `globals/functions.php` and `includes/head.php` using Git:
   ```bash
   git checkout globals/functions.php includes/head.php
   ```

## Dependencies

The migration uses these CDN-hosted libraries:

- **Leaflet.js v1.9.4**
  - CSS: `https://unpkg.com/leaflet@1.9.4/dist/leaflet.css`
  - JS: `https://unpkg.com/leaflet@1.9.4/dist/leaflet.js`

- **Leaflet.markercluster v1.5.3**
  - CSS: `https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css`
  - CSS: `https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css`
  - JS: `https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js`

All libraries are loaded from reliable CDNs with integrity checks for security.

## Browser Compatibility

Leaflet supports all modern browsers:
- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- IE 11+ (if needed)

## Notes

- The original marker clustering algorithm was replaced with Leaflet.markercluster, which is more efficient
- Google-specific features like `GBrowserIsCompatible()` were removed (no longer needed)
- The old `markerclusterer_compiled.js` file is no longer used but was not deleted
- All Smarty template syntax and PHP integration remains unchanged
- The map container HTML in `gmap_fullmap.tpl` did not need any changes

## Support

For issues or questions about this migration:
1. Check the Leaflet documentation: https://leafletjs.com/
2. Check Leaflet.markercluster: https://github.com/Leaflet/Leaflet.markercluster
3. Review the migration plan: See the implementation plan created during migration

## License

Leaflet is open-source software licensed under BSD-2-Clause.
Leaflet.markercluster is also open-source under MIT license.

Both are free to use for commercial and non-commercial projects.
