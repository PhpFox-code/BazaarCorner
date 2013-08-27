<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 7, 2013, 3:59 pm */ ?>
<?php if (! empty ( $this->_aVars['sStyleLogo'] )): ?>
<div class="custom_logo"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''); ?>"><img src="<?php echo $this->_aVars['sStyleLogo']; ?>" alt="<?php echo Phpfox::getParam('core.site_title'); ?>" /></a></div>
<?php else: ?>
<?php if (trim ( phpfox ::getParam('core.site_title')) != ""): ?>
		<div class="site-title"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''); ?>"><?php echo Phpfox::getParam('core.site_title'); ?></a></div>
<?php else: ?>
		<div class="logo"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''); ?>"></a></div>
<?php endif; ?>
<?php endif; ?>
