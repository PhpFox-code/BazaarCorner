<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: March 2, 2013, 11:24 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: default.html.php 906 2009-08-29 13:49:12Z Raymond_Benc $
 */
 
 

?>
<?php echo $this->_aVars['sMessage']; ?>
<?php if (isset ( $this->_aVars['sNext'] )): ?>
 Please hold...
<meta http-equiv="refresh" content="2;url=<?php echo $this->_aVars['sNext']; ?>" />
<?php endif; ?>
