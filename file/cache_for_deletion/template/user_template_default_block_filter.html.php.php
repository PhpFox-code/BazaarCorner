<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 26, 2013, 12:24 am */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: filter.html.php 4361 2012-06-26 14:01:00Z Raymond_Benc $
 */



?>
<form method="post" action="<?php if (isset ( $this->_aVars['aCallback']['url_home'] )):  echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aCallback']['url_home'], array('view' => $this->_aVars['sView']));  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('user.browse', array('view' => $this->_aVars['sView']));  endif; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>';  if (isset ( $this->_aVars['aCallback']['url_home'] )): ?>
	<div><input type="hidden" name="url_home" value="<?php echo $this->_aVars['aCallback']['url_home']; ?>" /></div>
<?php endif;  if (Phpfox ::getUserParam('user.can_search_user_gender')): ?>
	<div class="p_top_4">
		<span class="user_browse_title"><?php echo Phpfox::getPhrase('user.browse_for'); ?></span>:
		<div class="p_4">
<?php echo $this->_aVars['aFilters']['gender']; ?>
		</div>
	</div>
<?php endif;  if (Phpfox ::getUserParam('user.can_search_user_age')): ?>
	<div class="p_top_4">
		<span class="user_browse_title"><?php echo Phpfox::getPhrase('user.between_ages'); ?></span>:
		<div class="p_4">
<?php echo $this->_aVars['aFilters']['from']; ?> - <?php echo $this->_aVars['aFilters']['to']; ?>
		</div>
	</div>
<?php endif; ?>
	<div class="p_top_4">
		<span class="user_browse_title"><?php echo Phpfox::getPhrase('user.located_within'); ?></span>:
		<div class="p_4">
<?php echo $this->_aVars['aFilters']['country']; ?>
<?php Phpfox::getBlock('core.country-child', array('country_child_filter' => true,'country_child_type' => 'browse')); ?>
		</div>
	</div>

	<div class="p_top_4">
		<span class="user_browse_title"><?php echo Phpfox::getPhrase('user.city'); ?></span>:
		<div class="p_4">
<?php echo $this->_aVars['aFilters']['city']; ?>
		</div>
	</div>

	<div class="p_top_4">
		<span class="user_browse_title"><?php echo Phpfox::getPhrase('user.zip_postal_code'); ?></span>:
		<div class="p_4">
<?php echo $this->_aVars['aFilters']['zip']; ?>
		</div>
	</div>

	<div class="p_top_4">
		<span class="user_browse_title"><?php echo Phpfox::getPhrase('user.keywords'); ?></span>:
		<div class="p_4">
<?php echo $this->_aVars['aFilters']['keyword']; ?>
			<div class="extra_info">
<?php echo Phpfox::getPhrase('user.within'); ?>: <?php echo $this->_aVars['aFilters']['type']; ?>
			</div>
		</div>
	</div>
		
	<div class="p_top_8">
		<input type="submit" value="<?php echo Phpfox::getPhrase('user.browse_filter_submit'); ?>" class="button" name="search[submit]" />
	</div>
	
	<ul id="js_user_browse_advanced_link">
		<li><a href="#" onclick="$('#js_user_browse_advanced').show(); return false;" id="user_browse_advanced_link"><?php echo Phpfox::getPhrase('user.advanced_filters'); ?></a></li>
<?php if (isset ( $this->_aVars['bIsInSearchMode'] ) && $this->_aVars['bIsInSearchMode']): ?>
		<li><a href="#"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.browse'); ?>"><?php echo Phpfox::getPhrase('user.reset_browse_criteria'); ?></a></a></li>
<?php endif; ?>
	</ul>
	
	<div id="js_user_browse_advanced">
		<div class="user_browse_content">
		    
		    
	<div id="browse_custom_fields_popup_holder">
<?php if (count((array)$this->_aVars['aCustomFields'])):  $this->_aPhpfoxVars['iteration']['customfield'] = 0;  foreach ((array) $this->_aVars['aCustomFields'] as $this->_aVars['aCustomField']):  $this->_aPhpfoxVars['iteration']['customfield']++; ?>

	    <div class="go_left">

<?php if (isset ( $this->_aVars['aCustomField']['fields'] )): ?>
		<br />
		<div class="title">
