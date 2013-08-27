<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:12 am */ ?>
<?php




 if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['view_id'] == '2'): ?>
<div class="error_message">
<?php echo Phpfox::getPhrase('advancedmarketplace.notice_this_listing_is_marked_as_sold'); ?>
</div>
<div class="main_break"></div>
<?php endif; ?>

<?php echo $this->_aVars['sCreateJs']; ?>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('current'); ?>" enctype="multipart/form-data" onsubmit="return startProcess(<?php echo $this->_aVars['sGetJsForm']; ?>, false);" id="js_advancedmarketplace_form">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if ($this->_aVars['bIsEdit']): ?>
		<div><input type="hidden" name="id" id="ilistingid" value="<?php echo $this->_aVars['aForms']['listing_id']; ?>" /></div>
<?php endif; ?>

	<div id="js_custom_privacy_input_holder">
<?php if ($this->_aVars['bIsEdit'] && empty ( $this->_aVars['sModule'] ) && Phpfox ::isModule('privacy')): ?>
<?php Phpfox::getBlock('privacy.build', array('privacy_item_id' => $this->_aVars['aForms']['listing_id'],'privacy_module_id' => 'advancedmarketplace')); ?>
<?php endif; ?>
	</div>

	<div><input type="hidden" name="page_section_menu" value="" id="page_section_menu_form" /></div>
	
	<div id="js_mp_block_detail" class="js_mp_block page_section_menu_holder">
		
<?php if (empty ( $this->_aVars['sModule'] ) && ! empty ( $this->_aVars['aPages'] ) && ! $this->_aVars['bIsEdit']): ?>
			<div class="table">
				<div class="table_left">Pages</div>
				<div class="table_right">
					<select name="val[page_id]">
						<option value="0">None</option>
<?php if (count((array)$this->_aVars['aPages'])):  $this->_aPhpfoxVars['iteration']['pages'] = 0;  foreach ((array) $this->_aVars['aPages'] as $this->_aVars['aPage']):  $this->_aPhpfoxVars['iteration']['pages']++; ?>

							<option value="<?php echo $this->_aVars['aPage']['page_id']; ?>"><?php echo $this->_aVars['aPage']['title']; ?></option>
<?php endforeach; endif; ?>
					</select>
				</div>
			</div>
<?php endif; ?>
		<div class="table">
			<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif; ?><label for="category"><?php echo Phpfox::getPhrase('advancedmarketplace.category'); ?>:</label>
			</div>
			<div class="table_right">
<?php echo $this->_aVars['sCategories']; ?>
			</div>
		</div>
		<div id="advmarketplace_js_customfield_form" class="table"> 
<?php if (count ( $this->_aVars['aCustomFields'] ) > 0): ?>
<?php Phpfox::getBlock("advancedmarketplace.frontend.customfield", array('aCustomFields' => $this->_aVars['aCustomFields'],'cfInfors' => $this->_aVars['cfInfors'])); ?>
<?php else: ?>
				&#65279;
<?php endif; ?>
		</div>
		
		<div class="table">
			<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif; ?><label for="title"><?php echo Phpfox::getPhrase('advancedmarketplace.what_are_you_selling'); ?></label>
			</div>
			<div class="table_right">
				<input type="text" name="val[title]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title']) : (isset($this->_aVars['aForms']['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']) : '')); ?>
" id="title" size="40" maxlength="100" />
			</div>
		</div>
		<div class="table">
			<div class="table_left">
				<label for="description"><?php echo Phpfox::getPhrase('advancedmarketplace.short_description'); ?>:</label>
			</div>
			<div class="table_right">
				
				<textarea style="width: 970px;" rows="6" name="val[short_description]" ><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['short_description']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['short_description']) : (isset($this->_aVars['aForms']['short_description']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['short_description']) : '')); ?>
</textarea>
			</div>
		</div>
		<div class="table">
			<div class="table_left">
				<label for="description"><?php echo Phpfox::getPhrase('advancedmarketplace.description'); ?>:</label>
			</div>
			<div class="table_right">
				<?php Phpfox::getBlock('attachment.share');  echo Phpfox::getLib('phpfox.editor')->get('description', array (
  'id' => 'description',
  'rows' => '12',
)); ?>
			</div>
		</div>
		
		<div class="table">
			<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif; ?><label for="price"><?php echo Phpfox::getPhrase('advancedmarketplace.price'); ?>:</label>
			</div>
			<div class="table_right">
				<select name="val[currency_id]">
