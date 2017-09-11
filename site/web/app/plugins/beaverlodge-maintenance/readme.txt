=== Beaverlodge Maintenance ===
Contributors: beaverlodge
Tags: coming soon, maintenance, beaver builder, admin
Requires at least: 3.0.1
Tested up to: 4.5.2
Stable tag: 4.5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

**Requires Beaver Builder to work**

This plugin leverages the power of Beaver Builder's templates and drag and drop interface to create custom coming soon and maintenance pages.

Once active, if you are not logged in as admin, you will not see the site, only the custom template. However, if you are logged in as admin, you will be able to see and build out your site as expected.

### Features
* Easily register and create unique custom "coming soon" pages for your live site
* Supports Lite and Premium versions of Beaver Builder
* Includes free templates for you to use and upload

### Optional Extras
- [Premium Beaver Builder](https://www.wpbeaverbuilder.com/?fla=283)
- [Beaverlodge HQ](https://beaverlodgehq.com)

### Usage Video
[youtube https://www.youtube.com/watch?v=eCM8AKNIga0]

== Installation ==

### Plugin Installation
1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Settings > Page Builder Templates > Enable Templates Admin to enable the templates backend view
1. Templates > Maintenance Mode Template to edit the template how you like
1. To select who can see the site change the role in Settings > Beaverlodge Maintenance
1. Select which template to use in Settings > Beaverlodge Maintenance
1. You can enable and disable maintenance mode in Settings > Beaverlodge Maintenance


### Template Installation
1. Unzip the plugin file to your computer
1. Tools > Import > WordPress
1. Choose the template you like located in the templates folder
1. Upload file and import
1. If using earlier version of Beaver Builder 1.8, please install the [WordPress Patched Importer](https://www.wpbeaverbuilder.com/downloads/wordpress-importer-patched.zip)

== Screenshots ==

1. Astro Template
1. Horse Template
1. Running Template
1. Settings Page

== Frequently Asked Questions ==

= Can I use the plugin without Beaver Builder? =

No. Beaverlodge Maintenance uses the Beaver Builder templates to create the page layout and display the landing page.

= Do I have to use the premium version of Beaver Builder? =

No. However the pro version of Beaver Builder includes som advanced modules that add more features.

= I installed the templates but cannot see all the fields? =

The templates included use advanced modules that are only available in the premium version of Beaver Builder, if you are using the Lite version, you will need to [upgrade](https://www.wpbeaverbuilder.com/?fla=283) to get all available options.

= I imported the template but it doesnt show? =

Use the Settings > Beaverlodge Maintenance settings page to choose your custom template.


== Changelog ==

= 1.1.4 =
* Bug Fix: Fixed a bug where settings page clashed with other plugins

= 1.1.3 =
* Improvement: Added new template
* Bug Fix: Fixed a bug when meta box is already active


= 1.1.2 =
* Bug Fix: Fixed a bug where role selection wasn’t working and causing an error

= 1.1.1 =
* Bug Fix: Fixed a bug where files didn't all upload causing errors

= 1.1.0 =
* Improvement: Added settings page to setup the plugin
* Improvement: Added support to choose which template so do not need to rename slugs etc
* Improvement: Added support to customise which roles can access the site rather than just admin
* Improvement: Added support to disable maintenance mode without having to disable plugin
