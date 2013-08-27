<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * Author		Teamwurkz Technologies Inc.
 * package		phpfox article module 
 */
 
class Article_Component_Controller_Delsection extends Phpfox_Component
{	
	public function process()
	{
		Phpfox::isUser(true);
		
		if(!Phpfox::IsAdmin()) {
			$this->url()->send('article',null,'You have no permission to access the page.');
		}
		
		$iSection=$this->request()->getInt('id');
		
		if(Phpfox::getService('article.process')->removeSection($iSection)) {
			$this->url()->send('article.my',null,'Section successfully removed.');
		} else {
			$this->url()->send('article.my',null,'Section not found.');
		}
					
	}
}

?>