<?php echo Phpfox::getPhrase($this->_aVars['aCustomField']['phrase_var_name']); ?>
		</div>
		<br />
			<?php /* Cached: February 26, 2013, 12:24 am */ 
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: entry.html.php 382 2009-04-08 15:51:16Z Raymond_Benc $
 */

?>

<?php if (isset ( $this->_aVars['aCustomField']['fields'] )): ?>
<?php if (count((array)$this->_aVars['aCustomField']['fields'])):  foreach ((array) $this->_aVars['aCustomField']['fields'] as $this->_aVars['aField']): ?>
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase($this->_aVars['aField']['phrase_var_name']); ?>:
			</div>
			<div class="table_right">
<?php if ($this->_aVars['aField']['var_type'] == 'textarea' || $this->_aVars['aField']['var_type'] == 'text'): ?>
						<input type="text" class="js_custom_search" name="custom[<?php echo $this->_aVars['aField']['field_id']; ?>]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams[''.$this->_aVars['aField']['field_id'].'']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams[''.$this->_aVars['aField']['field_id'].'']) : (isset($this->_aVars['aForms'][''.$this->_aVars['aField']['field_id'].'']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms'][''.$this->_aVars['aField']['field_id'].'']) : '')); ?>
" size="25" />
<?php elseif ($this->_aVars['aField']['var_type'] == 'select'): ?>
					 <!-- custom input type select -->
						<select name="custom[<?php echo $this->_aVars['aField']['field_id']; ?>]" class="js_custom_search">
							<option value=""><?php echo Phpfox::getPhrase('user.any'); ?></option>
