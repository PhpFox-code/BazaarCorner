<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * Author		Teamwurkz Technologies Inc.
 * package		phpfox article module 
 */
 
class Article_Component_Controller_Add extends Phpfox_Component
{	
	public function process()
	{
		Phpfox::isUser(true);


		if(!Phpfox::IsAdmin()) {
			$this->url()->send('article',null,'You have no permission to access the page.');
		}
		
		$bIsEditing = false;
		
		if($iEditId = $this->request()->getInt('id')) {
			$aArticle = Phpfox::getService('article')->getArticle($iEditId);
						
			if(isset($aArticle['article_id'])) {
				$bIsEditing = true;

				$this->template()->assign(array(
						'aForms' => $aArticle
					)
				);								
			}						
		}
		
		// check input fields
		$aValidation = array(
			'title' => array(
				'def' => 'required',
				'title' => 'Please enter a title.'
			),
			'text' => array(
				'def' => 'required',
				'title' => 'Please add your content.'
			)			
		);		
		
		$oValid = Phpfox::getLib('validator')->set(array(
				'sFormName' => 'js_form',	
				'aParams' => $aValidation
			)
		);

		// Lets add the article
		if ($aVals = $this->request()->getArray('val'))
		{			
			if ($oValid->isValid($aVals))
			{
					if ($bIsEditing)
					{					
						if (Phpfox_Error::isPassed() && ($iId = Phpfox::getService('article.process')->update($aArticle['article_id'], $aArticle['user_id'], $aVals)))
						{
							$this->url()->send('article.add', array('id' => $aArticle['article_id']), 'Article has been updated.');
						}
					}

					if (Phpfox_Error::isPassed() && ($iId = Phpfox::getService('article.process')->add($aVals,Phpfox::getUserId())))
					{
						$this->url()->send('article.add', array('id'=>$iId), 'Article has been submitted.');
					}
			}			
		}		
		
		$this->template()->setTitle('Add an Article')
			->setBreadcrumb('Add an Article', $this->url()->makeUrl('article.add'))
			->setEditor()
			->setHeader('cache', array(
					'switch_legend.js' => 'static_script',
					'switch_menu.js' => 'static_script',
					'article.js' => 'module_article'		
				)
			)
			->assign(array(
					'sCreateJs' => $oValid->createJS(),
					'sGetJsForm' => $oValid->getJsForm(),
					'sCategories' => Phpfox::getService('article.category')->get(),
				)
			);		
		
		$this->template()->setHeader('<script type="text/javascript">var Attachment = {sCategory: "article", iItemId: "' . (isset($aArticle['article_id']) ? $aArticle['article_id'] : '') . '"};</script>');					
		
		if ($bIsEditing)
			{			
				$this->template()->setHeader('<script type="text/javascript">$(function(){var aCategories = explode(\',\', \''. $aArticle['categories'] .'\'); for (i in aCategories) { $(\'#js_mp_holder_\' + aCategories[i]).show(); $(\'#js_mp_category_item_\' + aCategories[i]).attr(\'selected\', true); }});</script>');	
			}
			
					
	}
}

?>