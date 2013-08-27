<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:08 am */ ?>
<?php


 echo '
<script language="javascript" type="text/javascript">
	$Behavior.advmarket_indexaction = function(){
		if($("#jhslider").size() > 0) {
			$($(".header_bar_float").get(2)).hide();
			$($(".header_bar_float").get(1)).hide();
		}
	};
	$(\'.header_bar_menu\').hide();
</script>
'; ?>

<?php if (! count ( $this->_aVars['aListings'] )): ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('advancedmarketplace.no_advancedmarketplace_listings_found'); ?>
</div>
<?php else:  echo '
<style type="text/css">
	.view_more_link {
		background-position: 64% 60% !important;
		padding-left: 170px !important;
	}
</style>

'; ?>


<?php if (count((array)$this->_aVars['aListings'])):  $this->_aPhpfoxVars['iteration']['listings'] = 0;  foreach ((array) $this->_aVars['aListings'] as $this->_aVars['aListing']):  $this->_aPhpfoxVars['iteration']['listings']++; ?>

<div id="js_mp_item_holder_<?php echo $this->_aVars['aListing']['listing_id']; ?>" class="js_listing_parent <?php if ($this->_aVars['aListing']['is_sponsor']): ?>row_sponsored <?php endif;  if ($this->_aVars['aListing']['is_featured']): ?>row_featured <?php endif;  if ($this->_aVars['aListing']['view_id'] == 1 && ! isset ( $this->_aVars['bIsInPendingMode'] )): ?>row_moderate <?php endif;  if (is_int ( $this->_aPhpfoxVars['iteration']['listings'] )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['listings'] == 1): ?> row_first<?php endif; ?>">

<?php if ($this->_aVars['aListing']['view_id'] == '1' && ! isset ( $this->_aVars['bIsInPendingMode'] )): ?>
    <div class="row_moderate_info">
<?php echo Phpfox::getPhrase('advancedmarketplace.pending_approval'); ?>
    </div>
<?php endif; ?>

<?php if (! Phpfox ::isMobile()): ?>
    <div class="row_title_image_header">

<?php if (isset ( $this->_aVars['sView'] ) && $this->_aVars['sView'] == 'featured'): ?>
<?php else: ?>
        <div id="js_featured_phrase_<?php echo $this->_aVars['aListing']['listing_id']; ?>" class="row_featured_link"<?php if (! $this->_aVars['aListing']['is_featured']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('advancedmarketplace.featured'); ?>
    </div>					
<?php endif; ?>
    <div id="js_sponsor_phrase_<?php echo $this->_aVars['aListing']['listing_id']; ?>" class="js_sponsor_event row_sponsored_link"<?php if (! $this->_aVars['aListing']['is_sponsor']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('advancedmarketplace.sponsored'); ?>
</div>					

<a href="<?php echo $this->_aVars['aListing']['url']; ?>"><?php if ($this->_aVars['aListing']['image_path'] != NULL): ?><img title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['advancedmarketplace_url_image'] . PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aListing"]["image_path"], "_120"); ?>" max_width='120' max_height='120' /><?php else: ?><img title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/noimage.png" style="max-width:120px; max-height:90px" max-width='120' max-height='90' /><?php endif; ?></a>
	
	<div class="listing_rate" style="">
		<div>
<?php for($i = 1; $i <= floor($this->_aVars["aListing"]["rating"] / 2); $i++) { ?>
				<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/staronsm.png" />
<?php } ?>
<?php for($i = 1; $i <= ceil(5 - $this->_aVars["aListing"]["rating"] / 2); $i++) { ?>
				<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/staroffsm.png" />
<?php } ?>
		</div>
		<div>
<?php echo $this->_aVars['aListing']['rating_count']; ?> <?php echo Phpfox::getPhrase('advancedmarketplace.review_s'); ?>
		</div>
	</div>
</div>				
<div class="row_title_image_header_body" style="min-height: 160px!important;">				
<?php endif; ?>
    <div class="row_title">				


        <div class="row_title_image">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aListing'],'suffix' => '_50_square','max_width' => '50','max_height' => '50')); ?>

<?php if (( $this->_aVars['aListing']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('advancedmarketplace.can_edit_own_listing')) || Phpfox ::getUserParam('advancedmarketplace.can_edit_other_listing') || ( $this->_aVars['aListing']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('advancedmarketplace.can_delete_own_listing')) || Phpfox ::getUserParam('advancedmarketplace.can_delete_other_listings') || ( Phpfox ::getUserParam('advancedmarketplace.can_feature_listings'))): ?>
            <div class="row_edit_bar_parent">
                <div class="row_edit_bar_holder">
                    <ul>
                        <?php /* Cached: February 25, 2013, 5:08 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: menu.html.php 3346 2011-10-24 15:20:05Z Raymond_Benc $
 */
 
 

?>
<?php if (( $this->_aVars['aListing']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('advancedmarketplace.can_edit_own_listing')) || Phpfox ::getUserParam('advancedmarketplace.can_edit_other_listing')): ?>
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace.add', array('id' => $this->_aVars['aListing']['listing_id'])); ?>" title="<?php echo Phpfox::getPhrase('advancedmarketplace.edit_listing'); ?>"><?php echo Phpfox::getPhrase('advancedmarketplace.edit_listing'); ?></a></li>	
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace.add.customize', array('id' => $this->_aVars['aListing']['listing_id'])); ?>" title="<?php echo Phpfox::getPhrase('advancedmarketplace.manage_photos'); ?>"><?php echo Phpfox::getPhrase('advancedmarketplace.manage_photos'); ?></a></li>	
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace.add.invite', array('id' => $this->_aVars['aListing']['listing_id'])); ?>" title="<?php echo Phpfox::getPhrase('advancedmarketplace.send_invitations'); ?>"><?php echo Phpfox::getPhrase('advancedmarketplace.send_invitations'); ?></a></li>	
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace.add.manage', array('id' => $this->_aVars['aListing']['listing_id'])); ?>" title="<?php echo Phpfox::getPhrase('advancedmarketplace.manage_invites'); ?>"><?php echo Phpfox::getPhrase('advancedmarketplace.manage_invites'); ?></a></li>	
<?php endif; ?>
<?php if (Phpfox ::getUserParam('advancedmarketplace.can_feature_listings') && $this->_aVars['aListing']['post_status'] != 2): ?>
		<li class="js_advancedmarketplace_is_feature" <?php if ($this->_aVars['aListing']['is_featured']): ?> style="display:none;"<?php endif; ?>><a href="#" onclick="$('#js_featured_phrase_<?php echo $this->_aVars['aListing']['listing_id']; ?>').show(); $.ajaxCall('advancedmarketplace.feature', 'listing_id=<?php echo $this->_aVars['aListing']['listing_id']; ?>&amp;type=1', 'GET'); $(this).parent().hide(); $(this).parents('ul:first').find('.js_advancedmarketplace_is_un_feature').show(); return false;"><?php echo Phpfox::getPhrase('advancedmarketplace.feature'); ?></a></li>
		<li class="js_advancedmarketplace_is_un_feature" <?php if (! $this->_aVars['aListing']['is_featured']): ?> style="display:none;"<?php endif; ?>><a href="#" onclick="$('#js_featured_phrase_<?php echo $this->_aVars['aListing']['listing_id']; ?>').hide(); $.ajaxCall('advancedmarketplace.feature', 'listing_id=<?php echo $this->_aVars['aListing']['listing_id']; ?>&amp;type=0', 'GET'); $(this).parent().hide(); $(this).parents('ul:first').find('.js_advancedmarketplace_is_feature').show(); return false;"><?php echo Phpfox::getPhrase('advancedmarketplace.un_feature'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('advancedmarketplace.can_sponsor_advancedmarketplace') && $this->_aVars['aListing']['post_status'] != 2): ?>
	<li>
	    <span id="js_sponsor_<?php echo $this->_aVars['aListing']['listing_id']; ?>">
<?php if ($this->_aVars['aListing']['is_sponsor']): ?>
		<a href="#" onclick="$('#js_sponsor_phrase_<?php echo $this->_aVars['aListing']['listing_id']; ?>').hide(); $.ajaxCall('advancedmarketplace.sponsor','listing_id=<?php echo $this->_aVars['aListing']['listing_id']; ?>&type=0', 'GET'); return false;">
<?php echo Phpfox::getPhrase('advancedmarketplace.unsponsor_this_listing'); ?>
		</a>
<?php else: ?>
		<a href="#" onclick="$('#js_sponsor_phrase_<?php echo $this->_aVars['aListing']['listing_id']; ?>').show(); $.ajaxCall('advancedmarketplace.sponsor','listing_id=<?php echo $this->_aVars['aListing']['listing_id']; ?>&type=1', 'GET'); return false;">
<?php echo Phpfox::getPhrase('advancedmarketplace.sponsor_this_listing'); ?>
		</a>
<?php endif; ?>
	    </span>
	</li>
<?php elseif (Phpfox ::getUserParam('advancedmarketplace.can_purchase_sponsor') && $this->_aVars['aListing']['user_id'] == Phpfox ::getUserId() && $this->_aVars['aListing']['is_sponsor'] != 1): ?>
	<li>
	    <a href="<?php echo Phpfox::permalink('ad.sponsor', $this->_aVars['aListing']['listing_id'], null, false, null, (array) array (
)); ?>section_advancedmarketplace/">
<?php echo Phpfox::getPhrase('advancedmarketplace.sponsor_this_listing'); ?>
	    </a>
	</li>
<?php endif; ?>
<?php if (( $this->_aVars['aListing']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('advancedmarketplace.can_delete_own_listing')) || Phpfox ::getUserParam('advancedmarketplace.can_delete_other_listings')): ?>
		<li class="item_delete"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace', array('delete' => $this->_aVars['aListing']['listing_id'])); ?>" class="sJsConfirm"><?php echo Phpfox::getPhrase('advancedmarketplace.delete_listing'); ?></a></li>
<?php endif; ?>
                    </ul>			
                </div>
                <div class="row_edit_bar">				
                    <a href="#" class="row_edit_bar_action"><span><?php echo Phpfox::getPhrase('advancedmarketplace.actions'); ?></span></a>							
                </div>
            </div>		
<?php endif; ?>

<?php if (Phpfox ::getUserParam('event.can_approve_events') || Phpfox ::getUserParam('event.can_delete_other_event')): ?><a href="#<?php echo $this->_aVars['aListing']['listing_id']; ?>" class="moderate_link" rel="advancedmarketplace">Moderate</a><?php endif; ?>
        </div>
        <div class="row_title_info">		

            <a href="<?php echo $this->_aVars['aListing']['url']; ?>" class="advlink" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aListing']['title']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aListing']['title']), 100, '...'), 25); ?></a><?php if ($this->_aVars['aListing']['view_id'] == '2'): ?><span class="advancedmarketplace_item_sold">(<?php echo Phpfox::getPhrase('advancedmarketplace.sold'); ?>)</span><?php endif; ?>
