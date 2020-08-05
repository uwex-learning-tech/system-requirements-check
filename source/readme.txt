=== Plugin Name ===
Contributors: eslin87
Tags: operating, browser, cookie, requirements, JRE, javascript, system, flash, check, checker, os, client, screen, resolution, IP
Requires at least: 3.0
Tested up to: 5.5
Stable tag: 1.2.2
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Checks for the specified version of the operating systems, web browsers, screen resolution, IP address, Flash Player, JRE, cookie, and Javascript.

== Description ==

A system requirements plugin that checks for the specified version of the operating systems, web browsers, screen resolution, IP addresses, Adobe Flash Player, Java Runtime Environment (JRE), Cookie, and Javascript on the client's system. The result can be displayed on a post or page with the use of a shortcode to let the end-users be aware that their system may not be optimal for specific tasks or operations.

== Installation ==

= Automatically in WordPress = 

1. Login into your site’s dashboard
2. Click Plugins on the left menu (administration role required)
3. Click Add New
4. Search for the “System Requirements Check” plugin
5. Click Install Now and select OK
6. Activate the plugin

= Manual installation = 
* Download the plugin file to your computer and unzip it
* Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installation's <code>wp-content/plugins/</code> directory.
* Activate the plugin from the Plugins menu within the WordPress admin.

== Frequently Asked Questions ==

= What is the purpose of this plugin? =

This plugin checks the client’s operating system, web browser, screen resolution, IP addresses, Adobe Flash Player, cookie, Java Runtime Environment, and JavaScript to see if the client’s system meets your requirements that were set in the System Requirements Check settings page.

= What is the shortcode and where it is? =

The shortcode is <code>[system_requirements_check]</code>. It is on top of the plugin's Settings page.

== Screenshots ==

1. Results
2. Settings page

== Changelog ==

= 1.2.2 =
* Updated screenshots and licensing info.

= 1.2.1 =
* Added plugin shortcode to the installation section on the readme.txt
* Made plugin shortcode text on top of the Settings page extra large
* Fixed the issue where the plugin thinks Chrome on iOS is Safari. Thanks to @laggedonuser for reporting and providing a fix.

= 1.2.0 =
* Updated existing icons
* Added more icons
* Added an option to disable web browsers check
* Added the option to display IP address
* Added the option to display and check the screen resolution
* Updated grammars and rephrased some sentences
* Fixed an issue where Safari version check is incorrect
* Rephrased Java check messages

= 1.1.2 =
* Updated links
* Fixed Linux label
* Set Linux check to off by default
* Added an option to disable all operating systems check

= 1.1.1 =
* Fixed minor errors (mostly grammar)

= 1.1.0 =
* Removed jQuery dependency
* Added Windows 10 detection
* Added Microsoft Edge detection
* Added Linux system detection

= 1.0.0 =
* Tested to be compatible with WordPress version 4.1
* Taking SSL connections into consideration with requesting script files

= 0.2.0 =
* Added Windows XP
* Updates looks and feels

= 0.1.1 =
* Fixed some grammars
* Listed preferred OS and browsers under passed checks

= 0.1.0 =
* First initial quick release
