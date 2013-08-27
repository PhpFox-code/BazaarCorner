<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:12 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: price.html.php 3533 2011-11-21 14:07:21Z Raymond_Benc $
 */
 
 

?>
<div class="advancedmarketplace_price_holder" style="margin-bottom: 20px;">
<?php echo $this->_aVars['sListingPrice']; ?>
<?php if ($this->_aVars['aListing']['user_id'] != Phpfox ::getUserId()): ?>
	<a href="#" class="advancedmarketplace_contact_seller" onclick="$Core.composeMessage({user_id: <?php echo $this->_aVars['aListing']['user_id']; ?>}); return false;"><?php echo Phpfox::getPhrase('advancedmarketplace.contact_seller'); ?></a>
	
<?php if ($this->_aVars['aListing']['is_sell'] && $this->_aVars['aListing']['view_id'] != '2' && $this->_aVars['aListing']['price'] != '0.00'): ?>
	<div class="advancedmarketplace_price_holder_button">
		<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace.purchase'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
			<div><input type="hidden" name="id" value="<?php echo $this->_aVars['aListing']['listing_id']; ?>" /></div>
			<input type="submit" value="<?php echo Phpfox::getPhrase('advancedmarketplace.buy_it_now'); ?>" class="button" />			
		
</form>

	</div>
<?php endif; ?>
<?php endif; ?>
</div>
