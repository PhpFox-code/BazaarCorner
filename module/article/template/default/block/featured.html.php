<?php 

defined('PHPFOX') or exit('NO DICE!'); 

?>

{if count($aFArticles)}

	{foreach from=$aFArticles item=aFArticle name=articles}
		<div class="p_10{if $phpfox.iteration.articles/2} row1{else} row2{/if}{if $phpfox.iteration.articles==1} row_first{/if}">
				<div class=""><b><a href="{url link='article.view.'$aFArticle.title_url}">{$aFArticle.title}</a></b></div>
				<div class="extra_info">Posted on {$aFArticle.time_stamp|date} by {$aFArticle|user}</div>
				<div class="p_10">
					{$aFArticle.text_parsed|strip_tags|shorten:100:'...'}			
				</div>
			<div class="clear"></div>
		</div>
	{/foreach}

<div class="clear"></div>	
{else}
<div class="p_10">
	No article available yet.
</div>
{/if}