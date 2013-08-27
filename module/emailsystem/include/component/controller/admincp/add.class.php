<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Controller_Admincp_Add extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		// When they first submit the emailsystem this block adds it to the ongoing or scheduling
        if(phpfox::getMessage() != "Update email system successfully.")
        {
            Phpfox::clearMessage();
            
        }
		if ($aVals = $this->request()->getArray('val'))
		{	
            if(!isset($aVals['attachment_files']))
            {
                $aVals['attachment_files'] = null;
            }
            
            if(!isset($aVals['include_non_user']))
            {
                $aVals['include_non_user'] = 0;
            }
           
            if($this->request()->get('is_create_new_templ_from') == 1 || $this->request()->get('is_update_template') == 1)//create new mail template from email		
            {
                
                 $template['module_id'] = "emailsystem";
                 $template['template_type'] = "emailtemplate";
                 $template['template_subject'] = $aVals['subject'];
                 $template['template_content'] = $aVals['text'];
                 if( $this->request()->get('is_update_template') == 0)
                 {
                     $template['template_name'] = $this->request()->get('name_template_mof');
                     if( empty($template['template_name']))
                     {
                         Phpfox_Error::set("Template Name cannot be empty");
                     }
                 }
                 
                 if( empty($template['template_subject']))
                 {
                     Phpfox_Error::set("Template Subject cannot be empty.");
                 }
                 if(Phpfox_Error::isPassed())
                 {
                     if($this->request()->get('is_create_new_templ_from') == 1)
                     {
                         $id = phpfox::getService('emailsystem.mailtemplate')->add($template); 
                         
                     }
                     else
                     {
                         
                         $id = $aVals['template_id'];
                         $id = phpfox::getService('emailsystem.mailtemplate')->update($template,$id); 
                         
                     }
                     $aVals['template_id'] = $id;
                 }
                
            }
            
            $aVals['txtPlain'] ="";
            $arr = $this->request()->get('attach');
            if(isset($arr) && $arr != null && count($arr)>0)
            {
                $attachs = phpfox::getService('emailsystem.attachment')->get($arr);
                $aVals['attachment_files'] = $attachs;
            }   
            if(isset($aVals['emailsystem_id']) && $aVals['emailsystem_id']>0)
            {
                $aemailsystem = Phpfox::getService('emailsystem.process')->update($aVals,Phpfox::getUserId());
                //delivery mail from fitter
                if($aemailsystem['type_id'] !=0)
                {   
                    $lst = phpfox::getService('emailsystem.email')->getUserInQueue($aemailsystem['emailsystem_id']);
                    $userInQueue = array();
                    if(count($lst) >0)
                    {
                        foreach($lst as $ur)
                        {
                            if( $ur['user_id']>0 )
                            {
                                $userInQueue[] = $ur['user_id'];
                            }
                        }
                    }
                     
                    $aValues = phpfox::getService('emailsystem.cron')->FilterMail($aemailsystem,$userInQueue);
                    if( count($aValues) >0)
                    {
                        $multiInsert = array();
                        foreach($aValues as $key=>$user)
                        {
                            $multiInsert[] = array(
                               0,$aemailsystem['emailsystem_id'],PHPFOX_TIME+$key,'',$user['user_id'],$user['email']
                                    );
                        }
                        phpfox::getService('emailsystem.email')->multiAdd($multiInsert);
                    }
                    
                    
                }
                if($aVals['include_non_user'] == 1)
                {
                    phpfox::getService('emailsystem.email')->multiAddExternalEmails($aemailsystem['emailsystem_id']);
                    
                }
                
                //end
                if($aemailsystem['update_st'] ==true)
                {
                    $this->url()->send('admincp.emailsystem.add.id_'.$aemailsystem['emailsystem_id'],null,'Update email system successfully.');
                    
                }

                
            }
			else
            {               
                
                $aemailsystem = Phpfox::getService('emailsystem.process')->add($aVals, Phpfox::getUserId());
                if ($aemailsystem['emailsystem_id'] >0)
                {
                    //delivery mail from fitter
                    if($aemailsystem['type_id'] !=0)//1 internal mail //2 external mail
                    {
                        $lst = phpfox::getService('emailsystem.email')->getUserInQueue($aemailsystem['emailsystem_id']);
                        $userInQueue = array();
                        if(count($lst) >0)
                        {
                            foreach($lst as $ur)
                            {
                                if( $ur['user_id']>0 )
                                {
                                    $userInQueue[] = $ur['user_id'];
                                }
                                    
                            }
                        }
                         
                        $aValues = phpfox::getService('emailsystem.cron')->FilterMail($aemailsystem,$userInQueue);
                       
                        if( count($aValues) >0)
                        {
                            $multiInsert = array();
                            $l_st = phpfox::getLib('database')->select('emailsystem_id')
                                            ->from(phpfox::getT('emailsystem'))
                                            ->where('weekly_email > 0')
                                            ->execute('getRows');
                            foreach($aValues as $key=>$user)
                            {
                                $multiInsert[] = array(
                                   0,$aemailsystem['emailsystem_id'],PHPFOX_TIME+$key,'',$user['user_id'],$user['email']
                                        );
                                $emsettings = phpfox::getService('emailsystem.settings')->get($user['user_id']);
                                if($emsettings)  
                                {
                                     $emsettings['emailsystem_list'][] = $aemailsystem['emailsystem_id'];
                                     $emsettings['emailsystem_list'] = serialize($emsettings['emailsystem_list']);
                                     phpfox::getService('emailsystem.settings')->update($emsettings['receiver_id'],$emsettings);        
                                             
                                }
                                else
                                {
                                    
                                     $array = array('ot2');
                                     if(count($l_st))
                                     {
                                         foreach($l_st as $key=>$e)
                                         {
                                             $array[] = $e['emailsystem_id'];
                                             
                                         }
                                         
                                     }
                                     $emsettings['emailsystem_list'] = serialize($array);
                                     $emsettings['receiver_id'] = $user['user_id'];
                                     $emsettings['is_receiver_email'] = 1;
                                     phpfox::getService('emailsystem.settings')->add($emsettings,$user['user_id']); 
                                }
                            }
                            phpfox::getService('emailsystem.email')->multiAdd($multiInsert);
                        } 
                    }
                    if($aVals['include_non_user'] == 1)
                    {
                        phpfox::getService('emailsystem.email')->multiAddExternalEmails($aemailsystem['emailsystem_id']);
                        
                    }
                    
                    //end
                    $this->url()->send('admincp.emailsystem.manage',null,'Add new email system successfully.');
                }
                elseif ($aemailsystem === false)
                {
                }
                else
                {
                    $this->url()->send('admincp.emailsystem.manage', null, null);
                }
            }
            $aVals['include_none_user'] = $aVals['include_non_user'];
            $aVals['gender_email'] = $aVals['gender'];
            
          
          
            $aVals['user_group_id']=$aVals['user_group'];
            $this->template()->assign(
                        array(
                            'editLetter' =>$aVals
                        )
                        );
		}
		if ($iId = $this->request()->getInt('id'))
        {
            
            $aNewsletter = Phpfox::getService('emailsystem')->get($iId);
            
            if($aNewsletter['type_id'] >2)
            {
                $this->url()->send('admincp.emailsystem.notifications');
            }
            $aNewsletter['attach'] = unserialize($aNewsletter['attachment_files']);
            
            if(isset($aNewsletter['text_html']))
            {
                $aNewsletter['text'] = $aNewsletter['text_html'];    
            }
            else
            {
                $aNewsletter['text'] = "";
            }
            $d = Phpfox::getService('user.group')->get();
            $aNewsletter['user_group_id'] = @unserialize($aNewsletter['user_group_id']);
            if(isset($aNewsletter['user_group_id']) && $aNewsletter['user_group_id']!=null)
                $aNewsletter['is_user_group']=true;
            else
                $aNewsletter['is_user_group']=false;

           
            $this->template()->assign(array(
                    'aForms' => $aNewsletter,
                    'editLetter'=>$aNewsletter,
                    'genders'=>Phpfox::getService('core')->getGenders(true),
                )
            );
        }
        
		$aValidation = array(
			'type_id' => array(
				'title' => Phpfox::getPhrase('emailsystem.select_a_emailsystem_type'),
				'def' => 'int'
			),
		);

		// 2 = html; 1 = plain text;
		$oValidator = Phpfox::getLib('validator')->set(array('sFormName' => 'js_form', 'aParams' => $aValidation));
		$aAge = array();
		for ($i = 18; $i <= 68; $i++)
		{
			$aAge[$i] = $i;
		}
        if (Phpfox::getUserParam('mail.can_add_attachment_on_mail'))
        {
            $this->template()->setHeader('<script type="text/javascript">var Attachment = {sCategory: "mail", iItemId: ""};</script>');
        }
        
        $html = mysql_escape_string("<a onclick='Phpfox.EmailSystem.SelectVars(\"text\");return false;' class='editor_button' href='#'><img class='editor_button' src='".phpfox::getParam('core.path')."module/emailsystem/static/image/email.png' width='16px' height='16px' alt='Mail Template Vars' title='Mail Template Vars' class='editor_button'/></a><div class='editor_separator'></div>");
		$this->template()->assign(array(
				            'aAge' => $aAge,
				            'aUserGroups' => Phpfox::getService('user.group')->get(),
				            'sCreateJs' => $oValidator->createJS(),
				            'sGetJsForm' => $oValidator->getJsForm(),
                            'sJsHtmlCode' =>$html,
			            )
		            )
		            ->setTitle(Phpfox::getPhrase('emailsystem.emailsystem'))
		            ->setBreadCrumb(Phpfox::getPhrase('emailsystem.emailsystem'),  $this->url()->makeUrl('admincp.emailsystem.add'))
		            ->setBreadCrumb('Create New Email System', null, true)//Phpfox::getPhrase('emailsystem.add_emailsystem')
		            ->setPhrase(array(
				            'emailsystem.min_age_cannot_be_higher_than_max_age',
				            'emailsystem.max_age_cannot_be_lower_than_the_min_age'
			            )
		            )		
		            ->setEditor(array(
					            'wysiwyg' => Phpfox::getCookie('editor_wysiwyg'),
					            'toggle' => Phpfox::getCookie('editor_wysiwyg')
				            )
			            )
		            ->setHeader(
                        array(
                            'add.js' => 'module_emailsystem',
                           // 'switch_legend.js' => 'static_script',
                            //'switch_menu.js' => 'static_script',            
                            //'jquery/plugin/jquery.highlightFade.js' => 'static_script',
                            //'jquery/plugin/jquery.scrollTo.js' => 'static_script',
                            'swfupload.js' => 'module_emailsystem' ,          
                            'swfupload.queue.js' => 'module_emailsystem', 
                            'fileprogress.js' => 'module_emailsystem' ,       
                            'handlers.js' => 'module_emailsystem' ,
                            'upload.css' =>'module_emailsystem'
                        )
                    );
        $emList = Phpfox::getService('emailsystem.mailtemplate')->get();
        $lstVars = phpfox::getService('emailsystem.vars')->get(); 
        $this->template()->assign(array(
                'emList' => $emList,
                'lstVars'=>$lstVars, 
                'core_path' =>phpfox::getParam('core.path'),
                'sUrlUpload' =>phpfox::getLib('url')->makeUrl('emailsystem.attachment'),
                'urlDownload' => phpfox::getLib('url')->makeUrl('emailsystem.attachment.download.'),
                //'sUrlUpload' =>Phpfox::getParam('core.path').'module/emailsystem/static/upload.php',
            )
        );
	}
}
