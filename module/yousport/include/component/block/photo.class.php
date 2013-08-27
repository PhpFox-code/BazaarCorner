<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined('PHPFOX') or exit('NO DICE!'); 
class Yousport_Component_Block_Photo extends Phpfox_Component
{
    public function process()
    {       
        $aNewPhotos = Phpfox::getService('yousport')->getPhotos(4);
        $this->template()->assign('aNewPhotos',$aNewPhotos);       
        $this->template()->assign(array(
                'sHeader'=> '',
                'sCorePath'=>Phpfox::getParam('core.path'),
                'aNewPhotos' => $aNewPhotos
            )
        );
        return 'block'; 
    }
}

?>
