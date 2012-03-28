<?php
//http://twitter.com/?status=Apps%20vs.%20the%20Web:%20http://www.alistapart.com/articles/apps-vs-the-web/
class TweetThis extends SSocializeLink {
    static protected $base_url = 'http://twitter.com/';

    static protected $url_key = 'status';
    
    static protected $icon = 'ssocialize/images/icons/twitter/twitter-icon-16-16.png';

    static protected $service_name = 'Tweet This';

    public function getPreparedLink() {
        $pageLink = $this->getLink();
		$shortURLClass = self::get_short_url_class();
        $shortURL = SSocializeShortURL::get_by_site_url($shortURLClass, $pageLink);
        if(!$shortURL) {
            $shortURL = singleton($shortURLClass);
            $shortURL->SiteURL = $pageLink;
            $shortURL->ShortURL = $shortURL->generateShortURL($pageLink);
            $shortURL->write();
        }
        return $shortURL->ShortURL;
    }

	public function getPreparedTitle() {
        return rawurlencode($this->title);
	}

    protected function buildQueryString() {
        $queryString = '';
        
        if($url_key = $this->stat('url_key')) $queryString .= sprintf('%s=%s%%20%s', $url_key, $this->getPreparedTitle(), $this->getPreparedLink());

        return $queryString;
    }

    
}

?>