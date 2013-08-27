<?php
  if (!defined('PHPFOX_INSTALLER') && !Phpfox::getParam('user.verify_email_at_signup') && !Phpfox::getParam('user.approve_users') && !isset($bDoNotAddFeed))
  {
      define('EMAILSYSTEM_EMAIL_MODIFY','register');
  }
?>
