<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: login-block.html.php 3826 2011-12-16 12:30:19Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{plugin call='user.template_controller_login_block__start'}
<form method="post" action="{url link="user.login"}">
	<div class="p_top_4">
		<label for="js_email">{if Phpfox::getParam('user.login_type') == 'user_name'}{phrase var='user.user_name'}{elseif Phpfox::getParam('user.login_type') == 'email'}{phrase var='user.email'}{else}{phrase var='user.login'}{/if}</label>:
		<div class="p_4">
			<input type="text" name="val[login]" id="js_email" value="" size="30" style="width:90%;" />
		</div>
	</div>
	
	<div class="p_top_4">
		<label for="js_password">{phrase var='user.password'}:</label> 
		<div class="p_4">
			<input type="password" name="val[password]" id="js_password" value="" size="30" style="width:90%;" />
			<div class="p_top_8">
		
			</div>
		</div>
	</div>
	
	<div class="p_top_8">
		<input type="submit" value="{phrase var='user.login_button'}" class="button" />  <strong style="padding-left: 19px;">or</strong> <div class="fbconnect_button" style="float:right;margin-right: 64px;"><fb:login-button scope="publish_stream,email,user_birthday" v="3"></fb:login-button></div>

</form>
