<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: August 3, 2013, 10:45 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: design.html.php 4444 2012-07-02 10:23:15Z Miguel_Espinoza $
 */
 
 

?>
<div id="js_style_holder">
	<div class="style_header">
		<div class="style_top_menu">
			<a href="#" id="js_designer_full_screen" title="<?php echo Phpfox::getPhrase('theme.full_screen'); ?>: <?php echo $this->_aVars['aDesigner']['design_header']; ?>" class="no_ajax_link"><?php echo Phpfox::getPhrase('theme.full_screen'); ?></a> |
			<a href="#" id="js_toggle_designer_content" title="<?php echo Phpfox::getPhrase('theme.toggle'); ?>: <?php echo $this->_aVars['aDesigner']['design_header']; ?>" class="no_ajax_link"><?php echo Phpfox::getPhrase('theme.toggle'); ?></a> |
<?php if (! isset ( $this->_aVars['aDesigner']['hide_block_link'] )): ?>
			<a href="#" id="js_toggle_blocks" title="<?php echo Phpfox::getPhrase('theme.toggle_all_blocks'); ?>" class="no_ajax_link"><?php echo Phpfox::getPhrase('theme.blocks'); ?></a> |
<?php endif; ?>
			<a href="<?php echo $this->_aVars['aDesigner']['current_page']; ?>" class="no_ajax_link"><?php echo Phpfox::getPhrase('theme.close'); ?></a>
		</div>
<?php echo $this->_aVars['aDesigner']['design_header']; ?>
	</div>		
	<div id="js_designer_content">
		<div class="style_content_left">
			<ul>
				<li><a href="#theme" class="active"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/color_wheel.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('theme.themes'); ?></a></li>					
<?php if (isset ( $this->_aVars['aBlocks'] )): ?>
				<li><a href="#block"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/shape_square_add.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('theme.blocks'); ?></a></li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aAdvanced'] )): ?>
				<li><a href="#advanced"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/color_swatch.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('theme.advanced'); ?></a>
				<li><a href="#css"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/page_white_code.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('theme.css'); ?></a>
				</li>
<?php endif; ?>
			</ul>
		</div>
<?php if (isset ( $this->_aVars['aAdvanced'] )): ?>
		<div class="style_separate"></div>		
		<div class="style_content_middle">			
			<ul>
<?php if (count((array)$this->_aVars['aAdvanced'])):  $this->_aPhpfoxVars['iteration']['css'] = 0;  foreach ((array) $this->_aVars['aAdvanced'] as $this->_aVars['aEdit']):  $this->_aPhpfoxVars['iteration']['css']++; ?>

				<li><a href="#<?php echo $this->_aVars['aEdit']['id']; ?>"<?php if ($this->_aPhpfoxVars['iteration']['css'] == 1): ?> class="active"<?php endif; ?>><?php echo $this->_aVars['aEdit']['block']; ?></a><span style="display:none;"><?php echo $this->_aVars['aEdit']['name']; ?></span></li>
<?php endforeach; endif; ?>
			</ul>
		</div>					
<?php endif; ?>
		<div class="style_separate"></div>
		<div class="style_content_right">
			<div class="js_designer_section" id="js_designer_theme">
<?php if ($this->_aVars['iTestStyleId']): ?>
				<form method="post" action="#" onsubmit="$(this).ajaxCall('theme.updateTheme'); return false;">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
					<div><input type="hidden" name="style_id" value="<?php echo $this->_aVars['iTestStyleId']; ?>" /></div>
					<div><input type="hidden" name="type_id" value="<?php echo $this->_aVars['aDesigner']['type_id']; ?>" /></div>
					<div><input type="hidden" name="item_id" value="<?php echo $this->_aVars['aDesigner']['item_id']; ?>" /></div>
					<div class="style_submit_box style_submit_box_theme">
						<input type="submit" value="<?php echo Phpfox::getPhrase('theme.use_theme'); ?>" class="button" />		
					</div>			
				
</form>

<?php else: ?>
			<br />
<?php endif; ?>

			<div class="style_main_content" style="padding:4px 0px 0px 4px;">				
