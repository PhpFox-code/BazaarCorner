<?php 

defined('PHPFOX') or exit('NO DICE!'); 

?>

{if isset($aArticle.article_id)}
<div id="headline" class="p_10">
<div class="extra_info">Posted on {$aArticle.time_stamp|date} by {$aArticle|user} | {$aArticle.total_views} views</div>
	<div class="p_10">
		{$aArticle.text_parsed}
		
		{module name='attachment.list' sType=article iItemId=$aArticle.article_id}
				
		{if $aArticle.user_id==Phpfox::getUserId()}
			<div class="p_top_8 t_right">
			<a href="{url link='article.add' id=$aArticle.article_id}">Edit Article</a> | 
			<a href="{url link='article.addsection' ai=$aArticle.article_id}">Add a Section</a> | 
			<a href="{url link='article.my' ato=$aArticle.article_id}">Insert an Article</a> | 
			<a href="{url link='article.managesection' ai=$aArticle.article_id}">Manage Sections</a></div>
		{/if}
		
	</div>
	{if count($aSections)}
		<div class="go_left" style="border:1px solid #ccc;">
		<div class="p_4 t_center"><strong>Table of Contents</strong></div>
			<ol style="list-style-type:upper-roman;">
			{foreach from=$aSections item=aContent}
				{if $aContent.parent_sec_id==0}
					<li><a href="#{$aContent.a_section_id}">{$aContent.title}</a></li>
					<ol style="list-style-type:lower-alpha;">
					{foreach from=$aSections item=aSubContent name=subcontent}
						{if $aSubContent.parent_sec_id==$aContent.a_section_id}
							<li><a href="#{$aSubContent.a_section_id}">{$aSubContent.title}</a></li>
						{/if}					
					{/foreach}					
					</ol>
				{/if}
			{/foreach}					
			</ol>
		</div>
		<div class="clear"></div>
		{foreach from=$aSections item=aSection}
			{if $aSection.parent_sec_id==0}		
				<div class="p_10">
					<h2 id="{$aSection.a_section_id}" >{$aSection.title}</h2>
					<div class="p_10">
						{if $aSection.is_published==1}
							<div class="extra_info">Main Article &raquo; <a href="{url link='article.view.'$aSection.atitleurl}">{$aSection.atitle}</a></div>
						{/if}
						{$aSection.text_parsed}
					</div>
					{if $aSection.user_id==Phpfox::getUserId()}
						<div class="p_top_8 t_right" ><a href="#headline">Top</a> | <a href="{url link='article.addsection' ai=$aArticle.article_id id=$aSection.a_section_id}">Edit</a> | <a href="{url link='article.delsection' id=$aSection.a_section_id}">Remove</a></div>
					{else}
						<div class="p_top_8 t_right" ><a href="#headline">Top</a></div>
					{/if}
					
					{foreach from=$aSections item=aSubSection}
						{if $aSubSection.parent_sec_id==$aSection.a_section_id}		
							<div class="p_10">
								<h3 id="{$aSubSection.a_section_id}" style="border-bottom:1px solid #eee;">{$aSubSection.title}</h3>
								<div class="p_10">
									{if $aSubSection.is_published==1}
										<div class="extra_info">Main Article &raquo; <a href="{url link='article.view.'$aSubSection.atitleurl}">{$aSubSection.atitle}</a></div>
									{/if}
									{$aSubSection.text_parsed}
								</div>
								{if $aSubSection.user_id==Phpfox::getUserId()}
									<div class="p_top_8 t_right" ><a href="#headline">Top</a> | <a href="{url link='article.addsection' ai=$aArticle.article_id id=$aSubSection.a_section_id}">Edit</a> | <a href="{url link='article.delsection' id=$aSubSection.a_section_id}">Remove</a></div>
								{else}
									<div class="p_top_8 t_right" ><a href="#headline">Top</a></div>								
								{/if}
							</div>
						{/if}
					{/foreach}

				</div>
			{/if}
		{/foreach}
	{/if}
</div>
{else}
<div class="p_10">Article not found.</div>
{/if}