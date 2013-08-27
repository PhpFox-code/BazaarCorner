<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * Author		Teamwurkz Technologies Inc.
 * package		phpfox article module 
 */
 
class Article_Service_Process extends Phpfox_Service 
{

	private $_aCategories = array();

	public function __construct()
	{	
		$this->_sTable = Phpfox::getT('article');	
	}
	
	public function add($aVals, $iUserID, $iUpdateId = null)
	{		
		
		$oFilter = Phpfox::getLib('parse.input');

		if (!isset($aVals['category']))
		{
			return Phpfox_Error::set('Please select a Category.');
		}

		foreach ($aVals['category'] as $iCategory)
		{		
			if (empty($iCategory))
			{
				continue;
			}
			
			if (!is_numeric($iCategory))
			{
				continue;
			}			
			
			$this->_aCategories[] = $iCategory;
		}
		
		if (!count($this->_aCategories))
		{
			return Phpfox_Error::set('Please select a Category.');
		}
		
		// Do not allow links in title
		if (!Phpfox::getLib('validator')->check($aVals['title'], array('url')))
		{
			return Phpfox_Error::set('Links in title not allowed');
		}
		
		$bHasAttachments = (!empty($aVals['attachment']));
		
		$sTitle = $oFilter->clean($aVals['title'], 255);
		
		$aInsert = array(
			'user_id' => (int) $iUserID,
			'title' => $sTitle,
			'title_url' => $oFilter->prepareTitle('article',$aVals['title'],'title_url',Phpfox::getUserId(),Phpfox::getT('article')),
			'is_published' => (int) $aVals['is_published'],
			'total_attachment' => ($bHasAttachments ? Phpfox::getService('attachment')->getCount($aVals['attachment']) : 0)
		);		
		
		if($iUpdateId) {
						
			if ($bHasAttachments)
				{
					Phpfox::getService('attachment.process')->updateItemId($aVals['attachment'], Phpfox::getUserId(), $iUpdateId);
				}			
			
			$iId=$this->database()->update($this->_sTable, $aInsert, 'article_id = ' . (int) $iUpdateId);
			$iId=$this->database()->update(Phpfox::getT('article_text'), array(
					'text' => $oFilter->clean($aVals['text']),
					'text_parsed' => $oFilter->prepare($aVals['text'])
					)
				, 'article_id = ' . (int) $iUpdateId);
				
			$this->database()->delete(Phpfox::getT('article_category_data'), 'article_id = ' . (int) $iUpdateId);
			
			foreach ($this->_aCategories as $iCategoryId)
			{
				$this->database()->insert(Phpfox::getT('article_category_data'), array('article_id' => $iUpdateId, 'category_id' => $iCategoryId));
			}				
				
		} else {

			$aInsert['time_stamp']= PHPFOX_TIME ;
			$iId = $this->database()->insert($this->_sTable, $aInsert);
			
			$this->database()->insert(Phpfox::getT('article_text'), array(
					'article_id' => $iId,
					'text' => $oFilter->clean($aVals['text']),
					'text_parsed' => $oFilter->prepare($aVals['text'])
				)
			);

			if ($bHasAttachments)
				{
					Phpfox::getService('attachment.process')->updateItemId($aVals['attachment'], Phpfox::getUserId(), $iId);
				}			

			foreach ($this->_aCategories as $iCategoryId)
			{
				$this->database()->insert(Phpfox::getT('article_category_data'), array('article_id' => $iId, 'category_id' => $iCategoryId));
			}
			
		}
						
		return $iId;		
	}

	public function update($iId, $iUserId, $aVals)
	{
		return $this->add($aVals, $iUserId, $iId);
	}

	public function addSection($aVals, $iUserID, $iUpdateId = null)
	{		
		
		$oFilter = Phpfox::getLib('parse.input');

		if (!isset($aVals['category']))
		{
			return Phpfox_Error::set('Please select a Category.');
		}

		foreach ($aVals['category'] as $iCategory)
		{		
			if (empty($iCategory))
			{
				continue;
			}
			
			if (!is_numeric($iCategory))
			{
				continue;
			}			
			
			$this->_aCategories[] = $iCategory;
		}
		
		if (!count($this->_aCategories))
		{
			return Phpfox_Error::set('Please select a Category.');
		}
		
		// Do not allow links in title
		if (!Phpfox::getLib('validator')->check($aVals['title'], array('url')))
		{
			return Phpfox_Error::set('Links in title not allowed');
		}
		
		$sTitle = $oFilter->clean($aVals['title'], 255);
		
		$aInsert = array(
			'article_id' => (int) $aVals['ai'],
			'user_id' => (int) $iUserID,
			'title' => $sTitle,
			'time_stamp' => PHPFOX_TIME,
			'parent_sec_id' => (int) $aVals['parent_sec_id']
		);		
		
		if($iUpdateId) {
			// start section update
			$iId=$this->database()->update(Phpfox::getT('article_section'), $aInsert, 'a_section_id = ' . (int) $iUpdateId);
			
			$aUSection = Phpfox::getService('article')->getSection($iUpdateId);
			
			$aInsertArticle = array(				
				'is_published' => (int) $aVals['is_published']								
			);		
			
			$iId=$this->database()->update($this->_sTable, $aInsertArticle, 'article_id = ' . (int) $aUSection['main_article']);
			$iId=$this->database()->update(Phpfox::getT('article_text'), array(
					'text' => $oFilter->clean($aVals['text']),
					'text_parsed' => $oFilter->prepare($aVals['text'])
					)
				, 'article_id = ' . (int) $aUSection['main_article']);
				
			$this->database()->delete(Phpfox::getT('article_category_data'), 'article_id = ' . (int) $aUSection['main_article']);
			
			foreach ($this->_aCategories as $iCategoryId)
			{
				$this->database()->insert(Phpfox::getT('article_category_data'), array('article_id' => $aUSection['main_article'], 'category_id' => $iCategoryId));
			}				
			
			// end update
			
		} else {
			$iId = $this->database()->insert(Phpfox::getT('article_section'), $aInsert);
			
			// Lets add to article
			$aInsertArticle = array(
				'user_id' => (int) $iUserID,
				'title' => $sTitle,
				'title_url' => $oFilter->prepareTitle('article',$aVals['title'],'title_url',Phpfox::getUserId(),Phpfox::getT('article')),
				'is_published' => (int) $aVals['is_published'],
				'time_stamp' => PHPFOX_TIME				
			);		
						
			$iArticleId = $this->database()->insert($this->_sTable, $aInsertArticle);
			
			$this->database()->update(Phpfox::getT('article_section'), array('main_article'=>$iArticleId), 'a_section_id = ' . (int) $iId);
			
			$this->database()->insert(Phpfox::getT('article_text'), array(
					'article_id' => $iArticleId,
					'text' => $oFilter->clean($aVals['text']),
					'text_parsed' => $oFilter->prepare($aVals['text'])
				)
			);
			
			foreach ($this->_aCategories as $iCategoryId)
			{
				$this->database()->insert(Phpfox::getT('article_category_data'), array('article_id' => $iArticleId, 'category_id' => $iCategoryId));
			}
			// end add article
		
		}
						
		return $iId;		
	}

