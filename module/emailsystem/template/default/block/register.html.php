<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');
?>
{if $controller != 'index-visitor'}
<div id="loading_js_emp"></div>
<div class="p_bottom_15" id="register_emp">
{phrase var='emailsystem.your_email'}:
<div class="p_4">
    <input type="text" value="" name="inp_email" size="24" id="inp_email">
</div>
<div class="message" id="message_inp" style="display: none;margin-left: 3px;width: 83%;text-align:left;">
    
</div>
<div class="p_top_4">
    <input type="submit" class="button" value="Submit" name="reg_submit" onclick="register();return false;">
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
{/literal}
{else}
{literal}
<style type="text/css">
#js_controller_core_index-visitor #left
{
     border:none;
}
</style>
{/literal}
{/if}