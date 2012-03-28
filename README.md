# SSocialize Module 0.1.1

## Maintainer Contact

Matt Bower (Nickname: webbower, webbower (at) gmail (dot) com) 

## Requirements

SilverStripe 2.4

## Installation Instructions

1. Place this directory in the root of your SilverStripe installation. I.e. you will now have the following root folders
		assets/
		cms/
		mysite/
		ssocialize/
2. Visit http://www.yoursite.com/dev/build/?flush=1 in your browser (where yoursite.com refers to the URL of your SilverStripe site)

## Usage Overview

### Share Links

In your _config.php file, call SSocialize::these() passing it a string of a single or an array of multiple SiteTree subclasses.

	SSocialize::these('MyPage');

OR

	SSocialize::these(array('MyPage', 'MyOtherPage'));

You can define groups of share links to easily reference in your templates.

	SSocialize::add_to_group('TweetThis'); // Adds the TweetThis share link to the "Default" group
	SSocialize::add_to_group(array('DiggThis', 'FacebookShare'), 'BlogPages'); // Adds the DiggThis and FacebookShare links to the "BlogPages" group.

If you need to use a URL shortener service (bit.ly, ow.ly, etc) for share systems like Twitter, you'll need to define which class handles communication with the URL shortener service for your share links. For example:

	TweetThis::set_short_url_class('BitlyURL');

Most URL shortener APIs require an account. When you have one, you'll usually need an API key and your username. You can set those for the URL shortener class you use. For example:

	BitlyURL::set_shortener_params('API Key', 'Username');

The URL shortener classes handle fetching and locally storing the shortened URLs

In your template, you can call the following variables:

	$SSocializeLinkGroup // Outputs the links assigned to the "Default" group
	$SSocializeLinkGroup(BlogPages) // Outputs the links assigned to the "BlogPages" group
	$SSocializeLink(TweetThis) // Outputs a Tweet This link

This module currently supports the following share links:

- FacebookShare (Facebook)
- TweetThis (Twitter)
- StumbleUponLink (Stumble Upon)
- DiggThis (Digg)
- DeliciousLink (Del.ico.us)

...and the following URL shortener APIs

- BitlyURL (bit.ly)

## Known issues

- Needs I18N support/customizable link labels
- Share links need to allow for icon overrides
- Add Print and Email This Page links?

## Roadmap

- Add more URL shortener services
	- awe.sm
- Add Social Profile Links widget
	- Links output
	- Admin GUI
- Add Admin panel GUI for page sharing links