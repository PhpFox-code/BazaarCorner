<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:12 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Friend
 * @version 		$Id: search.html.php 3955 2012-02-29 11:36:38Z Miguel_Espinoza $
 */
 
 

 if (! $this->_aVars['bSearch']): ?>
<script type="text/javascript">
	var sPrivacyInputName = '<?php echo $this->_aVars['sPrivacyInputName']; ?>';
	var sSearchByValue = '';
<?php echo '
	$Behavior.searchFriendBlock = function()
	{
		sSearchByValue = $(\'.js_is_enter\').val();		
		
		if ($.browser.mozilla) 
		{
			$(\'.js_is_enter\').keypress(checkForEnter);
		} 
		else 
		{
			$(\'.js_is_enter\').keydown(checkForEnter);
		}		
	};

	updateCheckBoxes();
	
	function updateFriendsList()
	{		
		updateCheckBoxes();
	}
	
	function removeFromSelectList(sId)
	{
		$(\'.js_cached_friend_id_\' + sId + \'\').remove();
		$(\'#js_friends_checkbox_\' + sId).attr(\'checked\', false);
		$(\'#js_friend_input_\' + sId).remove();
		$(\'.js_cached_friend_id_\' + sId).remove(); return false;		
		
		return false;
	}
	
	function addFriendToSelectList(oObject, sId)
	{		
		if (oObject.checked)
		{
			iCnt = 0;
			$(\'.js_cached_friend_name\').each(function()
			{			
				iCnt++;
			});			

			if (function_exists(\'plugin_addFriendToSelectList\'))
			{
				plugin_addFriendToSelectList(sId);
			}
			'; ?>

			$('#js_selected_friends').append('<div class="js_cached_friend_name row1 js_cached_friend_id_' + sId + '' + (iCnt ? '' : ' row_first') + '"><span style="display:none;">' + sId + '</span><input type="hidden" name="val[' + sPrivacyInputName + '][]" value="' + sId + '" /><a href="#" onclick="return removeFromSelectList(' + sId + ');"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/delete.gif','class' => "delete_hover v_middle")); ?></a> ' + $('#js_friend_' + sId + '').html() + '</div>');			
			<?php echo '
		}
		else
		{
			if (function_exists(\'plugin_removeFriendToSelectList\'))
			{
				plugin_removeFriendToSelectList(sId);
			}			
			
			$(\'.js_cached_friend_id_\' + sId).remove();
			$(\'#js_friend_input_\' + sId).remove();
		}
	}
	
	function cancelFriendSelection()
	{
		if (function_exists(\'plugin_cancelFriendSelection\'))
		{
			plugin_cancelFriendSelection();
		}			
		
		$(\'#js_selected_friends\').html(\'\');	
		$Core.loadInit(); 
		tb_remove();
	}
	
	function updateCheckBoxes()
	{
		iCnt = 0;
		$(\'.js_cached_friend_name\').each(function()
		{			
			iCnt++;
			$(\'#js_friends_checkbox_\' + $(this).find(\'span\').html()).attr(\'checked\', true);
		});
		
		$(\'#js_selected_count\').html((iCnt / 2));
	}
	
	function showLoader()
	{
		$(\'#js_friend_search_content\').html($.ajaxProcess(oTranslations[\'friend.loading\'], \'large\'));
	}	
	
	function checkForEnter(event)
	{
		if (event.keyCode == 13) 
		{
			showLoader(); 
			
			$.ajaxCall(\'friend.searchAjax\', \'find=\' + $(\'#js_find_friend\').val() + \'&amp;input=\' + sPrivacyInputName + \'\');
		
			return false;	
		}
	}
'; ?>

</script>
<div id="js_friend_loader_info"></div>
<div id="js_friend_loader">
<?php if ($this->_aVars['sFriendType'] != 'mail'): ?>
	<div class="p_4">
		<div class="go_left">
<?php echo Phpfox::getPhrase('friend.view'); ?>:&nbsp;<select name="view" onchange="showLoader(); $(this).ajaxCall('friend.searchAjax', 'input=<?php echo $this->_aVars['sPrivacyInputName']; ?>'); return false;">
				<option value="all"><?php echo Phpfox::getPhrase('friend.all_friends'); ?></option>
				<option value="online"<?php if ($this->_aVars['sView'] == 'online'): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('friend.online_friends'); ?></option>
<?php if (count ( $this->_aVars['aLists'] )): ?>
				<optgroup label="<?php echo Phpfox::getPhrase('friend.friends_list'); ?>">
<?php if (count((array)$this->_aVars['aLists'])):  foreach ((array) $this->_aVars['aLists'] as $this->_aVars['aList']): ?>
					<option value="<?php echo $this->_aVars['aList']['list_id']; ?>"<?php if ($this->_aVars['sView'] == $this->_aVars['aList']['list_id']): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aList']['name']), 30); ?></option>
<?php endforeach; endif; ?>
				</optgroup>
<?php endif; ?>
			</select>
		</div>
		<div class="t_right">
			<script type="text/javascript">
				sSearchByValue = '<?php echo Phpfox::getPhrase('friend.search_by_email_full_name_or_user_name'); ?>';
			</script>
			<input type="text" class="js_is_enter v_middle default_value" name="find" value="<?php echo Phpfox::getPhrase('friend.search_by_email_full_name_or_user_name'); ?>" onfocus="if (this.value == sSearchByValue)<?php echo '{'; ?>
this.value = ''; $(this).removeClass('default_value');<?php echo '}'; ?>
" onblur="if (this.value == '')<?php echo '{'; ?>
this.value = sSearchByValue; $(this).addClass('default_value');<?php echo '}'; ?>
" id="js_find_friend" size="30" />
			<input type="button" value="<?php echo Phpfox::getPhrase('friend.find'); ?>" onclick="showLoader(); $.ajaxCall('friend.searchAjax', 'friend_module_id=<?php echo $this->_aVars['sFriendModuleId']; ?>&amp;friend_item_id=<?php echo $this->_aVars['sFriendItemId']; ?>&amp;find=' + $('#js_find_friend').val() + '&amp;input=<?php echo $this->_aVars['sPrivacyInputName']; ?>'); return false;" class="button v_middle" />
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="main_break"></div>
	<div class="separate"></div>
	
<?php else: ?>
			<input type="text" class="js_is_enter v_middle default_value" name="find" value="<?php echo Phpfox::getPhrase('friend.search_by_email_full_name_or_user_name'); ?>" onfocus="if (this.value == sSearchByValue)<?php echo '{'; ?>
this.value = ''; $(this).removeClass('default_value');<?php echo '}'; ?>
" onblur="if (this.value == '')<?php echo '{'; ?>
this.value = sSearchByValue; $(this).addClass('default_value');<?php echo '}'; ?>
" id="js_find_friend" size="30" />
			<input type="button" value="<?php echo Phpfox::getPhrase('friend.find'); ?>" onclick="showLoader(); $.ajaxCall('friend.searchAjax', 'friend_module_id=<?php echo $this->_aVars['sFriendModuleId']; ?>&amp;friend_item_id=<?php echo $this->_aVars['sFriendItemId']; ?>&amp;find=' + $('#js_find_friend').val() + '&amp;input=<?php echo $this->_aVars['sPrivacyInputName']; ?>&amp;type=<?php echo $this->_aVars['sFriendType']; ?>'); return false;" class="button v_middle" />	

	<div class="main_break"></div>
	<div class="separate"></div>		
<?php endif; ?>
<?php echo $this->_aVars['sView']; ?>
	<div class="t_center">
<?php if (count((array)$this->_aVars['aLetters'])):  foreach ((array) $this->_aVars['aLetters'] as $this->_aVars['sLetter']): ?><span style="padding-right:5px;"><a href="#" onclick="showLoader(); $.ajaxCall('friend.searchAjax', 'letter=<?php echo $this->_aVars['sLetter']; ?>&amp;input=<?php echo $this->_aVars['sPrivacyInputName']; ?>&amp;type=<?php echo $this->_aVars['sFriendType']; ?>&amp;view=<?php echo $this->_aVars['sView']; ?>'); return false;"<?php if ($this->_aVars['sActualLetter'] == $this->_aVars['sLetter']): ?> style="text-decoration:underline;"<?php endif; ?>><?php echo $this->_aVars['sLetter']; ?></a></span><?php endforeach; endif; ?>
	</div>
	<div class="main_break"></div>
	
	<div class="separate"></div>

<?php endif; ?>
	<div id="js_friend_search_content">
<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager'); ?>
		<div class="main_break"></div>
		<div class="label_flow" style="height:200px;">
<?php if (count((array)$this->_aVars['aFriends'])):  $this->_aPhpfoxVars['iteration']['friend'] = 0;  foreach ((array) $this->_aVars['aFriends'] as $this->_aVars['aFriend']):  $this->_aPhpfoxVars['iteration']['friend']++; ?>

			<div class="<?php if (is_int ( $this->_aPhpfoxVars['iteration']['friend'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['friend'] == 1): ?> row_first<?php endif;  if (isset ( $this->_aVars['aFriend']['is_active'] )): ?> row_moderate<?php endif; ?>">
<?php if (! isset ( $this->_aVars['aFriend']['is_active'] )): ?>
				<span><input type="checkbox" class="checkbox" name="friend[]" class="js_friends_checkbox" id="js_friends_checkbox_<?php echo $this->_aVars['aFriend']['user_id']; ?>" value="<?php echo $this->_aVars['aFriend']['user_id']; ?>" <?php if (isset ( $this->_aVars['aFriend']['canMessageUser'] ) && $this->_aVars['aFriend']['canMessageUser'] == false): ?>DISABLED <?php else: ?> onclick="addFriendToSelectList(this, '<?php echo $this->_aVars['aFriend']['user_id']; ?>');"<?php endif; ?> style="vertical-align:middle;" /></span>
<?php endif; ?>
				<span id="js_friend_<?php echo $this->_aVars['aFriend']['user_id']; ?>"><?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFriend']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFriend']['user_name'], ((empty($this->_aVars['aFriend']['user_name']) && isset($this->_aVars['aFriend']['profile_page_id'])) ? $this->_aVars['aFriend']['profile_page_id'] : null))) . '"target="_blank">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFriend']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>';  if (isset ( $this->_aVars['aFriend']['is_active'] )): ?> <em>(<?php echo $this->_aVars['aFriend']['is_active']; ?>)</em><?php endif;  if (isset ( $this->_aVars['aFriend']['canMessageUser'] ) && $this->_aVars['aFriend']['canMessageUser'] == false): ?> <?php echo Phpfox::getPhrase('friend.cannot_select_this_user');  endif; ?></span>
			</div>
<?php endforeach; else: ?>
			<div class="extra_info">
<?php if ($this->_aVars['sFriendType'] == 'mail'): ?>
<?php echo Phpfox::getPhrase('user.sorry_no_members_found'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('friend.sorry_no_friends_were_found'); ?>
<?php endif; ?>
			</div>
<?php endif; ?>
		</div>
	</div>
<?php if (! $this->_aVars['bSearch']): ?>
<?php if ($this->_aVars['bIsForShare']): ?>
	
<?php else: ?>
<?php if ($this->_aVars['sPrivacyInputName'] != 'invite'): ?>
	<div class="main_break t_right">		
		<input type="button" name="submit" value="<?php echo Phpfox::getPhrase('friend.use_selected'); ?>" onclick="<?php echo 'if (function_exists(\'plugin_selectSearchFriends\')) { plugin_selectSearchFriends(); } else { $Core.loadInit(); tb_remove(); }'; ?>
" class="button" />&nbsp;<input type="button" name="cancel" value="<?php echo Phpfox::getPhrase('friend.cancel'); ?>" onclick="<?php echo 'if (function_exists(\'plugin_cancelSearchFriends\')) { plugin_cancelSearchFriends(); } else { cancelFriendSelection(); }'; ?>
" class="button" />		
	</div>
<?php endif; ?>
<?php endif; ?>
</div>
<?php endif; ?>
