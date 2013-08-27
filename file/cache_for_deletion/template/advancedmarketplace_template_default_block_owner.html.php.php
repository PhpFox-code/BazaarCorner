<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:12 am */ ?>
<?php if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
<div class="block<?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?> js_sortable<?php endif;  if (isset ( $this->_aVars['sCustomClassName'] )): ?> <?php echo $this->_aVars['sCustomClassName'];  endif; ?>"<?php if (isset ( $this->_aVars['sBlockBorderJsId'] )): ?> id="js_block_border_<?php echo $this->_aVars['sBlockBorderJsId']; ?>"<?php endif;  if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) && Phpfox ::getLib('module')->blockIsHidden('js_block_border_' . $this->_aVars['sBlockBorderJsId'] . '' )): ?> style="display:none;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['sHeader'] ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
		<div class="title <?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?>js_sortable_header<?php endif; ?>">		
<?php if (isset ( $this->_aVars['sBlockTitleBar'] )): ?>
<?php echo $this->_aVars['sBlockTitleBar']; ?>
<?php endif; ?>
<?php if (( isset ( $this->_aVars['aEditBar'] ) && Phpfox ::isUser())): ?>
			<div class="js_edit_header_bar">
				<a href="#" title="<?php echo Phpfox::getPhrase('core.edit_this_block'); ?>" onclick="$.ajaxCall('<?php echo $this->_aVars['aEditBar']['ajax_call']; ?>', 'block_id=<?php echo $this->_aVars['sBlockBorderJsId'];  if (isset ( $this->_aVars['aEditBar']['params'] )):  echo $this->_aVars['aEditBar']['params'];  endif; ?>'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_edit.png','alt' => '','class' => 'v_middle')); ?></a>				
			</div>
<?php endif; ?>
<?php if (true || isset ( $this->_aVars['sDeleteBlock'] )): ?>
			<div class="js_edit_header_bar js_edit_header_hover" style="display:none;">
<?php if (Phpfox ::getService('theme')->isInDnDMode()): ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')){
					$(this).parents('.block:first').remove(); $.ajaxCall('core.removeBlockDnD', 'sController=' + oParams['sController'] 
					+ '&amp;block_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>');} return false;"title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>
<?php else: ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')) { $(this).parents('.block:first').remove();
					$.ajaxCall('core.hideBlock', 'sController=' + oParams['sController'] + '&amp;type_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>&amp;block_id=' + $(this).parents('.block:first').attr('id')); } return false;" title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>				
<?php endif; ?>
			</div>
			
<?php endif; ?>
<?php if (empty ( $this->_aVars['sHeader'] )): ?>
<?php echo $this->_aVars['sBlockShowName']; ?>
<?php else: ?>
<?php echo $this->_aVars['sHeader']; ?>
<?php endif; ?>
              
                <!--  VIEW ALL !-->
<?php if (isset ( $this->_aVars['sLinkAll'] ) && ! isset ( $this->_aVars['aEditBar'] ) && ! isset ( $this->_aVars['sDeleteBlock'] )): ?>
                <a class="view_all_nav" href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['sLinkAll']); ?>"><?php echo Phpfox::getPhrase('yousport.view_all'); ?> <?php echo $this->_aVars['blk']; ?></a>
<?php unset($this->_aVars['sLinkAll']); ?>
<?php endif; ?>
            <!--  END VIEW ALL !-->
		</div>
           
<?php endif; ?>
<?php if (isset ( $this->_aVars['aEditBar'] )): ?>
	<div id="js_edit_block_<?php echo $this->_aVars['sBlockBorderJsId']; ?>" class="edit_bar" style="display:none;"></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aMenu'] ) && count ( $this->_aVars['aMenu'] )): ?>
	<div class="menu">
	<ul>
