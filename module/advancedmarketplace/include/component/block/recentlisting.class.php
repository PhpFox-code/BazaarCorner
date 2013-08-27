<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AdvancedMarketplace_Component_Block_RecentListing extends Phpfox_Component {

    public function process() 
    {    	
        $sText = $this->getParam('sText', '');
        $aConds[] = 'AND l.post_status != 2';
		$aConds[] = 'AND l.view_id = 0';
		$aConds[] = 'AND l.privacy = 0';
		$iPage = 1;        
		$iLimit = 10;        
        $sCategory = $this->getParam('sCategory', 0);
        $sCategories = Phpfox::getService("advancedmarketplace.category")->get(1);
        list($iTotal, $aListings) = PHPFOX::getService("advancedmarketplace")->getForHomepage($aConds, $sSortExp = 'l.time_stamp DESC', $iPage, $iLimit, $bIsHaveSearchTag = 0);
		$bIsDone = 0;
        if ($iPage * $iLimit >= $iTotal)
        {
            $bIsDone = 1;
        }		
		$this->template()->assign(array(
            'sHeader' => Phpfox::getPhrase('advancedmarketplace.recent_listing'),
            'corepath' => phpfox::getParam('core.path'),
            'sCategories' => $sCategories,
            'sCategory' => $sCategory,
            'aListings' => $aListings,
            'iTotal' => $iTotal,
            'sText' => $sText,
            'bIsDone' => $bIsDone,
            'advancedmarketplace_url_image' => Phpfox::getParam('core.url_pic') . "advancedmarketplace/",
        ));
        return 'block';
    }
}
?>