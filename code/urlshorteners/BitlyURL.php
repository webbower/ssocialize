<?php

class BitlyURL extends SSocializeShortURL {

    static $singular_name = 'Bit.ly URL';

    static $plural_name = 'Bit.ly URLs';

    static $api_url = 'http://api.bit.ly/v3/shorten';

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