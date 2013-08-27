<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Yousport_Component_Block_Video extends Phpfox_Component
{
    public function process()
    {      
        $aNewVideos = Phpfox::getService('yousport')->getNewVideos(6);
        $aTopVideos = Phpfox::getService('yousport')->getTopVideos(6);
        
        $sLinkAll = 'video';
        $this->template()->assign('sLinkAll',$sLinkAll);
        $blk=Phpfox::getPhrase('yousport.video');
        $this->template()->assign('blk',$blk);
        
        
        $this->template()->assign(array(              
                'sHeader'=> Phpfox::getPhrase('yousport.video'),
                'aNewVideos' => $aNewVideos,
                'aTopVideos'=> $aTopVideos
            )
        );
        return 'block';
    }
}
?>
