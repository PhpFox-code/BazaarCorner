<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 9, 2013, 4:40 pm */ ?>
<?php if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
<div class="block<?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?> js_sortable<?php endif;  if (isset ( $this->_aVars['sCustomClassName'] )): ?> <?php echo $this->_aVars['sCustomClassName'];  endif; ?>"<?php if (isset ( $this->_aVars['sBlockBorderJsId'] )): ?> id="js_block_border_<?php echo $this->_aVars['sBlockBorderJsId']; ?>"<?php endif;  if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) && Phpfox ::getLib('module')->blockIsHidden('js_block_border_' . $this->_aVars['sBlockBorderJsId'] . '' )): ?> style="display:none;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['sHeader'] ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
		<div class="title <?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?>js_sortable_header<?php endif; ?>">		
<?php if (isset ( $this->_aVars['sBlockTitleBar'] )): ?>
<?php echo $this->_aVars['sBlockTitleBar']; ?>
<?php endif; ?>
<?php if (( isset ( $this->_aVars['aEditBar'] ) && Phpfox ::isUser())): ?>
			<div class="js_edit_header_bar">
				<a href="#" title="<?php echo Phpfox::getPhrase('core.edit_this_block'); ?>" onclick="$.ajaxCall('<?php echo $this->_aVars['aEditBar']['ajax_call']; ?>', 'block_id=<?php echo $this->_aVars['sBlockBorderJsId'];  if (isset ( $this->_aVars['aEditBar']['params'] )):  echo $this->_aVars['aEditBar']['params'];  endif; ?>'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_edit.png','alt' => '','class' => 'v_middle')); ?></a>				
			</div>
<?php endif; ?>
<?php if (true || isset ( $this->_aVars['sDeleteBlock'] )): ?>
			<div class="js_edit_header_bar js_edit_header_hover" style="display:none;">
<?php if (Phpfox ::getService('theme')->isInDnDMode()): ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')){
					$(this).parents('.block:first').remove(); $.ajaxCall('core.removeBlockDnD', 'sController=' + oParams['sController'] 
					+ '&amp;block_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>');} return false;"title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>
<?php else: ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')) { $(this).parents('.block:first').remove();
					$.ajaxCall('core.hideBlock', 'sController=' + oParams['sController'] + '&amp;type_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>&amp;block_id=' + $(this).parents('.block:first').attr('id')); } return false;" title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>				
<?php endif; ?>
			</div>
			
<?php endif; ?>
<?php if (empty ( $this->_aVars['sHeader'] )): ?>
<?php echo $this->_aVars['sBlockShowName']; ?>
<?php else: ?>
<?php echo $this->_aVars['sHeader']; ?>
<?php endif; ?>
              
                <!--  VIEW ALL !-->
<?php if (isset ( $this->_aVars['sLinkAll'] ) && ! isset ( $this->_aVars['aEditBar'] ) && ! isset ( $this->_aVars['sDeleteBlock'] )): ?>
                <a class="view_all_nav" href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['sLinkAll']); ?>"><?php echo Phpfox::getPhrase('yousport.view_all'); ?> <?php echo $this->_aVars['blk']; ?></a>
<?php unset($this->_aVars['sLinkAll']); ?>
<?php endif; ?>
            <!--  END VIEW ALL !-->
		</div>
           
<?php endif; ?>
<?php if (isset ( $this->_aVars['aEditBar'] )): ?>
	<div id="js_edit_block_<?php echo $this->_aVars['sBlockBorderJsId']; ?>" class="edit_bar" style="display:none;"></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aMenu'] ) && count ( $this->_aVars['aMenu'] )): ?>
	<div class="menu">
	<ul>
