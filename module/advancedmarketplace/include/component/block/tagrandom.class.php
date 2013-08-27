<?php

defined('PHPFOX') or exit('NO DICE!');

class AdvancedMarketplace_Component_Block_Tagrandom extends Phpfox_Component
{
	public function process()
	{
		if(!phpfox::isModule('tag'))
		{
			return false;
		}
		$aRows = phpfox::getService('advancedmarketplace')->getTagCloudRandom();
		if(empty($aRows))
		{
			return false;
		}        
		$this->template()->assign(array(
            'aTags' => $aRows,
        ));
		return 'block';
	}
}
?>