<?php if (count((array)$this->_aVars['aCurrencies'])):  foreach ((array) $this->_aVars['aCurrencies'] as $this->_aVars['sCurrency'] => $this->_aVars['aCurrency']): ?>
					<option value="<?php echo $this->_aVars['sCurrency']; ?>"<?php if ($this->_aVars['bIsEdit']): ?> <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('currency_id') && in_array('currency_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['currency_id'])
								&& $aParams['currency_id'] == $this->_aVars['sCurrency'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['currency_id'])
									&& !isset($aParams['currency_id'])
									&& $this->_aVars['aForms']['currency_id'] == $this->_aVars['sCurrency'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							 else:  if ($this->_aVars['aCurrency']['is_default']): ?> selected="selected"<?php endif;  endif; ?>><?php echo Phpfox::getPhrase($this->_aVars['aCurrency']['name']); ?></option>
<?php endforeach; endif; ?>
				</select>
				<input type="text" name="val[price]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['price']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['price']) : (isset($this->_aVars['aForms']['price']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['price']) : '')); ?>
" id="price" size="10" maxlength="100" onfocus="this.select();" />
			</div>
		</div>
		
<?php if (Phpfox ::getUserParam('advancedmarketplace.can_sell_items_on_advancedmarketplace')): ?>
		<div class="table">
			<div class="table_left">
				<label for="postal_code"><?php echo Phpfox::getPhrase('advancedmarketplace.enable_instant_payment'); ?>:</label>
			</div>
			<div class="table_right">
				<div class="item_is_active_holder">
					<span class="js_item_active item_is_active"><input type="radio" name="val[is_sell]" value="1" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_sell') && in_array('is_sell', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_sell']) && $aParams['is_sell'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_sell']) && !isset($aParams['is_sell']) && $this->_aVars['aForms']['is_sell'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('core.yes'); ?></span>
					<span class="js_item_active item_is_not_active"><input type="radio" name="val[is_sell]" value="0" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_sell') && in_array('is_sell', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_sell']) && $aParams['is_sell'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_sell']) && !isset($aParams['is_sell']) && $this->_aVars['aForms']['is_sell'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['is_sell']) && !isset($aParams['is_sell']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('core.no'); ?></span>
				</div>
				<div class="extra_info">
<?php echo Phpfox::getPhrase('advancedmarketplace.if_you_enable_this_option_buyers_can_make_a_payment_to_one_of_the_payment_gateways_you_have_on_file_with_us_to_manage_your_payment_gateways_go_a_href_link_here_a', array('link' => $this->_aVars['sUserSettingLink'])); ?>
				</div>
			</div>
		</div>

		<div class="table">
			<div class="table_left">
				<label for="postal_code"><?php echo Phpfox::getPhrase('advancedmarketplace.auto_sold'); ?>:</label>
			</div>
			<div class="table_right">
				<div class="item_is_active_holder">
					<span class="js_item_active item_is_active"><input type="radio" name="val[auto_sell]" value="1" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('auto_sell') && in_array('auto_sell', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['auto_sell']) && $aParams['auto_sell'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['auto_sell']) && !isset($aParams['auto_sell']) && $this->_aVars['aForms']['auto_sell'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['auto_sell']) && !isset($aParams['auto_sell']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('core.yes'); ?></span>
					<span class="js_item_active item_is_not_active"><input type="radio" name="val[auto_sell]" value="0" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('auto_sell') && in_array('auto_sell', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['auto_sell']) && $aParams['auto_sell'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['auto_sell']) && !isset($aParams['auto_sell']) && $this->_aVars['aForms']['auto_sell'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('core.no'); ?></span>
				</div>
				<div class="extra_info">
<?php echo Phpfox::getPhrase('advancedmarketplace.if_this_is_enabled_and_once_a_successful_purchase_of_this_item_is_made'); ?>
				</div>
			</div>
		</div>
<?php endif; ?>

		<div class="separate"></div>

		<div class="table">
			<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif; ?><label for="country_iso"><?php echo Phpfox::getPhrase('advancedmarketplace.country'); ?>:</label>
			</div>
			<div class="table_right">
				<select name="val[country_iso]" id="country_iso">
		<option value=""><?php echo Phpfox::getPhrase('core.select'); ?>:</option>
			<option class="js_country_option" id="js_country_iso_option_PH" value="PH"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PH')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PH')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ph') ? Phpfox::getPhrase('core.translate_country_iso_ph') : 'Philippines'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AF" value="AF"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AF')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AF')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_af') ? Phpfox::getPhrase('core.translate_country_iso_af') : 'Afghanistan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AX" value="AX"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AX')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AX')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ax') ? Phpfox::getPhrase('core.translate_country_iso_ax') : 'Aland Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AL" value="AL"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AL')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AL')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_al') ? Phpfox::getPhrase('core.translate_country_iso_al') : 'Albania'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_DZ" value="DZ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'DZ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'DZ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_dz') ? Phpfox::getPhrase('core.translate_country_iso_dz') : 'Algeria'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AS" value="AS"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AS')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AS')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_as') ? Phpfox::getPhrase('core.translate_country_iso_as') : 'American Samoa'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AD" value="AD"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AD')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AD')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ad') ? Phpfox::getPhrase('core.translate_country_iso_ad') : 'Andorra'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AO" value="AO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ao') ? Phpfox::getPhrase('core.translate_country_iso_ao') : 'Angola'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AI" value="AI"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AI')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AI')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ai') ? Phpfox::getPhrase('core.translate_country_iso_ai') : 'Anguilla'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AQ" value="AQ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AQ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AQ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_aq') ? Phpfox::getPhrase('core.translate_country_iso_aq') : 'Antarctica'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AG" value="AG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ag') ? Phpfox::getPhrase('core.translate_country_iso_ag') : 'Antigua and Barbuda'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AR" value="AR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ar') ? Phpfox::getPhrase('core.translate_country_iso_ar') : 'Argentina'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AM" value="AM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_am') ? Phpfox::getPhrase('core.translate_country_iso_am') : 'Armenia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AW" value="AW"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AW')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AW')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_aw') ? Phpfox::getPhrase('core.translate_country_iso_aw') : 'Aruba'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AU" value="AU"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AU')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AU')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_au') ? Phpfox::getPhrase('core.translate_country_iso_au') : 'Australia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AT" value="AT"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AT')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AT')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_at') ? Phpfox::getPhrase('core.translate_country_iso_at') : 'Austria'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AZ" value="AZ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AZ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AZ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_az') ? Phpfox::getPhrase('core.translate_country_iso_az') : 'Azerbaijan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BS" value="BS"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BS')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BS')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bs') ? Phpfox::getPhrase('core.translate_country_iso_bs') : 'Bahamas'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BH" value="BH"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BH')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BH')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bh') ? Phpfox::getPhrase('core.translate_country_iso_bh') : 'Bahrain'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BD" value="BD"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BD')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BD')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bd') ? Phpfox::getPhrase('core.translate_country_iso_bd') : 'Bangladesh'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BB" value="BB"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BB')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BB')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bb') ? Phpfox::getPhrase('core.translate_country_iso_bb') : 'Barbados'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BY" value="BY"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BY')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BY')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_by') ? Phpfox::getPhrase('core.translate_country_iso_by') : 'Belarus'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BE" value="BE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_be') ? Phpfox::getPhrase('core.translate_country_iso_be') : 'Belgium'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BZ" value="BZ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BZ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BZ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bz') ? Phpfox::getPhrase('core.translate_country_iso_bz') : 'Belize'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BJ" value="BJ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BJ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BJ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bj') ? Phpfox::getPhrase('core.translate_country_iso_bj') : 'Benin'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BM" value="BM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bm') ? Phpfox::getPhrase('core.translate_country_iso_bm') : 'Bermuda'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BT" value="BT"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BT')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BT')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bt') ? Phpfox::getPhrase('core.translate_country_iso_bt') : 'Bhutan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BO" value="BO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bo') ? Phpfox::getPhrase('core.translate_country_iso_bo') : 'Bolivia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BA" value="BA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ba') ? Phpfox::getPhrase('core.translate_country_iso_ba') : 'Bosnia and Herzegovina'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BW" value="BW"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BW')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BW')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bw') ? Phpfox::getPhrase('core.translate_country_iso_bw') : 'Botswana'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BV" value="BV"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BV')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BV')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bv') ? Phpfox::getPhrase('core.translate_country_iso_bv') : 'Bouvet Island'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BR" value="BR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_br') ? Phpfox::getPhrase('core.translate_country_iso_br') : 'Brazil'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_IO" value="IO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'IO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'IO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_io') ? Phpfox::getPhrase('core.translate_country_iso_io') : 'British Indian Ocean Territory'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BN" value="BN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bn') ? Phpfox::getPhrase('core.translate_country_iso_bn') : 'Brunei Darussalam'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BG" value="BG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bg') ? Phpfox::getPhrase('core.translate_country_iso_bg') : 'Bulgaria'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BF" value="BF"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BF')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BF')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bf') ? Phpfox::getPhrase('core.translate_country_iso_bf') : 'Burkina Faso'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BI" value="BI"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BI')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BI')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bi') ? Phpfox::getPhrase('core.translate_country_iso_bi') : 'Burundi'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KH" value="KH"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KH')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KH')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_kh') ? Phpfox::getPhrase('core.translate_country_iso_kh') : 'Cambodia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CM" value="CM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cm') ? Phpfox::getPhrase('core.translate_country_iso_cm') : 'Cameroon'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CA" value="CA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ca') ? Phpfox::getPhrase('core.translate_country_iso_ca') : 'Canada'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CV" value="CV"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CV')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CV')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cv') ? Phpfox::getPhrase('core.translate_country_iso_cv') : 'Cape Verde'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KY" value="KY"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KY')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KY')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ky') ? Phpfox::getPhrase('core.translate_country_iso_ky') : 'Cayman Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CF" value="CF"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CF')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CF')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cf') ? Phpfox::getPhrase('core.translate_country_iso_cf') : 'Central African Republic'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TD" value="TD"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TD')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TD')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_td') ? Phpfox::getPhrase('core.translate_country_iso_td') : 'Chad'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CL" value="CL"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CL')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CL')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cl') ? Phpfox::getPhrase('core.translate_country_iso_cl') : 'Chile'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CN" value="CN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cn') ? Phpfox::getPhrase('core.translate_country_iso_cn') : 'China'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CX" value="CX"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CX')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CX')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cx') ? Phpfox::getPhrase('core.translate_country_iso_cx') : 'Christmas Island'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CC" value="CC"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CC')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CC')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cc') ? Phpfox::getPhrase('core.translate_country_iso_cc') : 'Cocos (Keeling) Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CO" value="CO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_co') ? Phpfox::getPhrase('core.translate_country_iso_co') : 'Colombia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KM" value="KM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_km') ? Phpfox::getPhrase('core.translate_country_iso_km') : 'Comoros'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CG" value="CG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cg') ? Phpfox::getPhrase('core.translate_country_iso_cg') : 'Congo'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CD" value="CD"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CD')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CD')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cd') ? Phpfox::getPhrase('core.translate_country_iso_cd') : 'Congo, the Democratic Republic of the'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CK" value="CK"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CK')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CK')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ck') ? Phpfox::getPhrase('core.translate_country_iso_ck') : 'Cook Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CR" value="CR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cr') ? Phpfox::getPhrase('core.translate_country_iso_cr') : 'Costa Rica'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CI" value="CI"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CI')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CI')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ci') ? Phpfox::getPhrase('core.translate_country_iso_ci') : 'Cote D\'Ivoire'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_HR" value="HR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'HR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'HR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_hr') ? Phpfox::getPhrase('core.translate_country_iso_hr') : 'Croatia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CU" value="CU"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CU')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CU')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cu') ? Phpfox::getPhrase('core.translate_country_iso_cu') : 'Cuba'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CY" value="CY"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CY')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CY')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cy') ? Phpfox::getPhrase('core.translate_country_iso_cy') : 'Cyprus'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CZ" value="CZ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CZ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CZ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_cz') ? Phpfox::getPhrase('core.translate_country_iso_cz') : 'Czech Republic'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_DK" value="DK"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'DK')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'DK')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_dk') ? Phpfox::getPhrase('core.translate_country_iso_dk') : 'Denmark'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_DJ" value="DJ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'DJ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'DJ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_dj') ? Phpfox::getPhrase('core.translate_country_iso_dj') : 'Djibouti'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_DM" value="DM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'DM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'DM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_dm') ? Phpfox::getPhrase('core.translate_country_iso_dm') : 'Dominica'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_DO" value="DO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'DO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'DO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_do') ? Phpfox::getPhrase('core.translate_country_iso_do') : 'Dominican Republic'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_EC" value="EC"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'EC')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'EC')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ec') ? Phpfox::getPhrase('core.translate_country_iso_ec') : 'Ecuador'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_EG" value="EG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'EG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'EG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_eg') ? Phpfox::getPhrase('core.translate_country_iso_eg') : 'Egypt'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SV" value="SV"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SV')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SV')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sv') ? Phpfox::getPhrase('core.translate_country_iso_sv') : 'El Salvador'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GQ" value="GQ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GQ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GQ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gq') ? Phpfox::getPhrase('core.translate_country_iso_gq') : 'Equatorial Guinea'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_ER" value="ER"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'ER')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'ER')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_er') ? Phpfox::getPhrase('core.translate_country_iso_er') : 'Eritrea'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_EE" value="EE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'EE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'EE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ee') ? Phpfox::getPhrase('core.translate_country_iso_ee') : 'Estonia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_ET" value="ET"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'ET')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'ET')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_et') ? Phpfox::getPhrase('core.translate_country_iso_et') : 'Ethiopia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_FK" value="FK"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'FK')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'FK')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_fk') ? Phpfox::getPhrase('core.translate_country_iso_fk') : 'Falkland Islands (Malvinas)'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_FO" value="FO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'FO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'FO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_fo') ? Phpfox::getPhrase('core.translate_country_iso_fo') : 'Faroe Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_FJ" value="FJ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'FJ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'FJ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_fj') ? Phpfox::getPhrase('core.translate_country_iso_fj') : 'Fiji'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_FI" value="FI"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'FI')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'FI')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_fi') ? Phpfox::getPhrase('core.translate_country_iso_fi') : 'Finland'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_FR" value="FR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'FR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'FR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_fr') ? Phpfox::getPhrase('core.translate_country_iso_fr') : 'France'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GF" value="GF"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GF')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GF')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gf') ? Phpfox::getPhrase('core.translate_country_iso_gf') : 'French Guiana'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PF" value="PF"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PF')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PF')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pf') ? Phpfox::getPhrase('core.translate_country_iso_pf') : 'French Polynesia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TF" value="TF"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TF')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TF')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tf') ? Phpfox::getPhrase('core.translate_country_iso_tf') : 'French Southern Territories'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GA" value="GA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ga') ? Phpfox::getPhrase('core.translate_country_iso_ga') : 'Gabon'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GM" value="GM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gm') ? Phpfox::getPhrase('core.translate_country_iso_gm') : 'Gambia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GE" value="GE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ge') ? Phpfox::getPhrase('core.translate_country_iso_ge') : 'Georgia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_DE" value="DE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'DE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'DE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_de') ? Phpfox::getPhrase('core.translate_country_iso_de') : 'Germany'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GH" value="GH"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GH')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GH')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gh') ? Phpfox::getPhrase('core.translate_country_iso_gh') : 'Ghana'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GI" value="GI"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GI')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GI')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gi') ? Phpfox::getPhrase('core.translate_country_iso_gi') : 'Gibraltar'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GR" value="GR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gr') ? Phpfox::getPhrase('core.translate_country_iso_gr') : 'Greece'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GL" value="GL"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GL')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GL')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gl') ? Phpfox::getPhrase('core.translate_country_iso_gl') : 'Greenland'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GD" value="GD"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GD')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GD')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gd') ? Phpfox::getPhrase('core.translate_country_iso_gd') : 'Grenada'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GP" value="GP"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GP')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GP')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gp') ? Phpfox::getPhrase('core.translate_country_iso_gp') : 'Guadeloupe'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GU" value="GU"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GU')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GU')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gu') ? Phpfox::getPhrase('core.translate_country_iso_gu') : 'Guam'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GT" value="GT"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GT')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GT')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gt') ? Phpfox::getPhrase('core.translate_country_iso_gt') : 'Guatemala'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GG" value="GG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gg') ? Phpfox::getPhrase('core.translate_country_iso_gg') : 'Guernsey'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GN" value="GN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gn') ? Phpfox::getPhrase('core.translate_country_iso_gn') : 'Guinea'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GW" value="GW"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GW')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GW')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gw') ? Phpfox::getPhrase('core.translate_country_iso_gw') : 'Guinea-Bissau'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GY" value="GY"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GY')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GY')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gy') ? Phpfox::getPhrase('core.translate_country_iso_gy') : 'Guyana'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_HT" value="HT"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'HT')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'HT')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ht') ? Phpfox::getPhrase('core.translate_country_iso_ht') : 'Haiti'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_HM" value="HM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'HM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'HM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_hm') ? Phpfox::getPhrase('core.translate_country_iso_hm') : 'Heard Island and Mcdonald Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_VA" value="VA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'VA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'VA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_va') ? Phpfox::getPhrase('core.translate_country_iso_va') : 'Holy See (Vatican City State)'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_HN" value="HN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'HN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'HN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_hn') ? Phpfox::getPhrase('core.translate_country_iso_hn') : 'Honduras'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_HK" value="HK"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'HK')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'HK')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_hk') ? Phpfox::getPhrase('core.translate_country_iso_hk') : 'Hong Kong'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_HU" value="HU"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'HU')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'HU')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_hu') ? Phpfox::getPhrase('core.translate_country_iso_hu') : 'Hungary'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_IS" value="IS"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'IS')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'IS')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_is') ? Phpfox::getPhrase('core.translate_country_iso_is') : 'Iceland'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_IN" value="IN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'IN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'IN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_in') ? Phpfox::getPhrase('core.translate_country_iso_in') : 'India'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_ID" value="ID"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'ID')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'ID')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_id') ? Phpfox::getPhrase('core.translate_country_iso_id') : 'Indonesia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_IR" value="IR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'IR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'IR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ir') ? Phpfox::getPhrase('core.translate_country_iso_ir') : 'Iran, Islamic Republic of'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_IQ" value="IQ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'IQ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'IQ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_iq') ? Phpfox::getPhrase('core.translate_country_iso_iq') : 'Iraq'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_IE" value="IE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'IE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'IE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ie') ? Phpfox::getPhrase('core.translate_country_iso_ie') : 'Ireland'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_IM" value="IM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'IM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'IM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_im') ? Phpfox::getPhrase('core.translate_country_iso_im') : 'Isle of Man'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_IL" value="IL"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'IL')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'IL')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_il') ? Phpfox::getPhrase('core.translate_country_iso_il') : 'Israel'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_IT" value="IT"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'IT')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'IT')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_it') ? Phpfox::getPhrase('core.translate_country_iso_it') : 'Italy'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_JM" value="JM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'JM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'JM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_jm') ? Phpfox::getPhrase('core.translate_country_iso_jm') : 'Jamaica'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_JP" value="JP"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'JP')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'JP')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_jp') ? Phpfox::getPhrase('core.translate_country_iso_jp') : 'Japan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_JO" value="JO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'JO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'JO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_jo') ? Phpfox::getPhrase('core.translate_country_iso_jo') : 'Jordan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KZ" value="KZ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KZ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KZ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_kz') ? Phpfox::getPhrase('core.translate_country_iso_kz') : 'Kazakhstan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KE" value="KE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ke') ? Phpfox::getPhrase('core.translate_country_iso_ke') : 'Kenya'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KI" value="KI"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KI')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KI')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ki') ? Phpfox::getPhrase('core.translate_country_iso_ki') : 'Kiribati'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KP" value="KP"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KP')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KP')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_kp') ? Phpfox::getPhrase('core.translate_country_iso_kp') : 'Korea, Democratic People\'s Republic of'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KR" value="KR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_kr') ? Phpfox::getPhrase('core.translate_country_iso_kr') : 'Korea, Republic of'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KW" value="KW"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KW')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KW')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_kw') ? Phpfox::getPhrase('core.translate_country_iso_kw') : 'Kuwait'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KG" value="KG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_kg') ? Phpfox::getPhrase('core.translate_country_iso_kg') : 'Kyrgyzstan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LA" value="LA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_la') ? Phpfox::getPhrase('core.translate_country_iso_la') : 'Lao People\'s Democratic Republic'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LV" value="LV"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LV')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LV')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_lv') ? Phpfox::getPhrase('core.translate_country_iso_lv') : 'Latvia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LB" value="LB"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LB')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LB')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_lb') ? Phpfox::getPhrase('core.translate_country_iso_lb') : 'Lebanon'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LS" value="LS"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LS')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LS')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ls') ? Phpfox::getPhrase('core.translate_country_iso_ls') : 'Lesotho'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LR" value="LR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_lr') ? Phpfox::getPhrase('core.translate_country_iso_lr') : 'Liberia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LY" value="LY"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LY')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LY')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ly') ? Phpfox::getPhrase('core.translate_country_iso_ly') : 'Libyan Arab Jamahiriya'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LI" value="LI"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LI')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LI')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_li') ? Phpfox::getPhrase('core.translate_country_iso_li') : 'Liechtenstein'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LT" value="LT"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LT')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LT')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_lt') ? Phpfox::getPhrase('core.translate_country_iso_lt') : 'Lithuania'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LU" value="LU"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LU')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LU')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_lu') ? Phpfox::getPhrase('core.translate_country_iso_lu') : 'Luxembourg'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MO" value="MO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mo') ? Phpfox::getPhrase('core.translate_country_iso_mo') : 'Macao'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MK" value="MK"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MK')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MK')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mk') ? Phpfox::getPhrase('core.translate_country_iso_mk') : 'Macedonia, the Former Yugoslav Republic of'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MG" value="MG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mg') ? Phpfox::getPhrase('core.translate_country_iso_mg') : 'Madagascar'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MW" value="MW"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MW')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MW')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mw') ? Phpfox::getPhrase('core.translate_country_iso_mw') : 'Malawi'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MY" value="MY"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MY')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MY')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_my') ? Phpfox::getPhrase('core.translate_country_iso_my') : 'Malaysia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MV" value="MV"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MV')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MV')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mv') ? Phpfox::getPhrase('core.translate_country_iso_mv') : 'Maldives'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_ML" value="ML"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'ML')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'ML')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ml') ? Phpfox::getPhrase('core.translate_country_iso_ml') : 'Mali'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MT" value="MT"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MT')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MT')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mt') ? Phpfox::getPhrase('core.translate_country_iso_mt') : 'Malta'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MH" value="MH"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MH')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MH')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mh') ? Phpfox::getPhrase('core.translate_country_iso_mh') : 'Marshall Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MQ" value="MQ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MQ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MQ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mq') ? Phpfox::getPhrase('core.translate_country_iso_mq') : 'Martinique'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MR" value="MR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mr') ? Phpfox::getPhrase('core.translate_country_iso_mr') : 'Mauritania'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MU" value="MU"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MU')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MU')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mu') ? Phpfox::getPhrase('core.translate_country_iso_mu') : 'Mauritius'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_YT" value="YT"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'YT')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'YT')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_yt') ? Phpfox::getPhrase('core.translate_country_iso_yt') : 'Mayotte'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MX" value="MX"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MX')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MX')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mx') ? Phpfox::getPhrase('core.translate_country_iso_mx') : 'Mexico'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_FM" value="FM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'FM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'FM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_fm') ? Phpfox::getPhrase('core.translate_country_iso_fm') : 'Micronesia, Federated States of'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MD" value="MD"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MD')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MD')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_md') ? Phpfox::getPhrase('core.translate_country_iso_md') : 'Moldova, Republic of'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MC" value="MC"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MC')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MC')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mc') ? Phpfox::getPhrase('core.translate_country_iso_mc') : 'Monaco'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MN" value="MN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mn') ? Phpfox::getPhrase('core.translate_country_iso_mn') : 'Mongolia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_ME" value="ME"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'ME')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'ME')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_me') ? Phpfox::getPhrase('core.translate_country_iso_me') : 'Montenegro'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MS" value="MS"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MS')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MS')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ms') ? Phpfox::getPhrase('core.translate_country_iso_ms') : 'Montserrat'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MA" value="MA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ma') ? Phpfox::getPhrase('core.translate_country_iso_ma') : 'Morocco'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MZ" value="MZ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MZ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MZ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mz') ? Phpfox::getPhrase('core.translate_country_iso_mz') : 'Mozambique'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MM" value="MM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mm') ? Phpfox::getPhrase('core.translate_country_iso_mm') : 'Myanmar'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NA" value="NA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_na') ? Phpfox::getPhrase('core.translate_country_iso_na') : 'Namibia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NR" value="NR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_nr') ? Phpfox::getPhrase('core.translate_country_iso_nr') : 'Nauru'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NP" value="NP"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NP')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NP')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_np') ? Phpfox::getPhrase('core.translate_country_iso_np') : 'Nepal'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NL" value="NL"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NL')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NL')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_nl') ? Phpfox::getPhrase('core.translate_country_iso_nl') : 'Netherlands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AN" value="AN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_an') ? Phpfox::getPhrase('core.translate_country_iso_an') : 'Netherlands Antilles'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NC" value="NC"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NC')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NC')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_nc') ? Phpfox::getPhrase('core.translate_country_iso_nc') : 'New Caledonia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NZ" value="NZ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NZ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NZ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_nz') ? Phpfox::getPhrase('core.translate_country_iso_nz') : 'New Zealand'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NI" value="NI"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NI')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NI')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ni') ? Phpfox::getPhrase('core.translate_country_iso_ni') : 'Nicaragua'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NE" value="NE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ne') ? Phpfox::getPhrase('core.translate_country_iso_ne') : 'Niger'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NG" value="NG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ng') ? Phpfox::getPhrase('core.translate_country_iso_ng') : 'Nigeria'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NU" value="NU"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NU')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NU')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_nu') ? Phpfox::getPhrase('core.translate_country_iso_nu') : 'Niue'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NF" value="NF"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NF')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NF')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_nf') ? Phpfox::getPhrase('core.translate_country_iso_nf') : 'Norfolk Island'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_MP" value="MP"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'MP')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'MP')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_mp') ? Phpfox::getPhrase('core.translate_country_iso_mp') : 'Northern Mariana Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_NO" value="NO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'NO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'NO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_no') ? Phpfox::getPhrase('core.translate_country_iso_no') : 'Norway'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_OM" value="OM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'OM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'OM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_om') ? Phpfox::getPhrase('core.translate_country_iso_om') : 'Oman'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PK" value="PK"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PK')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PK')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pk') ? Phpfox::getPhrase('core.translate_country_iso_pk') : 'Pakistan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PW" value="PW"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PW')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PW')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pw') ? Phpfox::getPhrase('core.translate_country_iso_pw') : 'Palau'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PS" value="PS"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PS')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PS')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ps') ? Phpfox::getPhrase('core.translate_country_iso_ps') : 'Palestinian Territory, Occupied'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PA" value="PA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pa') ? Phpfox::getPhrase('core.translate_country_iso_pa') : 'Panama'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PG" value="PG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pg') ? Phpfox::getPhrase('core.translate_country_iso_pg') : 'Papua New Guinea'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PY" value="PY"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PY')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PY')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_py') ? Phpfox::getPhrase('core.translate_country_iso_py') : 'Paraguay'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PE" value="PE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pe') ? Phpfox::getPhrase('core.translate_country_iso_pe') : 'Peru'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PN" value="PN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pn') ? Phpfox::getPhrase('core.translate_country_iso_pn') : 'Pitcairn'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PL" value="PL"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PL')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PL')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pl') ? Phpfox::getPhrase('core.translate_country_iso_pl') : 'Poland'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PT" value="PT"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PT')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PT')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pt') ? Phpfox::getPhrase('core.translate_country_iso_pt') : 'Portugal'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PR" value="PR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pr') ? Phpfox::getPhrase('core.translate_country_iso_pr') : 'Puerto Rico'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_QA" value="QA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'QA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'QA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_qa') ? Phpfox::getPhrase('core.translate_country_iso_qa') : 'Qatar'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_RE" value="RE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'RE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'RE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_re') ? Phpfox::getPhrase('core.translate_country_iso_re') : 'Reunion'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_RO" value="RO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'RO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'RO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ro') ? Phpfox::getPhrase('core.translate_country_iso_ro') : 'Romania'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_RU" value="RU"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'RU')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'RU')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ru') ? Phpfox::getPhrase('core.translate_country_iso_ru') : 'Russian Federation'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_RW" value="RW"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'RW')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'RW')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_rw') ? Phpfox::getPhrase('core.translate_country_iso_rw') : 'Rwanda'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_BL" value="BL"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'BL')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'BL')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_bl') ? Phpfox::getPhrase('core.translate_country_iso_bl') : 'Saint Barthelemy'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SH" value="SH"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SH')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SH')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sh') ? Phpfox::getPhrase('core.translate_country_iso_sh') : 'Saint Helena'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_KN" value="KN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'KN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'KN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_kn') ? Phpfox::getPhrase('core.translate_country_iso_kn') : 'Saint Kitts and Nevis'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LC" value="LC"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LC')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LC')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_lc') ? Phpfox::getPhrase('core.translate_country_iso_lc') : 'Saint Lucia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_PM" value="PM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'PM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'PM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_pm') ? Phpfox::getPhrase('core.translate_country_iso_pm') : 'Saint Pierre and Miquelon'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_VC" value="VC"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'VC')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'VC')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_vc') ? Phpfox::getPhrase('core.translate_country_iso_vc') : 'Saint Vincent and the Grenadines'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_WS" value="WS"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'WS')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'WS')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ws') ? Phpfox::getPhrase('core.translate_country_iso_ws') : 'Samoa'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SM" value="SM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sm') ? Phpfox::getPhrase('core.translate_country_iso_sm') : 'San Marino'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_ST" value="ST"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'ST')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'ST')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_st') ? Phpfox::getPhrase('core.translate_country_iso_st') : 'Sao Tome and Principe'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SA" value="SA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sa') ? Phpfox::getPhrase('core.translate_country_iso_sa') : 'Saudi Arabia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SN" value="SN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sn') ? Phpfox::getPhrase('core.translate_country_iso_sn') : 'Senegal'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_RS" value="RS"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'RS')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'RS')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_rs') ? Phpfox::getPhrase('core.translate_country_iso_rs') : 'Serbia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SC" value="SC"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SC')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SC')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sc') ? Phpfox::getPhrase('core.translate_country_iso_sc') : 'Seychelles'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SL" value="SL"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SL')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SL')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sl') ? Phpfox::getPhrase('core.translate_country_iso_sl') : 'Sierra Leone'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SG" value="SG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sg') ? Phpfox::getPhrase('core.translate_country_iso_sg') : 'Singapore'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SK" value="SK"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SK')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SK')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sk') ? Phpfox::getPhrase('core.translate_country_iso_sk') : 'Slovakia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SI" value="SI"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SI')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SI')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_si') ? Phpfox::getPhrase('core.translate_country_iso_si') : 'Slovenia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SB" value="SB"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SB')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SB')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sb') ? Phpfox::getPhrase('core.translate_country_iso_sb') : 'Solomon Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SO" value="SO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_so') ? Phpfox::getPhrase('core.translate_country_iso_so') : 'Somalia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_ZA" value="ZA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'ZA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'ZA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_za') ? Phpfox::getPhrase('core.translate_country_iso_za') : 'South Africa'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GS" value="GS"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GS')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GS')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gs') ? Phpfox::getPhrase('core.translate_country_iso_gs') : 'South Georgia and the South Sandwich Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_ES" value="ES"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'ES')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'ES')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_es') ? Phpfox::getPhrase('core.translate_country_iso_es') : 'Spain'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_LK" value="LK"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'LK')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'LK')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_lk') ? Phpfox::getPhrase('core.translate_country_iso_lk') : 'Sri Lanka'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SD" value="SD"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SD')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SD')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sd') ? Phpfox::getPhrase('core.translate_country_iso_sd') : 'Sudan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SR" value="SR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sr') ? Phpfox::getPhrase('core.translate_country_iso_sr') : 'Suriname'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SJ" value="SJ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SJ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SJ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sj') ? Phpfox::getPhrase('core.translate_country_iso_sj') : 'Svalbard and Jan Mayen'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SZ" value="SZ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SZ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SZ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sz') ? Phpfox::getPhrase('core.translate_country_iso_sz') : 'Swaziland'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SE" value="SE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_se') ? Phpfox::getPhrase('core.translate_country_iso_se') : 'Sweden'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_CH" value="CH"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'CH')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'CH')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ch') ? Phpfox::getPhrase('core.translate_country_iso_ch') : 'Switzerland'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_SY" value="SY"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'SY')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'SY')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_sy') ? Phpfox::getPhrase('core.translate_country_iso_sy') : 'Syrian Arab Republic'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TW" value="TW"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TW')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TW')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tw') ? Phpfox::getPhrase('core.translate_country_iso_tw') : 'Taiwan, Province of China'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TJ" value="TJ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TJ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TJ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tj') ? Phpfox::getPhrase('core.translate_country_iso_tj') : 'Tajikistan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TZ" value="TZ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TZ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TZ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tz') ? Phpfox::getPhrase('core.translate_country_iso_tz') : 'Tanzania, United Republic of'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TH" value="TH"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TH')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TH')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_th') ? Phpfox::getPhrase('core.translate_country_iso_th') : 'Thailand'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TL" value="TL"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TL')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TL')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tl') ? Phpfox::getPhrase('core.translate_country_iso_tl') : 'Timor-Leste'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TG" value="TG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tg') ? Phpfox::getPhrase('core.translate_country_iso_tg') : 'Togo'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TK" value="TK"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TK')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TK')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tk') ? Phpfox::getPhrase('core.translate_country_iso_tk') : 'Tokelau'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TO" value="TO"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TO')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TO')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_to') ? Phpfox::getPhrase('core.translate_country_iso_to') : 'Tonga'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TT" value="TT"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TT')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TT')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tt') ? Phpfox::getPhrase('core.translate_country_iso_tt') : 'Trinidad and Tobago'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TN" value="TN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tn') ? Phpfox::getPhrase('core.translate_country_iso_tn') : 'Tunisia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TR" value="TR"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TR')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TR')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tr') ? Phpfox::getPhrase('core.translate_country_iso_tr') : 'Turkey'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TM" value="TM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tm') ? Phpfox::getPhrase('core.translate_country_iso_tm') : 'Turkmenistan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TC" value="TC"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TC')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TC')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tc') ? Phpfox::getPhrase('core.translate_country_iso_tc') : 'Turks and Caicos Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_TV" value="TV"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'TV')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'TV')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_tv') ? Phpfox::getPhrase('core.translate_country_iso_tv') : 'Tuvalu'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_UG" value="UG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'UG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'UG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ug') ? Phpfox::getPhrase('core.translate_country_iso_ug') : 'Uganda'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_UA" value="UA"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'UA')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'UA')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ua') ? Phpfox::getPhrase('core.translate_country_iso_ua') : 'Ukraine'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_AE" value="AE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'AE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'AE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ae') ? Phpfox::getPhrase('core.translate_country_iso_ae') : 'United Arab Emirates'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_GB" value="GB"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'GB')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'GB')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_gb') ? Phpfox::getPhrase('core.translate_country_iso_gb') : 'United Kingdom'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_US" value="US"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'US')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'US')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_us') ? Phpfox::getPhrase('core.translate_country_iso_us') : 'United States'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_UM" value="UM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'UM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'UM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_um') ? Phpfox::getPhrase('core.translate_country_iso_um') : 'United States Minor Outlying Islands'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_UY" value="UY"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'UY')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'UY')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_uy') ? Phpfox::getPhrase('core.translate_country_iso_uy') : 'Uruguay'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_UZ" value="UZ"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'UZ')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'UZ')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_uz') ? Phpfox::getPhrase('core.translate_country_iso_uz') : 'Uzbekistan'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_VU" value="VU"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'VU')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'VU')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_vu') ? Phpfox::getPhrase('core.translate_country_iso_vu') : 'Vanuatu'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_VE" value="VE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'VE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'VE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ve') ? Phpfox::getPhrase('core.translate_country_iso_ve') : 'Venezuela'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_VN" value="VN"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'VN')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'VN')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_vn') ? Phpfox::getPhrase('core.translate_country_iso_vn') : 'Viet Nam'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_VG" value="VG"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'VG')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'VG')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_vg') ? Phpfox::getPhrase('core.translate_country_iso_vg') : 'Virgin Islands, British'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_VI" value="VI"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'VI')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'VI')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_vi') ? Phpfox::getPhrase('core.translate_country_iso_vi') : 'Virgin Islands, U.s.'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_WF" value="WF"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'WF')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'WF')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_wf') ? Phpfox::getPhrase('core.translate_country_iso_wf') : 'Wallis and Futuna'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_EH" value="EH"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'EH')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'EH')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_eh') ? Phpfox::getPhrase('core.translate_country_iso_eh') : 'Western Sahara'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_YE" value="YE"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'YE')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'YE')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_ye') ? Phpfox::getPhrase('core.translate_country_iso_ye') : 'Yemen'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_ZM" value="ZM"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'ZM')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'ZM')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_zm') ? Phpfox::getPhrase('core.translate_country_iso_zm') : 'Zambia'); ?></option>
			<option class="js_country_option" id="js_country_iso_option_ZW" value="ZW"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('country_iso') && in_array('country_iso', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['country_iso'])
								&& $aParams['country_iso'] == 'ZW')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['country_iso'])
									&& !isset($aParams['country_iso'])
									&& $this->_aVars['aForms']['country_iso'] == 'ZW')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo (Phpfox::getLib('locale')->isPhrase('core.translate_country_iso_zw') ? Phpfox::getPhrase('core.translate_country_iso_zw') : 'Zimbabwe'); ?></option>
		</select>