	public function updateSection($iId, $iUserId, $aVals)
	{
		return $this->addSection($aVals, $iUserId, $iId);
	}	

	public function featureArticle($iId, $bFeatured = true)
	{
		$aRow = $this->database()->select('*')
			->from($this->_sTable)
			->where('article_id='.(int) $iId .' AND user_id='.(int) Phpfox::getUserId())
			->execute('getRow');
		
		if(isset($aRow['article_id'])){
			if($bFeatured){
				$this->database()->update($this->_sTable,array('is_featured' => 1), 'article_id = ' . (int) $aRow['article_id']);
				return true;
			} else {
				$this->database()->update($this->_sTable,array('is_featured' => 0), 'article_id = ' . (int) $aRow['article_id']);
				return true;
			}
		}
		
		return false;
	}
	
	public function deleteArticle($iId)
	{
		$aRow = $this->database()->select('*')
			->from($this->_sTable)
			->where('article_id='.(int) $iId .' AND user_id='.(int) Phpfox::getUserId())
			->execute('getRow');

		if(isset($aRow['article_id'])) {
		
		$aSections = $this->database()->select('*')
			->from(Phpfox::getT('article_section'))
			->where('article_id='.(int) $iId .' AND user_id='. (int) Phpfox::getUserId())
			->execute('getRows');

		$aMainSections = $this->database()->select('*')
			->from(Phpfox::getT('article_section'))
			->where('main_article='.(int) $iId .' AND user_id='. (int) Phpfox::getUserId())
			->execute('getRows');

			if(count($aSections)){
				foreach($aSections as $aSection){
					$this->database()->delete(Phpfox::getT('article_section'), 'a_section_id = ' . (int) $aSection['a_section_id']);		
				}
			}

			if(count($aMainSections)){
				foreach($aMainSections as $aMainSection){
					$this->database()->delete(Phpfox::getT('article_section'), 'a_section_id = ' . (int) $aMainSection['a_section_id']);		
				}
			}
			
			$this->database()->delete(Phpfox::getT('article_category_data'), 'article_id = ' . (int) $aRow['article_id']);			
			$this->database()->delete(Phpfox::getT('article_text'), 'article_id = ' . (int) $aRow['article_id']);
			$this->database()->delete($this->_sTable, 'article_id = ' . (int) $aRow['article_id']);

			return true;		
		} 
		else {
			return false;		
		}
		
	}
	
	public function removeSection($iId)
	{
		$aRow = $this->database()->select('*')
			->from(Phpfox::getT('article_section'))
			->where('user_id='.(int) Phpfox::getUserId().' AND a_section_id='.(int) $iId)
			->execute('getRow');

		if(isset($aRow['a_section_id'])){
			$this->database()->delete(Phpfox::getT('article_section'), 'a_section_id = ' . (int) $aRow['a_section_id']);
			return true;		
		} else {
			return false;
		}		
	}
	
	public function insertArticle($toArticle, $aVals)
	{
	
		$aInsert = array(
			'article_id' => (int) $toArticle,
			'user_id' => (int) Phpfox::getUserId(),
			'title' => $aVals['title'],
			'time_stamp' => PHPFOX_TIME,
			'main_article'=> (int) $aVals['article_id']
		);		
		
		$iId = $this->database()->insert(Phpfox::getT('article_section'), $aInsert);
		
		return $iId;
	}
	
	public function updateSectionOrder($iArticle, $aVals)
	{
		//$aArticles = Phpfox::getService('article')->getArticleSections($aArticle['article_id']);
		foreach($aVals as $aVal)
		{	
			$iId=$this->database()->update(Phpfox::getT('article_section'), array('ordering' => $aVal['ordering']), 'user_id='.(int) Phpfox::getUserId().' AND a_section_id = ' . (int) $aVal['secid']);	
		}
		
	}
	
}

?>