<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 9, 2013, 6:21 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: info.html.php 602 2009-05-29 10:52:44Z Raymond_Benc $
 */
 
 

?>
<div style="position:relative;">
<?php if (count((array)$this->_aVars['aInfos'])):  foreach ((array) $this->_aVars['aInfos'] as $this->_aVars['sPhrase'] => $this->_aVars['sValue']): ?>
	<div class="info">
		<div class="info_left">
<?php echo $this->_aVars['sPhrase']; ?>:
		</div>	
		<div class="info_right">
<?php echo $this->_aVars['sValue']; ?>
		</div>	
	</div>
<?php endforeach; endif; ?>
</div>