<?php Phpfox::getBlock('core.country-child', array()); ?>
<?php if (! $this->_aVars['bIsEdit']): ?>
				<div class="extra_info">
					<a href="#" onclick="$(this).parent().hide(); $('#js_mp_add_city').show(); return false;"><?php echo Phpfox::getPhrase('advancedmarketplace.add_city_zip'); ?></a>
				</div>
<?php endif; ?>
			</div>
		</div>
		
		<div id="js_mp_add_city"<?php if (! $this->_aVars['bIsEdit']): ?> style="display:none;"<?php endif; ?>>
			
			<div class="table">
				<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif; ?><label for="location"><?php echo Phpfox::getPhrase('advancedmarketplace.location_venue'); ?>:</label>
				</div>
				<div class="table_right">
					<input type="text" name="val[location]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['location']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['location']) : (isset($this->_aVars['aForms']['location']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['location']) : '')); ?>
" id="location" size="40" maxlength="200" />			
				</div>
			</div>
			<div class="table">
				<div class="table_left">
					<label for="street_address"><?php echo Phpfox::getPhrase('advancedmarketplace.address'); ?></label>
				</div>
				<div class="table_right">
					<input type="text" name="val[address]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['address']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['address']) : (isset($this->_aVars['aForms']['address']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['address']) : '')); ?>
