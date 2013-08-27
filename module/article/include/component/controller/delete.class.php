<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * Author		Teamwurkz Technologies Inc.
 * package		phpfox article module 
 */
 
class Article_Component_Controller_Delete extends Phpfox_Component
{	
	public function process()
	{
		Phpfox::isUser(true);
		
		if(!Phpfox::IsAdmin()) {
			$this->url()->send('article',null,'You have no permission to access the page.');
		}
		
		if($aDelete = Phpfox::getService('article.process')->deleteArticle($this->request()->getInt('id'))) {
			$this->url()->send('article',null,'Article successfully deleted.');
		} else {
			$this->url()->send('article',null,'Article not found.');
		}
					
	}
}

?>