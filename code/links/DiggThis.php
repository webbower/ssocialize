<?php

class DiggThis extends SSocializeLink {
    static protected $base_url = 'http://digg.com/submit';
    
    static protected $title_key = 'title';
    
    static protected $url_key = 'url';
    
    static protected $service_name = 'Digg This';

    static protected $icon = 'ssocialize/images/icons/digg/digg-icon-16-16.png';
    
    public function getPreparedLink() {
        return rawurlencode($this->link);
    }
    
    public function getPreparedTitle() {
        return rawurlencode($this->title);
    }
    
}

?>