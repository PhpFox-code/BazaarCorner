<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: February 25, 2013, 5:25 am */ ?>
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
<?php if ($this->_aVars['aListings']):  if (count((array)$this->_aVars['aListings'])):  foreach ((array) $this->_aVars['aListings'] as $this->_aVars['iKey'] => $this->_aVars['aListing']): ?>
<?php /* Cached: February 25, 2013, 5:25 am */ ?>
<div class="grid" >     
    <div class="grid-inner-block">   
     
                  
        <a href="<?php echo $this->_aVars['aListing']['url']; ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean(Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aListing']['title'])); ?>">
<?php if ($this->_aVars['aListing']['image_path'] != NULL): ?>
            <div class="imgholder"><img style="width:250px;height:<?php echo $this->_aVars['aListing']['image_height']; ?>" title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['aListing']['image_path']; ?>"/>
            <div style="position:absolute; bottom:8px; right:8px; width:46px; height:20px;"><a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fbazaarcorner.com%2F&media=<?php echo $this->_aVars['aListing']['url']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div></div>
<?php else: ?>
            <div class="imgholder"><img style="width:170px;height:<?php echo $this->_aVars['aListing']['image_height']; ?>" title="<?php echo $this->_aVars['aListing']['title']; ?>" src="<?php echo $this->_aVars['corepath']; ?>module/advancedmarketplace/static/image/default/noimage.png"  /></div>
<?php endif; ?>
        </a>
        <p>
<?php if ($this->_aVars['aListing']['price'] > 0): ?>
            <div style="background-color:#E3E3E3;border-radius: 5px; font-size: 18px; position:absolute;top:13px; padding-right: 5px;padding-left: 3px;padding-bottom: 2px;padding-top: 2px;left: 10px;"><img src="http://www.bazaarcorner.com/images/tag.png" width="20" height="20" /><font color="#000000"> <?php echo Phpfox::getService('core.currency')->getSymbol($this->_aVars['aListing']['currency_id']);  echo $this->_aVars['aListing']['price']; ?></font></div>
<?php endif; ?>
        </p>
        <div class="meta">	  
          
             
             
             
             
<div class="fb-like" data-href="<?php echo $this->_aVars['aListing']['url']; ?>" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="lucida grande"> </div>
            <div class="clear"></div>
            <a href="<?php echo $this->_aVars['aListing']['url']; ?>"><?php echo $this->_aVars['aListing']['title']; ?></a>
            
            <ul class="icons-order-list">
                <li>
                <?php
                    $past_time = $this->_aVars["aListing"]["time_stamp"];
                    $current_time = time();
                    $diff = $current_time - $past_time;
                    $days = floor($diff/(24*60*60));
                    $remainder = $diff - $days*(24*60*60);
                    $hours = floor($remainder/3600);
                    $remainder = $remainder - ($hours*60*60);
                    $minutes = floor($remainder/60);
                    $seconds = $remainder-$minutes*60;
                    echo $days>0 ? $days .'D': ($hours>0 ? $hours. 'H':($minutes>0?$minutes .'M':''));
                    ?>
                </li>
               
                <li class="comment">
<?php echo $this->_aVars['aListing']['aFeed']['total_comment']; ?>
                </li>
                <li class="buyit">
<?php if ($this->_aVars['aListing']['price'] > 0): ?>
                    <a href="<?php echo $this->_aVars['aListing']['url']; ?>">Grab It</a>
<?php else: ?>
                    <a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aListing']['user_name']); ?>">Contact Seller</a>
<?php endif; ?>
                </li>
            </ul>
        </div>           
    </div>     
    <div>         
<?php Phpfox::getBlock('advancedmarketplace.comment', array('aFeed' => $this->_aVars['aListing']['aFeed'],'feed_display' => 'mini')); ?>
    </div>
    <div class="add-comment"> 
        <a href="<?php if (! Phpfox ::isUser()):  echo Phpfox::getLib('phpfox.url')->makeUrl('user.login');  endif; ?>" <?php if (Phpfox ::isUser()): ?>onclick="popupComment(<?php echo $this->_aVars['aListing']['aFeed']['item_id']; ?>);return false;"<?php endif; ?>>Add Comment</a>
<?php if ($this->_aVars['aListing']['aFeed']['total_comment'] > 3): ?><span style="color:#EFE3E5;">|</span><a style="padding:0px 5px;" href="<?php echo $this->_aVars['aListing']['url']; ?>">View All</a><?php endif; ?>
    </div>
</div>
<?php endforeach; endif;  endif; ?>

		
		
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
<?php unset($this->_aVars['sHeader'], $this->_aVars['sModule'], $this->_aVars['sComponent'], $this->_aVars['aFooter'], $this->_aVars['sBlockBorderJsId'], $this->_aVars['bBlockDisableSort'], $this->_aVars['bBlockCanMove'], $this->_aVars['aEditBar'], $this->_aVars['sDeleteBlock'], $this->_aVars['sBlockTitleBar'], $this->_aVars['sBlockJsId'], $this->_aVars['sCustomClassName']);  endif; ?>

<?php Phpfox::getBlock('ad.inner', array('sClass' => $this->_aVars['sClass'])); ?>
