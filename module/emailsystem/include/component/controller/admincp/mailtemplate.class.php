<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Controller_Admincp_mailtemplate extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		
        $request = $this->request();
        if($request->get('createnewvars'))// only for dev
        {
            $aVals = $request->get('val');
            if( empty($aVals['var_display']))
            {
                 Phpfox_Error::set("Vars Name cannot be empty");
            }
             if(Phpfox_Error::isPassed())
             {
                 $id = phpfox::getService('emailsystem.vars')->add($aVals);
                 if($id >0)
                 {
                     $this->url()->send('admincp.emailsystem.mailtemplate',null,'Create new vars successfully.');
                 }
                 else
                 {
                     Phpfox_Error::set("Something errors when create new vars. Please check again");             
                     
                 }
                 
             }
        }
        if($id = $request->get('edit'))//request edit template
        {
            $template = phpfox::getService('emailsystem.mailtemplate')->get($id);   
            $this->template()->assign(
                    array(
                        'is_edit' =>1,
                        'template_edit' =>$template,
                        'aForms' =>$template,
                    )
                    
                )   ;
        }
        if($id= $request->get('delete'))
        {
            $tempdel = phpfox::getService('emailsystem.mailtemplate')->get($id);
            if($tempdel['type_id'] == 3)
            {
                $this->url()->send('admincp.emailsystem.mailtemplate',null,'Can not delete mail template for event.'); 
            }
            phpfox::getService('emailsystem.mailtemplate')->delete($id);
            $this->url()->send('admincp.emailsystem.mailtemplate',null,'Delete mail template successfully.');     
        }
        if($id = $request->get('register'))
        {
            $tempreg = phpfox::getService('emailsystem.mailtemplate')->get($id);
            if($tempreg)                 
            {
                $tempreg['template_type'] = "register";
                unset($tempreg['type_id']);
                phpfox::getLib('phpfox.database')->update(phpfox::getT('emailsystem_template'),array("template_type" =>"emailtemplate"),'1 =1 ');   
                $id = phpfox::getService('emailsystem.mailtemplate')->update($tempreg,$id);      
                $this->url()->send('admincp.emailsystem.mailtemplate',null,'Update mail template successfully.');                
            }
        }
        if($request->get('edittemplate'))//update template mail
        {
            $template_id = $request->get('template_id');
            $aVals = $request->get('val');
            $aVals['module_id'] = "emailsystem";
            //$aVals['template_type'] = "emailtemplate";
            if( empty($aVals['template_name']))
            {
                 Phpfox_Error::set("Template Name cannot be empty");
            }
            if( empty($aVals['template_subject']))
            {
                Phpfox_Error::set("Template Subject cannot be empty");
            }
            if(Phpfox_Error::isPassed())
            {
                 $id = phpfox::getService('emailsystem.mailtemplate')->update($aVals,$template_id);
                 if($id >0)
                 {
                     $this->url()->send('admincp.emailsystem.mailtemplate',null,'Update mail template successfully.');
                 }
                 else
                 {
                     Phpfox_Error::set("Something errors when update mail template. Please check again");             
                     
                 }
                 
             }
        }
        if($request->get('createnew'))//create new mail template
        {
             $aVals = $request->get('val');
             $aVals['module_id'] = "emailsystem";
             $aVals['template_type'] = "emailtemplate";
             if( empty($aVals['template_name']))
             {
                 Phpfox_Error::set("Template Name cannot be empty");
             }
              if( empty($aVals['template_subject']))
             {
                 Phpfox_Error::set("Template Subject cannot be empty");
             }
             if(Phpfox_Error::isPassed())
             {
                 $id = phpfox::getService('emailsystem.mailtemplate')->add($aVals);
                 if($id >0)
                 {
                     $this->url()->send('admincp.emailsystem.mailtemplate',null,'Create new mail template successfully.');
                 }
                 else
                 {
                     Phpfox_Error::set("Something errors when create new mail template. Please check again");             
                     
                 }
                 
             }
        }
		$emList = Phpfox::getService('emailsystem.mailtemplate')->get();
        
        $html = mysql_escape_string("<a onclick='$Core.EmailSystem.SelectVars(\"template_content\");return false;' class='editor_button' href='#'><img class='editor_button' src='".phpfox::getParam('core.path')."module/emailsystem/static/image/email.png' width='16px' height='16px' alt='Mail Template Vars' title='Mail Template Vars' class='editor_button'/></a><div class='editor_separator'></div>");
        $lstVars = phpfox::getService('emailsystem.vars')->get();    
		$this->template()->assign(array(
				'emList' => $emList,
                'sJsHtmlCode' => $html,
                'core_path' =>phpfox::getParam('core.path'),
                'lstVars'=>$lstVars,   
			)
		)
		->setTitle(Phpfox::getPhrase('emailsystem.emailsystem'))
	    ->setBreadCrumb(Phpfox::getPhrase('emailsystem.emailsystem'),  $this->url()->makeUrl('admincp.emailsystem.mailtemplate'))
		->setBreadCrumb('Manage Email Templates', null, true)
		->setEditor(array(
                    'wysiwyg' => Phpfox::getCookie('editor_wysiwyg'),
                    'toggle' => Phpfox::getCookie('editor_wysiwyg')
                )
            )
		->setHeader(array('add.js' => 'module_emailsystem'));
	}
}
?>