<?php if (count((array)$this->_aVars['aMenu'])):  $this->_aPhpfoxVars['iteration']['content'] = 0;  foreach ((array) $this->_aVars['aMenu'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['content']++; ?>
 
		<li class="<?php if (count ( $this->_aVars['aMenu'] ) == $this->_aPhpfoxVars['iteration']['content']): ?> last<?php endif;  if ($this->_aPhpfoxVars['iteration']['content'] == 1): ?> first active<?php endif; ?>"><a href="<?php echo $this->_aVars['sLink']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a></li>
<?php endforeach; endif; ?>
	</ul>
	<div class="clear"></div>
	</div>
<?php unset($this->_aVars['aMenu']); ?>
<?php endif; ?>
	<div class="content"<?php if (isset ( $this->_aVars['sBlockJsId'] )): ?> id="js_block_content_<?php echo $this->_aVars['sBlockJsId']; ?>"<?php endif; ?>>
<?php endif; ?>
		<?php




?>   

<?php if (count ( $this->_aVars['lst_ems'] ) > 0): ?>
    <?php echo '
		<script type="text/javascript">
		$Behavior.initBlockEmailSystemSettingsAccount = function (){
		$(\'#js_block_border_emailsystem_settings\').show();
		$(\'.page_section_menu ul li a\').each(function(){
		   if($(\'.page_section_menu ul li a\').index($(this))>0)
		   {
				$(this).bind(\'click\',function(){
			  $(\'#js_block_border_emailsystem_settings\').hide();
		   });
		   }   
		   else
		   {
			   $(this).bind(\'click\',function(){
			  $(\'#js_block_border_emailsystem_settings\').show();
		   });
		   }
		   
		});
		}
		</script>
	'; ?>

    <div class="extra_info m_s">
<?php if (isset ( $this->_aVars['user_ems_settings']['is_receiver_email'] ) && $this->_aVars['user_ems_settings']['is_receiver_email'] == 0): ?>
        <p id="m_s_p2" style="padding-bottom:5px ;">Select the letters you want to be received from system. If you want to be received email from system. <a href="javascript:void(0)" onclick="javascript:letter(1);return false;">Click here</a></p>  
        <p id="m_s_p1" style="padding-bottom:5px ;display:none;">Select the letters you want to be received from system. If you don't want to be received any more. <a href="javascript:void(0);" onclick="javascript:letter(0)">Click here</a></p>     
<?php else: ?>
        <p id="m_s_p1" style="padding-bottom:5px ;">Select the letters you want to be received from system. If you don't want to be received any more. <a href="javascript:void(0);" onclick="javascript:letter(0);return false;">Click here</a></p>      
        <p id="m_s_p2" style="padding-bottom:5px ;display:none;">Select the letters you want to be received from system. If you want to be received email from system. <a href="javascript:void(0);" onclick="javascript:letter(1);return false;">Click here</a></p>  
<?php endif; ?>
    </div>
<?php if (isset ( $this->_aVars['user_ems_settings']['is_receiver_email'] ) && $this->_aVars['user_ems_settings']['is_receiver_email'] == 0): ?>
<?php else: ?>
    <div id="sm_s_t">
    <span><label><font style="color: #333333;font-size: 11px;font-weight: bold;padding: 10px 0 0 0px;">Duration</font> <select name="duration_l" id="durtion_l" onchange="viewgroup_ems(this.value)">
        <option value="-1">All</option>
        <!--<option value="0">One Time</option>-->
        <option value="1">Daily</option>
        <option value="2">Weekly</option>
        <option value="3">Monthly</option>
    </select></label></span>
    <div class="lst_emalsys table" >
<?php if (count((array)$this->_aVars['lst_ems'])):  foreach ((array) $this->_aVars['lst_ems'] as $this->_aVars['index'] => $this->_aVars['ems']): ?>
<?php if (( ( $this->_aVars['ems']['weekly_email'] != 0 && in_array ( $this->_aVars['ems']['emailsystem_id'] , $this->_aVars['emsSystems'] ) && ( $this->_aVars['user_gender'] == $this->_aVars['ems']['gender_email'] || $this->_aVars['ems']['gender_email'] == 0 ) ) || ( $this->_aVars['ems']['type_id'] >= 3 ) )): ?>
            <div class="checkbox gr_<?php echo $this->_aVars['ems']['weekly_email']; ?>">
            <label><input class="checkbox_ls" type="checkbox" value="<?php echo $this->_aVars['ems']['emailsystem_id']; ?>" name="gr_<?php echo $this->_aVars['ems']['weekly_email']; ?>" <?php if (isset ( $this->_aVars['user_ems_settings']['emailsystem_list'] )):  if (in_array ( $this->_aVars['ems']['emailsystem_id'] , $this->_aVars['user_ems_settings']['emailsystem_list'] )): ?>checked<?php endif;  else: ?>checked<?php endif; ?>/><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['ems']['emailsystem_name']), 35, '...'); ?></label>
            </div>
<?php endif; ?>
<?php endforeach; endif; ?>
            <div class="checkbox gr_ot2" style="">
                   <label><input class="checkbox_ls" type="checkbox" value="ot2" name="gr_ot2" <?php if (isset ( $this->_aVars['user_ems_settings']['emailsystem_list'] )):  if (in_array ( 'ot2' , $this->_aVars['user_ems_settings']['emailsystem_list'] )): ?>checked<?php endif;  else: ?>checked<?php endif; ?>>Other Email Systems</label> 
            </div>
    </div>
       <a href="javascript:void(0)" onclick="javascript:savesettings()"><input style="margin-bottom:1px;" type="submit" class="button" value="Save"></a> <span id="ajaxLoadding"></span> 
    </div>
<?php endif; ?>
<?php endif; ?>
<?php echo '
<style type="text/css">
    .lst_emalsys
    {
        margin:10px 0;
    }
    .m_s
    {
         font-size: 12px;
    }
    #js_block_border_emailsystem_settings
    {
         border-bottom: 1px solid #DFDFDF;
        padding: 8px 4px;
        position: relative;
    }
</style>
'; ?>

<script type="text/javascript">
	<?php echo '
    /*$Behavior.initBlockEmailSystemSettingsAccount = function (){
		$(\'#js_block_border_emailsystem_settings\').show();
		$(\'.page_section_menu ul li a\').each(function(){
		if($(\'.page_section_menu ul li a\').index($(this))>0)
		{
			$(this).bind(\'click\',function(){
			$(\'#js_block_border_emailsystem_settings\').hide();
			});
		}   
		else
		{
			$(this).bind(\'click\',function(){
			$(\'#js_block_border_emailsystem_settings\').show();
			});
		}
   
		});
	}*/

    function viewgroup_ems(v)
    {
        for(index = 0 ; index < 4 ; index++)
        {
            var view_g_v =\'.gr_\'+index;  
            
            if(v == index || v == -1)
            {
                $(view_g_v).show();
            }
            else
            {
                $(view_g_v).hide();    
            }
        }
    }
    function letter(value)
    {
        
        $.ajaxCall(\'emailsystem.changeletter\',\'st=\'+value);  
    }
    function savesettings()
    {
        $(\'#ajaxLoadding\').html($.ajaxProcess(\'\'));
        var length = 0;
        length = $(\'.checkbox_ls:checked\').length;
        var is_receiver_email = 1;
        var val = [];
        $(\'.checkbox_ls:checked\').each(function(i){
          val[i] = $(this).val();
        });
        if(length == 0)
        {
            if(confirm("Are you sure disable emailsystem.You do not receive any email from system ?")) 
            {
                 is_receiver_email = 0;
            }
        }
        $.ajaxCall(\'emailsystem.saveSetting\',\'lst=\'+val+\'&is_receiver_email=\'+is_receiver_email);
    }
    function reloadPage()
    {

        if(!document.getElementById(\'lst_emalsys\'))
        {
            window.location.href = self.location.href;
            
        }
    }    
	'; ?>

</script>




		
		
<?php if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
	</div>
<?php if (isset ( $this->_aVars['aFooter'] ) && count ( $this->_aVars['aFooter'] )): ?>
	<div class="bottom">
		<ul>
<?php if (count((array)$this->_aVars['aFooter'])):  $this->_aPhpfoxVars['iteration']['block'] = 0;  foreach ((array) $this->_aVars['aFooter'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['block']++; ?>

				<li id="js_block_bottom_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"<?php if ($this->_aPhpfoxVars['iteration']['block'] == 1): ?> class="first"<?php endif; ?>>
<?php if ($this->_aVars['sLink'] == '#'): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'ajax_image')); ?>
<?php endif; ?>
					<a href="<?php echo $this->_aVars['sLink']; ?>" id="js_block_bottom_link_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a>
				</li>
<?php endforeach; endif; ?>
		</ul>
	</div>
<?php endif; ?>
</div>
<?php unset($this->_aVars['sHeader'], $this->_aVars['sModule'], $this->_aVars['sComponent'], $this->_aVars['aFooter'], $this->_aVars['sBlockBorderJsId'], $this->_aVars['bBlockDisableSort'], $this->_aVars['bBlockCanMove'], $this->_aVars['aEditBar'], $this->_aVars['sDeleteBlock'], $this->_aVars['sBlockTitleBar'], $this->_aVars['sBlockJsId'], $this->_aVars['sCustomClassName']); ?>
<?php endif; ?>

<?php Phpfox::getBlock('ad.inner', array('sClass' => $this->_aVars['sClass'])); ?>
