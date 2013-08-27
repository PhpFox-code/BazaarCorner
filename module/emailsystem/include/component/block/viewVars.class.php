<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Block_ViewVars extends Phpfox_Component 
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{	
		 $lstVars = phpfox::getService('emailsystem.vars')->get();
         $editor= $this->getParam('idEditor');
         if($editor == null)
         {
             $editor = "template_content";
         }
         $this->template()->assign(
                array(
                    'lstVars' => $lstVars,
                    'editor' =>$editor,
                )
            );
	}
	
	
}

?>