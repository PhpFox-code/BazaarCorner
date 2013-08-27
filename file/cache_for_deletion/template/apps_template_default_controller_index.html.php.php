<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 8:18 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Miguel Espinoza
 * @package 		Phpfox
 * @version 		$Id: controller.html.php 64 2009-01-19 15:05:54Z Raymond_Benc $
 */
 
 

 if (count ( $this->_aVars['aApps'] )): ?>

<?php if (count((array)$this->_aVars['aApps'])):  $this->_aPhpfoxVars['iteration']['apps'] = 0;  foreach ((array) $this->_aVars['aApps'] as $this->_aVars['aApp']):  $this->_aPhpfoxVars['iteration']['apps']++; ?>

	<div id="js_apps_<?php echo $this->_aVars['aApp']['app_id']; ?>" class="<?php if (is_int ( $this->_aPhpfoxVars['iteration']['apps'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['apps'] == 1 && ! PHPFOX_IS_AJAX): ?> row_first<?php endif; ?>">		
		<div class="row_title">	
			<div class="row_title_image">
				<a href="<?php echo Phpfox::permalink('apps', $this->_aVars['aApp']['app_id'], $this->_aVars['aApp']['app_title'], false, null, (array) array (
)); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => 0,'path' => 'app.url_image','file' => $this->_aVars['aApp']['image_path'],'suffix' => '_square','max_width' => 50,'max_height' => 50,'title' => $this->_aVars['aApp']['app_title'])); ?></a>
				
<?php if (Phpfox ::getUserParam('apps.can_moderate_apps') || ( isset ( $this->_aVars['aApps']['user_id'] ) && $this->_aVars['aApps']['user_id'] == Phpfox ::getUserId())): ?>
				<div class="row_edit_bar_parent">
					<div class="row_edit_bar_holder">
						<ul>
							<?php /* Cached: February 25, 2013, 8:18 am */ 


 if (Phpfox ::getUserParam('apps.can_moderate_apps') || $this->_aVars['aApp']['user_id'] == Phpfox ::getUserId()): ?>
<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('apps.add', array('id' => $this->_aVars['aApp']['app_id'])); ?>"><?php echo Phpfox::getPhrase('apps.manage'); ?></a></li>
<?php endif;  if (isset ( $this->_aVars['aApp']['is_installed'] ) && $this->_aVars['aApp']['is_installed']): ?>
	<li class="item_uninstall">
		<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('apps', array('uninstall' => $this->_aVars['aApp']['app_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('apps.are_you_sure', array('phpfox_squote' => true)); ?>');" class="no_ajax_link">
<?php echo Phpfox::getPhrase('apps.uninstall'); ?>
		</a>
	</li>
	<li class="item_permissions">
		<a href="#" onclick="tb_show('Customize Access', $.ajaxBox('apps.showSetPermissions', 'TB_inline=true&amp;height=450&amp;width=400&amp;id=<?php echo $this->_aVars['aApp']['app_id']; ?>')); return false;">
<?php echo Phpfox::getPhrase('apps.permissions'); ?>
		</a>
	</li>
<?php endif;  if (Phpfox ::getUserParam('apps.can_moderate_apps') || $this->_aVars['aApp']['user_id'] == Phpfox ::getUserId()): ?>
	<li class="item_delete">
		<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('apps', array('delete' => $this->_aVars['aApp']['app_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('apps.are_you_sure', array('phpfox_squote' => true)); ?>');" class="no_ajax_link">
<?php echo Phpfox::getPhrase('apps.delete'); ?>
		</a>
	</li>
<?php endif; ?>
						</ul>			
					</div>
					<div class="row_edit_bar">				
							<a href="#" class="row_edit_bar_action"><span><?php echo Phpfox::getPhrase('apps.actions'); ?></span></a>							
					</div>
				</div>
<?php endif; ?>
				
<?php if (Phpfox ::getUserParam('apps.can_moderate_apps')): ?>
				<a href="#<?php echo $this->_aVars['aApp']['app_id']; ?>" class="moderate_link" rel="apps"><?php echo Phpfox::getPhrase('apps.moderate'); ?></a>
<?php endif; ?>
			</div>
			<div class="row_title_info">
				<a href="<?php echo Phpfox::permalink('apps', $this->_aVars['aApp']['app_id'], $this->_aVars['aApp']['app_title'], false, null, (array) array (
)); ?>" class="link"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aApp']['app_title']), 55, '...'), 40); ?></a>			
				<div class="extra_info">
					<ul class="extra_info_middot"><?php if (isset ( $this->_aVars['aApp']['category_name'] )): ?><li><?php echo Phpfox::getLib('locale')->convert($this->_aVars['aApp']['category_name']); ?></li><?php endif; ?></ul>
				</div>					
				<div class="item_content">
<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aApp']['app_description']); ?>
				</div>
<?php Phpfox::getBlock('feed.comment', array('aFeed' => $this->_aVars['aApp']['aFeed'])); ?>
			</div>							
		</div>
	</div>
<?php endforeach; endif; ?>
	
<?php if (Phpfox ::getUserParam('apps.can_moderate_apps')): ?>
<?php Phpfox::getBlock('core.moderation'); ?>
<?php endif; ?>
	
<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  else: ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('apps.no_apps_found'); ?>
</div>
<?php endif; ?>
