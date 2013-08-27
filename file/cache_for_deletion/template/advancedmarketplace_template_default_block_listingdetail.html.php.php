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
 echo '
<style type="text/css">
    div#content #js_block_border_advancedmarketplace_listingdetail div.menu
    {
        height:34px;
        background: #ececec;
        border-bottom: #dfdfdf;
    }
    div#content #js_block_border_advancedmarketplace_listingdetail div.menu ul
    {
        padding-left: 10px;
    }
    div#content #js_block_border_advancedmarketplace_listingdetail div.menu ul li a
    {
        line-height: 33px;
        font-size: 14px;
        color: #000;
    }
    div#content #js_block_border_advancedmarketplace_listingdetail div.menu ul li.active
    {
        background: url(';  echo $this->_aVars['corepath'];  echo 'module/advancedmarketplace/static/image/default/menu-l.png) no-repeat;
    padding-left: 14px;
    margin-top: -4px;
    }
    div#content #js_block_border_advancedmarketplace_listingdetail div.menu ul li.active a
    {
        background: url(';  echo $this->_aVars['corepath'];  echo 'module/advancedmarketplace/static/image/default/menu-r.png) no-repeat 100% 0;
    display: block;
    line-height: 38px;
    padding-right: 22px;
    }
    div#content #js_block_border_advancedmarketplace_listingdetail div.menu ul li a
    {
        border:none;
        border-radius:0;
        background: none;
    }
    .short_description_title
    {
        background: url(';  echo $this->_aVars['corepath'];  echo 'module/advancedmarketplace/static/image/default/border.png) repeat-x bottom;
    margin: 20px 0;
    }
    .description_title
    {
        background: #fff;
        font-size: 14px;
        padding: 4px 19px 4px 0;
    }
    .listing_detail
    {
        padding-left: 10px;
    }
    .short_description_content
    {
        color: #7B7B7B;
        font-size: 12px;
    }
    .short_description_content table tr td
    {
        height: 20px;
        width: 135px;
    }
	
	#yn_advmarket_wrapper .content {
		
	}
</style>    
'; ?>

<div id="yn_advmarket_wrapper">
	<!---Short description -->
	<div class="listing_detail">
		<div class="short_description">
			<div class="short_description_title"><span class="description_title"><?php echo Phpfox::getPhrase('advancedmarketplace.short_description'); ?></span></div>
			<div class="short_description_content">
<?php echo Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aListing']['short_description']); ?>
			</div>
		</div>
	</div>
	<!---Listing information -->
	<div class="listing_detail">
		<div class="short_description">
			<div class="short_description_title"><span class="description_title"><?php echo Phpfox::getPhrase('advancedmarketplace.listing_information'); ?></span></div>
			<div class="short_description_content">
				<table>
					<tr>
						<td><?php echo Phpfox::getPhrase('advancedmarketplace.posted_on'); ?>:</td><td><?php echo Phpfox::getTime(Phpfox::getParam('advancedmarketplace.advancedmarketplace_view_time_stamp'), $this->_aVars['aListing']['time_stamp']); ?></td>
					</tr>
<?php if (is_array ( $this->_aVars['aListing']['categories'] ) && count ( $this->_aVars['aListing']['categories'] )): ?>
						<tr>
							<td><?php echo Phpfox::getPhrase('advancedmarketplace.category'); ?>:</td><td><?php echo Phpfox::getService('core.category')->displayView($this->_aVars['aListing']['categories']); ?></td>
						</tr>		
<?php endif; ?>
					<tr>
						<td><?php echo Phpfox::getPhrase('advancedmarketplace.posted_by'); ?>:</td><td><?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aListing']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aListing']['user_name'], ((empty($this->_aVars['aListing']['user_name']) && isset($this->_aVars['aListing']['profile_page_id'])) ? $this->_aVars['aListing']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aListing']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?></td>
					</tr>
					<tr>
						<td><?php echo Phpfox::getPhrase('advancedmarketplace.location'); ?>:</td><td>
<?php if (! empty ( $this->_aVars['aListing']['location'] )): ?>
								<div class="p_2"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aListing']['location']); ?></div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aListing']['address'] )): ?>
								<div class="p_2"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aListing']['address']); ?></div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aListing']['city'] )): ?>
								<div class="p_2"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aListing']['city']); ?></div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aListing']['postal_code'] )): ?>
								<div class="p_2"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aListing']['postal_code']); ?></div>
<?php endif; ?>
<?php echo Phpfox::getService('core.country')->getCountry($this->_aVars['aListing']['country_iso']); ?>
<?php if (! empty ( $this->_aVars['aListing']['country_child_id'] )): ?>
							<div class="p_2">&raquo; <?php echo Phpfox::getService('core.country')->getChild($this->_aVars['aListing']['country_child_id']); ?></div>
<?php endif; ?>
									
						</td>
					</tr>
				</table>
			</div>
<?php if (isset ( $this->_aVars['aListing']['map_location'] ) && $this->_aVars['aListing']['map_location'] != ""): ?>
				<div style="width:390px; height:170px; position:relative;">
					<div style="margin-left:-8px; margin-top:-8px; position:absolute; background:#fff; border:8px blue solid; width:12px; height:12px; left:50%; top:50%; z-index:200; overflow:hidden; text-indent:-1000px; border-radius:12px;">Marker</div>
					<a href="http://maps.google.com/?q=<?php echo $this->_aVars['aListing']['map_location']; ?>" target="_blank" title="<?php echo Phpfox::getPhrase('advancedmarketplace.view_this_on_google_maps'); ?>"><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $this->_aVars['aListing']['map_location']; ?>&amp;zoom=16&amp;size=390x170&amp;sensor=false&amp;maptype=roadmap" alt="" /></a>
				</div>		
				<div class="p_top_4">					
					<a href="http://maps.google.com/?q=<?php echo $this->_aVars['aListing']['map_location']; ?>" target="_blank"><?php echo Phpfox::getPhrase('advancedmarketplace.view_this_on_google_maps'); ?></a>
				</div>
<?php endif; ?>
		</div>
	</div>
<?php if (count ( $this->_aVars['aCustomFields'] ) > 0): ?>
<?php Phpfox::getBlock("advancedmarketplace.frontend.viewcustomfield", array('aCustomFields' => $this->_aVars['aCustomFields'],'cfInfors' => $this->_aVars['cfInfors'])); ?>
<?php endif; ?>
	<div class="listing_detail">
		<div class="short_description">
			<div class="short_description_title"><span class="description_title"><?php echo Phpfox::getPhrase('advancedmarketplace.over_view'); ?></span></div>
			<div class="short_description_content">
<?php echo Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aListing']['description']); ?>
			</div>
		</div>
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
