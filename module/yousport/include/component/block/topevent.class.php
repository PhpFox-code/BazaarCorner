<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined('PHPFOX') or exit('NO DICE!'); 
class Yousport_Component_Block_Topevent extends Phpfox_Component
{  
    public function process()
    {
        $aTopEvents = phpfox::getService('yousport')->getTopEvents(2);
        $aEvents = phpfox::getService('yousport')->getNewEvents(2); 
        
        $sLinkAll = 'event';
        $this->template()->assign('sLinkAll',$sLinkAll);
        $blk=Phpfox::getPhrase('yousport.events');
        $this->template()->assign('blk',$blk);
       
        $this->template()->assign(array(              
                'sHeader'=> Phpfox::getPhrase('yousport.events'),
                'aEvents'=>$aEvents,
                'aTopEvents'=>$aTopEvents
            )
        );     
        return 'block';
    }
}
?>