" id="address" size="30" maxlength="200" />
				</div>
			</div>	
			
			<div class="table">
				<div class="table_left">
					<label for="city"><?php echo Phpfox::getPhrase('advancedmarketplace.city'); ?>:</label>
				</div>
				<div class="table_right">
					<input type="text" name="val[city]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['city']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['city']) : (isset($this->_aVars['aForms']['city']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['city']) : '')); ?>
" id="city" size="20" maxlength="200" />
				</div>
			</div>
			<div class="table">
				<div class="table_left">
					<label for="postal_code"><?php echo Phpfox::getPhrase('advancedmarketplace.zip_postal_code'); ?>:</label>
				</div>
				<div class="table_right">
					<input type="text" name="val[postal_code]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['postal_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['postal_code']) : (isset($this->_aVars['aForms']['postal_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['postal_code']) : '')); ?>
" id="postal_code" size="10" maxlength="20" />
				</div>
			</div>
		</div>
		<div class="table">
	            <div class="table_left">
	            <input id="refresh_map" type="button" value="<?php echo Phpfox::getPhrase('advancedmarketplace.refresh_map'); ?>" onclick="inputToMap();"/>
	            </div>
	            <div class="table_right">
	                <input type="hidden" name="val[gmap][latitude]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['input_gmap_latitude']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['input_gmap_latitude']) : (isset($this->_aVars['aForms']['input_gmap_latitude']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['input_gmap_latitude']) : '')); ?>
