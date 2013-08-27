<?php
  class EmailSystem_Service_mailtemplate extends Phpfox_Service
  {
        public function __construct()
        {
            $this->_sTable = Phpfox::getT('emailsystem_template');
            $this->_defaultSupportTemplate = array(
                'core.welcome_email_subject' =>'register',
                'user.please_verify_your_email_for_site_title' =>'verify',
                );
        }
        public function add($aVals)
        {
            if(isset($aVals['template_content']))
            {
                $aVals['template_content'] = str_replace("../../../",phpfox::getParam('core.path'),$aVals['template_content']);
                $aVals['template_content'] = str_replace("../../",phpfox::getParam('core.path'),$aVals['template_content']);
            }
            $iID  = phpfox::getLib('phpfox.database')->insert($this->_sTable,$aVals);
            return $iID;
        }
        /**
        * get list all templates mail
        * 
        */
        public function getListTemplate()
        {
            $res = phpfox::getLib('phpfox.database')->select('distinct mt.*,e.type_id')
                            ->from($this->_sTable,'mt')
                            ->leftjoin(phpfox::getT('emailsystem'),'e','e.template_id = mt.template_id')    
                            ->execute('getRows');
           
            if( count($res) <=0)
            {
                return null;
            }
            return $res;
        }
        /**
        * get template by id.
        * If template_id is null , get all templates
        * 
        * @param mixed $template_id
        */
        public function get($template_id = null)
        {
             if($template_id == null)
             {
                 return $this->getListTemplate();
             }
            $res = phpfox::getLib('phpfox.database')->select('distinct mt.*,e.type_id')
                            ->from($this->_sTable,'mt')
                            ->leftjoin(phpfox::getT('emailsystem'),'e','e.template_id = mt.template_id')
                            ->where('mt.template_id = '.$template_id)
                            ->execute('getSlaveRow');
            
            if($res != null && count($res) >0)
            {
                return $res;
            }
            return null;
        }
        public function getByType($template_type ="emailsystem")
        {
            $res = phpfox::getLib('phpfox.database')->select('distinct mt.*')
                            ->from($this->_sTable,'mt')
                            ->where('mt.template_type = "'.$template_type.'"')
                            ->execute('getRow');
            
           return $res;
        }
        /**
        * delete template mail by template_id
        * 
        * @param mixed $template_id
        */
        public function delete($template_id = null)
        {
            if($template_id !=  null)
            {
               
                phpfox::getLib('phpfox.database')->delete($this->_sTable,
                                        'template_id = '.$template_id
                                        );
            }
        }
         /**
        * Update template.
        * 
        * @param mixed $template_id
        */
        public function update($aVals,$template_id = null)
        {
            if($template_id != null)
            {
                if(isset($aVals['template_content']))
                {
                    $aVals['template_content'] = str_replace("../../../",phpfox::getParam('core.path'),$aVals['template_content']);
                    $aVals['template_content'] = str_replace("../../",phpfox::getParam('core.path'),$aVals['template_content']);
                }
                phpfox::getLib('phpfox.database')->update($this->_sTable,$aVals,'template_id = '.$template_id);
                return $template_id;
            }
            return null;
        }
        public function modifyEmailTemplate($sTextPlain,$sTextHtml,$aUser,$sSubject,$aSubject,$sMessage,$sEmailSig,$bMessageHeader)
        {
            
            /*if (is_array($aSubject))
            {
                if(!array_key_exists($aSubject[0],$this->_defaultSupportTemplate))
                {

                    return array($sTextPlain,$sTextHtml,$sSubject);
                }
            }
            else
            {
                return array($sTextPlain,$sTextHtml,$sSubject);
            }*/
            $template_type = isset($this->_defaultSupportTemplate[$aSubject[0]])?$this->_defaultSupportTemplate[$aSubject[0]]:"register";
            
            $mail_template = $this->getByType($template_type);
            if(!$mail_template)
            {
                $mail_template = $this->getByType('register');
            }
            if(!$mail_template)
            {
                return array($sTextPlain,$sTextHtml,$sSubject);
            }
            if($aUser)
            {
                $params['user_id']   = $aUser['user_id'];
                $params['is_mail_modify'] = 1;
                //$message = $tracking->generateMail($mail['text_html'],$replaceList,$mail['email_delivery_id'],$params);
                $replaceList = phpfox::getService('emailsystem.vars')->get();
                $sMessage = str_replace("\n","<br/>",$sMessage);
                $mail_template['template_content'] = str_replace("[content message]",$sMessage,$mail_template['template_content']);
                $sTextHtml = phpfox::getService('emailsystem.tracking')->generateMail($mail_template['template_content'],$replaceList,null,$params);
                $sTextPlain = strip_tags($sTextHtml);
                $is_subject = true;
                $subject =  phpfox::getService('emailsystem.tracking')->generateMail($mail_template['template_subject'],$replaceList,null,$params,$is_subject);
            }
            return array($sTextPlain,$sTextHtml,$sSubject);
        }
        
  }
?>
