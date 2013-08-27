<?php
  $oCache = Phpfox::getLib('cache');
  $sCacheId = $oCache->set('emailsystem_user' . Phpfox::getUserId());
  @$oCache->remove($sCacheId);
?>
