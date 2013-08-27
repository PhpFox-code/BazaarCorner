<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox_Service
 * @version 		$Id: emailsystem.class.php 1496 2010-03-05 17:15:05Z Raymond_Benc $
 */
class EmailSystem_Service_emailsystem extends Phpfox_Service
{
	/**
	 * Class constructor
	 */	 
	public function __construct()
	{	
		$this->_sTable = Phpfox::getT('emailsystem');
	}
    public function getNextRun()
    {
        $emailsystem = $this->database()->select('*')
                        ->from($this->_sTable)
                        ->order('time_stamp ASC,emailsystem_id DESC')
                        ->where('type_id = 1 OR type_id = 2')
                        ->limit(1)
                        ->execute('getRow');
        return $emailsystem;
    }
    public function setLastRun($emailsystem_id = null)
    {
        $this->database()->update(
                $this->_sTable,
                array(
                    'state' => 0,
                ),
                'state >0 AND state < 3'
                );
        if($emailsystem_id != null)
        {
            // 0 = not started; 1 = in progress; 2 = completed **  
            $this->database()->update(
                $this->_sTable,
                array(
                    'time_stamp'=>PHPFOX_TIME,
                    'state' => 1,
                ),
                'emailsystem_id = '.$emailsystem_id
                );
        }
        
    }
    public function getByType($type_id = 1)
    {
        if($type_id <=2)
        {
            $res = phpfox::getLib('phpfox.database')->select('*')
                ->from($this->_sTable)
                ->where('type_id = '.$type_id)
                ->execute('getRows');    
        }
        else
        {
            $res = phpfox::getLib('phpfox.database')->select('*')
                ->from($this->_sTable)
                ->where('type_id = '.$type_id)
                ->execute('getRow');
        }
        return $res;
        
    }
	/**
	 * Sanity check, this function checks for users pending their newsletter and newsletters still incomplete (in process)
	 * sets Phpfox_Error
	 */
	public function checkPending()
	{
		$aUsers = $this->database()->select('user_id')
			->from(Phpfox::getT('user_field'))
			->where('newsletter_state != 0')
			->execute('getSlaveRows');
		
		if (!empty($aUsers))
		{
			Phpfox_Error::set(Phpfox::getPhrase('emailsystem.there_are_users_still_missing_their_newsletter_total', array('total' => count($aUsers))));
			return Phpfox::getLib('url')->makeUrl('admincp.emailsystem.manage', array('task' => 'pending-users'));
		}

		$aNewsletters = $this->database()->select('emailsystem_id')
			->from($this->_sTable)
			->where('state = 1')
			->execute('getSlaveRows');
		if (!empty($aNewsletters))
		{
			Phpfox_Error::set(Phpfox::getPhrase('emailsystem.there_are_emailsystems_in_process_total', array('total' => count($aNewsletters))));
			return Phpfox::getLib('url')->makeUrl('admincp.emailsystem.manage', array('task' => 'pending-tasks'));
		}
	}	

	/**
	 *
	 */
    public function getByDuration($type = 0)
    {
       $aNewsletters = $this->database()->select('n.gender as gender_email,n.*, nt.*, ' . Phpfox::getUserField())
                ->from($this->_sTable, 'n')
                ->join(Phpfox::getT('user'), 'u', 'u.user_id = n.user_id')
                ->join(Phpfox::getT('emailsystem_text'), 'nt', 'nt.emailsystem_id = n.emailsystem_id')
                ->where('n.weekly_email = '.$type)
                ->order('time_stamp DESC')
                ->execute('getSlaveRows');
    }
	public function get($iId = null)
	{
		if (is_int($iId))
		{
			$this->database()->where('n.emailsystem_id = ' . (int)$iId);
		}  
		$aNewsletters = $this->database()->select('et.template_subject,n.gender as gender_email,n.*, nt.*, ' . Phpfox::getUserField())
			    ->from($this->_sTable, 'n')
			    ->join(Phpfox::getT('user'), 'u', 'u.user_id = n.user_id')
			    ->join(Phpfox::getT('emailsystem_text'), 'nt', 'nt.emailsystem_id = n.emailsystem_id')
                ->leftjoin(phpfox::getT('emailsystem_template'),'et','et.template_id = n.template_id')
			    ->order('time_stamp DESC')
			    ->execute('getSlaveRows');
       
		if ($iId !== null && !empty($aNewsletters))
		{
			return reset($aNewsletters);
		}
		return $aNewsletters;
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
		if ($sPlugin = Phpfox_Plugin::get('notification.service_notification__call'))
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