<?php if (count((array)$this->_aVars['aStlyes'])):  foreach ((array) $this->_aVars['aStlyes'] as $this->_aVars['aStyle']): ?>
				<form method="post" action="<?php echo $this->_aVars['aDesigner']['design_page']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
					<div><input type="hidden" name="test_style_id" value="<?php echo $this->_aVars['aStyle']['style_id']; ?>" /></div>
					<div class="style_box<?php if ($this->_aVars['aDesigner']['current_style_id'] == $this->_aVars['aStyle']['style_id']): ?> style_box_active<?php endif;  if ($this->_aVars['iTestStyleId'] == $this->_aVars['aStyle']['style_id']): ?> style_box_test<?php endif; ?>">
						<a href="#" onclick="$(this).parents('form:first').submit(); return false;"><?php echo $this->_aVars['aStyle']['name']; ?></a>		
						<div style="padding-top:5px;">
							<a href="#" onclick="$(this).parents('form:first').submit(); return false;">
								<img src="<?php echo $this->_aVars['aStyle']['sample_image']; ?>" alt="" />
							</a>
						</div>
					</div>				
				
</form>

<?php endforeach; endif; ?>
				<div class="clear"></div>							
			</div>					
	</div>
<?php if (isset ( $this->_aVars['aAdvanced'] )): ?>
	<div class="js_designer_section" id="js_designer_css" style="display:none;">		
		<form method="post" action="<?php echo $this->_aVars['aDesigner']['design_page']; ?>" onsubmit="$('.js_save_css_code_button').addClass('disabled'); $('#js_save_css_code').show(); $(this).ajaxCall('theme.processCss'); return false;">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
			<div><input type="hidden" name="type_id" value="<?php echo $this->_aVars['aDesigner']['type_id']; ?>" /></div>
			<div class="style_submit_box">
				<input type="hidden" name="action" value="" />
				<input type="submit" value="<?php echo Phpfox::getPhrase('theme.save'); ?>" name="save" class="button js_save_css_code_button" onclick="action.value = 'save';"/>
				<input type="submit" value="<?php echo Phpfox::getPhrase('theme.preview'); ?>" name="preview" class="button button_off js_save_css_code_button"  onclick="action.value = 'preview';" />
				<span id="js_save_css_code" style="display:none;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/small.gif','class' => 'v_middle')); ?></span>
			</div>
			<div class="p_4">
				<textarea cols="60" rows="6" name="css" style="width:98%;" id="js_css_code_editor"><?php if (isset ( $this->_aVars['aDesigner']['css_code'] )):  echo Phpfox::getLib('parse.output')->htmlspecialchars($this->_aVars['aDesigner']['css_code']);  endif; ?></textarea>					
			</div>					
		
</form>

	</div>
					
	<div class="js_designer_section" id="js_designer_advanced" style="display:none;">										
		<form method="post" action="<?php echo $this->_aVars['aDesigner']['design_page']; ?>" id="js_cache_form_css">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
			<div><input type="hidden" name="reset_form" value="1" /></div>
			<div><input type="hidden" name="reset_group" value="<?php echo $this->_aVars['sResetGroup']; ?>" id="js_reset_group" /></div>
		
</form>

					
		<form id="user_design_profile" method="post" action="#" onsubmit="$('#js_save_css_button').attr('disabled', true).addClass('disabled'); $('#js_save_css').show(); $(this).ajaxCall('theme.updateCss'); return false;">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
			<div><input type="hidden" name="type_id" value="<?php echo $this->_aVars['aDesigner']['type_id']; ?>" /></div>
			<div class="style_submit_box">
				<div class="style_submit_box_revert">				
					<input type="button" value="<?php echo Phpfox::getPhrase('theme.revert_to_default'); ?>" class="button" onclick="if (confirm('<?php echo Phpfox::getPhrase('theme.are_you_sure_note_that_this_will_revert_all_your_changes_and_not_just_those_within_this_group', array('phpfox_squote' => true)); ?>')) <?php echo '{ $.ajaxCall(\'theme.revertDesign\'); } return false;" />
				'; ?>

				</div>
				<div class="style_submit_box_revert_save">
					<input type="submit" value="<?php echo Phpfox::getPhrase('theme.save'); ?>" class="button" id="js_save_css_button" /> <span id="js_save_css" style="display:none;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/small.gif','class' => 'v_middle')); ?></span>							
				</div>
			</div>
			<div class="style_main_content">
				<div class="p_4">
