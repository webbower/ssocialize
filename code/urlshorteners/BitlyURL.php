<?php

class BitlyURL extends SSocializeShortURL {

    static $singular_name = 'Bit.ly URL';

    static $plural_name = 'Bit.ly URLs';

    static $api_url = 'http://api.%s/v3/shorten';

	static $base_domain = 'bit.ly';

    public function generateShortURL($url='') {
        $params = array(
            'login' => self::$api_login,
            'apiKey' => self::$api_key,
            'format' => 'txt',
            'longUrl' => $url,
        );
        return file_get_contents(self::get_api_url().'?'.http_build_query($params));
    }

	static public function get_api_url() {
		return sprintf(self::$api_url, self::$base_domain);
	}

	static public function get_base_domain() {
		return self::$base_domain;
	}

	static public function set_base_domain($domain) {
		self::$base_domain = $domain;
	}

}

?>