<?php if ($this->_aVars['aListing']['post_status'] == 2): ?>
				<div><?php echo Phpfox::getPhrase('advancedmarketplace.draft_info'); ?></div>
<?php endif; ?>
            <div class="advancedmarketplace_price_tag">
<?php if ($this->_aVars['aListing']['price'] == '0.00'): ?>
<?php echo Phpfox::getPhrase('advancedmarketplace.free'); ?>
<?php else: ?>
<?php echo Phpfox::getService('core.currency')->getSymbol($this->_aVars['aListing']['currency_id']);  echo $this->_aVars['aListing']['price']; ?>
<?php endif; ?>
            </div>																

            <div class="extra_info">
                <ul class="extra_info_middot"><li><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aListing']['time_stamp']); ?></li><li><span>&middot;</span></li><li><?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aListing']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aListing']['user_name'], ((empty($this->_aVars['aListing']['user_name']) && isset($this->_aVars['aListing']['profile_page_id'])) ? $this->_aVars['aListing']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aListing']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?></li><li>&middot;</li><li><a class="js_hover_title" href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace', array('location' => $this->_aVars['aListing']['country_iso'])); ?>"><?php echo Phpfox::getService('core.country')->getCountry($this->_aVars['aListing']['country_iso']); ?><span class="js_hover_info"><?php if (! empty ( $this->_aVars['aListing']['city'] )): ?> <?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aListing']['city']); ?> &raquo; <?php endif;  if (! empty ( $this->_aVars['aListing']['country_child_id'] )): ?> <?php echo Phpfox::getService('core.country')->getChild($this->_aVars['aListing']['country_child_id']); ?> &raquo; <?php endif; ?> <?php echo Phpfox::getService('core.country')->getCountry($this->_aVars['aListing']['country_iso']); ?></span></a></li></ul>
            </div>


