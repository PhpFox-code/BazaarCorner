<?php 

defined('PHPFOX') or exit('NO DICE!'); 

?>

{$sCreateJs}
<div class="main_break">

	<form method="post" action="{url link='article.addsection' ai=$aArticle.article_id}" id="js_form" name="js_form" onsubmit="{$sGetJsForm}" >
		{if isset($aForms.a_section_id)}<div><input type="hidden" name="id" value="{$aForms.a_section_id}"></div>{/if}
		<div><input type="hidden" name="val[ai]" value="{$aArticle.article_id}"></div>
		<h3><a href="{url link='article.view.'$aArticle.title_url}">{$aArticle.title}</a></h3>
		
		{if count($aSectionList)}
		<div class="table">
			<div class="table_left">Assign to Section:</div>
			<div class="table_right">				
								
					<select name="val[parent_sec_id]" id="parent_sec_id" >						
							<option value="" >-</option>
							{foreach from=$aSectionList item=aSectionItem}																
								{if $aSectionItem.parent_sec_id==0}
									{if isset($aForms.a_section_id) && $aForms.a_section_id!==$aSectionItem.a_section_id}
										{if $aForms.parent_sec_id==$aSectionItem.a_section_id}																	
											<option value="{$aSectionItem.a_section_id}" {if $aForms.parent_sec_id==$aSectionItem.a_section_id}selected{/if}>{$aSectionItem.title}</option>								
										{else}
											<option value="{$aSectionItem.a_section_id}" >{$aSectionItem.title}</option>
										{/if}
									{elseif !isset($aForms.a_section_id)}
											<option value="{$aSectionItem.a_section_id}" >{$aSectionItem.title}</option>
									{/if}
								{/if}
							{/foreach}
					</select> 																		
			</div>
		</div>
		{/if}

		<div class="table">
			<div class="table_left">
			{required}<label for="category">Category:</label>
			</div>
			<div class="table_right">
				{$sCategories}
			</div>
		</div>	
		
		<div class="table">
			<div class="table_left">
				{required}<label for="title"><strong>Section Title:</strong></label>
			</div>
			<div class="table_right">
				<input type="text" name="val[title]" value="{value type='input' id='title'}" id="title" size="50" maxlength="70" />
			</div>
			<div class="clear"></div>	
		</div>		

		<div class="table">
			<div class="table_left">
				{required} Section Text:
			</div>
			<div class="table_right">				
				{editor id='text'}
			</div>
			<div class="clear"></div>
		</div>	

		<div class="table">
			<div class="table_left">
				Publish:
			</div>
			<div class="table_right">	
				<div class="item_is_active_holder">		
					<span class="js_item_active item_is_active"><input type="radio" name="val[is_published]" value="1" {value type='radio' id='is_published' default='1' }/> {phrase var='core.yes'}</span>
					<span class="js_item_active item_is_not_active"><input type="radio" name="val[is_published]" value="0" {value type='radio' id='is_published' default='0' selected='true'}/> {phrase var='core.no'}</span>
				</div>
			</div>
			<div class="clear"></div>		
		</div>

	<div class="separate"></div>

		<div class="table_clear">
			<input type="submit" name="Submit" value="Submit" class="button" />			
		</div>
	</form>

</div>