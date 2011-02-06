<?php

class FacebookShare extends SSocializeLink {
    static protected $base_url = 'http://www.facebook.com/sharer.php';
    
    static protected $url_key = 'u';

    static protected $title_key = 't';

    static protected $icon = 'ssocialize/images/icons/facebook/facebook-icon-16-16.png';
    
    static protected $service_name = 'Share this on Facebook';

    public function getPreparedLink() {
        return rawurlencode($this->link);
    }
    
    public function getPreparedTitle() {
        return rawurlencode($this->title);
    }
    
}

?>