<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (Phpfox::getParam(\'facebook.enable_facebook_connect\') && (int) Phpfox::getUserBy(\'fb_user_id\') > 0)
{
	Phpfox::getLib(\'url\')->send(\'facebook.logout\');
} '; ?>