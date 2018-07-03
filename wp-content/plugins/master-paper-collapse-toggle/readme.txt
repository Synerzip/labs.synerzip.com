=== Master Paper Collapse Toggle ===
Contributors: Luis Rock
Tags: toggle, accordion, paper, collapse, master
Requires at least: 3.0
Tested up to: 4.6
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows you to create toggles in format of collapsible paper cards, inspired by Google Material Design.

== Description ==
Based on jQuery Paper Collapse Plugin, by Alexander Rühle, this WordPress plugin allows you to create toggles in format of collapsible paper cards, inspired by Google Material Design. 

You can even use FA icons on your toggles.

Install and basic usage video:
https://www.youtube.com/watch?v=6h_TpRY_JCc

Titles, icons and content:
https://www.youtube.com/watch?v=aAk9ER-Wc28

Shortcode attributes: title, icon, color


== Installation ==
1. Either use the built-in Wordpress plugin installer to grab the plugin from the Wordpress plugin repository, or upload the entire contents of the `master-paper-collapse-toggle.zip` folder to the `/wp-content/plugins/` directory.

2. Activate the plugin through the \'Plugins\' menu in WordPress.

3. Use the shortcode [mpaper]your content[/mpaper]

4. You better set a title. Use the attribute title=“Your Title”. Like this: [mpaper title=“Your Title”]your content[/mpaper] .

5. The default icon is “fa-bullseye”. But you can use any icon available in Font Awsome. First, select the icon you want to use, visiting Font Awsome Icons Cheatsheet Page. Then, copy the name of the icon (“fa-something”) and use it inside the shortcode, as an attribute. Like this: [mpaper title=“Your Title” icon=“fa-arrows”]your content[/mpaper].

6. If you do not want to use icon on your shortcode, go like this: [mpaper icon=“no”]content[/mpaper].

7. If you want to change title and icon color, use: [mpaper title=“Your Title” icon=“fa-arrows” color=“red”]your content[/mpaper]. Use hex color codes if you prefer.


== Frequently Asked Questions ==
Q: Is there a maximum number of Master Paper Collpase Toggles I can have on a single blog post or page?

A: I don’t think so.  You can have as many as you would like.


== Changelog ==
= 1.0 =
Initial release
= 1.1 =
Option to choose a color for title and icon added, via shortcode attribute (‘color’).
Class added to icon (mpc-icon), for CSS purposes