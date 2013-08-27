<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Service_Cron extends Phpfox_Service
{
     
     public function FilterMail($emailsystem = array(),$notInList = array())
     {
         
       
        if (!isset($emailsystem['text_plain']))
        {
            $emailsystem['text_plain'] = null;
        }
        $sSelect = Phpfox::getUserField() . ', un.user_id as notification, u.email, u.language_id';
        $sWhere = 'uf.newsletter_state = 0'; // 0 = no newsletter ever sent, 1 last newsletter sent
        // filter the audience
        if (isset($emailsystem['age_from']) && $emailsystem['age_from'] > 0)
        {
            $iFromDate = PHPFOX_TIME  - (31556926 * $emailsystem['age_from']);
            $sWhere .= ' AND u.birthday_search < ' . $iFromDate;
        }
        if (isset($emailsystem['age_to']) && $emailsystem['age_to'] > 0)
        {
            $iToDate = PHPFOX_TIME - (31556926 * $emailsystem['age_to']);
            $sWhere .= ' AND u.birthday_search > ' . $iToDate;
        }
        if (isset($emailsystem['country_iso']) && $emailsystem['country_iso'] != '')
        {
            $sWhere .= ' AND u.country_iso = \'' . $emailsystem['country_iso'] . '\''; // no extra checks here since it either comes directly from DB
        }
        if (isset($emailsystem['gender']) && $emailsystem['gender'] > 0)
        {
            $sWhere .= ' AND u.gender = ' . (int)$emailsystem['gender'];
        }
        if (!empty($emailsystem['user_group_id']))
        {
            $aUserGroups = unserialize($emailsystem['user_group_id']);
            
            $sWhere .= ' AND u.user_group_id IN(' . implode(',', $aUserGroups) . ')';
        }
        
        if( isset($notInList) && count($notInList) >0 )
        {
            $sWhere.=' AND u.user_id NOT IN(' . implode(',', $notInList) . ')';
        }
        
        $aUsers = $this->database()->select($sSelect)
                        ->from(Phpfox::getT('user'), 'u')
                        ->join(Phpfox::getT('user_field'), 'uf', 'uf.user_id = u.user_id')
                        ->limit((int)$emailsystem['total'])
                        ->leftjoin(Phpfox::getT('user_notification'), 'un', 'un.user_id = u.user_id')
                        ->group('u.user_id')
                        ->where($sWhere)
                        ->execute('getSlaveRows');
       
        return $aUsers;           
     }
     public function sendMail($emailsystem_id = null,$limit = 10,$send_now = false)
     {
         //$v = phpfox::getLib('template.cache')->parse($test);
         $where = "";
         if($emailsystem_id != null)
         {
             $where = ' AND email_emailsystem_id = '.$emailsystem_id;
         }
         //$limit = 10;
         
         $mails = $this->database()->select('*,md.user_id as receiver_id')
                        ->from(phpfox::getT('emailsystem_email_delivery'),'md')
                        //->join(phpfox::getT('user'),'u','u.user_id = md.user_id')
                        ->join(phpfox::getT('emailsystem'),'em','em.emailsystem_id = md.email_emailsystem_id AND (em.type_id =1 OR em.type_id = 2)')
                        ->join(phpfox::getT('emailsystem_text'),'emtext','emtext.emailsystem_id = md.email_emailsystem_id')
                        ->leftJoin(phpfox::getT('emailsystem_template'),'emt','emt.template_id = em.template_id')
                        ->where('1 = 1 '.$where)
                        ->order('md.time_sent ASC, md.email_delivery_status ASC')
                        ->limit($limit)
                        ->execute('getSlaveRows');
         /*Phpfox::getLib('mail')->to("nghiacr002@gmail.com")
                                         ->subject("mail")
                                         ->message(print_r($mails,true))
                                         ->fromName(Phpfox::getParam('core.mail_from_name'))  
                                         ->send();*/
         
         $mailservice =  phpfox::getService('emailsystem.email');
         $tracking =   phpfox::getService('emailsystem.tracking');
         $replaceList = phpfox::getService('emailsystem.vars')->get();
         
         foreach($mails as $mail)
         {
             
              $params['user_id']   = $mail['receiver_id'];
              $is_sent = false;
              switch($mail['weekly_email'])
              {
                  case 1://daily
                        $time = 24*60*60;
			//$time = 5*60;
                        
                        break;
                  case 2://weekly
			$time = 7*24*60*60;
			//$time = 2*5*60;
                        
                        break;
                  case 3://monthly
                         $time = 30*7*24*60*60;        
			//$time = 3*5*60;
                        break;
                  case 0:
                  default:
                        $time = 0;
                        break;
                  
              }
              if( $time != 0 && (PHPFOX_TIME - $mail['time_sent'] > $time ) )
              {
                   $is_sent = true;
              }
              if($time == 0 && $mail['email_delivery_status'] == 0)
              {
                   $is_sent = true;
              }
              $usersettings = phpfox::getService('emailsystem.settings')->get($mail['receiver_id']);
              
              if($usersettings && $mail['privacy'] != 1 )
              {
                    if($usersettings['is_receiver_email'] == 1 && !in_array('ot2',$usersettings['emailsystem_list']) && $mail['weekly_email'] == 0 )
                    {
                        
                         continue;
                    }
                    if($usersettings['is_receiver_email'] == 0 && $mail['privacy'] != 1 )
                    {
                       
                        continue;
                    }
                    if($usersettings['is_receiver_email'] == 1 && !in_array($mail['email_emailsystem_id'],$usersettings['emailsystem_list']) && $mail['weekly_email'] !=0)
                    {
                       
                        continue;
                    }
              }
              if($send_now == true)
              {
                 $is_sent = true; 
              }
		
              if($is_sent == true)
              {
                  try{
                      //if($mail['template_id']>0)
                      //{
                      //    $mail['template_content'] = $this->parseHTML($mail['template_content']);
                      //    $message = $tracking->generateMail($mail['template_content'],$replaceList,$mail['email_delivery_id'],$params);    
                      //}
                      //else
                      //{
                          $mail['text_html'] = $this->parseHTML($mail['text_html']);
                          
                          $message = $tracking->generateMail($mail['text_html'],$replaceList,$mail['email_delivery_id'],$params);
                         
           
                      //}
                      
                      $attachfiles = unserialize($mail['attachment_files']);
                      $htmlattfiles = $tracking->generateAttachFiles($attachfiles);
                      $message = $message.$htmlattfiles;    
                      $mail['text_html'] = $message;
                      $subject = "";
                      if (!isset($mail['subject']) || $mail['subject'] == "")
                      {
                          $subject = 'You have the mail from '.Phpfox::getParam('core.mail_from_name');
                      }
                      else
                      {
                          $is_subject = true;
                          $subject =  $tracking->generateMail($mail['subject'],$replaceList,$mail['email_delivery_id'],$params,$is_subject);
                      }
                      $mail['subject'] = $subject;
                      //$usersettings = Phpfox::getService('user.privacy.privacy')->getUserSettings($mail['receiver_id']);
                      //$notification = true;
                      //if(isset($usersettings['notification']['emailsystem.can_receive_notification']) && $aNewsletterInfo['privacy'] != 1  ) 
                      //{
                      //    continue;
                      //}
                  }catch(Exception $ex)
                  {
                      //do nothing
                      //continue;
                  }
                        
                  
                  if($mail['type_id'] == 2)
                  {
                        $message = $this->parse($message);
                        
                        /*if( count($attachfiles) > 0)
                        {
                              if (!file_exists(PHPFOX_DIR_LIB . 'phpmailer' . PHPFOX_DS . 'class.phpmailer.php'))
                              {
                                return Phpfox_Error::trigger('Unable to load lib: ' . PHPFOX_DIR_LIB . 'phpmailer' . PHPFOX_DS . 'class.phpmailer.php', E_USER_ERROR);
                              }
                              require_once(PHPFOX_DIR_LIB . 'phpmailer' . PHPFOX_DS . 'class.phpmailer.php');
                              $provider = new PHPMailer; 
                              
                        } 
                        else*/
                        $mailservice->update(array('email_delivery_status'=>2,'time_sent'=>PHPFOX_TIME),$mail['email_delivery_id']);    
                        {
                            try{
                                Phpfox::getLib('mail')->to($mail['email'])
                                         ->subject($subject)
                                         ->message($message)
                                         ->messagePlain(strip_tags($message))
                                         ->fromName(Phpfox::getParam('core.mail_from_name'))  
                                         ->send();
                               
                             }
                             catch(Exception $e)
                             {
                                //do nothing                                
                             }
                        }
                       
                       
                  }
                  elseif( $mail['type_id']== 1 )//internalmail
                  {
                        $mailservice->update(array('email_delivery_status'=>2,'time_sent'=>PHPFOX_TIME),$mail['email_delivery_id']);      
                        $this->sendInternal($mail);
                        
                  }
                  
              }
              
              
         }
     }
     public function parseHTML($sTxt)
     {
         $oFilterBbcode = Phpfox::getLib('parse.bbcode');
         $sTxt = $oFilterBbcode->preParse($sTxt);
         $sTxt = $oFilterBbcode->parse($sTxt);
         return $sTxt;
     }
     public function parse($sTxt)
     {
         $oFilterBbcode = Phpfox::getLib('parse.bbcode');
         $sTxt = Phpfox::getService('emoticon')->parse($sTxt);
         $sTxt = $oFilterBbcode->preParse($sTxt);
         $sTxt = str_replace("\n", "", $sTxt);
         $sTxt = str_replace("\n\r", "", $sTxt);
         $sTxt = str_replace("\r", "", $sTxt);
         //$sTxt = preg_replace('/<(.*?)>/ise', "'<'. stripslashes(str_replace('[br]', '', '\\1')) .'>'", $sTxt);
         //$sTxt = str_replace("[br]", "<br />", $sTxt);
         // Parse BBCode
         $sTxt = $oFilterBbcode->parse($sTxt);            
         $sTxt = Phpfox::getService('ban.word')->clean($sTxt);
         //$sTxt = Phpfox::getLib('parse.format')->validXhtml($sTxt);   
         $sTxt = phpfox::getLib('phpfox.parse.output')->parse($sTxt);
         return $sTxt;
     }
     public function sendInternal($aVals)
     {      
        if($aVals['receiver_id']<=0)
        {
            return;
        }
        $oFilter = Phpfox::getLib('parse.input');
        $aVals['subject'] = (isset($aVals['subject']) ? $oFilter->clean($aVals['subject'], 255) : null);
        
        $aInsert = array(
            'parent_id' => 0,
            'subject' => $aVals['subject'],
            'preview' => $oFilter->clean($aVals['text_html'], 255),
            'owner_user_id' => 0,
            'viewer_user_id' => $aVals['receiver_id'],
            'viewer_is_new' => 1,
            'time_stamp' => PHPFOX_TIME,
            'time_updated' => PHPFOX_TIME,
            'total_attachment' => 0,
        );

        $iId = $this->database()->insert(Phpfox::getT('mail'), $aInsert);
        
        $this->database()->insert(Phpfox::getT('mail_text'), array(
                'mail_id' => $iId,
                'text' => $oFilter->clean($aVals['text_html']),
                'text_parsed' => $oFilter->prepare($aVals['text_html'])
            )
        );
        
        // Send the user an email
        $sLink = Phpfox::getLib('url')->makeUrl('mail.view', array('id' => $iId));
        Phpfox::getLib('mail')->to($aVals['receiver_id'])
            ->subject(array('emailsystem.site_emailsystem_title', array('title' => $aVals['subject'])))
            ->message(array('emailsystem.you_have_received_a_emailsystem_from_title', array(
                        'title' => Phpfox::getParam('core.site_title'),
                        'link' => $sLink
                    )
                )
            )
            ->notification('mail.new_message')
            ->send();
            
        //(Phpfox::isModule('request') ? Phpfox::getService('request.process')->add('mail_send', $iId, $aVals['user_id']) : null);
        if (Phpfox::isModule('notification'))
        {
            Phpfox::getService('notification.process')->add('mail_send', $iId, $aVals['receiver_id'], 0);
        }
     }
     /** make auto send notification for modules**/
     public function cronNotifications()    
     {
         
         $nfs = phpfox::getService('emailsystem.notifications')->get();
                   
         if(count($nfs)>0)
         {
             foreach($nfs as $key=>$nf)
             {
                 if($nf['is_active_nf'] == 1)
                 {
                     
                      $params = unserialize($nf['params']);
                      
                      $nf['function'] = base64_decode($nf['function']);
                     
                      @eval($nf['function']);    
                 }
                 
             }
         }
     }
     private function _typeNotification($type = 3)
     {
         switch($type)
         {
             case 1:
                break;
             case 2:
                break;
             case 3://event
                return 'Event';
             case 4 ://blog
                return 'Blog';
             case 5 ://for the next
                break;
             default :
                return "";
             
         }
         return "";
     }
     
     public function sendNotifications($nf =array(),$params = array())
     {
         $type = $this->_typeNotification($nf['notifications_type']);
         $func = "cron".$type."NotificationCheck";
         
         if(method_exists('EmailSystem_Service_Cron',$func))
         {
                         
              $resultcheck = call_user_func_array(array($this,$func),array($params));
                       

              if($resultcheck == false)
              {
                    
                    return false;
              }    
         }
       
         $emailsystem = phpfox::getService('emailsystem')->getByType($nf['notifications_type']);
         $mailservice =  phpfox::getService('emailsystem.email');
         $tracking =   phpfox::getService('emailsystem.tracking');
         $replaceList = phpfox::getService('emailsystem.vars')->get();
         $limit1 = phpfox::getParam('emailsystem.x_mail_per_round');
                
         if(!isset($params['limit_sending']))
         {
             $params['limit_sending'] = 10;
         }
         if(isset($limit1) && $limit1 >0)
         {
             $params['limit_sending']  = $limit1;
         }
         if($emailsystem)
         {
             $where = "";
             $where = ' AND email_emailsystem_id = '.$emailsystem['emailsystem_id'];
             $where .= ' AND (email_delivery_status >=0 AND email_delivery_status < 2) AND md.user_id >0';
             $mails = $this->database()->select('*,md.user_id as receiver_id,em.subject as mail_subject')
                            ->from(phpfox::getT('emailsystem_email_delivery'),'md')
                            ->join(phpfox::getT('emailsystem'),'em','em.emailsystem_id = md.email_emailsystem_id')
                            ->join(phpfox::getT('emailsystem_text'),'emtext','emtext.emailsystem_id = md.email_emailsystem_id')
                            ->leftJoin(phpfox::getT('emailsystem_template'),'emt','emt.template_id = em.template_id')
                            ->where('1 = 1 '.$where)
                            ->limit($params['limit_sending'])
                            ->execute('getSlaveRows');
            
             if(count($mails)>0)
             {
                 foreach($mails as $mail)
                 {
                      $params['user_id'] = $mail['receiver_id'];
                      if($params['user_id'] == 0)
                      {
                          continue;
                      }
                      $mail['template_content'] = $this->parseHTML($mail['template_content']);
                      
                      $message = $tracking->generateMail($mail['template_content'],$replaceList,$mail['email_delivery_id'],$params);    
                      $attachfiles = unserialize($mail['attachment_files']);
                      if($attachfiles == false)
                      {
                          $htmlattfiles = "";
                          
                      }
                      else
                      {
                          $htmlattfiles = $tracking->generateAttachFiles($attachfiles);
                          
                      }
                      $message = $message.$htmlattfiles;    
                      $mail['text_html'] = $message;
                      $subject = "";
                      if (!isset($mail['template_subject']) || $mail['template_subject'] == "")
                      {
                            $subject = 'You have the mail from '.Phpfox::getParam('core.mail_from_name');
                      }
                      else
                      {
                            $is_subject = true;
                            $subject =  $tracking->generateMail($mail['template_subject'],$replaceList,$mail['email_delivery_id'],$params,$is_subject);
                      }
                      $usersettings = phpfox::getService('emailsystem.settings')->get($mail['receiver_id']);
                      if($usersettings && $mail['privacy'] != 1 )
                      {
                            if($usersettings['is_receiver_email'] == 1 && !in_array('ot2',$usersettings['emailsystem_list']) && $mail['weekly_email'] == 0 )
                            {
                                
                                 continue;
                            }
                            if($usersettings['is_receiver_email'] == 0 && $mail['privacy'] != 1 )
                            {
                               
                                continue;
                            }
                            if($usersettings['is_receiver_email'] == 1 && !in_array($mail['email_emailsystem_id'],$usersettings['emailsystem_list']) && $mail['weekly_email'] !=0)
                            {
                               
                                continue;
                            }
                            if($usersettings['unsubscribe_email'] && $usersettings['unsubscribe_email'] !="")
                            {
                                $unsb  = @unserialize($usersettings['unsubscribe_email']);
                                if($unsb !==false && in_array($emailsystem['emailsystem_id'],$unsb))
                                {
                                    continue;
                                }
                            }
							if(!in_array($emailsystem['emailsystem_id'], $usersettings['emailsystem_list']))
							{
								continue;
							}
							
                      
                      }
                      $mail['template_subject'] = $subject;
                      $message = $this->parse($message);
                      $mailservice->update(array('email_delivery_status'=>2,'time_sent'=>PHPFOX_TIME),$mail['email_delivery_id']); 
                      Phpfox_Error::skip(true);
                      Phpfox::getLib('mail')->to($mail['email'])
                                             ->subject($subject)
                                             ->message($message)
                                             ->messagePlain(strip_tags($message))
                                             ->fromName(Phpfox::getParam('core.mail_from_name'))  
                                             ->send();
                         
                 }
             }
         }
          
     }
     public function cronNotificationCheck($params = array())
     {
         return true;
     }
     public function cronBlogNotificationCheck($params = array())
     {
         //for the next
         return true;
     }
     public function cronEventNotificationCheck($params = array())
     {
            
         $timeago = 7;
        
         if(isset($params['comming_day']))
         {
             $timeago = $params['comming_day'];
         }
         $time = " DATEDIFF(FROM_UNIXTIME(e.start_time),FROM_UNIXTIME(".PHPFOX_TIME."))";                       
         $events = phpfox::getLib('phpfox.database')->select('*')
                    ->from(phpfox::getT('event'),'e')
                    ->leftjoin(phpfox::getT('event_text'),'t','t.event_id = e.event_id')
                    ->leftjoin(phpfox::getT('user'),'u','u.user_id = e.user_id')
                    ->where($time.' <='.$timeago.' AND '.$time .' >= 0')
                    ->execute('getRows');
         if( $events == null || count($events)<=0)
         {
             return false;
         }
         $sCacheId = $this->cache()->set('eventlistnotification_ems');
         $this->cache()->save($sCacheId, $events);
         return true;
         
     }
     /**
     * auto send send mail
     * 
     */
     public function cronSendLetter()
     {
           $emailsystem = phpfox::getService('emailsystem')->getNextRun();
           if($emailsystem != null)
           {
               try{
                $limit = phpfox::getParam('emailsystem.x_mail_per_round');
                
                if($limit == NULL || $limit < 0 )
                {
                    $limit = 10;
                }
               phpfox::getService('emailsystem')->setLastRun($emailsystem['emailsystem_id']);   
               $this->sendMail($emailsystem['emailsystem_id'],$limit);
               }
               catch(Exception $ex)
               {
                   //
               }
               
           }
     }
     /**
     * auto Get and add new user to queue mail
     * 
     */
     public function cronUpdateUsers()
     {

         $emailsystems = phpfox::getService('emailsystem')->get();
         $emailExternal = array();  
         if(count($emailsystems)>0)
         {
             foreach($emailsystems as $ems)
             {
              
                if($ems['type_id'] !=0 )
                {
                   
                    $lst = phpfox::getService('emailsystem.email')->getUserInQueue($ems['emailsystem_id']);
                    
                    $userInQueue = array();
                    
                    if(count($lst) >0)
                    {
                        foreach($lst as $ur)
                        {
                            if( $ur['user_id']>0 )
                            {
                                $userInQueue[] = $ur['user_id'];
                            }
                            /*if( $ur['user_id'] == 0 && $ems['include_none_user'] == 1)
                            {
                                //$emailExternal[] = array('email'=>$ur['email'],'emailsystem_id' =>$ems['emailsystem_id']);
                                if(isset($emailExternal[$ur['email']]))
                                {
                                   $emailExternal[$ur['email']][] = $ems['emailsystem_id'];
                                }
                                else
                                {
                                    $emailExternal[$ur['email']] = array($ems['emailsystem_id']);
                                }
                            }*/
                        }
                    }
                    $ems['gender'] = $ems['gender_email'];
                    $aValues = phpfox::getService('emailsystem.cron')->FilterMail($ems,$userInQueue);
                    if( count($aValues) >0 )
                    {
                        $multiInsert = array();
                        foreach($aValues as $key=>$user)
                        {
                            $multiInsert[] = array(
                               0,$ems['emailsystem_id'],PHPFOX_TIME+$key,'',$user['user_id'],$user['email']
                                    );
                        }
                        phpfox::getService('emailsystem.email')->multiAdd($multiInsert);
                    }
                }
                if($ems['include_none_user'] == 1)
                {
                    phpfox::getService('emailsystem.email')->multiAddExternalEmails($ems['emailsystem_id']);
                }
                if($ems['type_id'] == 3)
                {
                        
                    $nfs = phpfox::getService('emailsystem.notifications')->get();
                    
                    if(count($nfs) >0)
                    {
                        $eventsettings = $nfs[0];
                        $eventsettings['params'] = unserialize($eventsettings['params']);
                        //$remind_time = $eventsettings['params']['remind_day']*24*60*60;
                        //$comming_day = $eventsettings['params']['comming_day']*24*60*60;
                       //$eventsettings['params']['remind_day'] = 0;
                        //$time = " DATEDIFF(FROM_UNIXTIME(time_sent),FROM_UNIXTIME(".$comming_day."))";  
                        //$time2 = " DATEDIFF(FROM_UNIXTIME(time_sent),FROM_UNIXTIME(".PHPFOX_TIME."))";  
                        
                        /*$time2 = "DATEDIFF(FROM_UNIXTIME(".PHPFOX_TIME."),FROM_UNIXTIME(time_sent))";  
                        $this->database()->update(phpfox::getT('emailsystem_email_delivery'),array(
                                    'email_delivery_status '=>0,
                                    ),
                                    $time2.' >'.$eventsettings['params']['remind_day'].' AND '.$time2 . '>0'.
                                    ' AND email_emailsystem_id = '.$ems['emailsystem_id']
                                );
                        */
                        $remind_time = $eventsettings['params']['remind_day']*60*24*60;
			//$remind_time = $eventsettings['params']['remind_day']*60*5;
                        $tmp2 = PHPFOX_TIME - $remind_time;
                        //$time2 = "DATEDIFF(FROM_UNIXTIME(".PHPFOX_TIME."),FROM_UNIXTIME(time_sent))";  
                        $this->database()->update(phpfox::getT('emailsystem_email_delivery'),array(
                                    'email_delivery_status '=>0,
                                    ),
                                    $tmp2.' >time_sent AND '.$tmp2 . '>0'.
                                    ' AND email_emailsystem_id = '.$ems['emailsystem_id']
								); 
                        /*
                        $remind_time = $eventsettings['params']['remind_day']*1*60;
                        $tmp2 = PHPFOX_TIME - $remind_time;
                        //$time2 = "DATEDIFF(FROM_UNIXTIME(".PHPFOX_TIME."),FROM_UNIXTIME(time_sent))";  
                        $this->database()->update(phpfox::getT('emailsystem_email_delivery'),array(
                                    'email_delivery_status '=>0,
                                    ),
                                    $tmp2.' >time_sent AND '.$tmp2 . '>0'.
                                    ' AND email_emailsystem_id = '.$ems['emailsystem_id']
                                ); 
                        */
                    }
                }
                //end
             }
             
         }
         
     }
}
