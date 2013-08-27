<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Controller_Index extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		$aNewsletters = Phpfox::getService('newsletter')->get();
		$this->template()->assign(array(
				'aNewsletters' => $aNewsletters
			)
		);

		//$this->template()->setTemplate('blank');
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('notification.component_controller_index_clean')) ? eval($sPlugin) : false);
	}
}                                       

?>