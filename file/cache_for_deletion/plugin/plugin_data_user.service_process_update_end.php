<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = '$oCache = Phpfox::getLib(\'cache\');
  $sCacheId = $oCache->set(\'emailsystem_user\' . Phpfox::getUserId());
  @$oCache->remove($sCacheId); '; ?>