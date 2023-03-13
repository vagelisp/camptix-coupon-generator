=== CampTix Coupon Generator ===
Contributors: eboxnet
Donate link: https://github.com/sponsors/vagelisp
Tags: CampTix, coupons, CSV, generator
Requires at least: 5.0
Tested up to: 6.1
Stable tag: 6.1
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

CampTix Coupon Generator is a WordPress plugin that streamlines coupon generation for websites using the CampTix event management plugin. Import a CSV file to create coupons, log creation activity and send an email for each coupon generated. Ideal for generating unique coupons for event Organisers and Volunteers etc.


== Description ==

CampTix Coupon Generator is a WordPress plugin that streamlines coupon generation for websites using the CampTix event management plugin. With this plugin, you can quickly generate multiple CampTix coupons by importing a CSV file. It's perfect for event organisers who want to create unique coupons in bulk or provide discounts and special offers to attendees.

The plugin also maintains a log file that records all coupon creation activity, so you can easily review or download the data later. This feature helps you keep track of coupon usage and provides an audit trail of coupon distribution.

In addition, CampTix Coupon Generator sends an email after each coupon is created, provided that an email address is included in the CSV file. This feature ensures that recipients are immediately informed of the offer and can take advantage of it.

Overall, CampTix Coupon Generator is an essential plugin for event management websites that want to streamline the coupon creation process, keep track of coupon usage, and offer special deals to their attendees.

== Installation ==

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don’t need to leave your web browser. To do an automatic install of Camptix Coupon Generator, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type “Camptix Coupon Generator” and click Search Plugins. Once you’ve found the plugin you can view details about it such as the point release, rating and description. Most importantly of course, you can install it by simply clicking “Install Now”.

= Manual installation =

The manual installation method involves downloading Camptix Coupon Generator plugin and uploading it to your webserver via your favourite FTP application. The WordPress codex contains [instructions on how to do this here](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

= Updating =

Automatic updates should work like a charm; as always though, ensure you backup your site just in case.

== Upgrade Notice ==

= 1.0 =

=== Plugin Usage ===

1. Install and activate the CampTix Coupon Generator plugin.
2. Prepare a CSV file with the following columns: code, discount_price, discount_percent, quantity, email. The code and the quantity columns are required, the rest are optional however you should have discount_price or discount_percent. Add an email column if you want to send an email to each coupon recipient.
3. Import the CSV file on the Coupons Generator page.
4. Click on the Generate Coupons button.
5. The plugin will create the coupons and log the creation.
6. View the log file and list the created coupons on the Coupons page.

== Frequently Asked Questions ==
= How do I import a CSV file? =
1. Prepare a CSV file with the following columns: code, discount_price, discount_percent, quantity, email. The code and the quantity columns are required, the rest are optional however you should have discount_price or discount_percent. Add an email column if you want to send an email to each coupon recipient.
2. Import the CSV file on the Coupons Generator page.
3. Click on the Generate Coupons button.
4. The plugin will create the coupons and log the creation.
5. View the log file and list the created coupons on the Coupons page.

= How do I view the log file? =
The log file is available on the Coupons Generator page. You can view the log file and download it as a CSV file.

= How do I view the coupons? =
The coupons are available on the Coupons page. You can view the coupons and download them as a CSV file.


### Support

- Feel free to use the [support forum](https://wordpress.org/support/plugin/camptix-coupon-generator/), and we will get back to you as soon as possible.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* Initial release.