" id="input_gmap_latitude" />
	                <input type="hidden" name="val[gmap][longitude]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['input_gmap_longitude']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['input_gmap_longitude']) : (isset($this->_aVars['aForms']['input_gmap_longitude']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['input_gmap_longitude']) : '')); ?>
" id="input_gmap_longitude" />
	                <div id="mapHolder"></div>
	            </div>
	        </div>
	        <div class="clear"></div>
        <br/>
<?php if ($this->_aVars['bIsEdit'] && ( $this->_aVars['aForms']['view_id'] == '0' || $this->_aVars['aForms']['view_id'] == '2' )): ?>
		<div class="separate"></div>

		<div class="table">
			<div class="table_left">
				<label for="postal_code"><?php echo Phpfox::getPhrase('advancedmarketplace.closed_item_sold'); ?>:</label>
			</div>
			<div class="table_right">
				<div class="item_is_active_holder">
					<span class="js_item_active item_is_active"><input type="radio" name="val[view_id]" value="2" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('view_id') && in_array('view_id', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['view_id']) && $aParams['view_id'] == '2'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['view_id']) && !isset($aParams['view_id']) && $this->_aVars['aForms']['view_id'] == '2')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('core.yes'); ?></span>
					<span class="js_item_active item_is_not_active"><input type="radio" name="val[view_id]" value="0" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('view_id') && in_array('view_id', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['view_id']) && $aParams['view_id'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['view_id']) && !isset($aParams['view_id']) && $this->_aVars['aForms']['view_id'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['view_id']) && !isset($aParams['view_id']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('core.no'); ?></span>
				</div>
				<div class="extra_info">
<?php echo Phpfox::getPhrase('advancedmarketplace.enable_this_option_if_this_item_is_sold_and_this_listing_should_be_closed'); ?>
				</div>
			</div>
		</div>
<?php endif; ?>
<?php if (Phpfox ::isModule('tag')):  Phpfox::getBlock('tag.add', array('sType' => 'advancedmarketplace'));  endif; ?>
<?php if (empty ( $this->_aVars['sModule'] ) && Phpfox ::isModule('privacy')): ?>
			<div class="table">
				<div class="table_left">
<?php echo Phpfox::getPhrase('advancedmarketplace.listing_privacy'); ?>:
				</div>
				<div class="table_right">
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy','privacy_info' => 'advancedmarketplace.control_who_can_see_this_listing','default_privacy' => 'advancedmarketplace.display_on_profile')); ?>
				</div>
			</div>
			<div class="table">
				<div class="table_left">
<?php echo Phpfox::getPhrase('advancedmarketplace.comment_privacy'); ?>:
				</div>
				<div class="table_right">
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy_comment','privacy_info' => 'advancedmarketplace.control_who_can_comment_on_this_listing','privacy_no_custom' => true)); ?>
				</div>
			</div>
<?php endif; ?>
<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['post_status'] )): ?>
			<input type="hidden" name="val[post_status]" value="<?php echo $this->_aVars['aForms']['post_status']; ?>" />
