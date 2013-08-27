<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:12 am */ ?>
<div class="table">
	<div class="table_left">
<?php echo Phpfox::getPhrase('tag.topics'); ?>:
	</div>
	<div class="table_right">
		<input type="text" name="val<?php if ($this->_aVars['iItemId']): ?>[<?php echo $this->_aVars['iItemId']; ?>]<?php endif; ?>[tag_list]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['tag_list']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['tag_list']) : (isset($this->_aVars['aForms']['tag_list']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['tag_list']) : '')); ?>
" size="30" />
		<div class="extra_info">
<?php echo Phpfox::getPhrase('tag.separate_multiple_topics_with_commas'); ?>
		</div>
	</div>
	<div class="clear"></div>
</div>
