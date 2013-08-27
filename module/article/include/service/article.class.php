<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * Author		Teamwurkz Technologies Inc.
 * package		phpfox article module 
 */
class Article_Service_Article extends Phpfox_Service 
{

	public function __construct()
	{	
		$this->_sTable = Phpfox::getT('article');	
	}

	public function get($sCond='',$iPage = '', $iPageSize = '', $sOrder = '', $bCategory=false)
	{
				
		if($bCategory){
			$iCnt = $this->database()->select('COUNT(a.article_id)')
				->from($this->_sTable, 'a')
				->join(Phpfox::getT('article_category_data'), 'acd', 'acd.article_id = a.article_id')
				->join(Phpfox::getT('article_category'), 'ac', 'ac.category_id = acd.category_id')									
				->where($sCond)
				->execute('getSlaveField');
		
			$aRows = $this->database()->select('a.*, att.destination, att.server_id, att.is_image, at.text, at.text_parsed,'.Phpfox::getUserField())
				->from($this->_sTable, 'a')
				->join(Phpfox::getT('article_text'),'at','at.article_id=a.article_id')
				->join(Phpfox::getT('article_category_data'), 'acd', 'acd.article_id = a.article_id')
				->join(Phpfox::getT('article_category'), 'ac', 'ac.category_id = acd.category_id')
				->join(Phpfox::getT('user'),'u','u.user_id=a.user_id')
				->leftJoin(Phpfox::getT('attachment'),'att','att.item_id=a.article_id')
				->where($sCond)
				->group('a.article_id')
				->limit($iPage, $iPageSize, $iCnt)
				->order($sOrder)
				->execute('getRows');
		} else {
		$iCnt = $this->database()->select('COUNT(a.article_id)')
			->from($this->_sTable, 'a')
			->where($sCond)
			->execute('getSlaveField');
		
		$aRows = $this->database()->select('a.*, att.destination, att.server_id, att.is_image, at.text, at.text_parsed,'.Phpfox::getUserField())
			->from($this->_sTable, 'a')
			->join(Phpfox::getT('article_text'),'at','at.article_id=a.article_id')
			->join(Phpfox::getT('user'),'u','u.user_id=a.user_id')
			->leftJoin(Phpfox::getT('attachment'),'att','att.item_id=a.article_id')
			->group('a.article_id')
			->where($sCond)
			->limit($iPage, $iPageSize, $iCnt)
			->order($sOrder)
			->execute('getRows');
		
		}
		
		return array($iCnt, $aRows);
		
	}
	
	public function getArticle($iId)
	{
		$aRow = $this->database()->select('a.*, at.text')
			->from($this->_sTable, 'a')
			->join(Phpfox::getT('article_text'),'at','at.article_id=a.article_id')			
			->where('a.article_id='.(int) $iId .' AND user_id='.(int) Phpfox::getUserId())
			->execute('getRow');

		$aRow['categories'] = Phpfox::getService('article.category')->getCategoryIds($aRow['article_id']);
						
		return $aRow;		
	}

	public function getArticleTitle($iId)
	{
		$aRow = $this->database()->select('a.*')
			->from($this->_sTable, 'a')
			->where('a.article_id='.(int) $iId .' AND user_id='.(int) Phpfox::getUserId())
			->execute('getRow');
		
		return $aRow;		
	}

	public function getFeaturedArticles($iLimit = 3)
	{
		$aRows = $this->database()->select('a.*, at.text_parsed, '. Phpfox::getUserField())
			->from($this->_sTable, 'a')
			->join(Phpfox::getT('article_text'),'at','at.article_id=a.article_id')
			->join(Phpfox::getT('user'),'u','u.user_id=a.user_id')
			->where('a.is_featured=1')
			->limit($iLimit)
			->order('a.time_stamp DESC')
			->execute('getRows');
		
		return $aRows;		
	}

	public function getArticleView($sTitle)
	{
		$aRow = $this->database()->select('a.*, at.text, at.text_parsed,ac.name, ac.name_url,'.Phpfox::getUserField() )
			->from($this->_sTable, 'a')
			->join(Phpfox::getT('article_text'),'at','at.article_id=a.article_id')
			->join(Phpfox::getT('article_category_data'), 'acd', 'acd.article_id = a.article_id')
			->join(Phpfox::getT('article_category'), 'ac', 'ac.category_id = acd.category_id')			
			->join(Phpfox::getT('user'),'u','u.user_id=a.user_id')
			->where('a.title_url=\''.$this->database()->escape($sTitle).'\'')
			->execute('getRow');
		
		if(isset($aRow['article_id']) && $aRow['is_published']==0 && $aRow['user_id']!=Phpfox::getUserId()) {
			unset($aRow);
		}
		
		return $aRow;		
	}
	
	public function getSection($iId)
	{
		$aRow = $this->database()->select('s.a_section_id, s.title, s.user_id, s.article_id, s.parent_sec_id, s.main_article, at.text, a.is_published')
			->from(Phpfox::getT('article_section'),'s')
			->join(Phpfox::getT('article'),'a','a.article_id=s.main_article')
			->join(Phpfox::getT('article_text'),'at','at.article_id=s.main_article')
			->where('s.user_id='.(int) Phpfox::getUserId().' AND s.a_section_id='.(int) $iId)
			->execute('getRow');
			
			$aRow['categories'] = Phpfox::getService('article.category')->getCategoryIds($aRow['main_article']);
		
		return $aRow;		
	}

	public function getArticleSections($iId)
	{
		$aRows = $this->database()->select('s.a_section_id, s.title, s.user_id, s.article_id, s.parent_sec_id, s.ordering, at.text_parsed, a.is_published, a.title AS atitle, a.title_url AS atitleurl')
			->from(Phpfox::getT('article_section'),'s')
			->join(Phpfox::getT('article'),'a','a.article_id=s.main_article')
			->join(Phpfox::getT('article_text'),'at','at.article_id=s.main_article')
			->where('s.article_id='.(int) $iId)
			->order('s.ordering ASC')
			->execute('getRows');
		
		return $aRows;		
	}


}

?>