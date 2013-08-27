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
 * @version 		$Id: process.class.php 2517 2011-04-11 10:28:23Z Miguel_Espinoza $
 */
class EmailSystem_Service_Process extends Phpfox_Service
{
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		$this->_sTable = Phpfox::getT('emailsystem');
	}
    public function update($aVals,$iUser)
    {
        $aForm = array(
            'subject' => array(
                'message' => Phpfox::getPhrase('emailsystem.add_a_subject'),
                'type' => 'string:required'
            ),
            'total' => array(
                'message' => Phpfox::getPhrase('emailsystem.how_many_users_to_contact_per_round'),
                'type' => 'int:required'
            ),
            'type_id' => array(
                'message' => Phpfox::getPhrase('emailsystem.please_choose_a_type_of_emailsystem'),
                'type' => 'int:required'
            ),
            'text' => array(
                'message' => Phpfox::getPhrase('emailsystem.you_need_to_write_a_message_to_send'),
                'type' => 'string:required'
            ),
            'emailsystem_name' => array(
                'message ' => "You need to write the name of emailsystem",
                'type'=>'string:required'
                
                
            )
        );
        
        $this->validator()->process($aForm, $aVals);
        
        if (!Phpfox_Error::isPassed())
        {
            return false;
        }
        $intVersion = (int)str_replace('.','',Phpfox::VERSION);
        if( $intVersion >= 210 )
        {
            Phpfox::getService('ban')->checkAutomaticBan($aVals['subject'] . ' ' . $aVals['text'] . ' ' . $aVals['txtPlain']);    
        }
        

        $iActive = $this->database()->select('COUNT(emailsystem_id)')
                    ->from($this->_sTable)
                    ->where('state = 1')
                    ->execute('getSlaveField');
        if (!isset($aVals['gender']))
        {
            $aVals['gender'] = 0;
        }
        
        // insert the values in the database
        $aInsert = array(
            'subject' => $this->preParse()->clean($aVals['subject']),
            'round' => 0,
            'emailsystem_name' => $this->preParse()->clean($aVals['emailsystem_name']),   
            //'state' => $iActive > 0 ? 0 : 1, // 0 = not started; 1 = in progress; 2 = completed **
            'age_from' => (int)$aVals['age_from'],
            'age_to' => (int)$aVals['age_to'],
            'type_id' => (int)$aVals['type_id'], // 1 = Internal ; 2 = External
            'country_iso' => $this->preParse()->clean($aVals['country_iso']),
            'gender' => (int)$aVals['gender'],
            'user_group_id' => '',
            'total' => (int)$aVals['total'],
            'user_id' => (int)$iUser,
            //'time_stamp' => Phpfox::getTime(),
            'archive' => (isset($aVals['archive'])) ? (int)$aVals['archive'] : 2, // 2 = delete, 1 = keep
            'privacy' => (isset($aVals['privacy'])) ? (int)$aVals['privacy'] : 2,
            'attachment_files' =>serialize($aVals['attachment_files']),
            'template_id' =>$aVals['template_id'],
            'weekly_email'=>$aVals['weekly_email'],
            'include_none_user' =>$aVals['include_non_user'], 
        );
        
        if (isset($aVals['is_user_group']) && $aVals['is_user_group'] == 2)
        {
            $aGroups = array();
            $aUserGroups = Phpfox::getService('user.group')->get();
            if (isset($aVals['user_group']))
            {
                foreach ($aUserGroups as $aUserGroup)
                {
                    if (in_array($aUserGroup['user_group_id'], $aVals['user_group']))
                    {
                        $aGroups[] = $aUserGroup['user_group_id'];
                    }
                }
            }
            $aInsert['user_group_id'] = (count($aGroups) ? serialize($aGroups) : null);
        }

        $iId = $this->database()->update($this->_sTable, $aInsert,'emailsystem_id = '.$aVals['emailsystem_id']);
        $aVals['text'] = str_replace("../../../",phpfox::getParam('core.path'),$aVals['text']);
        $aVals['text'] = str_replace("../../",phpfox::getParam('core.path'),$aVals['text']);

        $this->database()->update(Phpfox::getT('emailsystem_text'), array(
            'text_plain' => $this->preParse()->clean($aVals['txtPlain']),
            'text_html' => $aVals['text']),
            'emailsystem_id = '.$aVals['emailsystem_id']
            
        );
        
        $aInsert['emailsystem_id'] = $aVals['emailsystem_id'];
        $aInsert['update_st'] = true;
        $aInsert['round'] = 0;
        return $aInsert;
    }
	/**
	 * Adds a new job to send the newsletter, 
   	 * @param <type> $aVals
	 * @return Int Next round to process | false on error.
	 */
	public function add($aVals, $iUser)
	{
		// Check validations using the new method
		
		$aForm = array(
			'subject' => array(
				'message' => Phpfox::getPhrase('emailsystem.add_a_subject'),
				'type' => 'string:required'
			),
			'total' => array(
				'message' => Phpfox::getPhrase('emailsystem.how_many_users_to_contact_per_round'),
				'type' => 'int:required'
			),
			'type_id' => array(
				'message' => Phpfox::getPhrase('emailsystem.please_choose_a_type_of_emailsystem'),
				'type' => 'int:required'
			),
			'text' => array(
				'message' => Phpfox::getPhrase('emailsystem.you_need_to_write_a_message_to_send'),
				'type' => 'string:required'
			),
             'emailsystem_name' => array(
                'message' => "You need to write the name of email system.",
                'type'=>'string:required'
                
                
            )
		);
		
		$this->validator()->process($aForm, $aVals);
        
		if (!Phpfox_Error::isPassed())
		{
			return false;
		}
        $intVersion = (int)str_replace('.','',Phpfox::VERSION);
        if( $intVersion >= 210 )
        {
            Phpfox::getService('ban')->checkAutomaticBan($aVals['subject'] . ' ' . $aVals['text'] . ' ' . $aVals['txtPlain']);    
        }
		

		$iActive = $this->database()->select('COUNT(emailsystem_id)')
			->from($this->_sTable)
			->where('state = 1')
			->execute('getSlaveField');

		// insert the values in the database
		$aInsert = array(
            'subject' => $this->preParse()->clean($aVals['subject']),
			'emailsystem_name' => $this->preParse()->clean($aVals['emailsystem_name']),
			'round' => 0,
			'state' => $iActive > 0 ? 0 : 1, // 0 = not started; 1 = in progress; 2 = completed **
			'age_from' => (int)$aVals['age_from'],
			'age_to' => (int)$aVals['age_to'],
			'type_id' => (int)$aVals['type_id'], // 1 = Internal ; 2 = External
			'country_iso' => $this->preParse()->clean($aVals['country_iso']),
			'gender' => (int)$aVals['gender'],
			'user_group_id' => '',
			'total' => (int)$aVals['total'],
			'user_id' => (int)$iUser,
			'time_stamp' => Phpfox::getTime(),
			'archive' => (isset($aVals['archive'])) ? (int)$aVals['archive'] : 2, // 2 = delete, 1 = keep
			'privacy' => (isset($aVals['privacy'])) ? (int)$aVals['privacy'] : 2,
            'attachment_files' =>serialize($aVals['attachment_files']),
            'template_id' =>$aVals['template_id'],
            'weekly_email' =>$aVals['weekly_email'],
            'include_none_user' =>$aVals['include_non_user'],
		);
		
		if (isset($aVals['is_user_group']) && $aVals['is_user_group'] == 2)
		{
			$aGroups = array();
			$aUserGroups = Phpfox::getService('user.group')->get();
			if (isset($aVals['user_group']))
			{
				foreach ($aUserGroups as $aUserGroup)
				{
					if (in_array($aUserGroup['user_group_id'], $aVals['user_group']))
					{
						$aGroups[] = $aUserGroup['user_group_id'];
					}
				}
			}
			$aInsert['user_group_id'] = (count($aGroups) ? serialize($aGroups) : null);
		}

		// ** when we implement the cron job this is the place to set the state differently
		$iId = $this->database()->insert($this->_sTable, $aInsert);
        $aVals['text'] = str_replace("../../../",phpfox::getParam('core.path'),$aVals['text']);
        $aVals['text'] = str_replace("../../",phpfox::getParam('core.path'),$aVals['text']);
		$this->database()->insert(Phpfox::getT('emailsystem_text'), array(
			'emailsystem_id' => $iId,
			'text_plain' => $this->preParse()->clean($aVals['txtPlain']),
			'text_html' => $aVals['text'])
		);
		// store that we are processing a job
		$aInsert['emailsystem_id'] = $iId;
		$aInsert['round'] = 0;
		return $aInsert;
	}

	
	public function delete($iId)
	{
		/*if (!Phpfox::getUserParam('emailsystem.can_create_emailsystem'))
		{
			return false;
		}*/
		$iState = $this->database()->select('state')
		->from($this->_sTable)
		->where('emailsystem_id = ' . (int)$iId)
		->execute('getSlaveField');
		if ($iState == 1)
		{
			$this->database()->update(Phpfox::getT('user_field'), array('newsletter_state' => 0), 'newsletter_state != 0');
		}
		$this->database()->delete($this->_sTable, 'emailsystem_id = ' . (int)$iId);
		$this->database()->delete(Phpfox::getT('emailsystem_text'), 'emailsystem_id = ' . (int)$iId);
		return true;
	}
	
	
	public function __call($sMethod, $aArguments)
	{
		/**
		 * Check if such a plug-in exists and if it does call it.
		 */
		if ($sPlugin = Phpfox_Plugin::get('notification.service_process__call'))
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