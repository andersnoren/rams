=== Rams ===
Contributors: Anlino
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=anders%40andersnoren%2ese&lc=US&item_name=Free%20WordPress%20Themes%20from%20Anders%20Noren&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Requires at least: 4.4
Requires PHP: 5.6
Tested up to: 5.5
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Installation ==

1. Upload the theme
2. Activate the theme

All theme specific options are handled through the WordPress Customizer.


== Use the gallery post format ==

1. Go to Admin > Posts > Add New.
2. Select the "Gallery" post format in the Post Attributes box.
3. Click "Add Media" and upload the images you wish to display in the gallery.
4. Close the Media window and publish/update the post.
5. The images you uploaded should now be displayed in the post gallery.


== Use the the quote post format ==

1. Create a new post.
2. Select "Quote" in the Format window to the right.
3. In the post content, enter the quote content within a blockquote element, and the quote attribution within a cite element.
4. Directly after the two elements, add the <!--more--> tag followed by the rest of the content. Example:

<blockquote>[quote content]
<cite>[quote attribution]</cite>
</blockquote>
<!--more-->
The rest of the content...

5. Publish.
6. The blockquote will now be presented as a single link element on the archive pages.


== Licenses ==

Montserrat
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Montserrat

Crimson Text
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Crimson+Text

Flexslider 2
License: GPLv2 
Source: http://flexslider.woothemes.com

screenshot.png post image 
License: CC0 Public Domain 
Source: http://www.unsplash.com


== Changelog ==

Version 2.0.0 (2020-12-23)
-------------------------
- Added "Requires PHP" and "Tested up to" to style.css and readme.txt.
- Added theme tags: block-styles, wide-blocks.
- Deleted the languages folder and license.txt.
- Updated Flexslider to 2.7.0, added non-minified version.
- Added theme version number to enqueues of theme files.
- Moved CSS, JS and images to the new assets folder.
- Replaced the `post-image` image size by setting the post-thumbnail size to the same dimensions.
- CSS cleanup.
- Updated the CSS reset to allow for more inherits.
- Cleaned up index.php, moved modification to the archive title and description to functions.php.
- Modified element structure of the archive header for better SEO.
- Fixed display of search when there aren't any results.
- Moved the Customizer class to a separate file, made it pluggable, and improved its structure and code.
- Restructured the sidebar to use flex instead of absolute positioning for child elements.
- Google Fonts: Removed the 500 font weight, since it wasn't being used.
- Removed searchform.php and styled the Core search form instead.
- Set links to be underlined by default.
- Updated the Post Content styles to have global targeting, and updated other styles to account for the new base styles.
- Improved color contrast.
- Updated conditional for outputting comments container.
- Added block editor color palette classes to the block editor styles, updated targeting.
- Removed <head> parameters disabling user scalability.
- Removed the title attribute from all links.
- Removed the "Comments are closed" message from the comments section.
- Output the excerpt on the page for search results, instead of the full content.
- Fixed the site header title element always being an h1.
- Removed conditional for outputting a blog logo in the header, since Rams doesn't support logos.
- Flexed the site header on mobile.
- More clear separation between posts on mobile.
- Updated resolution of screenshot to 1200x900 and file format to JPG, reducing file size.
- Block Editor style improvements.

Version 1.25 (2019-04-07)
-------------------------
- Added the new wp_body_open() function, along with a function_exists check

Version 1.24 (2018-12-28)
-------------------------
- Merged archive.php and search.php into index.php
- Merged single.php and page.php into singular.php

Version 1.23 (2018-12-07)
-------------------------
- Fixed Gutenberg style changes required due to changes in the block editor CSS and classes
- Fixed the Classic Block TinyMCE buttons being set to the wrong font

Version 1.22 (2018-11-30)
-------------------------
- Fixed Gutenberg editor styles font being overwritten

Version 1.21 (2018-10-14)
-------------------------
- Added the .has-accent-color/-background-color Gutenberg elements to the custom accent color function

Version 1.20 (2018-10-14)
-------------------------
- Accent color fix in the Gutenberg editor styles

Version 1.19 (2018-10-14)
-------------------------
- Fixed the default accent color in style.css and in the Gutenberg custom palette function

Version 1.18 (2018-10-13)
-------------------------
- Updated with Gutenberg support
	- Gutenberg editor styles
	- Styling of Gutenberg blocks
	- Custom Rams Gutenberg palette
	- Custom Rams Gutenberg typography styles
- Added option to disable Google Fonts with a translateable string
- Updated theme description
- Improved compatibility with < PHP 5.5

Version 1.17 (2018-05-24)
-------------------------
- Fixed output of cookie checkbox in comments

Version 1.16 (2017-12-01)
-------------------------
- Updated to the new readme.txt format, with changelog.txt incorporated into it
- Fixed notice in comments.php
- Changed closing element comment structure
- General code cleanup, improvements in readability
- Made all of the functions in functions.php pluggable
- Better handling of edge cases (missing title)
- Center post thumbnail images thinner than the featured-media element

Version 1.15 (2016-06-18)
-------------------------
- Added the new theme directory tags

Version 1.14 (2015-12-29)
-------------------------
- Removed the <title> tag from header.php (fixing conflict with title_tag())
- Updated the theme description
- Minor formatting updates to style.css

Version 1.13 (2015-08-25)
-------------------------
- Fixed an issue with overflowing images
- Added the .screen-reader-text class

Version 1.12 (2015-08-11)
-------------------------
- Replaced the custom title function with theme support for title-tag
- Modified the presentation of quotes in content-quote
- Added a description for adding quotes in content-quote to readme.txt
- Changed the post title to h1 elements on singular for SEO reasons

Version 1.11 (2015-01-27)
-------------------------
- Updated the readme.txt to reflect the changes in v1.10.

Version 1.10 (2015-01-27)
-------------------------
- Removed the video template file and format, and changed the display of the quote post format in order to be able to remove the meta fields from the theme
- Removed the meta fields and associated functions from functions.php
- Added sanitize callback to the custom accent color function
- Removed the shortcode modifying the display of wp_caption
- Updated the associated image alignment code in style.css
- Fixed the height of the more tag in the theme editor styles
- Added styling for the email input type

Version 1.09 (2014-10-02)
-------------------------
- Added a missing function prefix to functions.php

Version 1.08 (2014-09-25)
-------------------------
- Added a Search Page Template per user requests

Version 1.07 (2014-08-21)
-------------------------
- Moved enqueue comment-reply to functions.php

Version 1.06 (2014-08-21)
-------------------------
- Fixed an error in header.php

Version 1.05 (2014-08-06)
-------------------------
- Updated style.css for brevity and browser compatibility
- Made some improvements to the editor style

Version 1.04 (2014-07-20)
-------------------------
- Added a .no-js fallback for the post meta

Version 1.03 (2014-07-19)
-------------------------
- Added image.php and template-archives.php
- Added missing namespaces
- Updated the Swedish .mo file

Version 1.02 (2014-07-19)
-------------------------
- Improved styling of tables
– Made the header more adaptable to long blog titles at < 600px

Version 1.01 (2014-07-19)
-------------------------
- Added missing .sticky class 

Version 1.0 (2014-07-19)
------------------------- 