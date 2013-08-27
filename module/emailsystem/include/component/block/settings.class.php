<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Block_Settings extends Phpfox_Component 
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{	
         $user_id = null;
         $user_ems_settings = array();
         if(phpfox::isUser())
         {  
             $user_id = phpfox::getUserId();
             $user_ems_settings = phpfox::getService('emailsystem.settings')->get($user_id);
             
         }
         $lst_ems = phpfox::getService('emailsystem')->get();
         $emsSystems = phpfox::getLib('phpfox.database')->select('email_emailsystem_id')
                            ->from(phpfox::getT('emailsystem_email_delivery'))
                            ->where('user_id  = '.$user_id)
                            ->execute('getRows');
         $l = array();
         if(count($emsSystems)>0)
         {
             foreach($emsSystems as $k=>$v)
             {
                  $l[] = $v['email_emailsystem_id'];
             }
             
         }
         
         $sHeader = "";
         if(count($lst_ems) > 0)
         {
             $sHeader = "Email System Settings";
         }
         
         $this->template()->assign(
                array(
                    'user_ems_settings' => $user_ems_settings,
                    'lst_ems' => $lst_ems,
                    'sHeader' =>$sHeader,
                    'user_gender' => Phpfox::getUserBy("gender"),
                    'emsSystems' =>$l,
                )
            );
         return 'block';
	}
	
	
}

?>