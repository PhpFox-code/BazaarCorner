<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:13 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: birth.html.php 4189 2012-05-31 10:16:13Z Raymond_Benc $
 */
 
 

 if ($this->_aVars['aUser']['dob_setting'] == '3'): ?>
	<div class="message js_no_feed_to_show"><?php echo Phpfox::getPhrase('feed.there_are_no_new_feeds_to_view_at_this_time'); ?></div>
<?php else: ?>
<div class="timeline_holder">
	<div class="timeline_birth_title">		
<?php echo Phpfox::getPhrase('profile.born_on_birthday', array('birthday' => $this->_aVars['sBirthDisplay'])); ?>
	</div>
</div>
<?php endif; ?>
