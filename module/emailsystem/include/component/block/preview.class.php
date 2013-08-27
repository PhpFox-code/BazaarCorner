<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Block_Preview extends Phpfox_Component 
{
	
	public function process()
	{	
		 $template_id = $this->getParam('template_id');
         $template = phpfox::getService('emailsystem.mailtemplate')->get($template_id);
         $content = Phpfox::getLib('parse.output')->parse($template['template_content']);
         $this->template()->assign(
                array(
                    'template' => $template,
                    'content' =>$content,
                )
            );
	}
	
	
}

?>