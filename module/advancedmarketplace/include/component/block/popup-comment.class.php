<?php


defined('PHPFOX') or exit('NO DICE!');


class AdvancedMarketplace_Component_Block_Popup_Comment extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		$aListing = $this->getParam('aListing');
		$aFeed = $this->getParam('aFeed');
        $this->template()->assign(array(           
            'aListing' => $aListing,
            'aFeed' => $aFeed,
        ));        
        return 'block';
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('advancedmarketplace.component_block_photo_clean')) ? eval($sPlugin) : false);
	}
}

?>