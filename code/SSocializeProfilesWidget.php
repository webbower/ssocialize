<?php 

/**
 * Defines the SSocializeProfilesWidget widget
 * 
 *  @author       Matt Bower:Webbower <matt@webbower.com>
 */
class SSocializeProfilesWidget extends Widget {
    static $db = array(
		'Title' => 'Varchar',
	);

    static $defaults = array();

    static $title = 'Follow Me';
    static $cmsTitle = 'SSocialize Profiles Widget';
    static $description = 'Shows icons/links to your social website profiles. Set the URLs in your Site Configuration form.';

	static $default_icon_size = 'Large';

	function getCMSFields() {
		return new FieldSet(
			new TextField('Title')
		);
	}

	public function Title() {
		return $this->Title ? $this->Title : self::$title;
	}
	
	static public function set_default_icon_size($group = 'Large') {
		if(!in_array($group, array('Small', 'Large'))) return false;
		self::$default_icon_size = $group;
	}
	
	static public function get_default_icon_size() {
		$suffixes = array(
			'Large' => '32-32',
			'Small' => '16-16',
		);
		return $suffixes[self::$default_icon_size];
	}
	
}

class SSocializeProfilesWidget_Controller extends Widget_Controller {
	public function init() {
		parent::init();
		
		Requirements::themedCSS('profileswidget');
	}
	
	public function SiteConfig() {
		return SiteConfig::current_site_config();
	}
	
    
}