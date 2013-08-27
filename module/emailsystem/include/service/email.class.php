<?php
/**
* [PHPFOX_HEADER]
*/

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Service_Email extends Phpfox_Service
{
    public function __construct()
    {
        $this->_sTable = Phpfox::getT('emailsystem_email_delivery');
    }
    public function getUserInQueue($emailsystem_id = null)
    {
        if($emailsystem_id == null)
        {
            $res = phpfox::getLib('phpfox.database')->select('*')
                    ->from($this->_sTable)
                    ->execute('getRows');
            return $res;
        }
         $res = phpfox::getLib('phpfox.database')->select('*')
                    ->from($this->_sTable)
                    ->where('email_emailsystem_id  = '.$emailsystem_id)
                    ->execute('getRows');
            return $res;
    }
    public function get($mail_id = null)
    {
        if($mail_id == null)
        {
            return null;
        }
        $res = phpfox::getLib('phpfox.database')->select('*')
                ->from($this->_sTable)
                ->where('email_delivery_id = '.$mail_id)
                ->execute('getRow');
        return $res;
    }
    public function add($aVals)
    {
        $iID  = phpfox::getLib('phpfox.database')->insert($this->_sTable,$aVals);
        return $iID;
    }
    public function multiAdd($aVals)
    {
        phpfox::getLib('phpfox.database')->multiInsert(
                $this->_sTable,
               
                array(
                    'email_delivery_status','email_emailsystem_id','email_emailsystem_order','time_sent','user_id','email'
                ),
                 $aVals    
            );
    }
    public function update($aVals,$email_id = null)
    {                                             
        if($email_id == null)
        {
            return false;
        }
        phpfox::getLib('phpfox.database')->update($this->_sTable,$aVals,'email_delivery_id = '.$email_id);                 
    }
    public function delete($email_id = null)
    {
        if($email_id !=  null)
        {
            $email_id = phpfox::getLib('phpfox.database')->escape($email_id);  
            phpfox::getLib('phpfox.database')->delete($this->_sTable,
                                    'email_delivery_id = "'.$email_id.'"'
                                    );
        }
    }
    public function getDeliveryByEmail($email = null)
    {
        if($email == null)
        {
            return false;
        }
        $email = $this->database()->escape($email);
        $res = $this->database()->select('*')
                    ->from($this->_sTable)
                    ->where('email = "'.$email.'"')
                    ->execute('getRow');
        return $res;
        
    }
    public function addExternalEmail($email = null)
    {
        if($email == null)
        {
            return false;
        }
        
        $emailsystem_lst = phpfox::getService('emailsystem')->get();
    
        if( count($emailsystem_lst) >0)
        {
            $multiInsert = array();
            foreach($emailsystem_lst as $key=>$ems)
            {
                if(($ems['type_id'] == 2 && $ems['include_none_user'] == 1)|| (count($emailsystem_lst) == 1))//external mail
                {
                    $multiInsert[] = array(
                            0,$ems['emailsystem_id'],PHPFOX_TIME+$key,'',0,$email
                        );    
                    
                }
                
            }
            if(count($multiInsert)>0)
            {
                phpfox::getService('emailsystem.email')->multiAdd($multiInsert);    
            }
            
        }
    }
    public function getExternalEmails($emailsystem_id = null)
    {
        if($emailsystem_id == null)
        {
            $res = $this->database()->select('email')
                    ->from($this->_sTable)
                    ->where('user_id = 0')
                    ->execute('getRows');
            return $res;
        }
        $res = $this->database()->select('email')
                    ->from($this->_sTable)
                    ->where('email_emailsystem_id = "'.$emailsystem_id.'"')
                    ->execute('getRows');
        return $res;
    }
    public function updateRegisterSettings($user_id)
    {
        if(!$user_id || $user_id <=0)
        {
            return false;
        }
        $user = $this->database()->select('*')
                ->from(phpfox::getT('user'))
                ->where('user_id = '.$user_id)
                ->execute('getRow');
        if(!$user)
        {
            return false;
        }
        $this->database()->update($this->_sTable,array('user_id' =>$user_id),'email = "'.$user['email'].'"');
        $mails =  $this->database()->select('m.*')
                    ->from($this->_sTable,'m')
                    //->leftjoin(phpfox::getT('emailsystem'),'emailsystem','emailsystem.emailsystem_id = m.email_emailsystem_id')//
                    ->where('m.email = "'.$user['email'].'"')
                    ->execute('getRows');
        
	 $array = array('ot2');

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
		
        foreach($lst_ems as $ems)
        {
            if (($ems['weekly_email'] != 0  &&  ($user['gender']==$ems['gender_email'] || $ems['gender_email']==0))|| ($ems['type_id'] >=3))
            {
                $array[]=$ems['emailsystem_id'];
            }
        }
		
        if(count($mails))
         {
             foreach($mails as $key=>$e)
             {
                 $array[] = $e['email_emailsystem_id'];
                 
             }
             
         }
         $emsettings['emailsystem_list'] = serialize($array);
         $emsettings['receiver_id'] = $user['user_id'];
         $emsettings['is_receiver_email'] = 1;
         phpfox::getService('emailsystem.settings')->add($emsettings,$user['user_id']); 
                
    }
    public function multiAddExternalEmails($emailsystem_id = null)
    {
        $emailsystems = phpfox::getService('emailsystem')->get();  
        $emailExternal = array();                                                       
        if(count($emailsystems)>0)
         {
             foreach($emailsystems as $ems)
             {
                //delivery mail from fitter
                if($ems['type_id'] !=0 )
                {    
                    $lst = phpfox::getService('emailsystem.email')->getUserInQueue($ems['emailsystem_id']);
                    $userInQueue = array();
                    
                    if(count($lst) >0)
                    {
                        foreach($lst as $ur)
                        {
                            if( $ur['user_id'] == 0)
                            {
                                if(isset($emailExternal[$ur['email']]))
                                {
                                    $emailExternal[$ur['email']][] = $ems['emailsystem_id'];
                                }
                                else
                                {
                                    $emailExternal[$ur['email']] = array($ems['emailsystem_id']);
                                }
                            }
                        }
                    }
                     
 
                }
              
                //end
             }
             
             if(count($emailExternal) > 0)
             {
                 
                 $multiInsert = array();
                 foreach($emailExternal as $key=>$user)
                 {
                     foreach($emailsystems as $ems)
                     {
                        srand(PHPFOX_TIME);
                        if(!in_array($ems['emailsystem_id'],$user) && $ems['emailsystem_id'] == $emailsystem_id) 
                        {
                             $multiInsert[] = array(
                                0,$ems['emailsystem_id'],PHPFOX_TIME+rand(),'',0,$key
                                );
                        }
                       
                     }
                    
                 }
                 if(count($multiInsert) >0 )
                 {
                     phpfox::getService('emailsystem.email')->multiAdd($multiInsert);  
                     
                 }
                 
             }
         }
    }
    
}