<?php

/**
 * A framework for page sharing links
 * This framework allows you to add share links (Twitter, Facebook, Digg, etc) to pages on your website.
 * Currently, there is now UI for a site maintainer to control these. They are implemented by the developer.
 * 
 * Usage (_config.php):
 * 
 * In your site's _config.php file, use {@link SSocialize::these()} to add which {@link SiteTree} subclasses
 * to add the share links to. This will apply a {@link DataObjectDecorator} to the classes. You can pass a
 * string of a single class name or an indexed array of multiple classes.
 * <code>
 * SSocialize::these('SiteTreeSubClass');
 * SSocialize::these(array(
 *     'MyPage',
 *     'MyOtherPage',
 * ));
 * </code>
 * 
 * You can optionally define groups of share links to output on a page. They will be output in your template
 * in the order they are added.
 * <code>
 * // Adds the TweetThis share link to the "Default" group
 * SSocialize::add_to_group('TweetThis');
 * 
 * // Adds TweetThis, DiggThis, and FacebookShare share links to the "BlogShare" group
 * SSocialize::add_to_group(array('TweetThis', 'DiggThis', 'FacebookShare'), 'BlogShare');
 * </code>
 * 
 * For any URL shortener services (ow.ly, bit.ly, j.mp, etc), there are classes to fetch and locally store the
 * shortened URL. Most require an account with the service. If you are using one of these, most commonly for
 * Twitter, you will need to define which shortner service to use with
 * {@link SSocializeShortURL::set_short_url_class()} calling it on the {@link SSocializeLink} subclass e.g.
 * <code>
 * TweetThis::set_short_url_class('BitlyURL');
 * </code>
 * 
 * Then you'll set the service username and API key with
 * <code>
 * BitlyURL::set_shortener_params('API Key', 'Username');
 * </code>
 * 
 * Usage (templates):
 * 
 * There are 2 template variables you can use, 1 to reference groups that were defined with
 * {@link SSocialize::add_to_group()} and 1 to output single share links.
 * <code>
 * $SSocializeLinkGroup &lt!-- Outputs links from the "Default" group -->
 * $SSocializeLinkGroup(BlogShare) &lt!-- Outputs links from the "BlogShare" group -->
 * 
 * $SSocializeLink(TweetThis) &lt!-- Outputs a "TweetThis" share link -->
 * </code>
 *
 * @package ssocialize
 */
class SSocialize extends DataObjectDecorator {
    
    static $groups = array();
    
	/**
	 * Method to bind this {@link DataObjectDecorator} to selected {@link SiteTree} subclasses
	 *
	 * @param mixed $classes String of a single class name or indexed array of multiple class names
	 * @return void
	 */
    static public function these($classes=array()) {
        if(!is_array($classes)) $classes = array($classes);
        if(count($classes) === 0) return false;
        
        foreach ($classes as $class) {
            DataObject::add_extension($class,'SSocialize');
        }
    }

	/**
	 * Defines groups of Share Links to be output in a template
	 *
	 * @param mixed $links String of a single or indexed array of multiple {@link SSocializeLink} subclasses
	 * @param string $group Name of the group to add the share links to. Defaults to "Default" group if blank
	 * @return void
	 */
    static public function add_to_group($links=array(), $group='Default') {
        if(!array_key_exists($group, self::$groups)) {
            self::$groups[$group] = array();
        }
        
        if(!is_array($links)) {
            $links = array($links);
        }
        
        self::$groups[$group] = array_merge(self::$groups[$group], $links);
    }

	/**
	 * Template variable to output a group of share links
	 * long description and usage examples
	 *
	 * @param string $group Name of the group to output. Defaults to "Default" group
	 * @return string Template output of group of share links
	 */
    public function SSocializeLinkGroup($group='Default') {
        $classes = self::$groups[$group];
        $links = new DataObjectSet();
        foreach ($classes as $class) {
            if(is_subclass_of($class, 'SSocializeLink')) {
                $links->push(new $class($this->owner));
            }
        }
        
        return $links->customise(array('SSocializeLinks' => $links))->renderWith('SSocializeLinkGroup');
    }
    
	/**
	 * Template variable to output a single share link
	 * long description and usage examples
	 *
	 * @param string $class Name of {@link SSocializeLink} subclass
	 * @return SSocializeLink Class instance to output into template
	 */
    public function SSocializeLink($class) {
        if(is_subclass_of($class, 'SSocializeLink')) {
            return new $class($this->owner);
        }
    }

}

?>