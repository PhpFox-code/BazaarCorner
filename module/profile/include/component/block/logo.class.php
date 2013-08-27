<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * Profile Block Header
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Profile
 * @version 		$Id: logo.class.php 4296 2012-06-18 16:43:42Z Raymond_Benc $
 */
class Profile_Component_Block_Logo extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{	
		if (!defined('PHPFOX_IS_USER_PROFILE'))
		{
			return false;
		}
		
		$aUser = $this->getParam('aUser');
		
		if (empty($aUser['cover_photo']))
		{
			return false;
		}
		
		$aCoverPhoto = Phpfox::getService('photo')->getCoverPhoto($aUser['cover_photo']);
		
		if (!isset($aCoverPhoto['photo_id']))
		{
			return false;
		}
		
		if (!Phpfox::getService('user.privacy')->hasAccess($aUser['user_id'], 'profile.view_profile'))
		{
			return false;
		}		
		
		$this->template()->assign(array(
				'aCoverPhoto' => $aCoverPhoto,
				'bRefreshPhoto' => ($this->request()->getInt('coverupdate') ? true : false),
				'bNewCoverPhoto' => ($this->request()->getInt('newcoverphoto') ? true : false),
				'sLogoPosition' => $aUser['cover_photo_top'],
			)
		);
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('profile.component_block_logo_clean')) ? eval($sPlugin) : false);
	}
}

?>