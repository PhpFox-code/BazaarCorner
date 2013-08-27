<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 9, 2013, 6:21 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: activity.html.php 3326 2011-10-20 09:12:45Z Miguel_Espinoza $
 */
 
 

?>
<div style="position:relative;">
<?php if (count((array)$this->_aVars['aActivites'])):  foreach ((array) $this->_aVars['aActivites'] as $this->_aVars['sPhrase'] => $this->_aVars['sValue']): ?>
	<div class="info">
		<div class="info_left">
<?php echo $this->_aVars['sPhrase']; ?>:
		</div>	
		<div class="info_right" style="margin-left: 125px;">
<?php echo $this->_aVars['sValue']; ?>
		</div>	
	</div>
<?php endforeach; endif; ?>
</div>
