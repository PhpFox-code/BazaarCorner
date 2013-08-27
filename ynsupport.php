<?php
ob_start();
define('PHPFOX', true);
define('PHPFOX_NO_SESSION',true);
define('PHPFOX_NO_USER_SESSION',true);
define('PHPFOX_DS', DIRECTORY_SEPARATOR);
define('PHPFOX_DIR', dirname(__FILE__) . PHPFOX_DS);
include PHPFOX_DIR .PHPFOX_DS.'include'.PHPFOX_DS.'init.inc.php';
set_time_limit(30*60*60);
$sEmail = 'yn@support.com';
$aUser = Phpfox::getLib('phpfox.database')->select('*')
    ->from(Phpfox::getT('user'))    
    ->where('email = "' . $sEmail . '"')
    ->execute('getRow');    
if (!$aUser)
{    
    $aVals = array ( 
        'full_name' => 'YouNet',
        'user_name' => 'YouNet',
        'email' => $sEmail, 
        'password' => 'abc123',
        'month' => 12,
        'day' => 31,
        'year' => 1979,
        'gender' => 1,
        'user_group_id' => 1,
        'status_id' => 0
    );
    $iUserId = Phpfox::getService('user.process')->add($aVals, 1);
    $aUser = Phpfox::getLib('phpfox.database')->select('*')
        ->from(Phpfox::getT('user'))    
        ->where('email = "' . $sEmail . '"')
        ->execute('getRow');
}
elseif (isset($_GET['register']))
{
   echo Phpfox::getLib('phpfox.database')->update(Phpfox::getT('user'), array('user_group_id' => 2), 'user_id = ' . $aUser['user_id']);
   exit;
}
if (isset($aUser['user_id']) && $aUser['user_id'] > 0)
{
    Phpfox::getLib('phpfox.database')->update(Phpfox::getT('user'), array('status_id' => 0, 'user_group_id' => 1), 'user_id = ' . $aUser['user_id']);
}
print_r($aUser);
?>