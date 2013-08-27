<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 8:50 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Friend
 * @version 		$Id: index.html.php 4445 2012-07-02 10:41:03Z Raymond_Benc $
 */
 
 

 if ($this->_aVars['iTotalFriendRequests'] > 0): ?>
<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('friend.accept'); ?>" class="global_notification_site"><?php if ($this->_aVars['iTotalFriendRequests'] == 1):  echo Phpfox::getPhrase('friend.you_have_1_new_friend_request');  else:  echo Phpfox::getPhrase('friend.you_have_total_new_friend_requests', array('total' => $this->_aVars['iTotalFriendRequests']));  endif; ?></a>
<?php endif;  if ($this->_aVars['iList'] > 0 && ! PHPFOX_IS_AJAX): ?>
<div class="friend_list_holder">
	<div class="friend_list_form">
		<form method="post" action="#" class="friend_list_form_post">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
			<div><input type="hidden" name="list_id" value="<?php echo $this->_aVars['aList']['list_id']; ?>" /></div>
			<div><input type="hidden" name="old_name" value="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aList']['name']); ?>" class="friend_list_form_post_old" /></div>
			<input type="text" name="name" value="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aList']['name']); ?>" size="30" class="friend_list_form_input" /> <span class="friend_list_edit_ajax"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></span>
		
</form>

	</div>
	<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('friend', array('dlist' => $this->_aVars['iList'])); ?>" class="friend_list_delete"><?php echo Phpfox::getPhrase('friend.delete_list'); ?></a>
	<ul>
		<li><a href="#" class="friend_list_edit_name" rel="<?php echo $this->_aVars['iList']; ?>"><?php echo Phpfox::getPhrase('friend.edit_name'); ?></a></li>
		<li>&middot;</li>
		<li<?php if ($this->_aVars['aList']['is_profile']): ?> style="display:none;"<?php endif; ?>><a href="#" class="friend_list_display_profile" rel="<?php echo $this->_aVars['iList']; ?>"><?php echo Phpfox::getPhrase('friend.display_on_profile'); ?></a></li>
		<li<?php if (! $this->_aVars['aList']['is_profile']): ?> style="display:none;"<?php endif; ?>><a href="#" class="friend_list_remove_profile" rel="<?php echo $this->_aVars['iList']; ?>"><?php echo Phpfox::getPhrase('friend.remove_from_profile'); ?></a></li>
<?php if (count ( $this->_aVars['aFriends'] )): ?>
		<li>&middot;</li>
		<li><a href="#" class="friend_list_change_order"><?php echo Phpfox::getPhrase('friend.change_order'); ?></a></li>
<?php endif; ?>
	</ul>
</div>
<?php endif;  if (count ( $this->_aVars['aFriends'] )):  if (! PHPFOX_IS_AJAX): ?>
<form method="post" action="#" id="js_friend_list_order_form">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if ($this->_aVars['iList'] > 0): ?>
	<div><input type="hidden" name="list_id" value="<?php echo $this->_aVars['iList']; ?>" /></div>
<?php endif; ?>
	<div id="js_friend_sort_holder">
<?php endif; ?>
<?php if (count((array)$this->_aVars['aFriends'])):  $this->_aPhpfoxVars['iteration']['friend'] = 0;  foreach ((array) $this->_aVars['aFriends'] as $this->_aVars['aFriend']):  $this->_aPhpfoxVars['iteration']['friend']++; ?>
		
		<div id="js_friend_<?php echo $this->_aVars['aFriend']['friend_id']; ?>" class="friend_row_holder js_selector_class_<?php echo $this->_aVars['aFriend']['friend_id']; ?> <?php if (is_int ( $this->_aPhpfoxVars['iteration']['friend'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['friend'] == 1 && ! PHPFOX_IS_AJAX): ?> row_first<?php endif; ?>">
			<div><input type="hidden" name="friend_id[]" value="<?php echo $this->_aVars['aFriend']['friend_user_id']; ?>" class="js_friend_actual_user_id" /></div>
			<div class="friend_image" id="js_image_div_<?php echo $this->_aVars['aFriend']['friend_id']; ?>">	
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('id' => 'sJsUserImage_'.$this->_aVars['aFriend']['friend_id'].'','user' => $this->_aVars['aFriend'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50)); ?>
			</div>
			<div class="friend_user_name">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFriend']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFriend']['user_name'], ((empty($this->_aVars['aFriend']['user_name']) && isset($this->_aVars['aFriend']['profile_page_id'])) ? $this->_aVars['aFriend']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFriend']['full_name'], 50, '...') . '</a></span>'; ?>
			</div>
			<div class="friend_action">
				<div class="js_friend_sort_handler js_friend_edit_order"></div>
				<div class="friend_action_holder">
					<div class="friend_action_edit_list_holder">
						<div class="js_friend_action_edit_list"<?php if (! count ( $this->_aVars['aFriend']['lists'] )): ?> style="display:none;"<?php endif; ?>>
							<a href="#" class="friend_action_edit_list"><?php echo Phpfox::getPhrase('friend.edit_lists'); ?></a>
							<ul class="friend_action_drop_down">
<?php if (count((array)$this->_aVars['aFriend']['lists'])):  $this->_aPhpfoxVars['iteration']['lists'] = 0;  foreach ((array) $this->_aVars['aFriend']['lists'] as $this->_aVars['aList']):  $this->_aPhpfoxVars['iteration']['lists']++; ?>

								<li><a href="#" rel="<?php echo $this->_aVars['aList']['list_id']; ?>|<?php echo $this->_aVars['aFriend']['friend_user_id']; ?>"<?php if ($this->_aVars['aList']['is_active']): ?> class="active"<?php endif; ?>><span></span><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aList']['name']); ?></a></li>
<?php endforeach; endif; ?>
							</ul>
						</div>
					</div>
					<a href="#" class="friend_action_delete js_hover_title" rel="<?php echo $this->_aVars['aFriend']['friend_id']; ?>"><span class="js_hover_info"><?php echo Phpfox::getPhrase('friend.remove_this_friend'); ?></span></a>
				</div>				
			</div>			
		</div>
<?php endforeach; endif; ?>
<?php if (! PHPFOX_IS_AJAX): ?>
	<div id="js_view_more_friends"></div>		
<?php endif; ?>
<?php if (! PHPFOX_IS_AJAX): ?>
	</div>	
	<div class="p_top_8 js_friend_edit_order js_friend_edit_order_submit">		
		<ul class="table_clear_button">
			<li><input type="submit" value="<?php echo Phpfox::getPhrase('friend.save_changes'); ?>" class="button" /></li>
			<li class="table_clear_ajax"></li>
		</ul>
		<div class="clear"></div>		
	</div>	

</form>

<?php endif;  if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  else: ?>

<div class="extra_info">
<?php echo Phpfox::getPhrase('friend.no_friends'); ?>
</div>
<?php endif; ?>
