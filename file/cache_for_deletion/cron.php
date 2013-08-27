<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = array (
  1 => 
  array (
    'cron_id' => '1',
    'module_id' => 'log',
    'product_id' => 'phpfox',
    'next_run' => '1376840051',
    'last_run' => '1376836451',
    'type_id' => '2',
    'every' => '1',
    'is_active' => '1',
    'php_code' => 'Phpfox::getLib(\'phpfox.database\')->delete(Phpfox::getT(\'log_session\'), "last_activity < \'" . ((PHPFOX_TIME - (Phpfox::getParam(\'log.active_session\') * 60))) . "\'");
',
  ),
  2 => 
  array (
    'cron_id' => '2',
    'module_id' => 'mail',
    'product_id' => 'phpfox',
    'next_run' => '1379373401',
    'last_run' => '1376781401',
    'type_id' => '3',
    'every' => '30',
    'is_active' => '1',
    'php_code' => 'Phpfox::getService(\'mail.process\')->cronDeleteMessages();',
  ),
  3 => 
  array (
    'cron_id' => '3',
    'module_id' => 'emailsystem',
    'product_id' => 'EmailSystem',
    'next_run' => '1376839686',
    'last_run' => '1376839626',
    'type_id' => '1',
    'every' => '1',
    'is_active' => '1',
    'php_code' => 'Phpfox::getService(\'emailsystem.cron\')->cronUpdateUsers();',
  ),
  4 => 
  array (
    'cron_id' => '4',
    'module_id' => 'emailsystem',
    'product_id' => 'EmailSystem',
    'next_run' => '1376839686',
    'last_run' => '1376839626',
    'type_id' => '1',
    'every' => '1',
    'is_active' => '1',
    'php_code' => 'Phpfox::getService(\'emailsystem.cron\')->cronSendLetter();',
  ),
  5 => 
  array (
    'cron_id' => '5',
    'module_id' => 'emailsystem',
    'product_id' => 'EmailSystem',
    'next_run' => '1376839686',
    'last_run' => '1376839626',
    'type_id' => '1',
    'every' => '1',
    'is_active' => '1',
    'php_code' => 'Phpfox::getService(\'emailsystem.cron\')->cronNotifications();',
  ),
); ?>