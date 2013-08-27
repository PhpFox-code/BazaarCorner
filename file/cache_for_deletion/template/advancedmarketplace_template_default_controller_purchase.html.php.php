<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 26, 2013, 1:34 pm */ ?>
<?php 

 

?>
<div class="main_break"></div>
<?php if ($this->_aVars['bInvoice']): ?>

<h3><?php echo Phpfox::getPhrase('advancedmarketplace.payment_methods'); ?></h3>
<?php Phpfox::getBlock('api.gateway.form', array()); ?>

<?php else: ?>
<div class="info">
	<div class="info_left">
<?php echo Phpfox::getPhrase('advancedmarketplace.item_you_re_buying'); ?>:
	</div>
	<div class="info_right">
<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aListing']['title']); ?>
	</div>		
</div>
<div class="info">
	<div class="info_left">
<?php echo Phpfox::getPhrase('advancedmarketplace.price'); ?>:
	</div>
	<div class="info_right">
<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aListing']['price']); ?>
	</div>		
</div>
	
<div class="separate"></div>

<div class="p_4">
<?php echo Phpfox::getPhrase('advancedmarketplace.by_clicking_on_the_button_below_you_commit_to_buy_this_item_from_the_seller'); ?>
	<div class="p_4">
		<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('advancedmarketplace.purchase'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
			<div><input type="hidden" name="id" value="<?php echo $this->_aVars['aListing']['listing_id']; ?>" /></div>
			<div><input type="hidden" name="process" value="1" /></div>			
			<input type="submit" value="<?php echo Phpfox::getPhrase('advancedmarketplace.commit_to_buy'); ?>" class="button" />
		
</form>

	</div>
</div>
<?php endif; ?>
