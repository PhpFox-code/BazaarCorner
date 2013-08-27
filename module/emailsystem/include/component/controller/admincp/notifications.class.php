<?php


defined('PHPFOX') or exit('NO DICE!');

class EmailSystem_Component_Controller_Admincp_Notifications extends Phpfox_Component
{
	
	public function process()
	{
        if($this->request()->get('run_events_settings'))
        {
            $val = $this->request()->get('val');
            if(!is_int((int)$val['comming_day']) || $val['comming_day']<=0)
            {
                Phpfox_Error::set('Comming Day must be the number greater than 0.');
            }
            if(!is_int((int)$val['remind_day']) || $val['remind_day']<=0)
            {
                Phpfox_Error::set('Remind Day must be the number greater than 0.');
            }
            if(empty($val['subject']))
            {
                Phpfox_Error::set('Subject Mail cannot be empty.');
            }
            if(Phpfox_Error::isPassed())
            {
                $editEvents['params'] =  array(
                            'auto_mailing' =>$val['auto_mailing'],
                            'comming_day' =>$val['comming_day'],
                            'remind_day' =>$val['remind_day'],
                            );
                $editEvents['params']= serialize($editEvents['params']);
                $editEvents['is_active_nf'] = $val['auto_mailing'];
                $editTemplate['template_subject'] = $val['subject'];
                $editTemplate['template_content'] = $val['text_html_event'];
                phpfox::getService('emailsystem.notifications')->update($val['ems_notifications_id'],$editEvents);
                phpfox::getService('emailsystem.mailtemplate')->update($editTemplate,$val['template_id_edit']);
                $nfs = phpfox::getService('emailsystem.notifications')->get();
                if(count($nfs) >0)
                {
                    $eventsettings = $nfs[0];
                    $eventsettings['params'] = unserialize($eventsettings['params']);
                    $remind_time = $eventsettings['params']['remind_day']*24*60*60;
                    $ems = phpfox::getLib('database')->select('*')->from(phpfox::getT('emailsystem'))->where('type_id = 3')->execute('getRow');
                    $time = " DATEDIFF(FROM_UNIXTIME(time_sent),FROM_UNIXTIME(".PHPFOX_TIME."))";
                    phpfox::getLib('phpfox.database')->update(phpfox::getT('emailsystem_email_delivery'),array(
                                'email_delivery_status '=>0,
                                ),
                                //$time.' >='.$eventsettings['params']['remind_day'].
                                ' email_emailsystem_id = '.$ems['emailsystem_id']
                            );
                   
                   
                }
                phpfox::getService('emailsystem.cron')->cronNotifications();


            }
            
        }
        if($this->request()->get('save_events_settings'))
        {
            $val = $this->request()->get('val');
            if(!is_int((int)$val['comming_day']) || $val['comming_day']<=0)
            {
                Phpfox_Error::set('Comming Day must be the number greater than 0.');
            }
            if(!is_int((int)$val['remind_day']) || $val['remind_day']<=0)
            {
                Phpfox_Error::set('Remind Day must be the number greater than 0.');
            }
            if(empty($val['subject']))
            {
                Phpfox_Error::set('Subject Mail cannot be empty.');
            }
            if(Phpfox_Error::isPassed())
            {
                $editEvents['params'] =  array(
                            'auto_mailing' =>$val['auto_mailing'],
                            'comming_day' =>$val['comming_day'],
                            'remind_day' =>$val['remind_day'],
                            );
                $editEvents['params']= serialize($editEvents['params']);
                $editEvents['is_active_nf'] = $val['auto_mailing'];
                $editTemplate['template_subject'] = $val['subject'];
                $editTemplate['template_content'] = $val['text_html_event'];
                phpfox::getService('emailsystem.notifications')->update($val['ems_notifications_id'],$editEvents);
                phpfox::getService('emailsystem.mailtemplate')->update($editTemplate,$val['template_id_edit']);
                $this->url()->send('admincp.emailsystem.notifications',null,'Update Event Settings successfully.');
            }
        }
		$enfl = phpfox::getService('emailsystem.notifications')->get();
        if($enfl == null || count($enfl) <=0)
        {
            Phpfox_Error::set("There is no any settings.");
            $this->template()->assign(array(
                'no_setttings'=>1
                ));
            return false;
        }
        $eventsettings = $enfl[0];
        $eventsettings['params'] = unserialize($eventsettings['params']);
        $eventsettings['text_html_event'] = $eventsettings['template_content'];
        $emList = Phpfox::getService('emailsystem.mailtemplate')->get();
        //$auto_m_event = 1;
        $html = mysql_escape_string("<a onclick='Phpfox.EmailSystem.SelectVars(\"template_content\");return false;' class='editor_button' href='#'><img class='editor_button' src='".phpfox::getParam('core.path')."module/emailsystem/static/image/email.png' width='16px' height='16px' alt='Mail Template Vars' title='Mail Template Vars' class='editor_button'/></a><div class='editor_separator'></div>");
        $auto_m_event = $eventsettings['params']['auto_mailing'];
        $lstVars = phpfox::getService('emailsystem.vars')->get();   
        $this->template()->assign(array(
                'emList' => $emList,
                'eventsettings' => $eventsettings,
                'aForms' => $eventsettings,
                'sJsHtmlCode' => $html,
                'core_path' =>phpfox::getParam('core.path'),
                'auto_m_event' =>$auto_m_event,
                'lstVars'=>$lstVars,
                    )
                )
                        ->setHeader(array(
                            'add.js' => 'module_emailsystem',
                    )
                )
				->setBreadcrumb(Phpfox::getPhrase('emailsystem.manage_notifications'), $this->url()->makeUrl('admincp.emailsystem.notifications'))
                 ->setEditor(array(
                                'wysiwyg' => Phpfox::getCookie('editor_wysiwyg'),
                                'toggle' => Phpfox::getCookie('editor_wysiwyg')
                            )
                        )
        ;
	}
}
?>