<?php endif; ?>
		<div class="table_clear">
			<input type="submit" value="<?php if ($this->_aVars['bIsEdit']):  echo Phpfox::getPhrase('advancedmarketplace.update');  else:  echo Phpfox::getPhrase('advancedmarketplace.submit');  endif; ?>" class="button" />
<?php if (! $this->_aVars['bIsEdit']): ?><input type="submit" name="val[draft]" value="<?php echo Phpfox::getPhrase('blog.save_as_draft'); ?>" class="button button_off" /><?php endif; ?>
<?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['post_status'] == 2): ?>
				<input type="submit" name="val[draft_publish]" value="<?php echo Phpfox::getPhrase('blog.publish'); ?>" class="button button_off" />
<?php endif; ?>
		</div>
	</div>

	<div id="js_mp_block_customize" class="js_mp_block page_section_menu_holder" style="display:none;">
		<div id="js_advancedmarketplace_form_holder">
			<div class="table">
				<div class="table_left">
<?php echo Phpfox::getPhrase('advancedmarketplace.select_image_s'); ?>:
				</div>	
			
				<div id="js_upload_error_message"></div>
				<input type="hidden" name="val[method]" value="massuploader"/>
				<div>
					<input type="hidden" name="val[method]" value="massuploader"/>
				</div>
				<div class="table mass_uploader_table" style="border: none;">
					<div id="swf_msf_upload_button_holder">
						<div class="swf_upload_holder">
							<div id="swf_msf_upload_button"></div>
						</div>

						<div class="swf_upload_text_holder">
							<div class="swf_upload_progress"></div>
							<div class="swf_upload_text">
