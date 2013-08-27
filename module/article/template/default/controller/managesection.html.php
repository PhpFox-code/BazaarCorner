<?php 

defined('PHPFOX') or exit('NO DICE!'); 

?>

<div class="main_break">

	<form method="post" action="{url link='article.managesection' ai=$aArticle.article_id}" id="js_form" name="js_form" >
		<div><input type="hidden" name="updateorder" value="1" /></div>
		<h3><a href="{url link='article.view.'$aArticle.title_url}">{$aArticle.title}</a></h3>
		
		{if count($aSectionList)}
		<div class="p_10">
			{foreach from=$aSectionList item=aSectionItem}
			<div class="p_4"><input type="text" name="val[{$aSectionItem.a_section_id}][ordering]" value="{$aSectionItem.ordering}" id="title" size="4" maxlength="3" style="text-align:center;"/> {$aSectionItem.title}<input type="hidden" name="val[{$aSectionItem.a_section_id}][secid]" value="{$aSectionItem.a_section_id}" /></div>
			{/foreach}					
		</div>
		{else}
			<div class="p_10">No sections found.</div>
		{/if}

	<div class="separate"></div>

		<div class="table_clear">
			<input type="submit" name="Submit" value="Update Order" class="button" />			
		</div>
	</form>

</div>