=== SEO Auto Linker ===
Contributors: chrisguitarguy, agencypmg
Donate link: http://www.pwsausa.org/give.htm
Tags: seo, links, internal links, automatic linking
Requires at least: 3.2
Tested up to: 3.2.1
Stable tag: 0.1

SEO Auto Linker allows you to automagically add links into your content. Great for internal linking!

== Description ==

SEO Auto Linker is an update to the much loved [SEO Smart Links](http://wordpress.org/extend/plugins/seo-automatic-links/ "SEO Smart Links") plugin.

The plugin automatically links words and phrases in your post, page or custom post type content.

The difference is that you no longer have to try and guess what links will appear.  Specify keywords in a comma separated list, type in the URL to which those keywords will link, specify how many links to the specified URL per post, and then specify the post type. SEO Auto Linker does the rest.

Bugs?  Problems?  [Get in touch](http://pmg.co/contact).

== Installation ==

1. Download the `seo-auto-linker.zip` file and unzip it
2. Upload the `seo-auto-linker` folder to your `wp-content/plugins` directory
3. In the WordPress admin area, click "Plugins" on the menu and activate SEO Auto Linker
4. Set up your keywords and sit back!

== Frequently Asked Questions ==

= When I specify keywords, will they all get linked? =

Sort of.  If you keyword list is `lorem, ipsum`, the word `lorem` OR the word `ipsum` will be linked to the specified URL.  If the content contains both `lorem` and `ipsum, they will only both be linked if you set the number of links per post to more than one for that keyword list.

= Will this slow my site down? =

If you add hundreds of keywords, the answer is probably yes.  However, SEO auto linker makes use of several wp_cache functions which, when combined with a persistent caching plugin, should help speed things up.  If you're running a large scale WordPress install, you should probably be using a caching plugin anyway.

== Screenshots ==

1. A look at the admin screen

== Changelog ==

= 0.1 =
* The very first version.
* Support for automatic linking added

== Upgrade Notice ==

= 0.1 =
SEO Auto Linker works pretty alright, so maybe you should use it.