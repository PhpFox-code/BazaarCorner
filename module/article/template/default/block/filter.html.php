<?php 
 
defined('PHPFOX') or exit('NO DICE!'); 

?>

<form method="post" action="{if empty($sCategoryUrl)}{url link=$sParentLink}{else}{url link=''$sParentLink'.'$sCategoryUrl''}{/if}">

<div class="p_4">
	Keyword:
	<div class="p_4">
		{filter key='keyword'}
	</div>
</div>

<div class="clear"></div>
	<div class="p_10">
		<input name="search[submit]" value="Submit" class="button" type="submit" />
		<input name="search[reset]" value="Reset" class="button" type="submit" />	
	</div>	
</form>
