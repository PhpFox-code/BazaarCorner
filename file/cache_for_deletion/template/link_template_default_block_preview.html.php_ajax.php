<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:14 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: preview.html.php 3533 2011-11-21 14:07:21Z Raymond_Benc $
 */
 
 

 if (isset ( $this->_aVars['aLink']['images'] ) && $this->_aVars['iTotalImages'] = ( int ) count ( $this->_aVars['aLink']['images'] )):  endif; ?>
<script type="text/javascript">
	var $iTotalAttachmentImages = <?php if (isset ( $this->_aVars['iTotalImages'] )):  echo $this->_aVars['iTotalImages'];  else: ?>0<?php endif; ?>;	
	$Core.loadStaticFile('<?php echo $this->getStyle('static_script', 'preview.js', 'link'); ?>');
</script>
<?php if (! empty ( $this->_aVars['aLink']['embed_code'] )): ?>
<div style="display:none;"><textarea cols="30" rows="4" name="val[link][embed_code]"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aLink']['embed_code']); ?></textarea></div>
<?php endif; ?>
<div class="attachment_image">
	<div class="attachment_image_holder">
<?php if (! empty ( $this->_aVars['aLink']['default_image'] )): ?>
		<div><input type="hidden" name="val[link][image_hide]" value="0" id="js_attachment_link_default_image_hide" /></div>
		<div><input type="hidden" name="val[link][image]" value="<?php echo $this->_aVars['aLink']['default_image']; ?>" id="js_attachment_link_default_image_input" /></div>
		<div id="js_attachment_link_default_image">	
			<img src="<?php echo $this->_aVars['aLink']['default_image']; ?>" alt="" style="max-width:120px;" />
		</div>
<?php endif; ?>
	</div>
</div>
<div class="attachment_body">
<?php if (isset ( $this->_aVars['aLink']['title'] )): ?>
	<div>
		<div class="js_text_attachment_edit" style="display:none;"><input type="text" name="val[link][title]" value="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aLink']['title']); ?>" class="js_text_attachment_edit_value" /></div>
		<a class="attachment_body_title js_text_attachment_edit_link" href="#"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aLink']['title']); ?></a>
	</div>
<?php endif; ?>
	<div class="attachment_body_link">
<?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aLink']['link']), 50, '...'); ?>
	</div>
<?php if (isset ( $this->_aVars['aLink']['description'] )): ?>
	<div class="attachment_body_description">	
		<div class="js_text_attachment_edit" style="display:none;"><textarea cols="30" rows="4" name="val[link][description]" class="js_text_attachment_edit_value"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aLink']['description']); ?></textarea></div>
		<a class="js_text_attachment_edit_link" href="#"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aLink']['description']); ?></a>	
	</div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aLink']['images'] )): ?>
<?php if ($this->_aVars['iTotalImages'] > 1): ?>
	<div style="display:none;">
<?php if (count((array)$this->_aVars['aLink']['images'])):  $this->_aPhpfoxVars['iteration']['images'] = 0;  foreach ((array) $this->_aVars['aLink']['images'] as $this->_aVars['sImage']):  $this->_aPhpfoxVars['iteration']['images']++; ?>

		<div id="js_hidden_attachment_image_value_<?php echo $this->_aPhpfoxVars['iteration']['images']; ?>"><?php echo $this->_aVars['sImage']; ?></div>
		<div id="js_hidden_attachment_image_<?php echo $this->_aPhpfoxVars['iteration']['images']; ?>">
			<img src="<?php echo $this->_aVars['sImage']; ?>" alt="" style="max-width:120px;" />
		</div>
<?php endforeach; endif; ?>
	</div>	
	<div class="attachment_pager">
		<ul>
			<li class="no_link"><a href="#" onclick="return $Core.changeDefaultAttachmentImage(this, 'previous');" class="previous first"><?php echo Phpfox::getPhrase('link.previous'); ?></a></li>
			<li><a href="#" onclick="return $Core.changeDefaultAttachmentImage(this, 'next');" class="next"><?php echo Phpfox::getPhrase('link.next'); ?></a></li>
			<li class="counter"><span id="js_attachment_link_counter">1 of <?php echo $this->_aVars['iTotalImages']; ?></span><span class="small"><?php echo Phpfox::getPhrase('link.choose_a_thumbnail'); ?></span></li>
		</ul>
		<div class="clear"></div>
	</div>
<?php endif; ?>
	
	<div>
		<label><input type="checkbox" name="attachment_link_checkbox" value="0" onchange="$Core.toggleAttachmentLinkThumb(this);" > <?php echo Phpfox::getPhrase('link.no_thumbnail'); ?></label>
	</div>	
	
<?php endif; ?>
</div>
<div class="clear"></div>
