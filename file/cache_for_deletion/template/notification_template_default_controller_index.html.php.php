<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 8:18 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: $
 */
 
 

 if (count ( $this->_aVars['aNotifications'] )): ?>
<div id="js_notification_holder">
	<ul class="notification_holder">
<?php if (count((array)$this->_aVars['aNotifications'])):  $this->_aPhpfoxVars['iteration']['notifications'] = 0;  foreach ((array) $this->_aVars['aNotifications'] as $this->_aVars['sDate'] => $this->_aVars['aSubNotifications']):  $this->_aPhpfoxVars['iteration']['notifications']++; ?>

		<li class="notification_date"><?php echo $this->_aVars['sDate']; ?></li>
<?php if (count((array)$this->_aVars['aSubNotifications'])):  foreach ((array) $this->_aVars['aSubNotifications'] as $this->_aVars['aNotification']): ?>
		<li id="js_notification_<?php echo $this->_aVars['aNotification']['notification_id']; ?>" class="<?php if (! $this->_aVars['aNotification']['is_seen']): ?> is_new<?php endif; ?>"><?php if (! empty ( $this->_aVars['aNotification']['icon'] )): ?><img src="<?php echo $this->_aVars['aNotification']['icon']; ?>" alt="" class="v_middle" /> <?php endif; ?><a href="<?php echo $this->_aVars['aNotification']['link']; ?>" class="main_link<?php if (! $this->_aVars['aNotification']['is_seen']): ?> is_new<?php endif; ?>"><?php echo $this->_aVars['aNotification']['message']; ?></a> - <span class="extra_info"><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aNotification']['time_stamp']); ?></span><span class="notification_delete">&nbsp;&nbsp;-&nbsp;&nbsp;<a href="#" class="js_hover_title" onclick="$.ajaxCall('notification.delete', 'id=<?php echo $this->_aVars['aNotification']['notification_id']; ?>'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/delete.gif','class' => 'v_middle')); ?><span class="js_hover_info"><?php echo Phpfox::getPhrase('notification.delete_this_notification'); ?></span></a></span></li>
<?php endforeach; endif; ?>
<?php endforeach; endif; ?>
	</ul>

	<ul class="table_clear_button" id="js_notification_list_delete">
		<li><input type="button" value="<?php echo Phpfox::getPhrase('notification.delete_all_notifications'); ?>" class="button" onclick="$Core.processForm('#js_notification_list_delete'); $(this).ajaxCall('notification.removeAll'); return false;" /></li>
		<li class="table_clear_ajax"></li>
	</ul>
	<div class="clear"></div>
</div>
<?php endif; ?>

<div id="js_no_notifications"<?php if (count ( $this->_aVars['aNotifications'] )): ?> style="display:none;"<?php endif; ?>>
	<div class="extra_info">
<?php echo Phpfox::getPhrase('notification.no_new_notifications'); ?>
	</div>
	<br />
	<br />
	<ul class="table_clear_button" id="js_notification_list_delete_clear">
		<li><input type="button" value="<?php echo Phpfox::getPhrase('notification.reset_notification_count'); ?>" class="button button_off" onclick="$Core.processForm('#js_notification_list_delete_clear'); $(this).ajaxCall('notification.removeAll'); return false;" /></li>
		<li class="table_clear_ajax"></li>
	</ul>
	<div class="clear"></div>	 
	 
</div>
