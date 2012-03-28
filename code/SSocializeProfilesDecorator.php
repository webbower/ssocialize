<?php

class SSocializeProfilesDecorator extends DataObjectDecorator {
	public function extraStatics() {
		return array(
			'db' => array(
				'FacebookProfileURL' => 'Varchar',
				'TwitterProfileURL' => 'Varchar',
				'LinkedInProfileURL' => 'Varchar',
			),
			'has_one' => array(
				'FacebookIcon' => 'Image',
				'TwitterIcon' => 'Image',
				'LinkedInIcon' => 'Image',
			),
		);
	}
	
	public function updateCMSFields(FieldSet $fields) {
		$fields->addFieldsToTab('Root.Social Profiles', array(
			new HeaderField('FacebookHeader', 'Facebook', 2),
		    new TextField('FacebookProfileURL', 'Facebook Profile URL'),
			new ImageField('FacebookIcon', 'Custom Facebook Icon'),

			new HeaderField('TwitterHeader', 'Twitter', 2),
		    new TextField('TwitterProfileURL', 'Twitter Profile URL'),
			new ImageField('TwitterIcon', 'Custom Twitter Icon'),

			new HeaderField('LinkedInHeader', 'LinkedIn', 2),
		    new TextField('LinkedInProfileURL', 'LinkedIn Profile URL'),
			new ImageField('LinkedInIcon', 'Custom LinkedIn Icon'),
		));
	}
	
	public function FacebookImage() {
		$size = SSocializeProfilesWidget::get_default_icon_size();
		return $this->owner->FacebookIconID ?
			   $this->owner->FacebookIcon() :
			   sprintf('<img src="%s" alt="" />', Director::baseURL() . "ssocialize/images/icons/facebook/facebook-icon-{$size}.png");
	}
	
	public function TwitterImage() {
		$size = SSocializeProfilesWidget::get_default_icon_size();
		return $this->owner->TwitterIconID ?
			   $this->owner->TwitterIcon() :
			   sprintf('<img src="%s" alt="" />', Director::baseURL() . "ssocialize/images/icons/twitter/twitter-icon-{$size}.png");
	}
	
	public function LinkedInImage() {
		$size = SSocializeProfilesWidget::get_default_icon_size();
		return $this->owner->LinkedInIconID ?
			   $this->owner->LinkedInIcon() :
			   sprintf('<img src="%s" alt="" />', Director::baseURL() . "ssocialize/images/icons/linkedin/linkedin-icon-{$size}.png");
	}
	
}