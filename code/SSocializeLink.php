<?php

/**
 * Base class of share links
 * This class sets up the framework for creating share links. Subclass it to define a new share link to use.
 * 
 * The following properties must be hard-coded in the subclass:
 * 
 * $base_url
 * This is the base URL for the share service API that gets the query params appended to it.
 * 
 * $title_key
 * This is the query param key for the page title, if used (Twitter does not use this)
 * 
 * $url_key
 * This is the query param key for the page URL
 * 
 * $icon
 * Path to the icon for the share link
 * 
 * $service_name
 * Name of the service, usually in the form of a Call To Action ("Tweet This," "Share on Facebook," etc). Will be
 * used as the alt text on the icon or as a textual representation as a fallback.
 * 
 * The following method can and usually will be overridden:
 * 
 * getPreparedLink()
 * This method returns the URL of the page prepared for the service API to recieve, usually URL encoded in some way.
 * This is also where you would define the retrieval and local storage of a shortened URL using a subclass of
 * {@link SSocializeShortURL}
 * 
 * getPreparedTitle()
 * This method returns the title of the page prepared for the service API to recieve, usually URL encoded in some way
 * 
 * Additional Settings:
 * 
 * $short_url_class
 * The URL shortener class (a subclass of {@link SSocializeShortURL}) to use. Set with
 * {@link SSocializeLink::set_short_url_class()} referencing the subclass of {@link SSocializeLink} you are setting
 * it for (e.g. TweetThis::set_short_url_class())
 * 
 * @todo Add ability for manual override of default icon
 *
 * @package ssocialize
 */
class SSocializeLink extends ViewableData {
    static protected $base_url;
    
    static protected $title_key;
    
    static protected $url_key;
    
    static protected $icon;

    static protected $service_name;

	static protected $short_url_class;

    protected $title;
    
    protected $link;
    
    public function __construct(DataObject $page) {
        parent::__construct();
        $this->link = $page->AbsoluteLink();
        $this->title = $page->getTitle();
    }
    
    public function getPreparedLink() {
        return $this->link;
    }
    
    public function getPreparedTitle() {
        return $this->title;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function getLink() {
        return $this->link;
    }

    public function getServiceName() {
        return self::$service_name;
    }
    
    protected function buildQueryString() {
        $queryString = '';
        
        if($url_key = $this->stat('url_key')) $queryString .= sprintf('%s=%s', $url_key, $this->getPreparedLink());
        if($title_key = $this->stat('title_key')) $queryString .= sprintf('&amp;%s=%s', $title_key, $this->getPreparedTitle());

        return $queryString;
    }

    // static function setIcon($path='') {
    //     self::$icon = $path;
    // }
    // 
    public function getIcon() {
		if(file_exists(Director::baseFolder() . self::$icon)) {
			return sprintf('<img src="%s" alt="%s" />', Director::baseURL() . $this->stat('icon'), $this->stat('service_name'));
		} else {
			return $this->stat('service_name');
		}
    }

	static public function set_short_url_class($class='') {
		self::$short_url_class = $class;
	}

	static public function get_short_url_class() {
		return self::$short_url_class;
	}

    public function getSSocializeURL() {
        return sprintf('%s?%s', $this->stat('base_url'), $this->buildQueryString());
    }
    
    public function forTemplate() {
        return $this->renderWith(array($this->class, 'SSocializeLink'));
    }
}

?>