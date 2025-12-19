# SRTM Data Files

This directory should contain SRTM (Shuttle Radar Topography Mission) elevation data files.

## What are SRTM files?

SRTM data provides terrain elevation data for most of the world. WiND uses this data to generate line-of-sight (LOS) plots between nodes.

## How to get SRTM data

1. Download SRTM HGT files from:
   - https://dwtkns.com/srtm30m/ (30m resolution)
   - https://earthexplorer.usgs.gov/ (requires free account)
   
2. Files are named by their coordinate, e.g.:
   - `N37E023.hgt` for Greece (Athens area)
   - `N38E023.hgt` for northern Greece
   
3. Place the `.hgt` files directly in this directory

## Without SRTM data

The elevation/terrain plots on the Links page will not display. All other functionality will work normally.

## File format

SRTM files are binary elevation data:
- SRTM1: 1 arc-second (~30m) resolution, 3601x3601 samples
- SRTM3: 3 arc-second (~90m) resolution, 1201x1201 samples

WiND should work with either resolution.
