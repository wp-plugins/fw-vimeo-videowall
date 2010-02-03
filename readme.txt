=== fw-vimeo-videowall ===
Contributors: fairweb
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=11221214
Tags: video, vimeo, videowall, video widget, video thumbnail
Requires at least: 2.9
Tested up to: 2.9.1
Stable tag: '/trunk'

Displays a user, group, album or channel Vimeo videowall with thumbnails or small videos or a list of video titles in sidebar or content.

== Description ==
Displays a user, group, album or channel vimeo videowall with thumbnails or small videos or a list of video titles in sidebar or content.
= Choice to use =
* Widget : A widget with custom settings
* Content Short tags : you can add a videowall to a post or page
* Template tag : for advanced themes, you can place the videowall wherever you want using a template tag

You may choose to display clickable video thumbnails or titles which will open a window with Vimeo default sized video or small playable videos.
You may choose how many thumbnails or titles you want to display.

= Localized =
* English
* French

== Installation ==

1. Upload the `fw-vimeo-videowall` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. If you want to customize the CSS file, copy fw-vimeo-videowall.css file to your template directory so your styles won't be overwritten on next plugin upgrade.

= Widget =
1. From you template widget menu, slide the Vimeo Videowall widget to your sidebar
2. Choose your settings
3. Save widget

= Content short tags =
You can display a videowall in a page or post by using the `[fwvvw]` short tag. This tag can take different arguments.
Example : `[fwvvw id=30936 source="group" number="10"]`

= Template tag =
You can use the `fw_vimeowall_display()` function in your template files.
Example : `<?php if (function_exists('fw_vimeowall_display')) { fw_vimeowall_display('id=petole&source=user&type=image'); } ?>`

= Arguments for short tags and template tag =
1. id : the Vimeo user, group, album or channel ID you intend to use. This can be identified in the Vimeo url. Default is "petole".
1. source : the source type can be "user", "group", "album" or "channel". Default is "user".
1. type : will determine if you want a clickage image of the video or a list of video titles or the video itself to be displayed. Values are "image", "title" or "video". Default is "image".
1. number : number of thumbnails to display. Default is 4, a 0 value will display all.
1. width : thumbnail max width. Default is 100. It has no effet if `type` is set to "title".
1. height : thumbnail max height. Default is 100. It has no effet if `type` is set to "title".
1. echo : if true, displays the videowall, if false return the html without displaying it. Default is true.


== Screenshots ==
1. Here are the different ways to use the plugin.
2. If number of views is greater than 20, the plugin uses pagination

== Changelog ==
= 1.2 =
* Corrected W3C issues with id attributes
* Added pagination feature when number of videos is greater than 20. This is limited by the Vimeo API (Issue reported by weremoose).
= 1.1 =
* Added an option to display a list of clickable titles instead of thumbnails or videos (as requested by Tim Johnson)
* corrected a bug on CSS choice (default plugin CSS or custom CSS in template directory)
= 1.0 =
* First plugin release