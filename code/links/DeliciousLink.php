<?php
//http://del.icio.us/post?url=http://www.alistapart.com/articles/apps-vs-the-web/&title=Apps+vs.+the+Web
class DeliciousLink extends SSocializeLink {
    static protected $base_url = 'http://del.icio.us/post';
    
    static protected $title_key = 'title';
    
    static protected $url_key = 'url';
    
    static protected $service_name = 'Del.ico.us';

    static protected $icon = 'ssocialize/images/icons/delicious/delicious-icon-16-16.png';

    public function getPreparedTitle() {
        return urlencode($this->title);
    }
    
}


?>