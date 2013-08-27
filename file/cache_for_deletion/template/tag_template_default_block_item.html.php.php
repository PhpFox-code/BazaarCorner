<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:12 am */ ?>
<?php if (isset ( $this->_aVars['sTags'] ) && ! empty ( $this->_aVars['sTags'] )):  if ($this->_aVars['bIsInline']): ?>
 <span id="js_quick_edit_tag<?php echo $this->_aVars['iItemId']; ?>"><?php if ($this->_aVars['bDontCleanTags']):  echo $this->_aVars['sTags'];  else:  echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['sTags']), 55, '...'), 20);  endif; ?></span>
<?php else: ?>
<div class="item_tag_holder">
	<span class="item_tag">
<?php echo Phpfox::getPhrase('tag.topics'); ?>:
	</span>
	<span id="js_quick_edit_tag<?php echo $this->_aVars['iItemId']; ?>"><?php if (count((array)$this->_aVars['aTags'])):  $this->_aPhpfoxVars['iteration']['tag'] = 0;  foreach ((array) $this->_aVars['aTags'] as $this->_aVars['aTag']):  $this->_aPhpfoxVars['iteration']['tag']++;  if ($this->_aPhpfoxVars['iteration']['tag'] != 1): ?>, <?php endif; ?><a href="<?php echo $this->_aVars['aTag']['tag_url']; ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aTag']['tag_text']), 55, '...'), 20); ?></a><?php endforeach; endif; ?></span>
<?php if (( Phpfox ::getUserId() == $this->_aVars['iUserId'] && Phpfox ::getUserParam('tag.edit_own_tags')) || Phpfox ::getUserParam('tag.edit_user_tags')): ?>
	<div id="js_quick_edit_tag_content<?php echo $this->_aVars['iItemId']; ?>" style="display:none;">
<?php if (count((array)$this->_aVars['aTags'])):  $this->_aPhpfoxVars['iteration']['tag'] = 0;  foreach ((array) $this->_aVars['aTags'] as $this->_aVars['aTag']):  $this->_aPhpfoxVars['iteration']['tag']++;  if ($this->_aPhpfoxVars['iteration']['tag'] != 1): ?>, <?php endif;  echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aTag']['tag_text']), 55, '...'), 20);  endforeach; endif; ?>
	</div>
<?php endif; ?>
</div>
<?php endif;  endif;  unset($this->_aVars['sTags']); ?>
