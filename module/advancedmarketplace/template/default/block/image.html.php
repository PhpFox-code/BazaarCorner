<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: image.html.php 3444 2011-11-03 12:56:50Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div id="js_marketplace_click_image_viewer">
	<div id="js_marketplace_click_image_viewer_inner">
		{phrase var='advancedmarketplace.loading'}
	</div>
	<div id="js_marketplace_click_image_viewer_close">
		<a href="#" title="{phrase var='advancedmarketplace.close'}">{phrase var='advancedmarketplace.close'}</a>
	</div>
</div>
{if count($aImages) > 1}
<div class="js_box_thumbs_holder2">
{/if}
	<div class="advancedmarketplace_image_holder">		
		<div class="advancedmarketplace_image">
			{*img title=$aListing.title path='advancedmarketplace.url_image' file=$aListing.image_path suffix='_200' max_width='180' max_height='180'*}
			{if $aListing.image_path != NULL}{*
				*}<a title="{$aListing.title}" class="js_marketplace_click_image no_ajax_link" href="{$advancedmarketplace_url_image}<?php echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aListing"]["image_path"], "_400"); ?>">
					<img title="{$aListing.title}" src="{$advancedmarketplace_url_image}<?php echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aListing"]["image_path"], "_200"); ?>" max_width='180' max_height='180' />
				</a>{*
			*}{else}{*
				*}<img title="{$aListing.title}" src="<?php echo Phpfox::getLib('template')->getStyle('image', 'noimage/item.png'); ?>" max_width='120' max_height='120' />{*
			*}{/if}
		</div>
		{if count($aImages) > 1}
		<div class="advancedmarketplace_image_extra js_box_image_holder_thumbs">
			<ul>
				{foreach from=$aImages name=images item=aImage}
					<li>
					<a class="js_marketplace_click_image no_ajax_link" href="{*
						*}{$advancedmarketplace_url_image}<?php echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aImage"]["image_path"], "_50_square"); ?>{*
						*}{*img return_url=true server_id=$aImage.server_id title=$aListing.title path='advancedmarketplace.url_image' file=$aImage.image_path suffix='_400'*}{*
						*}">
							{*img server_id=$aImage.server_id title=$aListing.title path='advancedmarketplace.url_image' file=$aImage.image_path suffix='_50_square' max_width='50' max_height='50'*}
							<img title="{$aListing.title}" src="{$advancedmarketplace_url_image}<?php echo PHPFOX::getService("advancedmarketplace")->proccessImageName($this->_aVars["aImage"]["image_path"], "_50_square"); ?>" max_width='50' max_height='50' />
						</a>
					</li>
				{/foreach}
			</ul>
			<div class="clear"></div>
		</div>	
		{/if}
	</div>
{if count($aImages) > 1}
</div>
{/if}