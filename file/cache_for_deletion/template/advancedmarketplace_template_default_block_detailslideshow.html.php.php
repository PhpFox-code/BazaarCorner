<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:12 am */ ?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 echo '
<style type="text/css">
	';  if (count ( $this->_aVars['aImages'] ) > 1):  echo '
	#right {
		margin-top: 40px;
	}
	';  endif;  echo '
	
	.slideblock {
		clear: both;
		text-align: center;
	}
	
	.slider {
		height: 85px;
		padding-top: 30px;
		padding-left: 30px;
		background-color: #F7F7F7;
	}
	
	.slider ul {
		list-style: none;
		list-style: none outside none;
		position: absolute;
		top: 0;
		width: 1234px;
		display: block;
	}
	
	.slider ul li {
		float: left;
		margin-right: 10px;
	}
	
	div.rightnav {
		display: inline-block;
		float: left;
		margin-top: 6px;
	}
	
	div.leftnav {
		display: inline-block;
		float: left;
		margin-top: 6px;
	}
	
	div.slider2 {
		float: left;
		height: 50px;
		margin: 0 35px;
		overflow: hidden;
		position: relative;
		width: 355px;
	}
	
</style>
<script language="javasript" type="text/javascript">
	$Behavior.detailSlide = (function(){
		$("img.buff").hide();
		$(".slideclick").click(function(evt){
			evt.preventDefault();
			$img = $("<img>").attr({
				"src": $(this).attr("ref"),
				"style": "max-width:520px;max-height:322px;"
			});
			$(".bigimg").html($img);
			
			return false;
		});
		var pmcc = $(".slider2").find("li").size();
		if(pmcc <= 6) {
			$(".leftnav").css({
				"visibility": "hidden"
			});
			$(".rightnav").css({
				"visibility": "hidden"
			});
			$(".slider2").find("ul").css({
				"display": "inline-block",
				/* "width": "auto", */
				"position": "relative"
			});
			$(".slider2").css({
				"text-align": "center"
			});
		}
		var pncc = 0;
		var flg = false;
		$(".leftnav").find("a").css({
			"opacity": "0.3"
		}).mouseover(function(){
			$(this).css({
				"opacity": 1
			});
		}).mouseout(function(){
			$(this).css({
				"opacity": "0.3"
			});
		});
		$(".rightnav").find("a").css({
			"opacity": "0.3"
		}).mouseover(function(){
			$(this).css({
				"opacity": 1
			});
		}).mouseout(function(){
			$(this).css({
				"opacity": "0.3"
			});
		});
		$(".leftnav").find("a").click(function(evt){
			evt.preventDefault();
			if(pncc >= pmcc - 6 || flg)return false;
			pncc++;
			flg = true;
			$(".slider2").find("ul").stop(false, false).animate({
				"left": ("-=" + (60) + "px")
			}, function(){flg = false;});
			
			return false;
		});
		$(".rightnav").find("a").click(function(evt){
			evt.preventDefault();
			if(pncc <= 0 || flg)return false;
			pncc--;
			flg = true;
			$(".slider2").find("ul").stop(false, false).animate({
				"left": ("+=" + (60) + "px")
			}, function(){flg = false;});
			
			return false;
		});
	});
</script>
'; ?>


<?php if (( $this->_aVars['aListing']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('advancedmarketplace.can_edit_own_listing')) || Phpfox ::getUserParam('advancedmarketplace.can_edit_other_listing') || ( $this->_aVars['aListing']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('advancedmarketplace.can_delete_own_listing')) || Phpfox ::getUserParam('advancedmarketplace.can_delete_other_listings') || ( Phpfox ::getUserParam('advancedmarketplace.can_feature_listings'))): ?>
<div class="item_bar">
<?php if ($this->_aVars['aListing']['view_id'] == '1'): ?>
	<div class="message js_moderation_off">
<?php echo Phpfox::getPhrase('advancedmarketplace.listing_is_pending_approval'); ?>
	</div>
<?php endif; ?>
	<div class="item_bar_action_holder">
<?php if (( Phpfox ::getUserParam('advancedmarketplace.can_approve_listings') && $this->_aVars['aListing']['view_id'] == '1' )): ?>
		<a href="#" class="item_bar_approve item_bar_approve_image" onclick="return false;" style="display:none;" id="js_item_bar_approve_image"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></a>			
		<a href="#" class="item_bar_approve" onclick="$(this).hide(); $('#js_item_bar_approve_image').show(); $.ajaxCall('advancedmarketplace.approve', 'inline=true&amp;listing_id=<?php echo $this->_aVars['aListing']['listing_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('advancedmarketplace.approve'); ?></a>
<?php endif; ?>
		<a href="#" class="item_bar_action"><span><?php echo Phpfox::getPhrase('advancedmarketplace.actions'); ?></span></a>	
		<ul>
			<?php /* Cached: February 25, 2013, 5:12 am */  
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
</div>
<?php endif;  if ($this->_aVars['aListing']['image_path'] != NULL): ?>
	<div class="slideblock" style="width: 520px;">
		<div style="width: 520px; height: 322px;" class="bigimg">
<?php if ($this->_aVars['aListing']['image_path'] != NULL): ?><img title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['advancedmarketplace_url_image'];  echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aListing"]["image_path"], ""); ?>" style="max-width:520px;max-height:322px;" /><?php else: ?><img title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo Phpfox::getLib('template')->getStyle('image', 'noimage/item.png'); ?>" style="max-width:520px;max-height:322px" /><?php endif; ?>
		</div>
<?php if (count ( $this->_aVars['aImages'] ) > 1): ?>
		<div class="thumbnail">
			<div class="window">
				<div class="slider">
					<div class="leftnav">
						<a href="">
							<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/aleft.png" />
						</a>
					</div>
					<div class="slider2">
<?php if (count((array)$this->_aVars['aImages'])):  $this->_aPhpfoxVars['iteration']['images'] = 0;  foreach ((array) $this->_aVars['aImages'] as $this->_aVars['aImage']):  $this->_aPhpfoxVars['iteration']['images']++; ?>

						<img style="visibility: hidden;" class="buff" src="<?php echo $this->_aVars['advancedmarketplace_url_image'];  echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aImage"]["image_path"], ""); ?>" ?>
<?php endforeach; endif; ?>
						<ul>
<?php if (count((array)$this->_aVars['aImages'])):  $this->_aPhpfoxVars['iteration']['images'] = 0;  foreach ((array) $this->_aVars['aImages'] as $this->_aVars['aImage']):  $this->_aPhpfoxVars['iteration']['images']++; ?>

								<li>
								<a ref="<?php echo $this->_aVars['advancedmarketplace_url_image'];  echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aImage"]["image_path"], ""); ?>" class="slideclick js_marketplace_click_image no_ajax_link" href="<?php echo $this->_aVars['advancedmarketplace_url_image'];  echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aImage"]["image_path"], "_50_square"); ?>">
										
										<img title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['advancedmarketplace_url_image'];  echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aImage"]["image_path"], "_50_square"); ?>" max_width='50' max_height='50' />
									</a>
								</li>
<?php endforeach; endif; ?>
						</ul>
					</div>
					<div class="rightnav">
						<a href="">
							<img src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/aright.png" />
						</a>
					</div>
				</div>
			</div>
			<div class="btholder prev">
			</div>
			<div class="btholder next">
			</div>
		</div>
<?php endif; ?>
	</div>
<?php endif; ?>