<?php if (count((array)$this->_aVars['aMenu'])):  $this->_aPhpfoxVars['iteration']['content'] = 0;  foreach ((array) $this->_aVars['aMenu'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['content']++; ?>
 
		<li class="<?php if (count ( $this->_aVars['aMenu'] ) == $this->_aPhpfoxVars['iteration']['content']): ?> last<?php endif;  if ($this->_aPhpfoxVars['iteration']['content'] == 1): ?> first active<?php endif; ?>"><a href="<?php echo $this->_aVars['sLink']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a></li>
<?php endforeach; endif; ?>
	</ul>
	<div class="clear"></div>
	</div>
<?php unset($this->_aVars['aMenu']); ?>
<?php endif; ?>
	<div class="content"<?php if (isset ( $this->_aVars['sBlockJsId'] )): ?> id="js_block_content_<?php echo $this->_aVars['sBlockJsId']; ?>"<?php endif; ?>>
<?php endif; ?>
		<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 echo '
<style type="text/css">
   .row_title_info .username_listing
   {
       margin-bottom: 5px;
   }
   .username_listing a
   {
       font-size: 12px;
   }
   .button_follow
   {
       background: url(';  echo $this->_aVars['corepath'];  echo 'module/advancedmarketplace/static/image/default/follow.png) repeat-x center;
       color: #000000;
        font-size: 12px;
        line-height: 20px;
        padding: 3px 11px;
        border: 1px solid #dfdfdf;
   }
   .owner_left{width: 55px;}
   .inline_list ul{
		display: inline;
   }
   .margin-bottom-10 {
		margin-bottom: 10px;
   }
</style>
'; ?>

<div class="today_listing margin-bottom-10">
    <div class="content_listing">
        <div class="row_title_image">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aListing'],'suffix' => '_50_square','max_width' => '50','max_height' => '50')); ?>

			
		</div>

		<div class="row_title_info">
			<div class="username_listing"><a href="#"><?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aListing']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aListing']['user_name'], ((empty($this->_aVars['aListing']['user_name']) && isset($this->_aVars['aListing']['profile_page_id'])) ? $this->_aVars['aListing']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aListing']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?></a></div>
<?php if (phpfox ::getUserId() != $this->_aVars['aListing']['user_id'] && phpfox ::getParam('advancedmarketplace.can_follow_listings')): ?>
<?php if ($this->_aVars['bFollow'] != 'follow'): ?>
					<div id="js_follow_<?php echo $this->_aVars['iFollower']; ?>" >
						<input onclick="$(this).addClass('disabled').attr('disabled','disabled'); follow('follow',<?php echo $this->_aVars['aListing']['user_id']; ?>,<?php echo $this->_aVars['iFollower']; ?>); return false;" type="button" class="button"  value="<?php echo Phpfox::getPhrase('advancedmarketplace.follow'); ?>" />
					</div>
<?php else: ?>
					<div id="js_follow_<?php echo $this->_aVars['iFollower']; ?>" >
						<input onclick="$(this).addClass('disabled').attr('disabled','disabled');follow('unfollow',<?php echo $this->_aVars['aListing']['user_id']; ?>,<?php echo $this->_aVars['iFollower']; ?>); return false;" type="button" class="button" id="js_follow_<?php echo $this->_aVars['iFollower']; ?>" value="<?php echo Phpfox::getPhrase('advancedmarketplace.unfollow'); ?>" />
					</div>
<?php endif; ?>
<?php endif; ?>
		</div>
    </div>
    <div class="owner_listing_info" style="padding-top: 10px;">
        <table>
<?php if (isset ( $this->_aVars['aListing']['tag_list'] )): ?>
				<tr class="extra_info">
					<td class="" colspan="2">
<?php Phpfox::getBlock('tag.item', array('sType' => $this->_aVars['sTagType'],'sTags' => $this->_aVars['aListing']['tag_list'],'iItemId' => $this->_aVars['aListing']['listing_id'],'iUserId' => $this->_aVars['aListing']['user_id'])); ?>
					</td>
				</tr>
<?php endif; ?>
            <tr class="extra_info">
				<td class="" colspan="2">
					<span class="item_tag"><?php echo Phpfox::getPhrase('advancedmarketplace.last_updated'); ?>: </span>
					<span>
<?php if (isset ( $this->_aVars['aListing']['update_timestamp'] )): ?>
<?php echo Phpfox::getTime(Phpfox::getParam('advancedmarketplace.advancedmarketplace_view_time_stamp'), $this->_aVars['aListing']['update_timestamp']); ?>
<?php else: ?>
<?php echo Phpfox::getTime(Phpfox::getParam('advancedmarketplace.advancedmarketplace_view_time_stamp'), $this->_aVars['aListing']['time_stamp']); ?>
<?php endif; ?>
					</span>
				</td>
            </tr>
			<tr class="extra_info">
				<td class="inline_list">
					<span class="item_tag"><?php echo Phpfox::getPhrase('advancedmarketplace.category'); ?></span>: <?php echo Phpfox::getService('core.category')->displayView($this->_aVars['aListing']['categories']); ?>
				</td>
			</tr>
        </table>
        <div><?php echo $this->_aVars['aListing']['total_view']; ?> <?php echo Phpfox::getPhrase('advancedmarketplace.view_s'); ?></div>
    </div>
</div>


		
		
<?php if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
	</div>
<?php if (isset ( $this->_aVars['aFooter'] ) && count ( $this->_aVars['aFooter'] )): ?>
	<div class="bottom">
		<ul>
<?php if (count((array)$this->_aVars['aFooter'])):  $this->_aPhpfoxVars['iteration']['block'] = 0;  foreach ((array) $this->_aVars['aFooter'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['block']++; ?>

				<li id="js_block_bottom_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"<?php if ($this->_aPhpfoxVars['iteration']['block'] == 1): ?> class="first"<?php endif; ?>>
<?php if ($this->_aVars['sLink'] == '#'): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'ajax_image')); ?>
<?php endif; ?>
					<a href="<?php echo $this->_aVars['sLink']; ?>" id="js_block_bottom_link_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a>
				</li>
<?php endforeach; endif; ?>
		</ul>
	</div>
<?php endif; ?>
</div>
<?php unset($this->_aVars['sHeader'], $this->_aVars['sModule'], $this->_aVars['sComponent'], $this->_aVars['aFooter'], $this->_aVars['sBlockBorderJsId'], $this->_aVars['bBlockDisableSort'], $this->_aVars['bBlockCanMove'], $this->_aVars['aEditBar'], $this->_aVars['sDeleteBlock'], $this->_aVars['sBlockTitleBar'], $this->_aVars['sBlockJsId'], $this->_aVars['sCustomClassName']);  endif; ?>

<?php Phpfox::getBlock('ad.inner', array('sClass' => $this->_aVars['sClass'])); ?>
