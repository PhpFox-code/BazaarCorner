<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Service_tracking extends Phpfox_Service
{
     function __construct()
     {
             $this->_sTable = phpfox::getT('emailsystem_tracking_email');
     }
     
     public function getTrackingDetails($emailsystem_id = null,$fromDate = null,$toDate = null,$params = array())
     {
        $condition = array();
        $condition[] =" 1=1 ";
        $where = "";
        if ($emailsystem_id != null)
        {
            $where = " AND eed.email_emailsystem_id = ".$emailsystem_id;
        }
        if ($fromDate != null)
        {
            $condition[] = " AND DATEDIFF(DATE_FORMAT( FROM_UNIXTIME(ete.time_stamp),'%Y-%m-%d'),'".$fromDate."')>=0";
        }
        if ($toDate != null)
        {
            $condition[] = " AND DATEDIFF(DATE_FORMAT( FROM_UNIXTIME(ete.time_stamp),'%Y-%m-%d'),'".$toDate."')<=0";
        }
        if(!isset($params['limit']))
        {
            $res = phpfox::getLib('phpfox.database')->select('*,DATE_FORMAT( FROM_UNIXTIME(ete.time_stamp),\'%Y-%m-%d\') as readDay')
                    ->from($this->_sTable,'ete')
                    ->join(phpfox::getT('emailsystem_email_delivery'),'eed','eed.email_delivery_id = ete.email_delivery_id'.$where)
                    ->join(phpfox::getT('emailsystem'),'e','e.emailsystem_id = eed.email_emailsystem_id'.$where)
                    ->leftjoin(phpfox::getT('user'),'u','u.user_id = eed.user_id')
                    ->where($condition)
                    ->order('readDay ASC')
                    ->execute('getRows');
    
        }
        else
        {
            $res = phpfox::getLib('phpfox.database')->select('*,DATE_FORMAT( FROM_UNIXTIME(ete.time_stamp),\'%Y-%m-%d\') as readDay,eed.email as receiver_email')
                    ->from($this->_sTable,'ete')
                    ->join(phpfox::getT('emailsystem_email_delivery'),'eed','eed.email_delivery_id = ete.email_delivery_id'.$where)
                    ->join(phpfox::getT('emailsystem'),'e','e.emailsystem_id = eed.email_emailsystem_id'.$where)
                    ->leftjoin(phpfox::getT('user'),'u','u.user_id = eed.user_id')
                    ->where($condition)
                    ->limit($params['page'],$params['limit'],$params['total'])
                    ->order('readDay ASC')
                    ->execute('getRows');

        }        
        //$sql = $this->database()->_sqlQuery;
        //$report = $this->database()->sqlReport($sql);
        return $res;
     }
     public function getTrackingByDuration($emailsystem_id = null,$fromDate = null,$toDate = null,$params = array())
     {
        $res = $this->getTrackingDetails($emailsystem_id,$fromDate,$toDate,$params);
        if(count($res)>0)
        {
            $result = array();
            if(isset($params['group_by_month']) || isset($params['group_by_year']))
            {
                 foreach( $res as $r)
                 {
                     
                     $date = explode('-',$r['readDay']);
                     if(isset($params['group_by_year']))
                         $index = $date[0];
                     if(isset($params['group_by_month']))
                         $index = $date[1];
                     if(isset($result[$index]))
                     {
                         if($r['tracking_type'] == 1) //read mail
                         {
                            $result[$index]['total_read'] += 1;
                         }
                         elseif($r['tracking_type'] == 2) //click
                         {
                            $result[$index]['total_click'] += 1;    
                         }
                         else
                         {
                             $result[$index]['total_unsubscribe'] += 1; 
                         }
                     }
                     else
                     {
                         if($r['tracking_type'] == 1) //read mail
                         {
                            $result[$index]['total_read'] = 1;
                            $result[$index]['total_click'] = 0;
                            $result[$index]['total_unsubscribe'] = 0;    
                         }
                         elseif($r['tracking_type'] == 2) //click
                         {
                            $result[$index]['total_click'] = 1;    
                            $result[$index]['total_read'] = 0; 
                            $result[$index]['total_unsubscribe'] = 0;    
                         }
                         else
                         {
                             $result[$index]['total_read'] = 0;
                             $result[$index]['total_click'] = 0;
                             $result[$index]['total_unsubscribe'] = 1; 
                         }
                     }
                 
                 }
            }
            $result['name_em'] = $res[0]['emailsystem_name'];
            return $result;
           
        }
        return array();
     }
     public function parseVars($vars)
     {
         //$test = "[url_sub value='test' display='tesr dest']";
         $pattern = "/(?P<key_name>\w+)='(?P<key_value>[^\']+)/im";
         $sLdq = "[";
         $sRdq = "]";
         $test = $sLdq.$vars.$sRdq;
         preg_match_all($pattern, $test, $aMatches);
         if(isset($aMatches['key_name']) && count($aMatches['key_name'])>0)
         {
             $params =  array_combine($aMatches['key_name'], $aMatches['key_value']);    
             $var = explode(" ",$vars);
             if(count($var)>0)
             {
                $params['var_display'] =$var[0];     
             }
             
         }
         else
         {
             $params['var_display'] = $vars;
         }
         return $params;
     }
     public function parseContentVars($content)
     {
         $sLdq = "[";
         $sRdq = "]";
         //$test = $sLdq.$vars.$sRdq;
         $sLdq = preg_quote($sLdq);
         $sRdq = preg_quote($sRdq);
         preg_match_all("!{$sLdq}\s*(.*?)\s*{$sRdq}!s", $content, $aMatches);
         $params = array();
         if(isset($aMatches[1]))
         {
             return $aMatches[1];
         }
         return $params;
     }
     private function parseSBL($params,$ev,$total = 0)
     {
         $listreplace = array();
         $listvars = array();
         if(count($params)<= 0 || $ev == null || count($ev)<=0)
         {
             return array($listreplace,$listvars);
         }
         foreach($params as $pa)
         {
             $var = explode(' ',$pa);
             $listvars[] = '['.$pa.']';
             if($var[0] == 'event')
             {
                 switch ($var[1])
                 {
                     case 'total':
                        $listreplace[] = $total;
                        break;
                     case 'image':
                        $listreplace[] = '<img src="'.phpfox::getParam('core.path').'file/pic/event/'.sprintf($ev['image_path'],'').'" alt="event" width="100px" height="100px"/>';
                        break;
                     case 'content':
                        $listreplace[] = $ev['description_parsed'];
                        break;
                     case 'owner':
                        $listreplace[] = '<a href="'.phpfox::getLib('url')->makeUrl($ev['user_name']).'" >'.$ev['full_name'].'</a>';
                        break;
                     case 'starttime':
                        $listreplace[] = phpfox::getTime(Phpfox::getParam('mail.mail_time_stamp'),$ev['start_time']);
                        break;
                     case 'endtime':
                        $listreplace[] = phpfox::getTime(Phpfox::getParam('mail.mail_time_stamp'),$ev['end_time']);
                        break;
                     case 'address':
                        $tm = "";
                        $tm = $ev['location'].", ";
                        if (!empty($ev['city']))
                        {
                            $tm .= $ev['city'].", ";
                        }
                        $tm .=   Phpfox::getService('core.country')->getCountry($ev['country_iso']);
                        $listreplace[] = $tm;
                        break;
                     case 'title':
                        $listreplace[] = $ev['title'];
                        break;
                     case '':
                        break;
                 }
             }
         }
         return array($listvars,$listreplace);
     }
     public function parseSections($type = 3,$start="[event-start]",$end="[event-end]",$content)
     {
         if($start == null)
         {
             $start="[event-start]";
         }
          if($end == null)
         {
            $end="[event-end]";
         }
         $sLdq = preg_quote($start);
         $sRdq = preg_quote($end);
         preg_match_all("!{$sLdq}\s*(.*?)\s*{$sRdq}!s", $content, $aMatches);
        
         if(!strpos($content,$start) || !strpos($content,$end))
         {
             return $content;
         }
                
         if(isset($aMatches[1]))
         {
             switch($type)
             {
                 case 3://event
                    
                    $sCacheId = $this->cache()->set("eventlistnotification_ems");
                    $eventList = $this->cache()->get($sCacheId);
                    
                    if(count($eventList)<=0 || $eventList == false)
                    {
                        break;
                    }
                    foreach($aMatches[1] as $key=>$match)
                    {
                        $varsSec = $this->parseContentVars($match);
                        $t = "";
                        foreach($eventList as $key=>$event)
                        {
                            $cts = $match;   
                            list($a,$b) = $this->parseSBL($varsSec,$event,count($eventList));
                            
                            $cts = str_replace($a,$b,$cts);
                            $t .= $cts."<br/>";
                            
                        }
                        $content = str_replace($match,$t,$content) ;
                    }
                   
                    break;
                 case 4://blog
                    break;
             }
             if($type == 3)
             {
                 $content = str_replace("[event total]",count($eventList),$content);
             }
             $content = str_replace($start,"",$content) ;
             $content = str_replace($end,"",$content) ;
             
             return $content;
         }
         return $content;
     }
     public function generateMail($mailTemplate = "",$replaceVars = array(),$mail_id = null,$params = array(),$is_subject = false)
     {    
         
         if( $replaceVars == null || count($replaceVars) <=0 )
         {
             
             return $mailTemplate;;
         }
        
         $parsed_template = $mailTemplate;
         //get default vars for template
         $aUser = null;
         if(isset($params['user_id']))
         {
             $sCacheId = $this->cache()->set("emailsystem_user".$params['user_id']);
            
             if(!$aUser = $this->cache()->get($sCacheId))
             {
                
                   $aUser = $this->database()->select('u.*, uf.*, ua.*')
                            ->from(phpfox::getT('user'), 'u')
                            ->join(Phpfox::getT('user_field'), 'uf', 'uf.user_id = u.user_id')
                            ->join(Phpfox::getT('user_activity'), 'ua', 'ua.user_id = u.user_id')
                            ->where('u.user_id = ' . (int) $params['user_id'])
                            ->execute('getRow');;     
                   $this->cache()->save($sCacheId, $aUser);
             }
                         
         }
         
         //end get
         $lst_filter = array();
         $lst_replace = array();
         $nfs = phpfox::getService('emailsystem.notifications')->get();

         if(count($nfs)>0)
         {
             foreach($nfs as $key=>$nf)
             {
                 if($nf['is_active_nf'] == 1)
                 {
                      $nf['params'] = unserialize($nf['params']);
                     
                      $start = isset($nf['params']['tag-start'])?$nf['params']['tag-start']:null;
                      $end = isset($nf['params']['tag-end'])?$nf['params']['tag-end']:null;
                        
                      $parsed_template = $this->parseSections(3,$start,$end,$parsed_template);             
                 }
             }
         }
         
         $varsInTemplate = $this->parseContentVars($parsed_template);
         
         if(count($varsInTemplate)>0)
         {
             $lst_filter = array();
             $lst_replace = array();
              foreach($varsInTemplate as $keyvar=>$value)
              {
                  $params = $this->parseVars($value);
                  if (isset($replaceVars[$params['var_display']]))
                  {
                      @eval($replaceVars[$params['var_display']]['var_translate']);
                  }
                  
                  $test = $params['var_display'];
                  if(isset($$test) && $$test != null)
                  {
                      $lst_filter[] = '['.$value.']';
                      $lst_replace[] = ${$test};    
                  }
                  else
                  {
                      $lst_filter[] = '['.$value.']';
                      $lst_replace[] = 'unknown';    
                  }
                  
              }
              $parsed_template  = str_replace($lst_filter,$lst_replace,$parsed_template);
         }
         if(isset($params['is_mail_modify']) && $params['is_mail_modify'] == 1)
         {
             return $parsed_template;
         }
         $parsed_template = $this->formatUrlsInText($parsed_template,$mail_id);
         if($mail_id == null)
         {
             $mail_id = 0;
         }
         if($is_subject == false)
         {
             $img_url = phpfox::getParam('core.path').'module/emailsystem/static/image/img.gif';
             if(isset($replaceVars['img_tracking']))
             {
                 $img_url = $replaceVars['img_tracking'];
             }
             else
             {
                 $img_url = phpfox::getParam('core.path').'module/emailsystem/static/image/img.gif';
             } 
             $tracking_url ="<img src='".$this->generateImageTracking($img_url,$mail_id)."' alt=''/>";
             $parsed_template.=  $tracking_url;    
         }
         
         return $parsed_template;
     }
     public function generateAttachFiles($attachfiles = array(),$is_simple_att = true)
     {
         $html ="";
         
         if(count($attachfiles)>0)
         {
             if($is_simple_att == true)
             {
                  $html .="[br][br]--------------Attachment Files--------------------[br]";
                  $html_at = false;
                  foreach($attachfiles as $att)
                  {
                      $urlDownload = phpfox::getLib('url')->makeUrl('emailsystem.attachment.download.'.$att['attachment_id']);
                      $html .= '<a href="'.$urlDownload.'">'.$att['file_name'].'</a>[br]';
                      $html_at = true;
                  }
                  $html .="------------------End Files-----------------------[br]";   
                  if($html_at == false)
                  {
                      $html = "";
                  }
             }
             else//atttach file in format file.
             {
                 foreach($attachfiles as $att)
                 {
                      $path = PHPFOX_DIR_FILE.'attachment'.PHPFOX_DS.sprintf($att['destination'],'');
                      $file = fopen($path,"rb");
                      $is_read = true;
                      if ($file)
                      {
                          while(!feof($file))
                          {
                                $data .= fread($file, 1024*8);
                                if (connection_status()!=0)
                                {
                                    @fclose($file);
                                    $is_read = false;
                                }
                          }
                          @fclose($file);
                          $data = chunk_split(base64_encode($data));
                          $html .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"".$att['file_name']."\"\n" . 
                                  "Content-Disposition: attachment;\n" . " filename=\"".$att['file_name']."\"\n" . 
                                  "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                      }
                      
                 }
             }
              
         }
         return $html;
     }
     public function generateUrlTracking($url = "",$mail_id = null)
     {
         if($mail_id == null)
         {
             return $url;
         }
         $new_url = $this->encode_full_url($url);
         $trackingurl = phpfox::getLib('url')->makeUrl('emailsystem.tracking.'.$mail_id.'.url.').$new_url;
         return $trackingurl;
         
     }
     public function generateImageTracking($imgurl = "",$mail_id = null)
     {   
         if($mail_id == null)
         {
             return $imgurl;
         }
         $imgurl = $this->encode_full_url($imgurl);
         $trackingimg = phpfox::getLib('url')->makeUrl('emailsystem.tracking.'.$mail_id.'.img.').$imgurl;
         return $trackingimg;
     }
     public function generateunsubscribeTracking($imgurl = "",$mail_id = null,$params = array())
     {
         if($mail_id == null)
         {
             return $imgurl;
         }
         $imgurl = $this->encode_full_url($imgurl);
         $display = "Click here to unsubscribe";
         if(isset($params['display']))
         {
             $display = $params['display'];
         }
         $trackingimg = '<a href="'.phpfox::getLib('url')->makeUrl('emailsystem.tracking.'.$mail_id.'.unsubscribe.').$imgurl.'">'.$display.'</a>';
         return $trackingimg;
     }
     public function updateCounterMailRead($mail_id = null)
     {
         if($mail_id == null)
         {
             return false;
         }
         Phpfox::getLib('phpfox.database')->query("
            UPDATE " . phpfox::getT('emailsystem_email_delivery') . "
            SET counter = counter + 1
            WHERE email_delivery_id = " . $mail_id . "
        ");
     }
     public function saveHistoryEmail($mail_id = null,$type = 1)
     {
        if($mail_id == null)
        {
            return false;
        }
      
        $mail = phpfox::getService('emailsystem.email')->get($mail_id);
        if($mail)
        {
            $aVals['receiver_id'] = $mail['user_id'];
            $aVals['receiver_email'] = $mail['email'];
            $aVals['time_stamp'] = PHPFOX_TIME;
            $aVals['tracking_type'] = $type;
            $aVals['email_delivery_id'] = $mail['email_delivery_id'];
            $iID  = phpfox::getLib('phpfox.database')->insert($this->_sTable,$aVals);         
            return $iID;
        }
    }
     public function unsubscribeEmailSystem($mail_id = null) 
    {    
        
         if($mail_id == null)
         {
             return false;
         }
         $mail = phpfox::getService('emailsystem.email')->get($mail_id); 
         if($mail)
         {
             $mail_s['email_delivery_status']= -1;//pending
             phpfox::getService('emailsystem.email')->update($mail_s,$mail_id);
             $user_id = $mail['user_id'];
             if($user_id == 0)
             {
                //remove all
                phpfox::getLib('phpfox.database')->update(
                        phpfox::getT('emailsystem_email_delivery'),
                        array(
                           'email_delivery_status ' => -1,
                        ),
                        'email = "'.$mail['email'].'"'
                        );
             }
             else
             {
                 
                 $settings = phpfox::getService('emailsystem.settings')->get($user_id);
                 if($settings)
                 {
                     if(empty($settings['unsubscribe_email']))
                     {
                         $settings['unsubscribe_email'] = serialize(array($mail['email_emailsystem_id']));
                     }
                     else
                     {
                         $settings['unsubscribe_email'] = unserialize($settings['unsubscribe_email']);
                         $settings['unsubscribe_email'][] = $mail['email_emailsystem_id'];
                         $settings['unsubscribe_email'] = serialize($settings['unsubscribe_email']);
                     }
                     if(!empty($settings['emailsystem_list']))
                     {
                         foreach($settings['emailsystem_list'] as $key=>$value)
                         {
                             if($value == $mail['email_emailsystem_id'])
                             {
                                 unset($settings['emailsystem_list'][$key]);
                             }
                         }
                         $settings['emailsystem_list'] = serialize($settings['emailsystem_list']);
                     }
                     
                     phpfox::getService('emailsystem.settings')->update($settings['receiver_id'],$settings);
                 }
                 else
                 {
                     //$settings['unsubscribe_email'] = serialize(array($mail['email_emailsystem_id']));
                     $emailsystem_lst = phpfox::getService('emailsystem')->get();
                     $ems_arr = array();
                     foreach($emailsystem_lst as $ems)
                     {
                         if($mail['email_emailsystem_id'] !=$ems['emailsystem_id'] )
                         {
                            $ems_arr[] = $ems['emailsystem_id'];    
                         }
                         
                     }
                     $settings['emailsystem_list'] = serialize($ems_arr);
                     $settings['receiver_id'] = $user_id;
                     phpfox::getService('emailsystem.settings')->add($settings,$user_id);
                       
                 }
                 
             }
             
         }
    }
     private function encode_full_url(&$url)
    {
        $url = urlencode($url);
        //$url = str_replace("%2F", "/", $url);
        //$url = str_replace("%3A", ":", $url);
        $url = base64_encode($url) ;
        return $url;
    }
     public function formatUrlsInText($text,$mail_id = null)
     {
        if($mail_id == null)
        {
            return $text;
        }
        /*$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        preg_match_all($reg_exUrl, $text, $matches);
        var_dump($matches);
        $usedPatterns = array();
        foreach($matches[0] as $pattern){
            if(!array_key_exists($pattern, $usedPatterns)){
                $usedPatterns[$pattern]=true;
                $trackurl = $this->generateUrlTracking($pattern,$mail_id);
                echo $pattern."<br/>";
                $text = str_replace($pattern, "<a href='$trackurl' rel='nofollow'>$pattern</a>", $text);
            }
        }*/
        $regexp = "<a\s[^>]*href=(\"??)([^\">]*?)\\1[^>]*>(.*)<\/a>"; 
        
        if(preg_match_all("/$regexp/siU", $text, $matches, PREG_SET_ORDER)) 
        { 
            foreach($matches as $match) 
            {
                 // $match[2] = link address 
                 // $match[3] = link text
                 $trackurl = $this->generateUrlTracking($match[2],$mail_id);
                 $text = str_replace('href="'.$match[2].'"','href="'.$trackurl.'"', $text);
            }
        }
        return $text;
    } 
    public function url_exist($url)
    {
        //se passar a URL existe
        $c=curl_init();
        curl_setopt($c,CURLOPT_URL,$url);
        curl_setopt($c,CURLOPT_HEADER,1);//get the header
        curl_setopt($c,CURLOPT_NOBODY,1);//and *only* get the header
        curl_setopt($c,CURLOPT_RETURNTRANSFER,1);//get the response as a string from curl_exec(), rather than echoing it
        curl_setopt($c,CURLOPT_FRESH_CONNECT,1);//don't use a cached version of the url
        if(!curl_exec($c))
        {
            curl_close();
            return false;
        }else
        {
            curl_close();
            return true;
        }
    }   

}