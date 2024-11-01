=== WooCommerce Top Customers ===
Contributors: pinchofcode
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=paypal@pinchofcode.com&item_name=Donation+for+Pinch+Of+Code
Tags: woocommerce, customers, shortcode, orders, count, money
Requires at least: 3.8
Tested up to: 3.9.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the shortcode [wc_top_customers] to WooCommerce and shows a list of customers ordered by the number of their completed orders.

== Description ==

Adds the shortcode [wc_top_customers] to WooCommerce and shows a list of customers ordered by the number of their completed orders.

= Usage =

`[wc_top_customers number="12" columns="4" orderby="meta_key" orderby_meta_key="_order_count" order="asc" role="customer"]`

= Shortcode Parameters =

* **number**: The maximum number of customers to show. Default *12*
* **columns**: The number of columns to use for the grid. Default *4*
* **orderby**: The order key used to show customers. Default *meta_key*
* **orderby_meta_key**: Order customers by orders count (_order_count) or money spent(_money_spent). Default *_order_count*
* **order**: Shows customer in ascending or descending order. Default *asc*
* **role**: Show customers with the role assigned to this attribute. Default *customer*

= Support =
For any support request, please create a new issue [here](https://github.com/PinchOfCode/woocommerce-top-customers/issues).

**Note**: since the free nature of this plugin, the support may be discontinuous, but all the requests are checked and replied. We suggest to write on [GitHub](https://github.com/PinchOfCode/woocommerce-top-customers/issues) to get faster support.

= License =
Copyright (C) 2014 Pinch Of Code. All rights reserved.

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

== Installation ==

= WP Installation =

1. Go to Plugins > Add New > Search
2. Type WooCommerce Top Customers in the search box and hit Enter
3. Click on the button Install and then activate the plugin

= Manual Installation =

1. Upload `woocommerce-top-customers` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. Payment Gateways admin page
2. Order detail admin page

== Changelog ==

= 1.0.0 =
* First release
