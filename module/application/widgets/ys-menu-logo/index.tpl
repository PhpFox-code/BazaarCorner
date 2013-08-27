<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2011 YouNet Developments
 */
?>

<?php $title = Engine_Api::_()->getApi('settings', 'core')->getSetting('core_general_site_title', $this->translate('_SITE_TITLE')) ?>
<?php $route = $this->viewer()->getIdentity()
             ? array('route'=>'user_general', 'action'=>'home')
             : array('route'=>'default'); ?>
 <div class="Logo">
<?php echo $this->htmlLink($route, "<img src='" . $this->baseUrl('/application/themes/yousport/images/logo.png') . "'>")?>
</div>
