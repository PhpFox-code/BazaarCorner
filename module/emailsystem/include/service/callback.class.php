<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Service_Callback extends Phpfox_Service
{
	/**
	 * Class constructor
	 */
	public function __construct()
	{

	}

	/*public function getNotificationSettings()
	 {
		if (Phpfox::getUserParam('emailsystem.show_privacy'))
		{
		return array('emailsystem.can_receive_notification' => array(
		'phrase' => Phpfox::getPhrase('emailsystem.receive_emailsystem'),
		'default' => 1
		)
		);
		}
		} */

	public function getGlobalPrivacySettings()
	{
		return array(
			'blog.default_privacy_setting' => array(
				'phrase' => 'Email Systems'								
				)
				);
	}

	/**
	 * If a call is made to an unknown method attempt to connect
	 * it to a specific plug-in with the same name thus allowing
	 * plug-in developers the ability to extend classes.
	 *
	 * @param string $sMethod is the name of the method
	 * @param array $aArguments is the array of arguments of being passed
	 */
	public function __call($sMethod, $aArguments)
	{
		/**
		 * Check if such a plug-in exists and if it does call it.
		 */
		if ($sPlugin = Phpfox_Plugin::get('notification.service_callback__call'))
		{
			return eval($sPlugin);
		}
			
		/**
		 * No method or plug-in found we must throw a error.
		 */
		Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
	}
}

?>
