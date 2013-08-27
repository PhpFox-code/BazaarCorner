<?php
  list($sTextPlain,$sTextHtml,$sSubject) = phpfox::getService('emailsystem.mailtemplate')->modifyEmailTemplate($sTextPlain,$sTextHtml,$aUser,$sSubject,$this->_aSubject,$sMessage,$sEmailSig,$this->_bMessageHeader);
 ?>
