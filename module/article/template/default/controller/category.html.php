<?php 

defined('PHPFOX') or exit('NO DICE!'); 

?>

{if count($aArticles)}

	{foreach from=$aArticles item=aArticle name=articles}
		<div class="p_10{if $phpfox.iteration.articles/2} row1{else} row2{/if}{if $phpfox.iteration.articles==1} row_first{/if}">
			{if isset($aArticle.destination) && $aArticle.is_image==1}
			<div class="go_left t_center">
			<a href="{url link='article.view.'$aArticle.title_url}">
				{img server_id=$aArticle.server_id path='core.url_attachment' file=$aArticle.destination suffix='_thumb' width='120' max_width=120 class="hover_action" title=$aArticle.title}
			</a>
			</div>
			<div style="margin-left:130px;">
			{/if}		
			<div class=""><b><a href="{url link='article.view.'$aArticle.title_url}">{$aArticle.title}</a></b></div>
			<div class="extra_info">Posted on {$aArticle.time_stamp|date} by {$aArticle|user}</div>
			<div class="p_10">
				{$aArticle.text_parsed|strip_tags|shorten:300:'...'}			
			</div>
		{if $aArticle.user_id==Phpfox::getUserId()}
			<div class="p_top_8 t_right"><a href="{url link='article.add' id=$aArticle.article_id}">Edit Article</a> | <a href="{url link='article.delete' id=$aArticle.article_id}" class="sJsConfirm">Delete</a></div>
		{/if}
			
		{if isset($aArticle.destination) && $aArticle.is_image==1}</div>{/if}
		<div class="clear"></div>
		</div>
	{/foreach}

<div class="clear"></div>
	{unset var=$aArticle}
	<div class="t_right">
	{pager}
	</div>	
	
{else}
<div class="p_10">
	No article available yet.
</div>
{/if}