<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: March 2, 2013, 11:23 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: key.html.php 2833 2011-08-15 19:56:43Z Raymond_Benc $
 */
 
 

?>
<?php if (! $this->_aVars['bHasCurl']): ?>
Your server is missing the CURL library for PHP. In order for our product to run it requires CURL.
<?php else: ?>
<?php if (isset ( $this->_aVars['bFailed'] )): ?>
<div class="error_message">
	Invalid Hostname
</div>
<div class="p_4">
	The domain, sub-domain or sub-folder you are attempting to install phpFox to is not licensed to run our product. Please visit our <a href="http://www.phpfox.com/">clients area</a> for more information on how to
	setup your license. 
	<p>
		For more information regarding our license policy and on where you can run our product for development purposes please check <a href="http://www.phpfox.com/license/">here</a>.
	</p>
</div>
<?php else: ?>
<?php if (isset ( $this->_aVars['sError'] )): ?>
<div class="error_message">
<?php if ($this->_aVars['sError'] == 'invalid_hostname'): ?>
	Invalid Hostname
<?php elseif ($this->_aVars['sError'] == 'invalid_email'): ?>
	Invalid Email
<?php elseif ($this->_aVars['sError'] == 'invalid_password'): ?>
	Invalid Password
<?php endif; ?>
</div>
<?php endif; ?>
<?php echo $this->_aVars['sCreateJs']; ?>
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''.$this->_aVars['sUrl'].'.key'); ?>" id="js_form" onsubmit="<?php echo $this->_aVars['sGetJsForm']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div class="table_header">
			phpFox Client Details
		</div>
		<div class="table">
			<div class="table_left">
				Client Email:
			</div>
			<div class="table_right">
				<input type="text" name="val[email]" id="email" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['email']) : (isset($this->_aVars['aForms']['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['email']) : '')); ?>
" size="30" />
			</div>
		</div>
		<div class="table">
			<div class="table_left">
				Client Password:
			</div>
			<div class="table_right">
				<input type="password" name="val[password]" id="password" value="" size="30" />
			</div>
		</div>
		<div class="table_clear">
			<input type="submit" value="Submit" class="button" />
		</div>
	
</form>

	<br />
	<div class="message">
		<strong>Notice:</strong>
		<div class="p_4">
			To install your branding removal you will need to enter your phpFox login details. This is the same login details used to log into our clients area at <a href="http://www.phpfox.com/" target="_blank">http://www.phpfox.com/</a>.
			Alternatively, you can skip this step and continue with your install and optionally install your branding removal at a later time. 
			<div class="p_4 t_right">
				<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''.$this->_aVars['sUrl'].'.key'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
					<input type="submit" value="Skip This Step" class="button" name="skip" />
				
</form>

			</div>
		</div>
	</div>
<?php endif; ?>
<?php endif; ?>