<?php if (Phpfox ::isMobile()): ?>
            <a href="<?php echo $this->_aVars['aListing']['url']; ?>">
                
                <img title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['advancedmarketplace_url_image'];  echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aListing"]["image_path"], "_120"); ?>" max_width='120' max_height='120' />
            </a>
<?php endif; ?>

            <div class="item_content">
<?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.search')->highlight('search', Phpfox::getLib('phpfox.parse.output')->parse(strip_tags($this->_aVars['aListing']['description']))), 25), 200, 'advancedmarketplace.see_more', true); ?>
            </div>							

<?php Phpfox::getBlock('feed.comment', array('aFeed' => $this->_aVars['aListing']['aFeed'],'aListing' => $this->_aVars['aListing'])); ?>

        </div>			


    </div>	
<?php if (! Phpfox ::isMobile()): ?>
</div>
<?php endif; ?>
<div class="clear"></div>				
</div>
<?php endforeach; endif; ?>

<?php if (Phpfox ::getUserParam('advancedmarketplace.can_delete_other_listings') || Phpfox ::getUserParam('advancedmarketplace.can_feature_listings') || Phpfox ::getUserParam('advancedmarketplace.can_approve_listings')):  Phpfox::getBlock('core.moderation');  endif; ?>

<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  endif; ?>

