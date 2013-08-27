<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * Author		Teamwurkz Technologies Inc.
 * package		phpfox article module 
 */
 
class Article_Component_Controller_Managesection extends Phpfox_Component
{	
	public function process()
	{
		Phpfox::isUser(true);
		
		if(!Phpfox::IsAdmin()) {
			$this->url()->send('article',null,'You have no permission to access the page.');
		}
		
		$aArticle = Phpfox::getService('article')->getArticle($this->request()->getInt('ai'));
		if(!isset($aArticle['article_id'])) {
			$this->url()->send('article',null,'Article not found.');
		}
		
		$aSectionList = Phpfox::getService('article')->getArticleSections($aArticle['article_id']);		
		
		if ($this->request()->get('updateorder'))
		{
			$aVals = $this->request()->getArray('val');
			Phpfox::getService('article.process')->updateSectionOrder($aArticle['article_id'],$aVals);
			$this->url()->send('article.managesection',array('ai'=> $aArticle['article_id']),'Sections ordering updated.');
		}
		
		$this->template()->setTitle('Manage Sections')
			->setBreadcrumb('Manage Sections', null)
			->assign(array(
					'aArticle' => $aArticle,
					'aSectionList' => $aSectionList
				)
			);		
					
	}
}

?>