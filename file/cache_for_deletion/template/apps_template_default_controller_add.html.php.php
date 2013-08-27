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
 
 

?>

<?php if (! isset ( $this->_aVars['aApp'] )): ?>
<form action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('apps.add'); ?>" method="post" enctype="multipart/form-data">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('apps.name'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="app[name]" id="name" size="40" />
		</div>
	</div>
	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('apps.category'); ?>:
		</div>
		<div class="table_right">
			<select name="app[category]">
				<option value=""><?php echo Phpfox::getPhrase('apps.select'); ?>:</option>
<?php if (count((array)$this->_aVars['aCategories'])):  foreach ((array) $this->_aVars['aCategories'] as $this->_aVars['aCategory']): ?>
				<option value="<?php echo $this->_aVars['aCategory']['category_id']; ?>"><?php echo Phpfox::getLib('locale')->convert($this->_aVars['aCategory']['category_name']); ?></option>
<?php endforeach; endif; ?>
			</select>
		</div>
	</div>	
	
	<div class="table_clear">
		<input type="submit" value="<?php echo Phpfox::getPhrase('apps.submit'); ?>" class="button">
	</div>

</form>

<?php else: ?>
<form action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('apps.add', array('id' => $this->_aVars['aApp']['app_id'])); ?>" method="post" enctype="multipart/form-data">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<div><input type="hidden" name="val[app_id]" value="<?php echo $this->_aVars['aApp']['app_id']; ?>" /></div>
	<div id="js_apps_block_general" class="js_apps_block page_section_menu_holder">		
		
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('apps.app_id'); ?>:
			</div>
			<div class="table_right">
<?php echo $this->_aVars['aApp']['public_key']; ?>
			</div>
		</div>		
		
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('apps.title'); ?>:
			</div>
			<div class="table_right">				
				<input type="text" name="val[title]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['app_title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['app_title']) : (isset($this->_aVars['aForms']['app_title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['app_title']) : '')); ?>
" size="40" />
			</div>
		</div>
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('apps.category'); ?>:
			</div>
			<div class="table_right">
				<select name="val[category]">
<?php if (count((array)$this->_aVars['aCategories'])):  foreach ((array) $this->_aVars['aCategories'] as $this->_aVars['aCategory']): ?>
						<option value="<?php echo $this->_aVars['aCategory']['category_id']; ?>" <?php if ($this->_aVars['aApp']['category_id'] == $this->_aVars['aCategory']['category_id']): ?>selected="selected"<?php endif; ?>><?php echo Phpfox::getLib('locale')->convert($this->_aVars['aCategory']['category_name']); ?></option>
<?php endforeach; endif; ?>
				</select>
			</div>
		</div>		
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('apps.description'); ?>:
			</div>
			<div class="table_right">				
				<textarea cols="40" rows="6" name="val[description]"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['app_description']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['app_description']) : (isset($this->_aVars['aForms']['app_description']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['app_description']) : '')); ?>
</textarea>
			</div>
		</div>		

	</div>

	<div id="js_apps_block_photo" class="js_apps_block page_section_menu_holder">
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('apps.upload_new_picture'); ?>:
			</div>
			<div class="right">
<?php if (! empty ( $this->_aVars['aApp']['image_path'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => 0,'path' => 'app.url_image','file' => $this->_aVars['aApp']['image_path'],'suffix' => '_square','max_width' => 75,'max_height' => 75,'title' => $this->_aVars['aApp']['app_title'])); ?> <br />
<?php endif; ?>
				<input type="file" name="image" />
			</div>
		</div>			
	</div>

	<div id="js_apps_block_url" class="js_apps_block page_section_menu_holder">
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('apps.call_home_url'); ?>:
			</div>
			<div class="table_right">
				<input type="text" name="val[app_url]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['app_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['app_url']) : (isset($this->_aVars['aForms']['app_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['app_url']) : '')); ?>
" size="80" />
				<div class="extra_info">
					This is the URL to your application.
				</div>	
			</div>
		</div>
	</div>
	
	<div class="table_clear">
		<input type="submit" value="<?php echo Phpfox::getPhrase('apps.update'); ?>" class="button" />
	</div>

</form>

<?php endif; ?>
