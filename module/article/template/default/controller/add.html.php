<?php 

defined('PHPFOX') or exit('NO DICE!'); 

?>

{$sCreateJs}
<div class="main_break">

	<form method="post" action="{url link='article.add'}" id="js_form" name="js_form" onsubmit="{$sGetJsForm}" enctype="multipart/form-data">
		{if isset($aForms.article_id)}
			<div><input type="hidden" name="id" value="{$aForms.article_id}"></div>			
		{/if}
		<div><input type="hidden" name="val[attachment]" id="js_attachment" value="{value type='input' id='attachment'}" /></div>
		
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
				{required}<label for="text"><strong>Title:</strong></label>
			</div>
			<div class="table_right">
				<input type="text" name="val[title]" value="{value type='input' id='title'}" id="title" size="50" maxlength="70" /> {if isset($aForms.article_id)}<a href="{url link='article.view.'$aForms.title_url}">view</a>{/if}
			</div>
			<div class="clear"></div>	
		</div>		

		<div class="table">
			<div class="table_left">
				{required} Text:
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