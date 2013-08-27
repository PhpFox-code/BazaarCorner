<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Block_registervistorpage extends Phpfox_Component 
{
    /**
     * Class process method wnich is used to execute this component.
     */
    
    public function process()
    {   
     
        //$controller = phpfox::getLib('module')->getControllerName();
        if(phpfox::isUser())
        {
            return false;
        }
        $sHeader ="";
        
        $this->template()->assign(
                array(
                    'sHeader' =>$sHeader,
                )
            );
        return 'block';
    }
    
    
}

?>