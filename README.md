# WiND (Wireless Nodes Database)

WiND is a PHP-based wireless network management system for mapping and managing network nodes, communities, and services. This project has undergone significant modernization, including migration to the latest template engines, PHP 8.2+ compatibility, and a new mapping API. Below you will find a summary of the work done and links to detailed documentation for each major change.

## Project Highlights
- **Modern PHP 8.2+ compatibility**
- **Smarty 5.7.0 template engine integration**
- **Legacy template and code migration guides**
- **Leaflet.js migration for mapping**
- **Zero-dependency modern template engine (optional)**

## Documentation

- [Setup Complete](SETUP_COMPLETE.md):
  - Overview of the current system status, components, and successful configuration steps.
- [Smarty 5 Migration](SMARTY5_MIGRATION.md):
  - Details on upgrading to Smarty 5.7.0, including autoloading and PSR-4 support.
- [Smarty 3 Integration](SMARTY3_INTEGRATION.md):
  - Steps and fixes for integrating Smarty 3.1.48 and ensuring PHP 8.1 compatibility.
- [Smarty Compatibility Fix](SMARTY_FIX.md):
  - How the codebase was adapted to support both Smarty 2.x and 3.x/4.x versions.
- [Smarty 2.x to 3.x Template Conversion Guide](TEMPLATE_CONVERSION_GUIDE.md):
  - Quick reference for updating legacy templates to work with newer Smarty versions.
- [PHP 8.2 Compatibility](PHP82_COMPATIBILITY.md):
  - All code changes and issues resolved for PHP 8.2 support.
- [Modern Template Engine](MODERN_TEMPLATE_ENGINE.md):
  - Description and usage of the custom, zero-dependency template engine as an alternative to Smarty.
- [Leaflet Migration](LEAFLET_MIGRATION.md):
  - Migration steps and API changes from Google Maps to Leaflet.js for mapping features.

## How to Use
- See each documentation file above for migration, setup, and troubleshooting instructions.
- For template or code migration, follow the guides in the respective `.md` files.
- For mapping, refer to the Leaflet migration guide.

## Contributing
Contributions are welcome! Please see the documentation for details on the architecture and recent changes before submitting pull requests.

---

Original **WiND** is maintained by the Athens Wireless Metropolitan Network (AWMN) community and contributors.

https://github.com/wind-project/wind/wiki/Team