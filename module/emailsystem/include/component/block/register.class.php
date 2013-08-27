<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Block_Register extends Phpfox_Component 
{
    /**
     * Class process method wnich is used to execute this component.
     */
    
    public function process()
    {   
     
        $controller = phpfox::getLib('module')->getControllerName();
        
        if(phpfox::isUser())
        {
            return false;
        }
        $sHeader = Phpfox::getPhrase('emailsystem.subscribe_newsletter');
        if($controller == 'index-visitor')
        {
            $sHeader ="";
        }
        $this->template()->assign(
                array(
                    'sHeader' =>$sHeader,
                    'controller' =>$controller,
                )
            );
        phpfox::getLib('template')->setPhrase(array(                            
                        'emailsystem.please_enter_a_valid_email_address',
                        ))
            ;
         return 'block';
    }
    
    
}

?>