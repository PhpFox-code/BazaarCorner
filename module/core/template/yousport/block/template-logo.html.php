{if !empty($sStyleLogo)}
<div class="custom_logo"><a href="{url link=''}"><img src="{$sStyleLogo}" alt="{param var='core.site_title'}" /></a></div>
{else}
	{if trim(phpfox::getParam('core.site_title')) != ""}
		<div class="site-title"><a href="{url link=''}">{param var='core.site_title'}</a></div>
	{else}
		<div class="logo"><a href="{url link=''}"></a></div>
	{/if}
{/if}