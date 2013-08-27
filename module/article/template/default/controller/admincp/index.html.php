<?php 
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div id="js_menu_drop_down" style="display:none;">
	<div class="link_menu dropContent" style="display:block;">
		<ul>
			<li><a href="#" onclick="return Phpfox.article.action(this, 'edit');">edit</a></li>
			<li><a href="#" onclick="return Phpfox.article.action(this, 'delete');">delete</a></li>
		</ul>
	</div>
</div>
<div class="table_header">
	Categories
</div>
<form method="post" action="{url link='admincp.article'}">
	<div class="table">
		<div class="sortable">
			{$sCategories}			
		</div>
	</div>
	<div class="table_clear">
		<input type="submit" value="Update Order" class="button" />
	</div>
</form>