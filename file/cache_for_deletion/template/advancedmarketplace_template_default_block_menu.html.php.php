<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:25 am */ ?>
<?php 
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
