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
    .today_listing .large_listing_image img
    {
        max-width: 200px;
        max-height: 200px;
        padding:0 2px;
    }
   .content_listing_view
   {
       text-align: center;
   }
   .listing_rate
   {
       /* background: url(';  echo $this->_aVars['corepath'];  echo 'module/advancedmarketplace/static/image/default/rate.png); */
       height: 25px;
   }
   .total_view_listing
   {
       font-size: 12px;
       color: #565656;
       padding:10px;
   }
   .yn_detail_feature_listing
   {
		left: 2px;
		margin-top: 2px;
   }
   .yn_detail_sponsor_listing
   {
		left: 2px;
		margin-top: 2px;
   }
'; ?>

<?php if (( ( int ) PHPFOX ::getUserId() !== ( ( int ) $this->_aVars['aListing']['user_id'] ) )): ?>
   .content_listing_view:hover {
		cursor: pointer;
   }
   
   .content_listing_view:hover .total_view_listing {
		cursor: pointer;
		text-decoration: underline;
   }
<?php endif; ?>
</style>

<div class="today_listing">
    <div class="large_listing_image">
<?php if (isset ( $this->_aVars['sView'] ) && $this->_aVars['sView'] == 'featured'): ?>
<?php else: ?>
		<div id="js_featured_phrase_<?php echo $this->_aVars['aListing']['listing_id']; ?>"  class="row_featured_link yn_detail_feature_listing"<?php if (! $this->_aVars['aListing']['is_featured']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('advancedmarketplace.featured'); ?>
		</div>					
<?php endif; ?>
		<div id="js_sponsor_phrase_<?php echo $this->_aVars['aListing']['listing_id']; ?>" class="row_sponsored_link yn_detail_sponsor_listing"<?php if (! $this->_aVars['aListing']['is_sponsor']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('advancedmarketplace.sponsored'); ?>
		</div>
		
<?php if ($this->_aVars['aListing']['image_path'] != NULL): ?><a title="<?php echo $this->_aVars['aListing']['title']; ?>" class="js_marketplace_click_image no_ajax_link" href="<?php echo $this->_aVars['advancedmarketplace_url_image'];  echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aListing"]["image_path"], "_400"); ?>">
				<img title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['advancedmarketplace_url_image'];  echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aListing"]["image_path"], "_200"); ?>" max_width='180' max_height='180' style="max-width: 180px; max-height: 180px;" />
			</a><?php else: ?><img title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/noimage.png" max_width='180' max_height='180' style="max-width: 180px; max-height: 180px;" /><?php endif; ?>
	</div>
    <div class="content_listing_view" <?php if (( ( int ) PHPFOX ::getUserId() !== ( ( int ) $this->_aVars['aListing']['user_id'] ) )): ?>onclick="tb_show('<?php echo Phpfox::getPhrase("advancedmarketplace.rating"); ?>', $.ajaxBox('advancedmarketplace.ratePopup', 'height=300&width=550&id=<?php echo $this->_aVars['aListing']['listing_id']; ?>')); return false;"<?php endif; ?>>
        <div class="listing_rate_detail">
<?php for($i = 1; $i <= floor($this->_aVars["rating"] / 2); $i++) { ?>
				<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/staron.png" />
<?php } ?>
<?php for($i = 1; $i <= ceil(5 - $this->_aVars["rating"] / 2); $i++) { ?>
				<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/staroff.png" />
<?php } ?>
		</div>
        <div class="total_view_listing"><span class="review-count"><?php echo $this->_aVars['iRatingCount']; ?></span> <?php echo Phpfox::getPhrase('advancedmarketplace.review_s'); ?></div>
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