<?php echo Phpfox::getPhrase('advancedmarketplace.select_file'); ?>(s)
							</div>
						</div>
					</div>
				</div>
				<div class="table_right">
					<div class="extra_info">
<?php echo Phpfox::getPhrase('advancedmarketplace.you_can_upload_a_jpg_gif_or_png_file'); ?>
<?php if ($this->_aVars['iMaxFileSize'] !== null): ?>
						<br />
<?php echo Phpfox::getPhrase('advancedmarketplace.the_file_size_limit_is_file_size_if_your_upload_does_not_work_try_uploading_a_smaller_picture', array('file_size' => Phpfox::getLib('phpfox.file')->filesize($this->_aVars['iMaxFileSize']))); ?>
<?php endif; ?>
					</div>
				</div>
			</div>

		</div>

<?php Phpfox::getBlock('advancedmarketplace.photo', array()); ?>

	</div>

	<div id="js_mp_block_invite" class="js_mp_block page_section_menu_holder" style="display:none;">
<?php if (Phpfox ::isModule('friend')): ?>
			<div style="width:75%; float:left; position:relative;">
				<h3 style="margin-top:0px; padding-top:0px;"><?php echo Phpfox::getPhrase('advancedmarketplace.invite_friends'); ?></h3>
				<div style="height:370px;">