<?php if (count((array)$this->_aVars['aAdvanced'])):  $this->_aPhpfoxVars['iteration']['css'] = 0;  foreach ((array) $this->_aVars['aAdvanced'] as $this->_aVars['aEdit']):  $this->_aPhpfoxVars['iteration']['css']++; ?>

					<div class="js_designer_child_section" id="js_designer_child_<?php echo $this->_aVars['aEdit']['id']; ?>" style="display:none;">
		
<?php if (isset ( $this->_aVars['aEdit']['design']['width'] )): ?>
<?php echo Phpfox::getPhrase('theme.width'); ?>:
								<div class="p_2">
								<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][width]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'width', this.value);">
									<option value=""<?php if (empty ( $this->_aVars['aEdit']['value']['width'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aEdit']['design']['width'])):  foreach ((array) $this->_aVars['aEdit']['design']['width'] as $this->_aVars['sWidth']): ?>
									<option value="<?php echo $this->_aVars['sWidth']; ?>"<?php if (isset ( $this->_aVars['aEdit']['value']['width'] ) && $this->_aVars['aEdit']['value']['width'] == $this->_aVars['sWidth']): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sWidth']; ?></option>
<?php endforeach; endif; ?>
								</select>
								</div>
<?php endif; ?>
							
<?php if (isset ( $this->_aVars['aEdit']['design']['background'] )): ?>
								<fieldset>
									<legend><?php echo Phpfox::getPhrase('theme.background'); ?></legend>
<?php if (isset ( $this->_aVars['aEdit']['design']['background']['color'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.color'); ?>:
										<div class="p_2">
											<div><input class="js_colorpicker_div js_form_value" type="hidden" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][background-color]" value="<?php if (isset ( $this->_aVars['aEdit']['value']['background']['color'] )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEdit']['value']['background']['color']);  endif; ?>" size="20" /></div>
											<a href="#?name=<?php echo $this->_aVars['aEdit']['name']; ?>&amp;attr=background-color" class="colorpicker_select"<?php if (isset ( $this->_aVars['aEdit']['value']['background']['color'] )): ?> style="background-color:<?php echo $this->_aVars['aEdit']['value']['background']['color']; ?>;"<?php endif; ?>>Color</a>	
										</div>
									</div>
<?php endif; ?>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['background']['image'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.url'); ?>:
										<div class="p_2">
											<input class="js_form_value" type="text" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][background-image]" id="js_theme_url_<?php echo $this->_aVars['aEdit']['id']; ?>" value="<?php if (isset ( $this->_aVars['aEdit']['value']['background']['image'] )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEdit']['value']['background']['image']);  endif; ?>" size="20" onblur="return on_change_image(this);" />
											<a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('theme.attach_files', array('phpfox_squote' => true)); ?>', $.ajaxBox('attachment.add', 'height=500&width=600&category_id=theme&amp;item_id=<?php echo $this->_aVars['aDesigner']['item_id']; ?>&amp;input=js_theme_url_<?php echo $this->_aVars['aEdit']['id']; ?>')); return false;">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/attach.png','class' => 'v_middle')); ?>
											</a>
										</div>
									</div>
<?php endif; ?>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['background']['attachment'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.scroll'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][background-attachment]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'background-attachment', this.value);">
												<option value=""<?php if (isset ( $this->_aVars['aEdit']['value']['background']['attachment'] ) && empty ( $this->_aVars['aEdit']['value']['background']['attachment'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
												<option value="scroll"<?php if (isset ( $this->_aVars['aEdit']['value']['background']['attachment'] ) && $this->_aVars['aEdit']['value']['background']['attachment'] == 'scroll'): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.yes'); ?></option>
												<option value="fixed"<?php if (isset ( $this->_aVars['aEdit']['value']['background']['attachment'] ) && $this->_aVars['aEdit']['value']['background']['attachment'] == 'fixed'): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.no'); ?></option>
											</select>
										</div>
									</div>
<?php endif; ?>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['background']['position'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.position'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][background-position]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'background-position', this.value);">
												<option value=""<?php if (isset ( $this->_aVars['aEdit']['value']['background']['position'] ) && empty ( $this->_aVars['aEdit']['value']['background']['position'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aPositions'])):  foreach ((array) $this->_aVars['aPositions'] as $this->_aVars['sPosition']): ?>
													<option value="<?php echo $this->_aVars['sPosition']; ?>" <?php if (isset ( $this->_aVars['aEdit']['value']['background']['position'] ) && $this->_aVars['aEdit']['value']['background']['position'] == $this->_aVars['sPosition']): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sPosition']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>
<?php endif; ?>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['background']['repeat'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.repeat'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][background-repeat]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'background-repeat', this.value);">
												<option value=""<?php if (isset ( $this->_aVars['aEdit']['value']['background']['repeat'] ) && empty ( $this->_aVars['aEdit']['value']['background']['repeat'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
												<option value="no-repeat"<?php if (isset ( $this->_aVars['aEdit']['value']['background']['repeat'] ) && $this->_aVars['aEdit']['value']['background']['repeat'] == 'no-repeat'): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.do_not_repeat'); ?></option>
												<option value="repeat-x"<?php if (isset ( $this->_aVars['aEdit']['value']['background']['repeat'] ) && $this->_aVars['aEdit']['value']['background']['repeat'] == 'repeat-x'): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.across'); ?></option>
												<option value="repeat-y"<?php if (isset ( $this->_aVars['aEdit']['value']['background']['repeat'] ) && $this->_aVars['aEdit']['value']['background']['repeat'] == 'repeat-y'): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.down'); ?></option>
												<option value="repeat"<?php if (isset ( $this->_aVars['aEdit']['value']['background']['repeat'] ) && $this->_aVars['aEdit']['value']['background']['repeat'] == 'repeat'): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.tile'); ?></option>
											</select>
										</div>
									</div>
<?php endif; ?>
									
									<div class="clear"></div>
									
								</fieldset>
<?php endif; ?>
								
<?php if (isset ( $this->_aVars['aEdit']['design']['font'] )): ?>
								<fieldset>
									<legend><?php echo Phpfox::getPhrase('theme.font'); ?></legend>
<?php if (isset ( $this->_aVars['aEdit']['design']['font']['color'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.color'); ?>:
										<div class="p_2">
											<div><input class="js_colorpicker_div js_form_value" type="hidden" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][font-color]" value="<?php if (isset ( $this->_aVars['aEdit']['value']['font']['color'] )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEdit']['value']['font']['color']);  endif; ?>" size="20" /></div>
											<a href="#?name=<?php echo $this->_aVars['aEdit']['name']; ?>&amp;attr=font-color" class="colorpicker_select"<?php if (isset ( $this->_aVars['aEdit']['value']['font']['color'] )): ?> style="background-color:<?php echo $this->_aVars['aEdit']['value']['font']['color']; ?>;"<?php endif; ?>>Color</a>	
										</div>
									</div>
<?php endif; ?>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['font']['family'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.family'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][font-family]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'font-family', this.value);">
												<option value=""<?php if (isset ( $this->_aVars['aEdit']['value']['font']['family'] ) && empty ( $this->_aVars['aEdit']['value']['font']['family'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aFonts'])):  foreach ((array) $this->_aVars['aFonts'] as $this->_aVars['sFont']): ?>
													<option value="<?php echo $this->_aVars['sFont']; ?>" style="font-family:<?php echo $this->_aVars['sFont']; ?>;"<?php if (isset ( $this->_aVars['aEdit']['value']['font']['family'] ) && $this->_aVars['aEdit']['value']['font']['family'] == $this->_aVars['sFont']): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sFont']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>
<?php endif; ?>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['font']['size'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.size'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][font-size]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'font-size', this.value);">
												<option value=""<?php if (isset ( $this->_aVars['aEdit']['value']['font']['size'] ) && empty ( $this->_aVars['aEdit']['value']['font']['size'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aFontSizes'])):  foreach ((array) $this->_aVars['aFontSizes'] as $this->_aVars['iSize']): ?>
													<option value="<?php echo $this->_aVars['iSize']; ?>"<?php if (isset ( $this->_aVars['aEdit']['value']['font']['size'] ) && $this->_aVars['aEdit']['value']['font']['size'] == $this->_aVars['iSize']): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['iSize']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>
<?php endif; ?>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['font']['style'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.style'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][font-style]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'font-style', this.value);">
												<option value=""<?php if (isset ( $this->_aVars['aEdit']['value']['font']['style'] ) && empty ( $this->_aVars['aEdit']['value']['font']['style'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aFontStyles'])):  foreach ((array) $this->_aVars['aFontStyles'] as $this->_aVars['sStyle']): ?>
													<option value="<?php echo $this->_aVars['sStyle']; ?>"<?php if (isset ( $this->_aVars['aEdit']['value']['font']['style'] ) && $this->_aVars['aEdit']['value']['font']['style'] == $this->_aVars['sStyle']): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sStyle']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>
<?php endif; ?>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['font']['weight'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.weight'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][font-weight]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'font-weight', this.value);">
												<option value=""<?php if (isset ( $this->_aVars['aEdit']['value']['font']['weight'] ) && empty ( $this->_aVars['aEdit']['value']['font']['weight'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aFontWeights'])):  foreach ((array) $this->_aVars['aFontWeights'] as $this->_aVars['sWeight']): ?>
													<option value="<?php echo $this->_aVars['sWeight']; ?>"<?php if (isset ( $this->_aVars['aEdit']['value']['font']['weight'] ) && $this->_aVars['aEdit']['value']['font']['weight'] == $this->_aVars['sWeight']): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sWeight']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>
<?php endif; ?>
									
									<div class="clear"></div>
									
								</fieldset>
<?php endif; ?>
								
<?php if (isset ( $this->_aVars['aEdit']['design']['text'] )): ?>
								<fieldset>
									<legend><?php echo Phpfox::getPhrase('theme.text'); ?></legend>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['text']['align'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.align'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][text-align]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'text-align', this.value);">
												<option value=""<?php if (isset ( $this->_aVars['aEdit']['value']['text']['align'] ) && empty ( $this->_aVars['aEdit']['value']['text']['align'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aTextAlign'])):  foreach ((array) $this->_aVars['aTextAlign'] as $this->_aVars['sAlign']): ?>
													<option value="<?php echo $this->_aVars['sAlign']; ?>"<?php if (isset ( $this->_aVars['aEdit']['value']['text']['align'] ) && $this->_aVars['aEdit']['value']['text']['align'] == $this->_aVars['sAlign']): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sAlign']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>
<?php endif; ?>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['text']['transform'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.transform'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][text-transform]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'text-transform', this.value);">
												<option value=""<?php if (isset ( $this->_aVars['aEdit']['value']['text']['transform'] ) && empty ( $this->_aVars['aEdit']['value']['text']['transform'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aTextTransforms'])):  foreach ((array) $this->_aVars['aTextTransforms'] as $this->_aVars['sTransform']): ?>
													<option value="<?php echo $this->_aVars['sTransform']; ?>"<?php if (isset ( $this->_aVars['aEdit']['value']['text']['transform'] ) && $this->_aVars['aEdit']['value']['text']['transform'] == $this->_aVars['sTransform']): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sTransform']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>
<?php endif; ?>
									
<?php if (isset ( $this->_aVars['aEdit']['design']['text']['decoration'] )): ?>
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.decoration'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][text-decoration]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'text-decoration', this.value);">
												<option value=""<?php if (isset ( $this->_aVars['aEdit']['value']['text']['decoration'] ) && empty ( $this->_aVars['aEdit']['value']['text']['decoration'] )): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aTextDecorations'])):  foreach ((array) $this->_aVars['aTextDecorations'] as $this->_aVars['sDecoration']): ?>
													<option value="<?php echo $this->_aVars['sDecoration']; ?>"<?php if (isset ( $this->_aVars['aEdit']['value']['text']['decoration'] ) && $this->_aVars['aEdit']['value']['text']['decoration'] == $this->_aVars['sDecoration']): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sDecoration']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>
<?php endif; ?>
									
									<div class="clear"></div>

								</fieldset>
<?php endif; ?>
								
<?php if (isset ( $this->_aVars['aEdit']['design']['border'] )): ?>
<?php if (count((array)$this->_aVars['aEdit']['design']['border']['type'])):  foreach ((array) $this->_aVars['aEdit']['design']['border']['type'] as $this->_aVars['sBorderPlacement'] => $this->_aVars['bBorderValue']): ?>
								<fieldset>
									<legend><?php echo Phpfox::getPhrase('theme.border'); ?>: <?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['sBorderPlacement'], 'css_position'); ?></legend>
									
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.style'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][border-<?php echo $this->_aVars['sBorderPlacement']; ?>-style]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'border-<?php echo $this->_aVars['sBorderPlacement']; ?>-style', this.value);">
												<option value=""><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aBorderStyles'])):  foreach ((array) $this->_aVars['aBorderStyles'] as $this->_aVars['sBorderStyle']): ?>
												<option value="<?php echo $this->_aVars['sBorderStyle']; ?>"<?php if (( $this->_aVars['sBorderPlacement'] == 'top' && isset ( $this->_aVars['aEdit']['value']['border']['top']['style'] ) && $this->_aVars['aEdit']['value']['border']['top']['style'] == $this->_aVars['sBorderStyle'] ) || ( $this->_aVars['sBorderPlacement'] == 'right' && isset ( $this->_aVars['aEdit']['value']['border']['right']['style'] ) && $this->_aVars['aEdit']['value']['border']['right']['style'] == $this->_aVars['sBorderStyle'] ) || ( $this->_aVars['sBorderPlacement'] == 'bottom' && isset ( $this->_aVars['aEdit']['value']['border']['bottom']['style'] ) && $this->_aVars['aEdit']['value']['border']['bottom']['style'] == $this->_aVars['sBorderStyle'] ) || ( $this->_aVars['sBorderPlacement'] == 'left' && isset ( $this->_aVars['aEdit']['value']['border']['left']['style'] ) && $this->_aVars['aEdit']['value']['border']['left']['style'] == $this->_aVars['sBorderStyle'] )): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sBorderStyle']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>										
									
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.width'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][border-<?php echo $this->_aVars['sBorderPlacement']; ?>-width]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'border-<?php echo $this->_aVars['sBorderPlacement']; ?>-width', this.value);">
												<option value=""><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aBorderWidths'])):  foreach ((array) $this->_aVars['aBorderWidths'] as $this->_aVars['sBorderWidth']): ?>
												<option value="<?php echo $this->_aVars['sBorderWidth']; ?>"<?php if (( $this->_aVars['sBorderPlacement'] == 'top' && isset ( $this->_aVars['aEdit']['value']['border']['top']['width'] ) && $this->_aVars['aEdit']['value']['border']['top']['width'] == $this->_aVars['sBorderWidth'] ) || ( $this->_aVars['sBorderPlacement'] == 'right' && isset ( $this->_aVars['aEdit']['value']['border']['right']['width'] ) && $this->_aVars['aEdit']['value']['border']['right']['width'] == $this->_aVars['sBorderWidth'] ) || ( $this->_aVars['sBorderPlacement'] == 'bottom' && isset ( $this->_aVars['aEdit']['value']['border']['bottom']['width'] ) && $this->_aVars['aEdit']['value']['border']['bottom']['width'] == $this->_aVars['sBorderWidth'] ) || ( $this->_aVars['sBorderPlacement'] == 'left' && isset ( $this->_aVars['aEdit']['value']['border']['left']['width'] ) && $this->_aVars['aEdit']['value']['border']['left']['width'] == $this->_aVars['sBorderWidth'] )): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sBorderWidth']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>									
									
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.color'); ?>:
										<div class="p_2">
											<div><input class="js_colorpicker_div js_form_value" type="hidden" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][border-<?php echo $this->_aVars['sBorderPlacement']; ?>-color]" value="<?php if (( $this->_aVars['sBorderPlacement'] == 'top' && isset ( $this->_aVars['aEdit']['value']['border']['top']['color'] ) )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEdit']['value']['border']['top']['color']);  elseif (( $this->_aVars['sBorderPlacement'] == 'right' && isset ( $this->_aVars['aEdit']['value']['border']['right']['color'] ) )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEdit']['value']['border']['right']['color']);  elseif (( $this->_aVars['sBorderPlacement'] == 'bottom' && isset ( $this->_aVars['aEdit']['value']['border']['bottom']['color'] ) )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEdit']['value']['border']['bottom']['color']);  elseif (( $this->_aVars['sBorderPlacement'] == 'left' && isset ( $this->_aVars['aEdit']['value']['border']['left']['color'] ) )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEdit']['value']['border']['left']['color']);  endif; ?>" size="20" /></div>
											<a href="#?name=<?php echo $this->_aVars['aEdit']['name']; ?>&amp;attr=border-<?php echo $this->_aVars['sBorderPlacement']; ?>-color" class="colorpicker_select"<?php if (( $this->_aVars['sBorderPlacement'] == 'top' && isset ( $this->_aVars['aEdit']['value']['border']['top']['color'] ) )): ?> style="background-color:<?php echo $this->_aVars['aEdit']['value']['border']['top']['color']; ?>;"<?php elseif (( $this->_aVars['sBorderPlacement'] == 'right' && isset ( $this->_aVars['aEdit']['value']['border']['right']['color'] ) )): ?> style="background-color:<?php echo $this->_aVars['aEdit']['value']['border']['right']['color']; ?>;"<?php elseif (( $this->_aVars['sBorderPlacement'] == 'bottom' && isset ( $this->_aVars['aEdit']['value']['border']['bottom']['color'] ) )): ?> style="background-color:<?php echo $this->_aVars['aEdit']['value']['border']['bottom']['color']; ?>;"<?php elseif (( $this->_aVars['sBorderPlacement'] == 'left' && isset ( $this->_aVars['aEdit']['value']['border']['left']['color'] ) )): ?> style="background-color:<?php echo $this->_aVars['aEdit']['value']['border']['left']['color']; ?>;"<?php endif; ?>>Color</a>
										</div>
									</div>		
									
									<div class="clear"></div>
																
								</fieldset>					
<?php endforeach; endif; ?>
<?php endif; ?>
								
<?php if (isset ( $this->_aVars['aEdit']['design']['padding'] )): ?>
<?php if (count((array)$this->_aVars['aEdit']['design']['padding']['type'])):  foreach ((array) $this->_aVars['aEdit']['design']['padding']['type'] as $this->_aVars['sPaddingPlacement'] => $this->_aVars['bPaddingValue']): ?>
								<fieldset>
									<legend><?php echo Phpfox::getPhrase('theme.padding'); ?>: <?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['sPaddingPlacement'], 'css_position'); ?></legend>										
									
									<div class="go_left">
<?php echo Phpfox::getPhrase('theme.size'); ?>:
										<div class="p_2">
											<select class="js_form_value" name="css[<?php echo $this->_aVars['aEdit']['name']; ?>][padding-<?php echo $this->_aVars['sPaddingPlacement']; ?>]" onchange="return on_change_attr('<?php echo $this->_aVars['aEdit']['name']; ?>', 'padding-<?php echo $this->_aVars['sPaddingPlacement']; ?>', this.value);">
												<option value=""><?php echo Phpfox::getPhrase('theme.default'); ?></option>
<?php if (count((array)$this->_aVars['aPaddingSizes'])):  foreach ((array) $this->_aVars['aPaddingSizes'] as $this->_aVars['sPaddingSize']): ?>
												<option value="<?php echo $this->_aVars['sPaddingSize']; ?>"<?php if (( $this->_aVars['sPaddingPlacement'] == 'top' && isset ( $this->_aVars['aEdit']['value']['padding']['top'] ) && $this->_aVars['aEdit']['value']['padding']['top'] == $this->_aVars['sPaddingSize'] ) || ( $this->_aVars['sPaddingPlacement'] == 'right' && isset ( $this->_aVars['aEdit']['value']['padding']['right'] ) && $this->_aVars['aEdit']['value']['padding']['right'] == $this->_aVars['sPaddingSize'] ) || ( $this->_aVars['sPaddingPlacement'] == 'bottom' && isset ( $this->_aVars['aEdit']['value']['padding']['bottom'] ) && $this->_aVars['aEdit']['value']['padding']['bottom'] == $this->_aVars['sPaddingSize'] ) || ( $this->_aVars['sPaddingPlacement'] == 'left' && isset ( $this->_aVars['aEdit']['value']['padding']['left'] ) && $this->_aVars['aEdit']['value']['padding']['left'] == $this->_aVars['sPaddingSize'] )): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sPaddingSize']; ?></option>
<?php endforeach; endif; ?>
											</select>
										</div>
									</div>									
									
								</fieldset>					
<?php endforeach; endif; ?>
<?php endif; ?>
									
									<div style="margin-top:4px;">				
										<input type="button" value="<?php echo Phpfox::getPhrase('theme.reset'); ?>" class="button js_design_reset" id="js_reset_button_<?php echo $this->_aVars['aEdit']['id']; ?>" /> <span id="js_reset_span_<?php echo $this->_aVars['aEdit']['id']; ?>" style="display:none;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/small.gif','class' => 'v_middle')); ?></span>
									</div>								
											
								</div>						
							
							
<?php endforeach; endif; ?>
							</div>
							</div>	
														
						
</form>

					</div>
<?php endif; ?>
					
<?php if (isset ( $this->_aVars['aBlocks'] )): ?>
					<div class="js_designer_section" id="js_designer_block" style="display:none;">		
						<div style="position:relative; height:35px; padding:6px 0px 0px 0px;">
							<div style="position:absolute; right:7px; top:7px;">
								<input type="button" class="button" onclick="if (confirm(getPhrase('core.are_you_sure'))) { window.location.href='<?php echo $this->_aVars['aDesigner']['design_page']; ?>resetblock_true/'; }" value="<?php echo Phpfox::getPhrase('theme.reset'); ?>" />
							</div>
							<div class="extra_info">
<?php echo Phpfox::getPhrase('theme.click_on_the_blocks_below_to_hide_unhide_them'); ?>
							</div>														
						</div>						
						<div style="padding:4px 0px 0px 4px;">				
<?php if (count((array)$this->_aVars['aBlocks'])):  foreach ((array) $this->_aVars['aBlocks'] as $this->_aVars['aBlock']): ?>
							<div class="style_box<?php if ($this->_aVars['aBlock']['is_installed']): ?> style_box_active<?php endif; ?>">							
								<div><input type="hidden" name="js_block_installed" value="<?php if ($this->_aVars['aBlock']['is_installed']): ?>0<?php else: ?>1<?php endif; ?>" id="js_block_installed_<?php echo $this->_aVars['aBlock']['block_id']; ?>" /></div>
								<a href="#" onclick="if ($('#js_block_installed_<?php echo $this->_aVars['aBlock']['block_id']; ?>').val() == '0') { $('#js_block_installed_<?php echo $this->_aVars['aBlock']['block_id']; ?>').val('1'); $(this).parent().removeClass('style_box_active'); } else { $('#js_block_installed_<?php echo $this->_aVars['aBlock']['block_id']; ?>').val('0'); $(this).parent().addClass('style_box_active'); } if ($('#js_block_installed_<?php echo $this->_aVars['aBlock']['block_id']; ?>').val() == '1') { $('#js_block_border_<?php echo $this->_aVars['aBlock']['cache_id']; ?>').hide(); } else { $('#js_block_border_<?php echo $this->_aVars['aBlock']['cache_id']; ?>').show(); } $.ajaxCall('theme.updateBlock', 'val[item_id]=<?php echo $this->_aVars['aDesigner']['item_id']; ?>&amp;val[type_id]=<?php echo $this->_aVars['aDesigner']['type_id']; ?>&amp;val[cache_id]=<?php echo $this->_aVars['aBlock']['cache_id']; ?>&amp;val[is_installed]=' + $('#js_block_installed_<?php echo $this->_aVars['aBlock']['block_id']; ?>').val()); return false;"><?php echo Phpfox::getLib('locale')->convert($this->_aVars['aBlock']['title']); ?></a>
							</div>
<?php endforeach; endif; ?>
							<div class="clear"></div>							
						</div>						
					</div>					
<?php endif; ?>
				
			</div>
			<div class="clear"></div>
		</div>	
</div>
<?php echo $this->_aVars['sResetJs']; ?>
<?php echo '
<script type="text/javascript">
	$Behavior.customDesignPanelPush = function(){
		if ($Core.exists(\'#js_style_holder\')){
			$(\'body\').addClass(\'main_core_body_holder_class\');
		}
		else {
			$(\'body\').removeClass(\'main_core_body_holder_class\');
		}
	}
</script>
'; ?>