<?php if (count((array)$this->_aVars['aField']['options'])):  foreach ((array) $this->_aVars['aField']['options'] as $this->_aVars['aOption']): ?>
							<option value="<?php echo $this->_aVars['aOption']['option_id']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'][''.$this->_aVars['aField']['field_id'].''])
 && is_numeric(''.$this->_aVars['aOption']['option_id'].'') && in_array(''.$this->_aVars['aOption']['option_id'].'', $this->_aVars['aForms'][''.$this->_aVars['aField']['field_id'].'']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams[''.$this->_aVars['aOption']['option_id'].''])
								&& $aParams[''.$this->_aVars['aOption']['option_id'].''] == $this->_aVars['aOption']['option_id'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms'][''.$this->_aVars['aOption']['option_id'].''])
									&& !isset($aParams[''.$this->_aVars['aOption']['option_id'].''])
									&& $this->_aVars['aForms'][''.$this->_aVars['aOption']['option_id'].''] == $this->_aVars['aOption']['option_id'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase($this->_aVars['aOption']['phrase_var_name']); ?></option>
<?php endforeach; endif; ?>
						</select>
<?php elseif ($this->_aVars['aField']['var_type'] == 'multiselect'): ?>
						<!-- custom input type multi select -->
						<select name="custom[<?php echo $this->_aVars['aField']['field_id']; ?>][]" multiple class="js_custom_search" >
							<option value=""><?php echo Phpfox::getPhrase('user.any'); ?></option>
<?php if (count((array)$this->_aVars['aField']['options'])):  foreach ((array) $this->_aVars['aField']['options'] as $this->_aVars['aOption']): ?>
									<option value="<?php echo $this->_aVars['aOption']['option_id']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'][''.$this->_aVars['aField']['field_id'].''])
 && is_numeric(''.$this->_aVars['aOption']['option_id'].'') && in_array(''.$this->_aVars['aOption']['option_id'].'', $this->_aVars['aForms'][''.$this->_aVars['aField']['field_id'].'']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams[''.$this->_aVars['aOption']['option_id'].''])
								&& $aParams[''.$this->_aVars['aOption']['option_id'].''] == $this->_aVars['aOption']['option_id'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms'][''.$this->_aVars['aOption']['option_id'].''])
									&& !isset($aParams[''.$this->_aVars['aOption']['option_id'].''])
									&& $this->_aVars['aForms'][''.$this->_aVars['aOption']['option_id'].''] == $this->_aVars['aOption']['option_id'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase($this->_aVars['aOption']['phrase_var_name']); ?></option>
<?php endforeach; endif; ?>
						</select>
<?php elseif ($this->_aVars['aField']['var_type'] == 'radio'): ?>
					
<?php if (count((array)$this->_aVars['aField']['options'])):  foreach ((array) $this->_aVars['aField']['options'] as $this->_aVars['aOption']): ?>
				<input type="radio" name="custom[<?php echo $this->_aVars['aField']['field_id']; ?>]" value="<?php echo $this->_aVars['aOption']['option_id']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric(''.$this->_aVars['aOption']['option_id'].'') && in_array(''.$this->_aVars['aOption']['option_id'].'', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams[''.$this->_aVars['aOption']['option_id'].'']) && $aParams[''.$this->_aVars['aOption']['option_id'].''] == ''.$this->_aVars['aOption']['option_id'].''))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms'][''.$this->_aVars['aOption']['option_id'].'']) && !isset($aParams[''.$this->_aVars['aOption']['option_id'].'']) && $this->_aVars['aForms'][''.$this->_aVars['aOption']['option_id'].''] == ''.$this->_aVars['aOption']['option_id'].'')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
 class="js_custom_search"><?php echo Phpfox::getPhrase($this->_aVars['aOption']['phrase_var_name']); ?> <br />
<?php endforeach; endif; ?>
<?php elseif ($this->_aVars['aField']['var_type'] == 'checkbox'): ?>
<?php if (count((array)$this->_aVars['aField']['options'])):  foreach ((array) $this->_aVars['aField']['options'] as $this->_aVars['aOption']): ?>
				<input type="checkbox" name="custom[<?php echo $this->_aVars['aField']['field_id']; ?>][<?php echo $this->_aVars['aOption']['option_id']; ?>]" value="<?php echo $this->_aVars['aOption']['option_id']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'][''.$this->_aVars['aField']['field_id'].''])
 && is_numeric(''.$this->_aVars['aOption']['option_id'].'') && in_array(''.$this->_aVars['aOption']['option_id'].'', $this->_aVars['aForms'][''.$this->_aVars['aField']['field_id'].'']))
							
{
								echo ' checked="checked" ';
							}

							if (isset($aParams[''.$this->_aVars['aOption']['option_id'].''])
								&& $aParams[''.$this->_aVars['aOption']['option_id'].''] == $this->_aVars['aOption']['option_id'])

							{

								echo ' checked="checked" ';

							}

							else

							{

								if (isset($this->_aVars['aForms'][''.$this->_aVars['aOption']['option_id'].''])
									&& !isset($aParams[''.$this->_aVars['aOption']['option_id'].''])
									&& $this->_aVars['aForms'][''.$this->_aVars['aOption']['option_id'].''] == $this->_aVars['aOption']['option_id'])
								{
								 echo ' checked="checked" ';
								}
								else
								{
									echo "";
								}
							}
							?>
 class="js_custom_search v_middle"> <?php echo Phpfox::getPhrase($this->_aVars['aOption']['phrase_var_name']); ?> <br />
<?php endforeach; endif; ?>
<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
<?php endforeach; endif;  endif; ?>
<?php endif; ?>
	    </div>
<?php if (is_int ( $this->_aPhpfoxVars['iteration']['customfield'] / 3 )): ?>
		<div class="clear"> </div>
<?php endif; ?>
<?php endforeach; endif; ?>
	    
	    <div class="clear"></div>
	</div>
<?php if (count ( $this->_aVars['aForms'] )): ?>
<?php echo ''; ?>

<?php endif; ?>
	
	<div class="p_top_4" style="border-top: 1px #DFDFDF solid;">
	    <span class="user_browse_title"><?php echo Phpfox::getPhrase('user.sort_results_by'); ?></span>:
	    <div class="p_top_4">
<?php echo $this->_aVars['aFilters']['sort']; ?> <?php echo $this->_aVars['aFilters']['sort_by']; ?>
	    </div>
	</div>	
		
	<div class="p_top_15">
	    <a href="#" id="js_user_browse_advanced_link_close" onclick="$('#js_user_browse_advanced').hide(); return false;"><?php echo Phpfox::getPhrase('user.close_advanced_filters'); ?></a>
	    <input type="submit" value="<?php echo Phpfox::getPhrase('user.browse_filter_submit'); ?>" class="button" name="search[submit]" />
	</div>	
		    
		</div>
	</div>

	

</form>

