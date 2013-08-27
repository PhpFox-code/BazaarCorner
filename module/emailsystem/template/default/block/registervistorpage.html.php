<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');
?>
<div class="user_register_holder emailsystemregister">
    <div class="holder">
        <div class="user_register_form" align="right">
            <div id="loading_js_emp"></div>
            <div class="" id="register_emp">
                <div class="p_4">
                    <input type="text" value="{phrase var='emailsystem.email_to_receive_newsletters'}" name="inp_email" size="39" id="inp_email" onfocus="if(this.value=='{phrase var='emailsystem.email_to_receive_newsletters'}')this.value='';" onblur="if(this.value=='')this.value='{phrase var='emailsystem.email_to_receive_newsletters'}';">
                    <input type="submit" class="button" value="{phrase var='core.submit'}" name="reg_submit" onclick="register();return false;" style="margin-bottom:5px;*margin-bottom: 10px;">
                </div>
                <div class="clear"><div>
                <div class="message" id="message_inp" style="display: none;margin-left: 3px;width: 76%;text-align:left;">
                    aa
                </div>
                <div class="p_top_4">
                    
                </div>

            </div>
        </div>
    </div>
</div>
{literal}
<script type="text/javascript">
    function register()
    {
        var email = $('#inp_email').val();
        var res = validateEmail(email);
        
        if( res == false)
        {
             alert('{/literal}{phrase var='emailsystem.please_enter_a_valid_email_address'}{literal}');
        }
        else
        {
            $('#loading_js_emp').html($.ajaxProcess(''));
            $('#register_emp').hide();
            $('#register_emp').ajaxCall('emailsystem.register','emailsystem='+email);
        }
        return false;
    }
    function validateEmail(id)
    {
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;
        return emailPattern.test(id);

    }  
    
</script>

<style type="text/css">
.emailsystemregister
{
   
}
</style>
{/literal}
