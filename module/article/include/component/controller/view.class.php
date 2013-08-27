<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * Author		Teamwurkz Technologies Inc.
 * package		phpfox article module 
 */
 
class Article_Component_Controller_View extends Phpfox_Component
{	
	public function process()
	{
	
	$sArticleTitle = $this->request()->get('req3');
	
	$aArticle = Phpfox::getService('article')->getArticleView($sArticleTitle);
	if(isset($aArticle['article_id'])) {
		if(Phpfox::IsUser()){
			Phpfox::getLib('database')->updateCounter('article', 'total_views', 'article_id', $aArticle['article_id']);
		}
		$aSections = Phpfox::getService('article')->getArticleSections($aArticle['article_id']);
		
	} else {
		$this->url()->send('article', null, 'Article not found.');
	}
	
	
		$this->template()->setTitle($aArticle['title'])
			->setMeta('description', $aArticle['title'].'.')
			->setMeta('description', substr(strip_tags($aArticle['text_parsed']),0,250).'.')
			->setMeta('keywords', $this->template()->getKeywords($aArticle['title']))
			->setBreadcrumb('Articles',$this->url()->makeUrl('article'))
			->setBreadcrumb($aArticle['name'],$this->url()->makeUrl('article.category.').$aArticle['name_url'])
			->setBreadcrumb($aArticle['title'], $this->url()->makeUrl('article.view').$aArticle['title_url'],true)			
			->assign(array(
					'aArticle' => $aArticle,
					'aSections' => $aSections
				)
			);		
		
	}
}

?>