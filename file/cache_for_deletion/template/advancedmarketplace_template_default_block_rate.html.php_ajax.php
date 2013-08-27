<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: August 3, 2013, 10:39 pm */ ?>
<?php
?>
<script type="text/javascript" src="<?php echo $this->_aVars['core_url']; ?>static/jscript/jquery/plugin/star/jquery.rating.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_aVars['core_url']; ?>static/jscript/jquery/plugin/star/jquery.rating.css" />

<div id="js_rating_holder_<?php echo $this->_aVars['aRatingCallback']['type']; ?>">
	<form id="form-rating" method="post" action="#">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		
			<input type="hidden" name="rating[type]" value="<?php echo $this->_aVars['aRatingCallback']['type']; ?>" />
			<input type="hidden" name="rating[item_id]" value="<?php echo $this->_aVars['aRatingCallback']['item_id']; ?>" />
			<input type="hidden" name="rating[listing_id]" value="<?php echo $this->_aVars['item_id']; ?>" />
		
		
		<div><strong><?php echo Phpfox::getPhrase("advancedmarketplace.comment"); ?>: </strong></div>
		<div>
			<textarea rows="8" cols="61" name="rating[comment]"></textarea>
			<input type="hidden" name="page" value="<?php echo $this->_aVars['page']; ?>" />
		</div>
		<br />
		<div class="clear"></div>
		<div style="float: left;"><strong><?php echo Phpfox::getPhrase("advancedmarketplace.rate"); ?>: </strong></div>
		<div style="height:18px; position: relative; float: left;">
			<div style="position:absolute; width: 200px; margin-left: 10px;">		
<?php if (count((array)$this->_aVars['aRatingCallback']['stars'])):  foreach ((array) $this->_aVars['aRatingCallback']['stars'] as $this->_aVars['sKey'] => $this->_aVars['sPhrase']): ?>
					<input type="radio" class="js_rating_star" id="js_rating_star_<?php echo $this->_aVars['sKey']; ?>" name="rating[star]" value="<?php echo $this->_aVars['sKey']; ?>" title="<?php echo $this->_aVars['sKey'];  if ($this->_aVars['sPhrase'] != $this->_aVars['sKey']): ?> (<?php echo $this->_aVars['sPhrase']; ?>)<?php endif; ?>"<?php if ($this->_aVars['aRatingCallback']['default_rating'] >= $this->_aVars['sKey']): ?> checked="checked"<?php endif; ?> />
<?php endforeach; endif; ?>
				<div class="clear"></div>
			</div>
		</div>
		<div style="text-align: right">
			<input type="submit" id="rating" value="<?php echo Phpfox::getPhrase("advancedmarketplace.review"); ?>" class="button" />
		</div>
	
</form>

</div>
 <script language="javascript" type="text/javascript">
 <?php echo '
 	$(\'.js_rating_star\').rating();
	
 	$("#form-rating").submit(function(evt){
		evt.preventDefault();

		$(this).ajaxCall("advancedmarketplace.advMarketRating");
		tb_remove();
		return false;
 	 });
 '; ?>

 </script>
 
 
 
