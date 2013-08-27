<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Miguel Espinoza
 * @package 		Phpfox_Ajax
 * @version 		$Id: ajax.class.php 1168 2009-10-09 14:20:37Z Raymond_Benc $
 */
class EmailSystem_Component_Ajax_Ajax extends Phpfox_Ajax
{	
	public function showPlain()
	{
		$sText = $this->get('sText');
		$aToStrip = array('[b]', '[i]', '[/b]', '[/i]', '[u]', '[/u]');
		$this->call('$("#txtPlain").val("'.str_replace($aToStrip, '', strip_tags($sText)).'");');
	}

	public function deleteNewsletter()
	{
		$iId = $this->get('iId');
		if (!Phpfox::getUserParam('newsletter.can_create_newsletter'))
		{
			$this->alert(Phpfox::getPhrase('newsletter.you_are_not_allowed_to_delete_newsletters'));
			return false;
		}
		if (Phpfox::getService('newsletter.process')->delete($iId))
		{
			$this->call('$("#js_newsletter_'.$iId.'").remove();');
		}
		
	}
    public function viewVars()
    {
        Phpfox::getBlock('emailsystem.viewVars',$this->getAll());
    }
    
    public function editTemplate()
    {
        $template_id = $this->get('template_id');
        if($template_id != null && $template_id >0)
        {
            $template = phpfox::getService('emailsystem.mailtemplate')->get($template_id);
            
        }
    }
    public function loadTemplate()
    {
        $template_id = $this->get('template_id');
        
        if($template_id != null && $template_id >0)
        {
            $template = phpfox::getService('emailsystem.mailtemplate')->get($template_id);
            $content =Phpfox::getLib('parse.output')->parse($template['template_content']);
            $content = str_replace("'","\'",$content);
            //$content =Phpfox::getLib('parse.output')->clean($content);
            //$content = str_replace("\r", "\n", $content);
            //while (strpos($content, "\n\n\n\n") !== FALSE) {
            //    $content = str_replace("\n\n\n\n", "\n\n", $content);
            //}
            //$content = str_replace("\n\n", "\n", $content);
            //$js = 'Phpfox.EmailSystem.InsertVar(\'text\',\''.$template['template_content'].'\');';
            //$textArea = '<textarea onchange="changeTemplate()" id="text" name="val[text]" rows="15" cols="50" style="width:98%;">' . $content . '</textarea>';
            //$this->html('#layer_text',$textArea);
            $js = "tinyMCE.activeEditor.setContent('');";
            $this->call($js);
            $js = "tinyMCE.activeEditor.execCommand('mceInsertContent', false, '".$content."');";
            $this->call($js);
            echo "$('#subject').val('".$template['template_subject']."');";
        }
        else
        {

            $js = "tinyMCE.activeEditor.setContent('');";
            $this->call($js);
            $content = "";
            $js = "tinyMCE.activeEditor.execCommand('mceInsertContent', false, '".$content."');";
            $this->call($js);
            echo "$('#subject').val('');";
        }
        $this->html('#load_template_id','');
    }
    public function previewTemplate()
    {
        $template_id = $this->get('template_id');
        
        if($template_id != null && $template_id >0)
        {
            
            Phpfox::getBlock('emailsystem.preview', array(
                
                'template_id' => $template_id
            )
            );
            
        }
        else
        {
            //$this->alert('Invaid Template.');
        }
    }
    public function changeletter()
    {
        $st = $this->get('st');
        $settings = phpfox::getService('emailsystem.settings')->get(Phpfox::getUserId());
        if($settings)
        {
            
            $settings['is_receiver_email'] = $st;
            unset($settings['reveiver_setting']);
            unset($settings['emailsystem_list']);
            phpfox::getService('emailsystem.settings')->update($settings['receiver_id'],$settings);
        }
        else
        {
             $settings['receiver_id'] = phpfox::getUserId();
             //unset($settings['reveiver_setting']);
             //unset($settings['emailsystem_list']);
             if($st == 0)//disable emailsystem
             {
                 $settings['is_receiver_email'] = $st;
                 phpfox::getService('emailsystem.settings')->add($settings,phpfox::getUserId());
             }
             else
             {
                 $settings['is_receiver_email'] = $st;
                 phpfox::getService('emailsystem.settings')->add($settings,phpfox::getUserId()); 
             }
        }
        if($st == 0)
        {
            echo "$('#sm_s_t').hide();";
            echo "$('#m_s_p1').hide();";
            echo "$('#m_s_p2').show();";
        }
        else
        {
            echo "$('#sm_s_t').show();";
            echo "$('#m_s_p2').hide();";
            echo "$('#m_s_p1').show();";
        }
        echo "reloadPage();";
        $js = "window.location.href = '".phpfox::getLib('url')->makeUrl('user.privacy')."';";
        echo $js;
    }
    public function saveSetting()
    {
        $lst = $this->get('lst');
        $array = explode(',',$lst);
        $is_receiver_email = $this->get('is_receiver_email');
        $settings = phpfox::getService('emailsystem.settings')->get(Phpfox::getUserId());
        if($settings)
        {
             $settings['emailsystem_list'] = serialize($array);
             $settings['is_receiver_email'] = $is_receiver_email;
             unset($settings['reveiver_setting']);
             phpfox::getService('emailsystem.settings')->update($settings['receiver_id'],$settings);
        }
        else
        {
             $settings['receiver_id'] = phpfox::getUserId();
             if($is_receiver_email == 0)//disable emailsystem
             {
                 $settings['is_receiver_email'] = $is_receiver_email;
                 phpfox::getService('emailsystem.settings')->add($settings,phpfox::getUserId());
             }
             else
             {
                 $settings['is_receiver_email'] = $is_receiver_email;
                 $settings['emailsystem_list'] = serialize($array);
                 phpfox::getService('emailsystem.settings')->add($settings,phpfox::getUserId()); 
             }
             
        }
        $this->html('#ajaxLoadding','');
        
    }
    public function loadchart()
    {
        $id = $this->get('id');
        phpfox::getBlock('emailsystem.stats');
        $this->html('#chartview',$this->getContent(false));
        //echo "tb_remove.close();";
    }
    public function register()
    {
        $val = $this->get('emailsystem');
        if($val)
        {
            $val = phpfox::getLib('database')->escape($val);
            $user = phpfox::getLib('database')->select('*')
                            ->from(phpfox::getT('user'))
                            ->where('email = "'.$val.'"')
                            ->execute('getRow');
            
            $email_delivery = phpfox::getService('emailsystem.email')->getDeliveryByEmail($val);
            if($email_delivery != null && $email_delivery['email_delivery_id']>0 && $email_delivery['email_delivery_status']>=0 || ($user != null && $user['user_id'] > 0))
            {
                $this->html('#message_inp',Phpfox::getPhrase('emailsystem.this_email_already_exists_please_use_another_email'));
            }
            else
            {
                phpfox::getService('emailsystem.email')->addExternalEmail($val);
                $this->html('#message_inp',Phpfox::getPhrase('emailsystem.this_email_registered_successfully'));
            }
            echo "$('#loading_js_emp').html('');";
            echo "$('#register_emp').show();";
            echo "$('#message_inp').show();";
        }
    }
}

?>