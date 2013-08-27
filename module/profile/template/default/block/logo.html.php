<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Profile
 * @version 		$Id: logo.html.php 4230 2012-06-07 14:52:19Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{if $bRefreshPhoto}
<div class="cover_photo_link">
{else}
<a href="{permalink module='photo' id=$aCoverPhoto.photo_id title=$aCoverPhoto.title}userid_{$aCoverPhoto.user_id}/" class="thickbox photo_holder_image cover_photo_link" rel="{$aCoverPhoto.photo_id}">
{/if}
	{if $bRefreshPhoto || $bNewCoverPhoto}
	{img id='js_photo_cover_position' server_id=$aCoverPhoto.server_id path='photo.url_photo' file=$aCoverPhoto.destination suffix='_1024' width=980 title=$aCoverPhoto.title style='position:absolute; top:'$sLogoPosition'px; left:0px;' time_stamp=true}
	{else}
	{img id='js_photo_cover_position' server_id=$aCoverPhoto.server_id path='photo.url_photo' file=$aCoverPhoto.destination suffix='_1024' width=980 title=$aCoverPhoto.title style='position:absolute; top:'$sLogoPosition'px; left:0px;'}
	{/if}
{if $bRefreshPhoto}
</div>
{else}
</a>
{/if}
{if $bRefreshPhoto}
{literal}
<style type="text/css">
	#js_photo_cover_position
	{
		cursor:move;
	}
</style>
<script type="text/javascript">
var sCoverPosition = '0';	
$Behavior.positionCoverPhoto = function(){
	$('#js_photo_cover_position').draggable({
		axis: 'y',
		cursor: 'move',	
		stop: function(event, ui){
			var sStop = $(this).position();
			sCoverPosition = sStop.top;			
		}
	});	
}
</script>
{/literal}
{/if}
{if $bRefreshPhoto}
<div class="cover_photo_change">
	{phrase var='user.drag_to_reposition_cover'}
	<form method="post" action="#">
		<ul class="table_clear_button">			
			<li><div><input type="button" class="button button_off" value="{phrase var='user.cancel_cover_photo'}" name="cancel" onclick="window.location.href='{url link='profile'}';" /></div></li>
			<li><div><input type="button" class="button" value="{phrase var='user.save_changes'}" name="save" onclick="$.ajaxCall('user.updateCoverPosition', 'position=' + sCoverPosition); return false;" /></div></li>
		</ul>
		<div class="clear"></div>
	</form>
</div>
{/if}