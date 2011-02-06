<?php

/**
 * Base class for short URL fetching and storage
 * The following properties must be hard-coded in the subclass:
 * 
 * $singular_name
 * The singular human readble name of the subclass ("Bit.ly URL," etc)
 * 
 * $plural_name
 * The plural human readble name of the subclass ("Bit.ly URLs," etc)
 * 
 * $api_url
 * This is the API URL for the shortener service
 * 
 * The following method can and usually will be overridden:
 * 
 * generateShortURL()
 * This method does the legwork of fetching the shortened URL from the API. It must return the URL in plain text format,
 * not JSON, XML, or any other format
 * 
 * Additional Settings:
 * 
 * $api_key, $api_login
 * Most URL shorteners require an account to use the API. Once you have an account, they provide you with a username and
 * API key to send with the URL shortener request. Set these in your _config.php file using
 * {@link SSocializeShortURL::set_shortener_params()}, referencing the subclass of {@link SSocializeShortURL}
 * passing the API key as the first arg and the account username as the second arg.
 *
 * @package ssocialize
 */
class SSocializeShortURL extends DataObject {

    static $db = array(
        'SiteURL' => 'Varchar(255)',
        'ShortURL' => 'Varchar',
    );

    static $api_key;
    
    static $api_login;
    
    static $api_url;

    static $singular_name = 'SScocialize Shortened URL';

    static $plural_name = 'SScocialize  Shortened URLs';

    public function generateShortURL($url='') {
		user_error("You must define generateShortURL() in {$this->class}", E_USER_ERROR);
    }

    static public function get_by_site_url($class='', $url='') {
        $url_SQL = Convert::raw2sql($url);
        if($link = DataObject::get_one($class, "SiteURL = '{$url_SQL}'")) {
            return $link;
        } else {
            return false;
        }
    }

	static public function set_shortener_params($api_key, $api_login) {
		self::$api_key = $api_key;
		self::$api_login = $api_login;
	}

}

?>