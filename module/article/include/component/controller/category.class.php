<?php

defined('PHPFOX') or exit('NO DICE!');

class Article_Component_Controller_Category extends Phpfox_Component
{

	public function process()
	{
		
		$sCategory='';
		
		// Set category
		$sCategory = null;
		$aCacheCategories = array();
		$iRequestCount = 0;
		$sView = $this->request()->get('view', false);
		$aCallback = $this->getParam('aCallback', false);	
		$sCategoryUrl = '';			

		$aRequests = $this->request()->getRequests();			
		foreach ($aRequests as $sKey => $sValue)
		{			
			if (!preg_match("/req[0-9]/", $sKey))
			{
				continue;
			}
			
			$iRequestCount++;
			
			$aCacheCategories[] = $sValue;
			
			$this->url()->setParam($sKey, $sValue);
			
			if ($aCallback !== false)
			{
				if ($iRequestCount > $aCallback['category_request'])
				{
					$sCategory = $sValue;
					$sCategoryUrl .= '.' . $sValue;
				}
			}
			else 
			{
				if ($sKey != 'req1')
				{
					$sCategory = $sValue;
					$sCategoryUrl .= '.' . $sValue;
				}
			}
		}		

		$this->setParam('sCategory', $sCategory);		
		 
		// End set category url

		$iPage = $this->request()->getInt('page');
		$iPageSize = 10;
		$sOrder = 'a.time_stamp DESC';
		$sCond='a.is_published=1';
		$sBreadCrumb='Articles';

		if ($sCategory)
			{
				$sCond.=' AND ac.name_url =\''.Phpfox::getLib('database')->escape($sCategory).'\'';			
			}
		
		list($iCnt, $aArticles) = Phpfox::getService('article')->get($sCond, $iPage, $iPageSize,$sOrder,true);
		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));
		
			$this->template()->setTitle('Articles')
				->setBreadcrumb($sBreadCrumb,$this->url()->makeUrl('article'))
				->setHeader('cache', array(
						'pager.css' => 'style_css'						
					)			
				)
				->assign(array(					
					'aArticles' => $aArticles,
					'sCategoryUrl' => $sCategoryUrl,
					'sParentLink' => ($aCallback !== false ? $aCallback['url_home'][0] . '.' . implode('.', $aCallback['url_home'][1]) . '.article' : 'article')					
				)
			);						

		// Category breadcrumb
		if ($sCategory !== null)
		{
			$aCategories = Phpfox::getService('article.category')->getParentBreadcrumb($sCategory);			
			$iCnt = 0;
			foreach ($aCategories as $aCategory)
			{
				$iCnt++;
				
				$this->template()->setTitle($aCategory[0]);
				
				if ($aCallback !== false)
				{
					$sHomeUrl = '/' . $aCallback['url_home'][0] . '/' . implode('/', $aCallback['url_home'][1]) . '/article/';	
					$aCategory[1] = preg_replace('/^http:\/\/(.*?)\/article\/(.*?)$/i', 'http://\\1' . $sHomeUrl . '\\2', $aCategory[1]);						
				}
				
				$this->template()->setBreadcrumb($aCategory[0], $aCategory[1], ($iCnt === count($aCategories) ? true : false));
			}			
		}
		
			if ($aCallback !== false)
			{
				$this->template()->rebuildMenu('article.index', $aCallback['url_home']);			
			}
			// End category breadcrumb
			
	}
	
}

?>