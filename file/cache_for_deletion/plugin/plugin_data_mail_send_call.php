<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'list($sTextPlain,$sTextHtml,$sSubject) = phpfox::getService(\'emailsystem.mailtemplate\')->modifyEmailTemplate($sTextPlain,$sTextHtml,$aUser,$sSubject,$this->_aSubject,$sMessage,$sEmailSig,$this->_bMessageHeader); if (Phpfox::getParam(\'facebook.enable_facebook_connect\'))
{
	
} '; ?>