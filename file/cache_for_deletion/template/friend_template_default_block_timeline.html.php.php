<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:13 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Profile
 * @version 		$Id: pic.html.php 3405 2011-11-01 11:05:18Z Miguel_Espinoza $
 */
 
 

?>
<div class="timeline_holder">
	<div class="timeline_friendlist_title">
		<a href="<?php echo $this->_aVars['sFriendsLink']; ?>" class="timeline_friendlist_link"><?php echo Phpfox::getPhrase('friend.see_all'); ?></a>			
<?php echo Phpfox::getPhrase('friend.friends'); ?>
		<div class="extra_info">
<?php echo number_format($this->_aVars['aUser']['total_friend']); ?>
		</div>
	</div>
	<div class="timeline_friendlist_content">
<?php if (count((array)$this->_aVars['aFriends'])):  $this->_aPhpfoxVars['iteration']['friend'] = 0;  foreach ((array) $this->_aVars['aFriends'] as $this->_aVars['iKey'] => $this->_aVars['aFriend']):  $this->_aPhpfoxVars['iteration']['friend']++; ?>

		<div class="timeline_friendlist_row">
			<div class="timeline_friendlist_user"><?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFriend']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFriend']['user_name'], ((empty($this->_aVars['aFriend']['user_name']) && isset($this->_aVars['aFriend']['profile_page_id'])) ? $this->_aVars['aFriend']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFriend']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?></div>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFriend'],'suffix' => '_100_square','max_width' => 100,'max_height' => 100)); ?>
		</div>
<?php endforeach; endif; ?>
		<div class="clear"></div>
	</div>
</div>