<?php if (isset ( $this->_aVars['aForms']['listing_id'] )): ?>
<?php Phpfox::getBlock('friend.search', array('input' => 'invite','hide' => true,'friend_item_id' => $this->_aVars['aForms']['listing_id'],'friend_module_id' => 'advancedmarketplace')); ?>
<?php endif; ?>
				</div>
<?php endif; ?>

				<h3><?php echo Phpfox::getPhrase('advancedmarketplace.invite_people_via_email'); ?></h3>
				<div class="p_4">
					<textarea cols="40" rows="8" name="val[emails]" style="width:98%; height:60px;"></textarea>
					<div class="extra_info">
<?php echo Phpfox::getPhrase('advancedmarketplace.separate_multiple_emails_with_a_comma'); ?>
						<div>
							<input type="checkbox" name="val[invite_from]" value="1"> <?php echo Phpfox::getPhrase('mail.send_from_my_own_address_semail', array('sEmail' => $this->_aVars['sMyEmail'])); ?>
						</div>
					</div>
				</div>

				<h3><?php echo Phpfox::getPhrase('advancedmarketplace.add_a_personal_message'); ?></h3>
				<div class="p_4">
					<textarea cols="40" rows="8" name="val[personal_message]" style="width:98%; height:60px;"></textarea>
				</div>

				<div class="p_top_8">
					<input type="submit" value="<?php echo Phpfox::getPhrase('advancedmarketplace.send_invitations'); ?>" class="button" />
				</div>

			</div>
<?php if (Phpfox ::isModule('friend')): ?>
			<div style="margin-left:77%; position:relative;">
				<div class="block">
					<div class="title"><?php echo Phpfox::getPhrase('advancedmarketplace.new_guest_list'); ?></div>
					<div class="content">
						<div class="label_flow" style="height:330px;">
							<div id="js_selected_friends"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="clear"></div>
<?php endif; ?>
	</div>

<?php if (isset ( $this->_aVars['aForms']['listing_id'] ) && $this->_aVars['bIsEdit']): ?>
	<div id="js_mp_block_manage" class="js_mp_block page_section_menu_holder" style="display:none;">
<?php Phpfox::getBlock('advancedmarketplace.list', array()); ?>
	</div>
<?php endif; ?>


</form>

<?php echo '
<script>
	function showCoupon()
	{
		var iId = document.getElementById("yn_product_type").value;

		if(iId == 2)
		{
			$(\'#yn_coupon_code\').show();
			$(\'#yn_coupon_activity\').show();			
		}
		else
		{
			$(\'#yn_coupon_code\').css(\'display\',\'none\');
			$(\'#yn_coupon_activity\').css(\'display\',\'none\');
		}
	}
</script>
'; ?>


