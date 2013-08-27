<?php

defined('PHPFOX') or exit('NO DICE!');

class Article_Component_Block_Category extends Phpfox_Component
{
	public function process()
	{
		if (defined('PHPFOX_IS_USER_PROFILE'))
		{
			return false;
		}
		
		$sCategory = $this->getParam('sCategory');
		
		$aCategories = Phpfox::getService('article.category')->getForBrowse($sCategory);
		
		if (!is_array($aCategories))
		{
			return false;
		}
		
		if (!count($aCategories))
		{
			return false;
		}
		
		$aCallback = $this->getParam('aCallback', false);
		if ($aCallback !== false)
		{
			$sHomeUrl = '/' . $aCallback['url_home'][0] . '/' . implode('/', $aCallback['url_home'][1]) . '/article/';			
			foreach ($aCategories as $iKey => $aCategory)
			{				
				$aCategories[$iKey]['url'] = preg_replace('/^http:\/\/(.*?)\/article\/(.*?)$/i', 'http://\\1' . $sHomeUrl . '\\2', $aCategory['url']);
				if (isset($aCategory['sub']))
				{
					foreach ($aCategory['sub'] as $iSubKey => $aSubCategory)
					{
						$aCategories[$iKey]['sub'][$iSubKey]['url'] = preg_replace('/^http:\/\/(.*?)\/article\/(.*?)$/i', 'http://\\1' . $sHomeUrl . '\\2', $aSubCategory['url']);		
					}
				}
			}		
		}
		
		$this->template()->assign(array(
				'sHeader' => ($sCategory === null ? 'Categories' : 'Sub Categories'),
				'aCategories' => $aCategories,
				'sCategory' => $sCategory
			)
		);
		
		return 'block';		
	}
	
	public function clean()
	{

	}
}

?>