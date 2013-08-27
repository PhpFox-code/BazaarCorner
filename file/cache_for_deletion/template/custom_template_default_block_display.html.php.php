<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:13 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: display.html.php 3042 2011-09-08 09:58:34Z Raymond_Benc $
 */
 
 

 if (count((array)$this->_aVars['aCustomMain'])):  foreach ((array) $this->_aVars['aCustomMain'] as $this->_aVars['aCustom']):  if ($this->_aVars['sTemplate'] == 'info'):  if (! empty ( $this->_aVars['aCustom']['value'] )): ?>
<div class="info">
	<div class="info_left">
<?php echo Phpfox::getPhrase($this->_aVars['aCustom']['phrase_var_name']); ?>:
	</div>	
	<div class="info_right">
<?php Phpfox::getBlock('custom.entry', array('data' => $this->_aVars['aCustom'],'template' => $this->_aVars['sTemplate'],'edit_user_id' => $this->_aVars['aUser']['user_id'])); ?>
	</div>	
</div>		
<?php endif;  else: ?>
<?php Phpfox::getBlock('custom.block', array('data' => $this->_aVars['aCustom'],'template' => $this->_aVars['sTemplate'],'edit_user_id' => $this->_aVars['aUser']['user_id']));  endif;  endforeach; endif; ?>
