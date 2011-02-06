<?php

class JmpURL extends SSocializeShortURL {

    static $singular_name = 'j.mp URL';

    static $plural_name = 'j.mp URLs';

    static $api_url = 'http://api.j.mp/v3/shorten';

    public function generateShortURL($url='') {
        $params = array(
            'login' => self::$api_login,
            'apiKey' => self::$api_key,
            'format' => 'txt',
            'longUrl' => $url,
        );
        return file_get_contents(self::$api_url.'?'.http_build_query($params));
    }

}

?>