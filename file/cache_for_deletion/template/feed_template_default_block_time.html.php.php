<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:13 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: entry.html.php 4171 2012-05-16 07:10:36Z Raymond_Benc $
 */
 
 

?>
<div id="timeline_dates">
	<ul>
		<li class="parent active"><a href="#" onclick="$.ajaxCall('feed.viewMore', '<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] )): ?>&profile_user_id=<?php echo $this->_aVars['aUser']['user_id'];  endif;  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&callback_module_id=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&callback_item_id=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>&resettimeline=1', 'GET'); return false;" class="no_ajax_link"><?php echo Phpfox::getPhrase('feed.now'); ?></a></li>
<?php if (count((array)$this->_aVars['aTimelineDates'])):  foreach ((array) $this->_aVars['aTimelineDates'] as $this->_aVars['aTimelineDate']): ?>
		<li class="parent">
			<a href="#" onclick="$.ajaxCall('feed.viewMore', '<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] )): ?>&profile_user_id=<?php echo $this->_aVars['aUser']['user_id'];  endif;  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&callback_module_id=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&callback_item_id=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>&year=<?php echo $this->_aVars['aTimelineDate']['year']; ?>&forceview=1', 'GET'); $('#timeline_dates ul li ul').hide(); $('#timeline_dates li').removeClass('active'); $(this).parent().addClass('active'); $(this).parent().find('ul').show(); return false;" class="no_ajax_link"><?php echo $this->_aVars['aTimelineDate']['year']; ?></a>
<?php if (isset ( $this->_aVars['aTimelineDate']['months'] ) && count ( $this->_aVars['aTimelineDate']['months'] )): ?>
			<ul>
<?php if (count((array)$this->_aVars['aTimelineDate']['months'])):  foreach ((array) $this->_aVars['aTimelineDate']['months'] as $this->_aVars['aMonth']): ?>
				<li><a href="#" onclick="$.ajaxCall('feed.viewMore', '<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] )): ?>&profile_user_id=<?php echo $this->_aVars['aUser']['user_id'];  endif;  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&callback_module_id=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&callback_item_id=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>&year=<?php echo $this->_aVars['aTimelineDate']['year']; ?>&month=<?php echo $this->_aVars['aMonth']['id']; ?>&forceview=1', 'GET'); return false;" class="no_ajax_link"><?php echo $this->_aVars['aMonth']['phrase']; ?></a></li>
<?php endforeach; endif; ?>
			</ul>
<?php endif; ?>
		</li>
<?php endforeach; endif; ?>
	</ul>
</div>
<?php Phpfox::getBlock('report.profile', array()); ?>
