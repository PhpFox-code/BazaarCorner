<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * Author		Teamwurkz Technologies Inc.
 * package		phpfox article module 
 */
 
class Article_Component_Controller_Index extends Phpfox_Component
{	
	public function process()
	{
		
		$aArticles = Phpfox::getService('article')->get();
		$sMy = $this->request()->get('req2');
		$iATO = 0;
		$sCategory='';
		$aCallback = $this->getParam('aCallback', false);
		
		if($sMy=='my') {
			$sCond='a.user_id='.(int) Phpfox::getUserId();			
			$iATO = $this->request()->getInt('ato');
			$sBreadCrumb='My Articles';			
		} else {
			$sCond='a.is_published=1';
			$sBreadCrumb='Articles';
		}

		// Start filter

		$aFilters = array(
			'keyword' => array(
				'type' => 'input:text',
				'size' => 30,
				'search' => ' AND (at.text LIKE \'%[VALUE]%\' OR a.title LIKE \'%[VALUE]%\')'
			)
		);
		
		$oFilter = Phpfox::getLib('search')
			->set(array(
				'type' => 'browse',
				'filters' => $aFilters,
				'search' => 'keyword',
				'prepare' => false
			)
		);			
		// End filter		

		// Apply filter		
		if(count($oFilter->getConditions())) 
			{ 
				$aFilterRows = $oFilter->getConditions();
				foreach ($aFilterRows as $iKey => $aFilterCond)
				{
					$sCond.= $aFilterCond;
				}
				
			}
				
		$iPage = $this->request()->getInt('page');
		$iPageSize = 10;
		$sOrder = 'a.time_stamp DESC';
		
		list($iCnt, $aArticles) = Phpfox::getService('article')->get($sCond, $iPage, $iPageSize,$sOrder,false);
		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));
		
			$this->template()->setTitle('Articles')
				->setBreadcrumb($sBreadCrumb,$this->url()->makeUrl('article').($sMy=='my' ? 'my':''))
				->setHeader('cache', array(
						'pager.css' => 'style_css'						
					)			
				)
				->assign(array(					
					'aArticles' => $aArticles,
					'iATO'=> (int) $iATO,
					'sParentLink' => ($aCallback !== false ? $aCallback['url_home'][0] . '.' . implode('.', $aCallback['url_home'][1]) . '.article' : 'article')
				)
			);						
				
	}
}

?>