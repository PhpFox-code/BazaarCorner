<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AdvancedMarketplace_Component_Block_Listing extends Phpfox_Component {

    public function process() 
    {     
        $aListings = $this->getParam('aListings', 1);
        $this->template()->assign(array(           
            'aListings' => $aListings,
        ));        
        return 'block';
    }
}
?>