<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: August 17, 2013, 6:34 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: mobile.html.php 3335 2011-10-20 17:26:57Z Raymond_Benc $
 */
 
 

?>
<div id="mobile_profile_header">
	<div id="mobile_profile_photo">
		<div id="mobile_profile_photo_image">
<?php echo $this->_aVars['sProfileImage']; ?>
		</div>
		<div id="mobile_profile_photo_name">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aUser']['full_name']), 50); ?>
			<ul>
<?php if (Phpfox ::getUserId() != $this->_aVars['aUser']['user_id']): ?>
<?php if (Phpfox ::isModule('mail') && Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'mail.send_message' )): ?>
					<li><a href="#" onclick="$Core.composeMessage({user_id: <?php echo $this->_aVars['aUser']['user_id']; ?>}); return false;"><?php echo Phpfox::getPhrase('profile.message'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::isModule('friend') && ! $this->_aVars['aUser']['is_friend']): ?>
					<li id="js_add_friend_on_profile"><a href="#" onclick="return $Core.addAsFriend('<?php echo $this->_aVars['aUser']['user_id']; ?>');" title="<?php echo Phpfox::getPhrase('profile.add_to_friends'); ?>"><?php echo Phpfox::getPhrase('profile.add_to_friends'); ?></a></li>
<?php endif; ?>
<?php if ($this->_aVars['bCanPoke'] && Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'poke.can_send_poke' )): ?>
					<li id="liPoke">
						<a href="#" id="section_poke" onclick="$Core.box('poke.poke', 400, 'user_id=<?php echo $this->_aVars['aUser']['user_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('poke.poke', array('full_name' => '')); ?></a>
					</li>
<?php endif; ?>
<?php endif; ?>
			</ul>
			<div class="clear"></div>				
		</div>			
	</div>
	<ul class="mobile_profile_header_menu">
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aUser']['user_name']); ?>"<?php if (! $this->_aVars['bIsInfo']): ?> class="active"<?php endif; ?>><?php echo Phpfox::getPhrase('profile.wall'); ?></a></li>			
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aUser']['user_name'].'.info'); ?>"<?php if ($this->_aVars['bIsInfo']): ?> class="active"<?php endif; ?>><?php echo Phpfox::getPhrase('profile.info'); ?></a></li>
	</ul>
	<div class="clear"></div>
</div>
