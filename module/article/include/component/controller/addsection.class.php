<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * Author		Teamwurkz Technologies Inc.
 * package		phpfox article module 
 */
 
class Article_Component_Controller_Addsection extends Phpfox_Component
{	
	public function process()
	{
		Phpfox::isUser(true);
		
		if(!Phpfox::IsAdmin()) {
			$this->url()->send('article',null,'You have no permission to access the page.');
		}
		
		$bIsEditing = false;
		
		$iArticleId = $this->request()->getInt('ai');
		$iInsArticle = $this->request()->getInt('ins');
		
		$aSectionList = Phpfox::getService('article')->getArticleSections($iArticleId);
		
		$aArticle = Phpfox::getService('article')->getArticleTitle($iArticleId);
		
		
		if(!isset($aArticle['article_id'])) {
			$this->url()->send('article',null,'Article not found.');
		}

		if($iInsArticle > 0){
			$aInsArticle = Phpfox::getService('article')->getArticleTitle($iInsArticle);
			
			if(!isset($aInsArticle['article_id'])) {
				$this->url()->send('article',null,'Article not found.');
			} else {
				if($iInsId = Phpfox::getService('article.process')->insertArticle($aArticle['article_id'],$aInsArticle)){
					$this->url()->send('article.addsection', array('ai'=>$iArticleId,'id'=>$iInsId), 'Section has been added.');
				}
			}
			
		}
		
		if($iEditId = $this->request()->getInt('id')) {
			$aSection = Phpfox::getService('article')->getSection($iEditId);
						
			if(isset($aSection['a_section_id'])) {
				$bIsEditing = true;

				$this->template()->assign(array(
						'aForms' => $aSection
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
						if (Phpfox_Error::isPassed() && ($iId = Phpfox::getService('article.process')->updateSection($aSection['a_section_id'], Phpfox::getUserId(), $aVals)))
						{
							$this->url()->send('article.addsection', array('ai'=>$iArticleId,'id' => $aSection['a_section_id']), 'Section has been updated.');
						} else {
							$this->url()->send('article.addsection', array('ai'=>$iArticleId,'id' => $aSection['a_section_id']), null);
						}
					}

					if (Phpfox_Error::isPassed() && ($iId = Phpfox::getService('article.process')->addSection($aVals,Phpfox::getUserId())))
					{
						$this->url()->send('article.addsection', array('ai'=>$iArticleId,'id'=>$iId), 'Section has been added.');
					}
					
					
			}			
		}		
		
		$this->template()->setTitle('Add a Section')
			->setBreadcrumb('Add a Section', null)
			->setEditor(array('wysiwyg' => true))
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
					'aArticle' => $aArticle,
					'aSectionList' => $aSectionList					
				)
			);		

		if ($bIsEditing)
			{					
				$this->template()->setHeader('<script type="text/javascript">$(function(){var aCategories = explode(\',\', \''. $aSection['categories'] .'\'); for (i in aCategories) { $(\'#js_mp_holder_\' + aCategories[i]).show(); $(\'#js_mp_category_item_\' + aCategories[i]).attr(\'selected\', true); }});</script>');	
			}			
					
	}
}

?>