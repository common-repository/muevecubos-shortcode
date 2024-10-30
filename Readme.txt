=== Plugin Name ===
Contributors: pablotrinidad
Donate link: http://pablotrinidad.es/
Tags: muevecubos, boardgames
Requires at least: 4.0.1
Tested up to: 4.4.1
Stable tag: /trunk/
License: LGPLv3
License URI: http://www.gnu.org/licenses/lgpl-3.0.html

A plugin to let muevecubos.com detect your boardgame reviews and integrate them in their fantastic web.

== Description ==

A plugin to let muevecubos.com detect your boardgame reviews and integrate them in their fantastic web. It provides a shortcode to enable reviews integration with muevecubos.com.

Read how integration works in http://muevecubos.com/blog/resenas-en-muevecubos/

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress


== Frequently Asked Questions ==

= What if I make a mistake in the shortcode format? =

An error message will be shown in your post. The message should guide you to repair the shortcode syntax. Try previewing your posts before publishing them!

= What will be shown if everything is ok? =

Nothing will be shown. A `<div>` section will be created with the adequate syntax. You can check the source code of your blog post to be sure it's been created adequately.


== Changelog ==

= 1.0 =
* First stable version.

== Upgrade Notice ==

= 1.0 =
This is the first online available version of this plugin.

== How to use this plugin ==

Muevecubos.com captures review summaries from the posts you publish under the following format.

`[muevecubos notasobre100="80" bggid="32141"]
Here comes the review
[/muevecubos]`

These are the fields that must be provided with the shortcode:
* `notasobre100` field should be a number between 0 and 100 indicating your score.
* `bggid` field should be the number used in boardgamegeek.com to identify the board game you are reviewing.

The review should be provided inside the shortcode structure. Avoid using HTML labels inside the description since muevecubos.com won't show them. You can use other shortcodes inside the review and they will be compiled correctly.

== Screenshots ==

1. Use muevecubos shortcode in your posts.